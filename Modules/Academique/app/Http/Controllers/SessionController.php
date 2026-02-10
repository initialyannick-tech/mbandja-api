<?php

namespace Modules\Academique\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Http\Requests\SessionRequest;
use Modules\Academique\Repositories\SessionRepository;
use Modules\Core\Http\Controllers\CoreController;
use Symfony\Component\HttpFoundation\JsonResponse;

class SessionController extends CoreController
{
    protected SessionRepository $sessionRepository;

    public function __construct(SessionRepository $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }

    /**
     * Liste sessions sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function list() {
        return $this->sessionRepository->index();
    }

    /**
     * Liste des sessions
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->sessionRepository->paginate();
    }


    /**
     * Création d'une session
     *
     * @param SessionRequest $request
     * @return JsonResponse
     */
    public function store(SessionRequest $request): JsonResponse
    {
        $data = $request->validated();
        $sessions = $this->sessionRepository->store($data);
        if(!$sessions){
            return $this->returnError('Une erreur est survenue lors de la création de la session académique');
        } else {
            return $this->returnSuccess('Session académique créé avec succès', $sessions);
        }
    }


    /**
     * Afficher une session
     *
     * @param [type] $id
     * @return SessionResource
     */
    public function show($id)
    {
        return $this->sessionRepository->show($id);
    }


    /**
     * Rechercher une session
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        return $this->sessionRepository->search($keyword);
    }


    /**
     * Mise à jour d'une session
     *
     * @param ClubRequest $request
     * @param [type] $id
     * @return JsonResponse
     */
    public function update(SessionRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $club = $this->sessionRepository->update($id, $data);
        if(!$club){
            return $this->returnError('Une erreur est survenue lors de la mise à jour de la session académique');
        } else {
            return $this->returnSuccess('Session académique mis à jour avec succès', $club);
        }
    }


    /**
     * Suppression d'un club
     *
     * @param [type] $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $res = $this->sessionRepository->delete($id);
        if(!$res){
            return $this->returnError('Une erreur est survenue lors de la suppression du club');
        } else {
            return $this->returnSuccess('Club supprimé avec succès');
        }
    }
}
