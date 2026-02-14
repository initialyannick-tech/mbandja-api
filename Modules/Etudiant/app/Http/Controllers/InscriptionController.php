<?php

namespace Modules\Etudiant\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Etudiant\Http\Requests\InscriptionRequest;
use Modules\Etudiant\Repositories\InscriptionRepository;

class InscriptionController extends CoreController
{
    protected $repository;

    public function __construct(InscriptionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Liste inscriptions sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function list() {
        return $this->repository->index();
    }

    /**
     * Liste des inscriptions
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->repository->paginate();
    }


    /**
     * Création d'une inscription
     *
     * @param InscriptionRequest  $request
     * @return JsonResponse
     */
    public function store(InscriptionRequest  $request): JsonResponse
    {
        $data = $request->validated();
        $inscription  = $this->repository->store($data);
        if(!$inscription ){
            return $this->returnError("L'étudiant est déjà inscrit pour cette session.");
        } else {
            return $this->returnSuccess('Inscription créé avec succès', $inscription );
        }
    }

    /**
     * Rechercher une inscription
     *
     * @param [type] $keyword
     * @return void
     */
    public function search($keyword)
    {
        return $this->repository->search($keyword);
    }

    /**
     * Afficher une inscription
     *
     * @param [type] $id
     * @return void
     */
    public function show($id)
    {
        return $this->repository->show($id);
    }


    /**
     * Mise à jour d'une inscription
     *
     * @param InscriptionRequest $request
     * @param [type] $id
     * @return JsonResponse
     */
    public function update(InscriptionRequest $request, $id)
    {
        $data = $request->validated();
        $inscription = $this->repository->update($data, $id);
        if (!$inscription) {
            return $this->returnError('Une erreur est survenue lors de la modification de l\'inscription');
        } else {
            return $this->returnSuccess('Inscription modifié avec succès', $inscription);
        }
    }


    /**
     * Suppression d'une inscription
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        $inscription = $this->repository->destroy($id);
        if (!$inscription) {
            return $this->returnError('Une erreur est survenue lors de la suppression de l\'inscription');
        } else {
            return $this->returnSuccess('Inscription supprimé avec succès');
        }
    }

}
