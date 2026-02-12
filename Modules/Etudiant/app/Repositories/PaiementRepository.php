<?php

namespace Modules\Etudiant\Repositories;

use Modules\Etudiant\Models\Inscription;
use Modules\Etudiant\Models\Paiement;

class PaiementRepository
{
   
    public function store(array $data)
    {
        $inscription = Inscription::find($data['inscription_id']);
        if (!$inscription) {
            return false;
        }
        if ($data['montant'] > $inscription->solde) {
            return 'montant_superieur_au_solde';
        }

        $paiement = new Paiement;
        $paiement->fill($data);

        if ($paiement->save()) {
            return $paiement->load('inscription');
        }

        return false;
    }

}
