<?php

namespace Modules\Etudiant\Repositories;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Etudiant\Models\Inscription;
use Modules\Etudiant\Models\Paiement;
use Modules\Etudiant\Transformers\PaiementResource;

class PaiementRepository
{
   
    
     /**
     * Liste des paiements sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $paiements = Paiement::with('inscription.classe', 'etudiant')->orderBy('id', 'desc')->get();
        return PaiementResource::collection($paiements);
    }

    /**
     * Récupérer tous les Paiements
     *
     * @return AnonymousResourceCollection
     */
    public function paginate(): AnonymousResourceCollection
    {
        $paiements = Paiement::with('inscription.classe', 'etudiant')->orderBy('id', 'desc')->paginate(10);
        return PaiementResource::collection($paiements);
    }

    public function store(array $data)
    {
        $inscription = Inscription::with('classe') ->find($data['inscription_id']);
        if (!$inscription) {
            return false;
        }
        $totalPaye = (float) $inscription->paiements()->sum('montant');
        $montantTotal = (float) ($inscription->classe->frais_inscription ?? 0);
        $reste = $montantTotal - $totalPaye;
        if ($data['montant'] <= 0) {
            return 'montant_invalide';
        }
        if ($data['montant'] > $reste) {
            return 'montant_superieur_au_solde';
        }
        $paiement = new Paiement();
        $paiement->fill($data);
        $paiement->save();

        // Mise à jour statut
        $inscription->mettreAJourStatut();

        // Recharger proprement
        $inscription->refresh();

        return $paiement->load('inscription.classe', 'etudiant');
    }

    public function search($keyword)
    {
        $paiements = Paiement::with(['inscription.classe', 'inscription.etudiant', 'inscription.session'])
            ->whereHas('inscription.classe', function ($query) use ($keyword) {
                $query->where('libelle', 'like', "%{$keyword}%")
                    ->orWhere('code', 'like', "%{$keyword}%");
            })
            ->orWhereHas('inscription.etudiant', function ($query) use ($keyword) {
                $query->where('nom', 'like', "%{$keyword}%")
                    ->orWhere('prenom', 'like', "%{$keyword}%")
                    ->orWhere('telephone', 'like', "%{$keyword}%");
            })
            ->orWhere('numero_recu', 'like', "%{$keyword}%")
            ->orWhereHas('inscription', function ($query) use ($keyword) {
                $query->where('date_inscription', 'like', "%{$keyword}%");
            })->orderByDesc('id') ->paginate(10);

        return PaiementResource::collection($paiements);
    }



    public function show($code): PaiementResource
    {
        $paiement = Paiement::where('numero_recu', $code)->with(['inscription.classe', 'etudiant'])->first();
        return new PaiementResource($paiement);
    }

     public function update($data, $id)
    {
        $paiement = Paiement::find($id);
        $paiement->fill($data);
        if ($paiement->save()) {
            return $paiement;
        }
        return false;
    }

    public function destroy($id)
    {
        $paiement = Paiement::find($id);
        if ($paiement->delete()) {
            return true;
        }
        return false;
    }

}
