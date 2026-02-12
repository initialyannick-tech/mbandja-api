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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
