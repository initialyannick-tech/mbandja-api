<?php

namespace Modules\Academique\Repositories;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Models\Session;
use Modules\Academique\Transformers\SessionRessource;

class SessionRepository
{
    /**
     * Liste des sessions sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $sessions = Session::all();
        return SessionRessource::collection($sessions);
    }

    /**
     * Création d'une sessions académique
     *
     * @param [type] $data
     * @return false|Session
     */
    public function store($data): false|Session
    {
        if (isset($data['active']) && $data['active'] === true) {
             Session::where('active', true)->update(['active' => false]);
        }
        $sessions = new Session;
        $sessions->fill($data);
        if($sessions->save()){
            return $sessions;
        }
        return false;
    }

    /**
     * Récupérer tous les sessions académique
     *
     * @return AnonymousResourceCollection
     */
    public function paginate(): AnonymousResourceCollection
    {
        $sessions = Session::orderBy('id', 'desc')->paginate(10);
        return SessionRessource::collection($sessions);
    }

    /**
     * Rechercher une session académique par son libelle, date_debut, date_fin
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        $sessions = Session::with('cycles')->where(function ($query) use ($keyword) {
                $query->where('libelle', 'like', "%{$keyword}%")
                    ->orWhere('date_debut', 'like', "%{$keyword}%")
                    ->orWhere('date_fin', 'like', "%{$keyword}%");
            })->paginate(10);
        return SessionRessource::collection($sessions);
    }


    /**
     * Récupérer une session académique par son ID
     *
     * @param [type] $id
     * @return SessionRessource
     */
    public function show($id): SessionRessource
    {
        $sessions = Session::where('id', $id)->with(['cycles', 'classes', 'unites'])->first();
        return SessionRessource::make($sessions);
    }


    /**
     * Mettre à jour une session académique
     *
     * @param [type] $id
     * @param [type] $data
     * @return false
     */
    public function update($id, $data)
    {
        $sessions = Session::find($id);
        $sessions->fill($data);
        if($sessions->save()){
            return $sessions;
        }
        return false;
    }

    /**
     * Supprimer une session académique
     *
     * @param [type] $id
     * @return true
     */
    public function delete($id): bool
    {
        $sessions = Session::find($id);
        if($sessions->delete()){
            return true;
        }
        return false;
    }
}
