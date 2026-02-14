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

    public function search($keyword)
    {
        $inscriptions = Inscription::with(['classe', 'etudiant', 'session'])
            ->whereHas('classe', function ($query) use ($keyword) {
                $query->where('libelle', 'like', "%{$keyword}%")
                    ->orWhere('code', 'like', "%{$keyword}%");
            })
            ->orWhereHas('etudiant', function ($query) use ($keyword) {
                $query->where('nom', 'like', "%{$keyword}%")
                    ->orWhere('prenom', 'like', "%{$keyword}%")
                    ->orWhere('telephone', 'like', "%{$keyword}%");
            })
            ->orWhere('date_inscription', 'like', "%{$keyword}%")
            ->orderByDesc('id')
            ->paginate(10);

        return InscriptionResource::collection($inscriptions);
    }


    public function show($id): InscriptionResource
    {
        $inscriptions = Inscription::find($id);
        return new InscriptionResource($inscriptions);
    }

    public function update($data, $id)
    {
        $inscription = Inscription::find($id);
        $inscription->fill($data);
        if ($inscription->save()) {
            return $inscription;
        }
        return false;
    }

    public function destroy($id)
    {
        $inscription = Inscription::find($id);
        if ($inscription->delete()) {
            return true;
        }
        return false;
    }
}
