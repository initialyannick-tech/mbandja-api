<?php

namespace Modules\Academique\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Http\Requests\EnseignantRequest;
use Modules\Academique\Repositories\EnseigantRepository;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Academique\Transformers\EnseignantResource;

class EnseigantController extends CoreController
{

    protected EnseigantRepository $enseigantRepository;

    public function __construct(EnseigantRepository $enseigantRepository)
    {
        $this->enseigantRepository = $enseigantRepository;
    }

    /**
     * Liste enseignants sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function list() {
        return $this->enseigantRepository->index();
    }

    /**
     * Liste des enseignants
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->enseigantRepository->paginate();
    }


    /**
     * Création d'un enseignant
     *
     * @param EnseignantRequest $request
     * @return JsonResponse
     */
    public function store(EnseignantRequest $request): JsonResponse
    {
        $data = $request->validated();
        $enseignant = $this->enseigantRepository->store($data);
        if(!$enseignant){
            return $this->returnError('Une erreur est survenue lors de la création d\'un enseignant');
        } else {
            return $this->returnSuccess('Enseignant créé avec succès', $enseignant);
        }
    }


    /**
     * Afficher un enseignant
     *
     * @param [type] $id
     * @return EnseignantResource
     */
    public function show($id)
    {
        return $this->enseigantRepository->show($id);
    }


    /**
     * Rechercher un enseignant
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        return $this->enseigantRepository->search($keyword);
    }


    /**
     * Mise à jour d'un enseignant
     *
     * @param EnseignantRequest $request
     * @param [type] $id
     * @return JsonResponse
     */
    public function update(EnseignantRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $enseignant = $this->enseigantRepository->update($id, $data);
        if(!$enseignant){
            return $this->returnError('Une erreur est survenue lors de la mise à jour d\'un enseignant');
        } else {
            return $this->returnSuccess('Enseignant mis à jour avec succès', $enseignant);
        }
    }


    /**
     * Suppression d'une enseignant
     *
     * @param [type] $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $res = $this->enseigantRepository->delete($id);
        if(!$res){
            return $this->returnError('Une erreur est survenue lors de la suppression d\'un enseignant');
        } else {
            return $this->returnSuccess('Enseignant supprimé avec succès');
        }
    }


    
}
