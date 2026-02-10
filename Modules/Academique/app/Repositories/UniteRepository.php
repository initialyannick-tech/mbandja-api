<?php

namespace Modules\Academique\Repositories;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Models\Unite;
use Modules\Academique\Transformers\UniteRessource;

class UniteRepository
{
    /**
     * Liste des unités sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $unites = Unite::all();
        return UniteRessource::collection($unites);
    }

    /**
     * Création d'une unités
     *
     * @param [type] $data
     * @return false|Unite
     */
    public function store($data): false|Unite
    {
        $unite = new Unite;
        $unite->fill($data);
        if($unite->save()){
            return $unite;
        }
        return false;
    }

    /**
     * Récupérer tous les unités
     *
     * @return AnonymousResourceCollection
     */
    public function paginate(): AnonymousResourceCollection
    {
        $unites = Unite::orderBy('id', 'desc')->paginate(10);
        return UniteRessource::collection($unites);
    }

    /**
     * Rechercher une unités par son libelle, code, session, classe & semestre
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search(string $keyword): AnonymousResourceCollection
    {
        $keyword = trim($keyword);

        $unites = Unite::with(['session', 'classe', 'semestre'])
            ->where(function ($query) use ($keyword) {
                $query->where('libelle', 'LIKE', "%{$keyword}%")
                    ->orWhere('code', 'LIKE', "%{$keyword}%")
                    ->orWhere('credit', 'LIKE', "%{$keyword}%");
            })
            ->orWhereHas('session', function ($q) use ($keyword) {
                $q->where('libelle', 'LIKE', "%{$keyword}%");
            })
            ->orWhereHas('classe', function ($q) use ($keyword) {
                $q->where('libelle', 'LIKE', "%{$keyword}%");
            })
            ->orWhereHas('semestre', function ($q) use ($keyword) {
                $q->where('libelle', 'LIKE', "%{$keyword}%");
            })->paginate(10);

        return UniteRessource::collection($unites);
    }


    /**
     * Récupérer une unités par son CODE
     *
     * @param [type] $code
     * @return UniteRessource
     */
    public function show($code): UniteRessource
    {
        $unite = Unite::where('code', $code)->with(['session', 'classe', 'semestre'])->first();
        return UniteRessource::make($unite);
    }


    /**
     * Mettre à jour d'une unités
     *
     * @param [type] $id
     * @param [type] $data
     * @return false
     */
    public function update($id, $data)
    {
        $unite = Unite::find($id);
        $unite->fill($data);
        if($unite->save()){
            return $unite;
        }
        return false;
    }

    /**
     * Supprimer d'une unités
     *
     * @param [type] $id
     * @return true
     */
    public function delete($id): bool
    {
        $unite = Unite::find($id);
        if($unite->delete()){
            return true;
        }
        return false;
    }
}
