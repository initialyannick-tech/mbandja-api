<?php

namespace Modules\Etudiant\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Etudiant\Http\Requests\EtudiantRequest;
use Modules\Etudiant\Transformers\EtudiantResource;
use Modules\Etudiant\Repositories\EtudiantRepository;

class EtudiantController extends CoreController
{
    protected EtudiantRepository $etudiantRepository;

    public function __construct(EtudiantRepository $etudiantRepository)
    {
        $this->etudiantRepository = $etudiantRepository;
    }

    /**
     * Liste étudiant sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function list() {
        return $this->etudiantRepository->index();
    }

    /**
     * Liste des étudiants
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->etudiantRepository->paginate();
    }


    /**
     * Création d'un étudiant
     *
     * @param EtudiantRequest $request
     * @return JsonResponse
     */
    public function store(EtudiantRequest $request): JsonResponse
    {
        $data = $request->validated();
        $etudiant = $this->etudiantRepository->store($data);
        if(!$etudiant){
            return $this->returnError('Une erreur est survenue lors de la création de l\'étudiant');
        } else {
            return $this->returnSuccess('Etudiant créé avec succès', $etudiant);
        }
    }


    /**
     * Afficher une étudiant
     *
     * @param [type] $code
     * @return EtudiantResource
     */
    public function show($code)
    {
        return $this->etudiantRepository->show($code);
    }


    /**
     * Rechercher un étudiant
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        return $this->etudiantRepository->search($keyword);
    }


    /**
     * Mise à jour d'un étudiant
     *
     * @param EtudiantRequest $request
     * @param [type] $id
     * @return JsonResponse
     */
    public function update(EtudiantRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $etudiant = $this->etudiantRepository->update($id, $data);
        if(!$etudiant){
            return $this->returnError('Une erreur est survenue lors de la mise à jour de l\'étudiant');
        } else {
            return $this->returnSuccess('Etudiant mis à jour avec succès', $etudiant);
        }
    }


    /**
     * Suppression d'un étudiant
     *
     * @param [type] $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $res = $this->etudiantRepository->delete($id);
        if(!$res){
            return $this->returnError('Une erreur est survenue lors de la suppression d\'un étudiant');
        } else {
            return $this->returnSuccess('Etudiant supprimé avec succès');
        }
    }
}
