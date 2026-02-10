<?php

namespace Modules\Academique\Repositories;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Models\Semestre;
use Modules\Academique\Transformers\SemestreRessource;

class SemestreRepository
{
     /**
     * Liste des semestres sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $semestres = Semestre::all();
        return SemestreRessource::collection($semestres);
    }

    /**
     * Création d'un semestre
     *
     * @param [type] $data
     * @return false|Session
     */
    public function store($data): false|Semestre
    {
        $maxOrdre = Semestre::max('ordre');
        $data['ordre'] = $maxOrdre !== null ? (string) ((int) $maxOrdre + 1): '1';
        $semestre = new Semestre;
        $semestre->fill($data);
        if($semestre->save()){
            return $semestre;
        }
        return false;
    }

    /**
     * Récupérer tous les semestres
     *
     * @return AnonymousResourceCollection
     */
    public function paginate(): AnonymousResourceCollection
    {
        $semestres = Semestre::orderBy('id', 'desc')->paginate(10);
        return SemestreRessource::collection($semestres);
    }

    /**
     * Rechercher un semestre par son libelle, ordre
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
         $emestre = Semestre::where(function ($query) use ($keyword) {
                $query->where('libelle', 'like', "%{$keyword}%")
                    ->orWhere('ordre', 'like', "%{$keyword}%");
            })->paginate(10);
        return SemestreRessource::collection($emestre);
    }


    /**
     * Récupérer un semestre par son id
     *
     * @param [type] $id
     * @return SemestreRessource
     */
    public function show($id): SemestreRessource
    {
        $semestre = Semestre::where('id', $id)->first();
        return SemestreRessource::make($semestre);
    }


    /**
     * Mettre à jour un semestre
     *
     * @param [type] $id
     * @param [type] $data
     * @return false
     */
    public function update($id, $data)
    {
        $semestre = Semestre::find($id);
        $semestre->fill($data);
        if($semestre->save()){
            return $semestre;
        }
        return false;
    }

    /**
     * Supprimer un semestre
     *
     * @param [type] $id
     * @return true
     */
    public function delete($id): bool
    {
        $semestre = Semestre::find($id);
        if($semestre->delete()){
            return true;
        }
        return false;
    }
}
