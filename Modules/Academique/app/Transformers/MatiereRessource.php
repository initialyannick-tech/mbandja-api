<?php

namespace Modules\Academique\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatiereRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
         return [
            'id'          => $this->id,
            'code'        => $this->code,
            'libelle'     => $this->libelle,
            'coefficient' => $this->coefficient,
            'unite'       => $this->unite,
        ];
    }
}
