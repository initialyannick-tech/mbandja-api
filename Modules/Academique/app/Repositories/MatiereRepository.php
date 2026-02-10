<?php

namespace Modules\Academique\Repositories;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Models\Matiere;
use Modules\Academique\Transformers\MatiereRessource;

class MatiereRepository
{
    /**
     * Liste des matières sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $matieres = Matiere::all();
        return MatiereRessource::collection($matieres);
    }

    /**
     * Création d'une matières
     *
     * @param [type] $data
     * @return false|Matiere
     */
    public function store($data): false|Matiere
    {
        $matiere = new Matiere;
        $matiere->fill($data);
        if($matiere->save()){
            return $matiere;
        }
        return false;
    }

    /**
     * Récupérer tous les matières
     *
     * @return AnonymousResourceCollection
     */
    public function paginate(): AnonymousResourceCollection
    {
        $matieres = Matiere::orderBy('id', 'desc')->paginate(10);
        return MatiereRessource::collection($matieres);
    }

    /**
     * Rechercher une matière par son libelle, ordre, session
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        $matieres = Matiere::with('unite')->where(function ($query) use ($keyword) {
                $query->where('libelle', 'like', "%{$keyword}%")
                    ->orWhere('code', 'like', "%{$keyword}%");
                })->paginate(10);
        return MatiereRessource::collection($matieres);
    }


    /**
     * Récupérer une matière par son CODE
     *
     * @param [type] $code
     * @return MatiereRessource
     */
    public function show($code): MatiereRessource
    {
        $matieres = Matiere::where('code', $code)->with(['unite'])->first();
        return MatiereRessource::make($matieres);
    }


    /**
     * Mettre à jour une matière
     *
     * @param [type] $id
     * @param [type] $data
     * @return false
     */
    public function update($id, $data)
    {
        $matiere = Matiere::find($id);
        $matiere->fill($data);
        if($matiere->save()){
            return $matiere;
        }
        return false;
    }

    /**
     * Supprimer d'une matière
     *
     * @param [type] $id
     * @return true
     */
    public function delete($id): bool
    {
        $matiere = Matiere::find($id);
        if($matiere->delete()){
            return true;
        }
        return false;
    }
}
