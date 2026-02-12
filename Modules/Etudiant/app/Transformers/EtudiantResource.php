<?php

namespace Modules\Etudiant\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EtudiantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            "id"             => $this->id,
            "matricule"      => $this->matricule,
            "nom"            => $this->nom,
            "prenom"         => $this->prenom,
            "sexe"           => $this->sexe,
            "date_naissance" => $this->date_naissance,
            "lieu_naissance" => $this->lieu_naissance,
            "telephone"  => $this->telephone,
            "email"      => $this->email,
            "adresse"    => $this->adresse, 
            "documents"  => $this->documents,
            "contacts"   => $this->contacts,
            "inscriptions" => $this->inscriptions
        ];

    }
}
