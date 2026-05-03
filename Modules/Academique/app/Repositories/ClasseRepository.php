<?php

namespace Modules\Academique\Repositories;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Models\Classe;
use Modules\Academique\Transformers\ClasseRessource;

class ClasseRepository
{
    /**
     * Liste des classes sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $classes = Classe::all();
        return ClasseRessource::collection($classes);
    }

    /**
     * Création d'une classe
     *
     * @param [type] $data
     * @return false|Classe
     */
    public function store($data): false|Classe
    {
        $classe = new Classe;
        $classe->fill($data);
        if($classe->save()){
            return $classe;
        }
        return false;
    }

    /**
     * Récupérer tous les classes
     *
     * @return AnonymousResourceCollection
     */
    public function paginate(): AnonymousResourceCollection
    {
        $classes = Classe::orderBy('id', 'desc')->paginate(10);
        return ClasseRessource::collection($classes);
    }

    /**
     * Rechercher une classe par son libelle, code, session, cycle
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        $classes = Classe::with('session', 'cycle')->where(function ($query) use ($keyword) {
                $query->where('libelle', 'like', "%{$keyword}%")
                    ->orWhere('code', 'like', "%{$keyword}%");
                })->paginate(10);
        return ClasseRessource::collection($classes);
    }


    /**
     * Récupérer une classe par son CODE
     *
     * @param [type] $code
     * @return ClasseRessource
     */
    public function show($code): ClasseRessource
    {
        $classe = Classe::where('code', $code)->with(['session', 'cycle'])->first();
        return ClasseRessource::make($classe);
    }


    /**
     * Mettre à jour une classe
     *
     * @param [type] $id
     * @param [type] $data
     * @return false
     */
    public function update($id, $data)
    {
        $classe = Classe::find($id);
        if (!$classe) {
            return false;
        }
        $classe->fill($data);
        $classe->save();
        if (isset($data['semestres'])) {
            $classe->semestres()->sync($data['semestres']);
        }
        return $classe->load(['semestres', 'cycle', 'session']);
    }

    /**
     * Supprimer d'une classe
     *
     * @param [type] $id
     * @return true
     */
    public function delete($id): bool
    {
        $classe = Classe::find($id);
        if($classe->delete()){
            return true;
        }
        return false;
    }


    /**
     * Assigner une ou plusieurs matières à une classe
     *
     * @param array $data
     * @return Classe|false
     */
    public function assigneMatieres(array $data): Classe|false
    {
        $classe = Classe::find($data['classe_id']);
        if (!$classe) {
            return false;
        }
        $matieres = $data['matieres'] ?? [];
        if (empty($matieres)) {
            return false;
        }
        $classe->matieres()->sync($matieres);
        return $classe->load('matieres');
    }
}
