<?php

namespace Modules\Etudiant\Repositories;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Etudiant\Models\Inscription;
use Modules\Etudiant\Transformers\InscriptionResource;

class InscriptionRepository
{
    

    /**
     * Liste des Inscriptions sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $inscriptions = Inscription::all();
        return InscriptionResource::collection($inscriptions);
    }

    /**
     * Récupérer tous les Inscriptions
     *
     * @return AnonymousResourceCollection
     */
    public function paginate(): AnonymousResourceCollection
    {
        $inscriptions = Inscription::orderBy('id', 'desc')->paginate(10);
        return InscriptionResource::collection($inscriptions);
    }

   
    public function store($data) 
    {
        $exists = Inscription::where('etudiant_id', $data['etudiant_id'])->where('session_id', $data['session_id'])->exists();
        if ($exists) {
            return false;
        }
        $inscription = new Inscription;
        $inscription->fill($data);
        $inscription->statut_paiement = 'impaye';
        if ($inscription->save()) {
            return $inscription->load(['classe','etudiant','session']);
        }
        return false;
    }
}
