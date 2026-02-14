<?php

namespace Modules\Etudiant\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'classe' => $this->classe,
            'etudiant' => $this->etudiant,
            'session' => $this->session,
            'date_inscription' => $this->date_inscription,
            'statut_paiement' => $this->statut_paiement,
            'paiements' => $this->paiements,
            'total_paye'=> $this->total_paye,
            'montant_total'=> $this->montant_total,
            'reste_a_payer'=> $this->reste_a_payer,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
