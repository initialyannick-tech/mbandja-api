<?php

namespace Modules\Academique\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Http\Requests\UniteRequest;
use Modules\Academique\Repositories\UniteRepository;
use Modules\Core\Http\Controllers\CoreController;
use Symfony\Component\HttpFoundation\JsonResponse;

class UniteController extends CoreController
{
    protected UniteRepository $uniteRepository;

    public function __construct(UniteRepository $uniteRepository)
    {
        $this->uniteRepository = $uniteRepository;
    }

    /**
     * Liste unites sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function list() {
        return $this->uniteRepository->index();
    }

    /**
     * Liste des unités
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->uniteRepository->paginate();
    }


    /**
     * Création d'une unité
     *
     * @param UniteRequest $request
     * @return JsonResponse
     */
    public function store(UniteRequest $request): JsonResponse
    {
        $data = $request->validated();
        $unite = $this->uniteRepository->store($data);
        if(!$unite){
            return $this->returnError('Une erreur est survenue lors de la création d\'une unité');
        } else {
            return $this->returnSuccess('Unité créé avec succès', $unite);
        }
    }


    /**
     * Afficher une unité
     *
     * @param [type] $code
     * @return UniteResource
     */
    public function show($code)
    {
        return $this->uniteRepository->show($code);
    }


    /**
     * Rechercher une unité
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        return $this->uniteRepository->search($keyword);
    }


    /**
     * Mise à jour d'une unité
     *
     * @param UniteRequest $request
     * @param [type] $id
     * @return JsonResponse
     */
    public function update(UniteRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $unite = $this->uniteRepository->update($id, $data);
        if(!$unite){
            return $this->returnError('Une erreur est survenue lors de la mise à jour d\'une unité');
        } else {
            return $this->returnSuccess('Unité mis à jour avec succès', $unite);
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
        $res = $this->uniteRepository->delete($id);
        if(!$res){
            return $this->returnError('Une erreur est survenue lors de la suppression de l\'unité');
        } else {
            return $this->returnSuccess('Unité supprimé avec succès');
        }
    }
}
