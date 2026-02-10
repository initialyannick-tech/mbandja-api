<?php

namespace Modules\Etudiant\Repositories;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Etudiant\Models\Etudiant;
use Modules\Etudiant\Transformers\EtudiantResource;

class EtudiantRepository
{
    /**
     * Liste des étudiants sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $etudiants = Etudiant::all();
        return EtudiantResource::collection($etudiants);
    }

    /**
     * Création d'un étudiants
     *
     * @param [type] $data
     * @return false|Etudiant
     */
    public function store($data): false|Etudiant
    {
        $etudiants = new Etudiant;
        $etudiants->fill($data);
        if($etudiants->save()){
            return $etudiants;
        }
        return false;
    }

    /**
     * Récupérer tous les étudiants
     *
     * @return AnonymousResourceCollection
     */
    public function paginate(): AnonymousResourceCollection
    {
        $etudiants = Etudiant::orderBy('id', 'desc')->paginate(10);
        return EtudiantResource::collection($etudiants);
    }

    /**
     * Rechercher un étudiant par son libelle
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        $etudiants = Etudiant::with('contacts', 'documents')->where(function ($query) use ($keyword) {
                $query->where('nom', 'like', "%{$keyword}%")
                    ->orWhere('prenom', 'like', "%{$keyword}%")
                    ->orWhere('telephone', 'like', "%{$keyword}%")
                    ->orWhere('matricule', 'like', "%{$keyword}%");
                })->paginate(10);
        return EtudiantResource::collection($etudiants);
    }


    /**
     * Récupérer un étudiant par son ID
     *
     * @param [type] $code
     * @return EtudiantResource
     */
    public function show($code): EtudiantResource
    {
        $etudiants = Etudiant::where('matricule', $code)->with(['contacts', 'documents'])->first();
        return EtudiantResource::make($etudiants);
    }


    /**
     * Mettre à jour un étudiant
     *
     * @param [type] $id
     * @param [type] $data
     * @return false
     */
    public function update($id, $data)
    {
        $etudiants = Etudiant::find($id);
        $etudiants->fill($data);
        if($etudiants->save()){
            return $etudiants;
        }
        return false;
    }

    /**
     * Supprimer un étudiant
     *
     * @param [type] $id
     * @return true
     */
    public function delete($id): bool
    {
        $etudiants = Etudiant::find($id);
        if($etudiants->delete()){
            return true;
        }
        return false;
    }
}
