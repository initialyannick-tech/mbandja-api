<?php

namespace Modules\Academique\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Http\Requests\CycleRequest;
use Modules\Academique\Repositories\CycleRepository;
use Modules\Core\Http\Controllers\CoreController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CycleController extends CoreController
{
    protected CycleRepository $cycleRepository;

    public function __construct(CycleRepository $cycleRepository)
    {
        $this->cycleRepository = $cycleRepository;
    }

    /**
     * Liste cycles sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function list() {
        return $this->cycleRepository->index();
    }

    /**
     * Liste des cycles
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->cycleRepository->paginate();
    }


    /**
     * Création d'un cycle
     *
     * @param CycleRequest $request
     * @return JsonResponse
     */
    public function store(CycleRequest $request): JsonResponse
    {
        $data = $request->validated();
        $cycle = $this->cycleRepository->store($data);
        if(!$cycle){
            return $this->returnError('Une erreur est survenue lors de la création d\'un cycle');
        } else {
            return $this->returnSuccess('Cycle créé avec succès', $cycle);
        }
    }


    /**
     * Afficher un cycle
     *
     * @param [type] $id
     * @return CycleResource
     */
    public function show($id)
    {
        return $this->cycleRepository->show($id);
    }


    /**
     * Rechercher un cycle
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        return $this->cycleRepository->search($keyword);
    }


    /**
     * Mise à jour d'un cycle
     *
     * @param CycleRequest $request
     * @param [type] $id
     * @return JsonResponse
     */
    public function update(CycleRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $cycle = $this->cycleRepository->update($id, $data);
        if(!$cycle){
            return $this->returnError('Une erreur est survenue lors de la mise à jour du cycle');
        } else {
            return $this->returnSuccess('Cycle mis à jour avec succès', $cycle);
        }
    }


    /**
     * Suppression d'un cycle
     *
     * @param [type] $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $res = $this->cycleRepository->delete($id);
        if(!$res){
            return $this->returnError('Une erreur est survenue lors de la suppression du cycle');
        } else {
            return $this->returnSuccess('Cycle supprimé avec succès');
        }
    }
}
