<?php

namespace Modules\Etudiant\Http\Controllers;


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
     * Paiement inscription
     *
     * @param PaiementRequest  $request
     * @return JsonResponse
     */
    public function store(PaiementRequest $request)
    {
        $data = $request->validated();
        $paiement = $this->repository->store($data);

        if ($paiement === 'montant_superieur_au_solde') {
            return $this->returnError("Le montant dépasse le solde restant.");
        }elseif (!$paiement) {
            return $this->returnError("Erreur lors de l'enregistrement du paiement.");
        }else{
           return $this->returnSuccess("Paiement enregistré avec succès", $paiement);
        }
    }

}
