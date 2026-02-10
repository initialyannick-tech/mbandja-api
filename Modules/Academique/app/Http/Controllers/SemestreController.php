<?php

namespace Modules\Academique\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Http\Requests\SemestreRequest;
use Modules\Academique\Http\Requests\SemestreUpdateRequest;
use Modules\Academique\Repositories\SemestreRepository;
use Modules\Core\Http\Controllers\CoreController;
use Symfony\Component\HttpFoundation\JsonResponse;

class SemestreController extends CoreController
{
    protected SemestreRepository $semestreRepository;

    public function __construct(SemestreRepository $semestreRepository)
    {
        $this->semestreRepository = $semestreRepository;
    }

    /**
     * Liste semestres sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function list() {
        return $this->semestreRepository->index();
    }

    /**
     * Liste des semestres
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->semestreRepository->paginate();
    }


    /**
     * Création d'un semestre
     *
     * @param SemestreRequest $request
     * @return JsonResponse
     */
    public function store(SemestreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $semestre = $this->semestreRepository->store($data);
        if(!$semestre){
            return $this->returnError('Une erreur est survenue lors de la création d\'un semestre');
        } else {
            return $this->returnSuccess('Semestre créé avec succès', $semestre);
        }
    }


    /**
     * Afficher un semestre
     *
     * @param [type] $id
     * @return SessionResource
     */
    public function show($id)
    {
        return $this->semestreRepository->show($id);
    }


    /**
     * Rechercher un semestre
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        return $this->semestreRepository->search($keyword);
    }


    /**
     * Mise à jour d'un semestre
     *
     * @param SemestreUpdateRequest $request
     * @param [type] $id
     * @return JsonResponse
     */
    public function update(SemestreUpdateRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $semestre = $this->semestreRepository->update($id, $data);
        if(!$semestre){
            return $this->returnError('Une erreur est survenue lors de la mise à jour du semestre');
        } else {
            return $this->returnSuccess('Semestre mis à jour avec succès', $semestre);
        }
    }


    /**
     * Suppression d'un semestre
     *
     * @param [type] $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $res = $this->semestreRepository->delete($id);
        if(!$res){
            return $this->returnError('Une erreur est survenue lors de la suppression du semestre');
        } else {
            return $this->returnSuccess('Semestre supprimé avec succès');
        }
    }
}
