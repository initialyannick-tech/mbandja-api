<?php

namespace Modules\Academique\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CycleRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'     => $this->id,
            'libelle'=> $this->libelle,
            'ordre'  => $this->ordre,
            'session'=> $this->session
        ];
    }
}
