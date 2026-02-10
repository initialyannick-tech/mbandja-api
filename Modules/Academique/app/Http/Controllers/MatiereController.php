<?php

namespace Modules\Academique\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Http\Requests\MatiereRequest;
use Modules\Academique\Repositories\MatiereRepository;
use Modules\Core\Http\Controllers\CoreController;
use Symfony\Component\HttpFoundation\JsonResponse;

class MatiereController extends CoreController
{
    protected MatiereRepository $matiereRepository;

    public function __construct(MatiereRepository $matiereRepository)
    {
        $this->matiereRepository = $matiereRepository;
    }

    /**
     * Liste matières sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function list() {
        return $this->matiereRepository->index();
    }

    /**
     * Liste des matières
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->matiereRepository->paginate();
    }


    /**
     * Création d'une matière
     *
     * @param MatiereRequest $request
     * @return JsonResponse
     */
    public function store(MatiereRequest $request): JsonResponse
    {
        $data = $request->validated();
        $matiere = $this->matiereRepository->store($data);
        if(!$matiere){
            return $this->returnError('Une erreur est survenue lors de la création d\'une matière');
        } else {
            return $this->returnSuccess('Matière créé avec succès', $matiere);
        }
    }


    /**
     * Afficher une matière
     *
     * @param [type] $code
     * @return MatiereResource
     */
    public function show($code)
    {
        return $this->matiereRepository->show($code);
    }


    /**
     * Rechercher une matière
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        return $this->matiereRepository->search($keyword);
    }


    /**
     * Mise à jour d'une matière
     *
     * @param UniteRequest $request
     * @param [type] $id
     * @return JsonResponse
     */
    public function update(MatiereRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $matiere = $this->matiereRepository->update($id, $data);
        if(!$matiere){
            return $this->returnError('Une erreur est survenue lors de la mise à jour d\'une matière');
        } else {
            return $this->returnSuccess('Matière mis à jour avec succès', $matiere);
        }
    }


    /**
     * Suppression d'une unité
     *
     * @param [type] $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $res = $this->matiereRepository->delete($id);
        if(!$res){
            return $this->returnError('Une erreur est survenue lors de la suppression de l\'unité');
        } else {
            return $this->returnSuccess('Unité supprimé avec succès');
        }
    }
}
