<?php

namespace Modules\Academique\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UniteRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'code'    => $this->code,
            'libelle' => $this->libelle,
            'credit'  => (float) $this->credit,
            'classe'  => $this->classe,
            'semestre'=>  $this->semestre,
            'session' => $this->session,
        ];
    }
}
