<?php

namespace Modules\Academique\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Http\Requests\ClasseRequest;
use Modules\Academique\Repositories\ClasseRepository;
use Modules\Core\Http\Controllers\CoreController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ClasseController extends CoreController
{
    protected ClasseRepository $classeRepository;

    public function __construct(ClasseRepository $classeRepository)
    {
        $this->classeRepository = $classeRepository;
    }

    /**
     * Liste classes sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function list() {
        return $this->classeRepository->index();
    }

    /**
     * Liste des classes
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->classeRepository->paginate();
    }


    /**
     * Création d'une classe
     *
     * @param ClasseRequest $request
     * @return JsonResponse
     */
    public function store(ClasseRequest $request): JsonResponse
    {
        $data = $request->validated();
        $classe = $this->classeRepository->store($data);
        if(!$classe){
            return $this->returnError('Une erreur est survenue lors de la création d\'une classe');
        } else {
            return $this->returnSuccess('Classe créé avec succès', $classe);
        }
    }


    /**
     * Afficher une classe
     *
     * @param [type] $code
     * @return ClasseResource
     */
    public function show($code)
    {
        return $this->classeRepository->show($code);
    }


    /**
     * Rechercher une classe
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        return $this->classeRepository->search($keyword);
    }


    /**
     * Mise à jour d'une classe
     *
     * @param ClasseRequest $request
     * @param [type] $id
     * @return JsonResponse
     */
    public function update(ClasseRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $classe = $this->classeRepository->update($id, $data);
        if(!$classe){
            return $this->returnError('Une erreur est survenue lors de la mise à jour de la classe');
        } else {
            return $this->returnSuccess('Classe mis à jour avec succès', $classe);
        }
    }


    /**
     * Suppression d'une classe
     *
     * @param [type] $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $res = $this->classeRepository->delete($id);
        if(!$res){
            return $this->returnError('Une erreur est survenue lors de la suppression d\'une classe');
        } else {
            return $this->returnSuccess('Classe supprimé avec succès');
        }
    }
}
