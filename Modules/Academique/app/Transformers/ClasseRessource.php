<?php

namespace Modules\Academique\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClasseRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'code'     => $this->code,
            'libelle'  => $this->libelle,
            'capacite' => $this->capacite,
            'session'  => $this->session,
            'cycle'    => $this->cycle,
            'semestres' => $this->semestres,
            'frais_inscription' => $this->frais_inscription,
            'matieres' => $this->matieres->map(function ($matiere) {
                return [
                    'id' => $matiere->id,
                    'code' => $matiere->code,
                    'libelle' => $matiere->libelle,
                    'unite' => $matiere->unite,
                    'coefficient' => $matiere->coefficient
                ];
            }),
            'inscriptions' => $this->inscriptions
        ];
    }
}
