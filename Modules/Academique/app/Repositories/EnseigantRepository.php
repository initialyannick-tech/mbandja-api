<?php

namespace Modules\Academique\Repositories;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Models\Enseignant;
use Modules\Academique\Transformers\EnseignantResource;

class EnseigantRepository
{
    /**
     * Liste des enseignants sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $enseignants = Enseignant::all();
        return EnseignantResource::collection($enseignants);
    }

    /**
     * Création d'un enseignants
     *
     * @param [type] $data
     * @return false|Enseignant
     */
    public function store($data): false|Enseignant
    {
        $enseignant = new Enseignant;
        $enseignant->fill($data);
        if($enseignant->save()){
            return $enseignant;
        }
        return false;
    }

    /**
     * Récupérer tous les enseignants
     *
     * @return AnonymousResourceCollection
     */
    public function paginate(): AnonymousResourceCollection
    {
        $enseignants = Enseignant::orderBy('id', 'desc')->paginate(10);
        return EnseignantResource::collection($enseignants);
    }

    /**
     * Rechercher un enseignant par son nom, prenom, email
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        $enseignants = Enseignant::with('classes')->where(function ($query) use ($keyword) {
                $query->where('nom', 'like', "%{$keyword}%")
                     ->orWhere('prenom', 'like', "%{$keyword}%")
                     ->orWhere('specialite', 'like', "%{$keyword}%");
                })->paginate(10);
        return EnseignantResource::collection($enseignants);
    }


    /**
     * Récupérer un enseignant par son id
     *
     * @param [type] $id
     * @return EnseignantResource
     */
    public function show($id): EnseignantResource
    {
        $enseignant = Enseignant::where('id', $id)->with(['classes'])->first();
        return EnseignantResource::make($enseignant);
    }


    /**
     * Mettre à jour un enseignant
     *
     * @param [type] $id
     * @param [type] $data
     * @return false
     */
    public function update($id, $data)
    {
        $enseignant = Enseignant::find($id);
        $enseignant->fill($data);
        if ($enseignant->save()) {
             return $enseignant;
        }
        return false;
    }

    /**
     * Supprimer d'un enseignant
     *
     * @param [type] $id
     * @return true
     */
    public function delete($id): bool
    {
        $enseignant = Enseignant::find($id);
        if($enseignant->delete()){
            return true;
        }
        return false;
    }
}
