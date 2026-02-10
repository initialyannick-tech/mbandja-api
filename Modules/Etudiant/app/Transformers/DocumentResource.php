<?php

namespace Modules\Etudiant\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'libelle' => $this->libelle,
            'lien' => url('storage/' . $this->lien), // Chemin complet du fichier
            'agent_id' => $this->agent_id,
        ];

    }
}
