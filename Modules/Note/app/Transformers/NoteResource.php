<?php

namespace Modules\Note\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        // return [
        //     'id' => $this->id,
        //     'valeur' => $this->valeur,
        //     'type' => $this->type,
        //     'libelle' => $this->libelle,
        //     'appreciation' => $this->appreciation,
        //     'matiere' => [
        //         'id' => $this->matiere?->id,
        //         'code' => $this->matiere?->code,
        //         'libelle' => $this->matiere?->libelle,
        //         'coefficient' => $this->matiere?->coefficient,
        //         'unite' => [
        //             'code' => $this->matiere?->unite?->code,
        //             'libelle' => $this->matiere?->unite?->libelle,
        //             'credit' => $this->matiere?->unite?->credit,
        //         ],
        //     ],
        //     'inscription' => [
        //         'nom' => $this->inscription?->etudiant?->nom,
        //         'prenom' => $this->inscription?->etudiant?->prenom,
        //         'email' => $this->inscription?->etudiant?->email,
        //         'classe' => [
        //             'libelle' =>$this->inscription?->classe?->libelle
        //         ],
        //     ],
        // ];

        // Moyenne par matière (simple)
        $notesMatiere = $this->matiere->notes->where('inscription_id', $this->inscription_id);
        $moyenneMatiere = $notesMatiere->count() > 0? $notesMatiere->avg('valeur'): null;

        // Moyenne générale pondérée par credit de l'UE
        $notesInscription = $this->inscription->notes;
        $totalPondere = 0;
        $creditTotal = 0;

        foreach ($notesInscription as $n) {
            $credit = $n->matiere?->unite?->credit ?? 1;
            $totalPondere += $n->valeur * $credit;
            $creditTotal += $credit;
        }
        $moyenneGenerale = $creditTotal > 0 ? $totalPondere / $creditTotal : null;

        return [
            'id' => $this->id,
            'valeur' => $this->valeur,
            'type' => $this->type,
            'libelle' => $this->libelle,
            'appreciation' => $this->appreciation,
            'matiere' => [
                'code' => $this->matiere?->code,
                'libelle' => $this->matiere?->libelle,
                'coefficient' => $this->matiere?->coefficient,
                'unite' => [
                    'code' => $this->matiere?->unite?->code,
                    'libelle' => $this->matiere?->unite?->libelle,
                    'credit' => $this->matiere?->unite?->credit,
                    'classe_id' => $this->matiere?->unite?->classe_id,
                    'semestre_id' => $this->matiere?->unite?->semestre_id,
                    'session_id' => $this->matiere?->unite?->session_id,
                ],
            ],
            'inscription' => [
                'nom' => $this->inscription?->etudiant?->nom,
                'prenom' => $this->inscription?->etudiant?->prenom,
                'email' => $this->inscription?->etudiant?->email,
                'classe_id' => $this->inscription?->classe_id,
            ],
            'moyenne_matiere' => $moyenneMatiere ? round($moyenneMatiere, 2) : null,
            'moyenne_generale' => $moyenneGenerale ? round($moyenneGenerale, 2) : null,
        ];
    }
}
