<?php

namespace Modules\Etudiant\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Etudiant\Http\Requests\PaiementRequest;
use Modules\Etudiant\Repositories\PaiementRepository;

class PaiementController extends CoreController
{

    protected $repository;

    public function __construct(PaiementRepository $repository)
    {
        $this->repository = $repository;
    }


     /**
     * Liste paiements sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function list() {
        return $this->repository->index();
    }

    /**
     * Liste des paiements
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->repository->paginate();
    }

    /**
     * Paiement inscription
     *
     * @param PaiementRequest  $request
     * @return JsonResponse
     */
    public function store(PaiementRequest $request): JsonResponse
    {
        $data = $request->validated();
        $paiement = $this->repository->store($data);

        if ($paiement === 'montant_superieur_au_solde') {
            return $this->returnError("Le montant dépasse le solde restant.");
        }

        if ($paiement === 'montant_invalide') {
            return $this->returnError("Le montant doit être supérieur à zéro.");
        }

        if ($paiement === false) {
            return $this->returnError("Erreur lors de l'enregistrement du paiement.");
        }

        return $this->returnSuccess(
            "Paiement enregistré avec succès",
            $paiement
        );
    }


     /**
     * Rechercher un paiement
     *
     * @param [type] $keyword
     * @return void
     */
    public function search($keyword)
    {
        return $this->repository->search($keyword);
    }

    /**
     * Afficher un paiement
     *
     * @param [type] $code
     * @return void
     */
    public function show($code)
    {
        return $this->repository->show($code);
    }


    /**
     * Mise à jour d'un paiement
     *
     * @param PaiementRequest $request
     * @param [type] $id
     * @return JsonResponse
     */
    public function update(PaiementRequest $request, $id)
    {
        $data = $request->validated();
        $paiement = $this->repository->update($data, $id);
        if (!$paiement) {
            return $this->returnError('Une erreur est survenue lors de la modification du paiement');
        } else {
            return $this->returnSuccess('Paiement modifié avec succès', $paiement);
        }
    }


    /**
     * Suppression d'un paiement
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        $paiement = $this->repository->destroy($id);
        if (!$paiement) {
            return $this->returnError('Une erreur est survenue lors de la suppression du paiement');
        } else {
            return $this->returnSuccess('Paiement supprimé avec succès');
        }
    }

}
