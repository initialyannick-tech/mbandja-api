<?php

namespace Modules\Academique\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'libelle'     => $this->libelle,
            'date_debut'  => $this->date_debut->format('Y-m-d'),
            'date_fin'    => $this->date_fin->format('Y-m-d'),
            'active'      => $this->active,
        ];
    }
}
