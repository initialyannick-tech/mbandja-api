<?php

namespace Modules\Note\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Note\Http\Requests\NoteRequest;
use Modules\Note\Repositories\NoteRepository;
use Modules\Note\Transformers\NoteResource;

class NoteController extends CoreController
{
    protected NoteRepository $noteRepository;

    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    /**
     * Liste notes sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function list() {
        return $this->noteRepository->index();
    }

    /**
     * Liste des notes
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->noteRepository->paginate();
    }


    /**
     * Création d'une note
     *
     * @param NoteRequest $request
     * @return JsonResponse
     */
    public function store(NoteRequest $request): JsonResponse
    {
        $data = $request->validated();
        $note = $this->noteRepository->store($data);
        if(!$note){
            return $this->returnError('Une erreur est survenue lors de la création d\'une note académique');
        } else {
            return $this->returnSuccess('Note académique créé avec succès', $note);
        }
    }


    /**
     * Afficher une note
     *
     * @param [type] $id
     * @return NoteResource
     */
    public function show($id)
    {
        return $this->noteRepository->show($id);
    }


    /**
     * Rechercher une note
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        return $this->noteRepository->search($keyword);
    }


    /**
     * Mise à jour d'une session
     *
     * @param NoteRequest $request
     * @param [type] $id
     * @return JsonResponse
     */
    public function update(NoteRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $note = $this->noteRepository->update($id, $data);
        if(!$note){
            return $this->returnError('Une erreur est survenue lors de la mise à jour de la note académique');
        } else {
            return $this->returnSuccess('Note académique mis à jour avec succès', $note);
        }
    }


    /**
     * Suppression d'une note
     *
     * @param [type] $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $res = $this->noteRepository->delete($id);
        if(!$res){
            return $this->returnError('Une erreur est survenue lors de la suppression de la note');
        } else {
            return $this->returnSuccess('Note supprimé avec succès');
        }
    }
}
