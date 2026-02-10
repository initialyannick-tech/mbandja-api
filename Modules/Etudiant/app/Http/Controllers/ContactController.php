<?php

namespace Modules\Etudiant\Http\Controllers;


use Modules\Core\Http\Controllers\CoreController;
use Modules\Etudiant\Http\Requests\ContactRequest;
use Modules\Etudiant\Repositories\ContactRepository;

class ContactController extends CoreController
{
   protected ContactRepository $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Liste paginée des personnes à contacter
     *
     */
    public function index()
    {
        return $this->repository->paginate();
    }


    /**
     * Rechercher un contact
     *
     * @param [type] $keyword
     * @return void
     */
    public function search($keyword)
    {
        return $this->repository->search($keyword);
    }


    /**
     * Création d'un contact
     *
     * @param ContactRequest $request
     * @return void
     */
    public function store(ContactRequest $request)
    {
        $data = $request->validated();
        $contact = $this->repository->store($data);
        if (!$contact) {
            return $this->returnError('Une erreur est survenue lors de la création d\'un contact');
        } else {
            return $this->returnSuccess('Contact créé avec succès', $contact);
        }
    }


    /**
     * Afficher un seul contact
     *
     * @param [type] $id
     * @return void
     */
    public function show($id)
    {
        return $this->repository->show($id);
    }


    /**
     * Mise à jour d'un contact
     *
     * @param ContactRequest $request
     * @param [type] $id
     * @return JsonResponse
     */
    public function update(ContactRequest $request, $id)
    {
        $data = $request->validated();
        $contact = $this->repository->update($data, $id);
        if (!$contact) {
            return $this->returnError('Une erreur est survenue lors de la modification du contact');
        } else {
            return $this->returnSuccess('Contact modifié avec succès', $contact);
        }
    }


    /**
     * Suppression d'un contact
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        $contact = $this->repository->destroy($id);
        if (!$contact) {
            return $this->returnError('Une erreur est survenue lors de la suppression du contact');
        } else {
            return $this->returnSuccess('Contact supprimé avec succès');
        }
    }

}
