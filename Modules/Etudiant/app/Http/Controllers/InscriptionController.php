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

}
