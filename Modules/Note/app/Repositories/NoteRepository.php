<?php

namespace Modules\Note\Repositories;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Note\Models\Note;
use Modules\Note\Transformers\NoteResource;

class NoteRepository
{
    /**
     * Liste des notes sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $notes = Note::with(['matiere.unite','matiere.notes','inscription.etudiant','inscription.notes'])->get();
        return NoteResource::collection($notes);
    }

    /**
     * Création d'une note 
     *
     * @param [type] $data
     * @return Note|false
     */
    public function store($data)
    {
        $note = new Note;
        $note->fill($data);
        if($note->save()){
            $note->load(['matiere.unite','matiere.notes','inscription.etudiant','inscription.notes']);
            return $note;
        }
        return false;
    }

    /**
     * Récupérer tous les notes
     *
     * @return AnonymousResourceCollection
     */
    public function paginate(): AnonymousResourceCollection
    {
        $notes = Note::with([ 
            'matiere.unite',
            'matiere.notes',
            'inscription.etudiant',
            'inscription.notes'
        ])->orderBy('id', 'desc')->paginate(10);
        return NoteResource::collection($notes);
    }

    /**
     * Rechercher une note par son etudians incrit, matiere
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        $notes = Note::with([
            'matiere.unite',
            'matiere.notes',
            'inscription.etudiant',
            'inscription.notes'
        ])
        ->whereHas('inscription.etudiant', function($query) use ($keyword) {
            $query->where('nom', 'like', "%{$keyword}%")
                ->orWhere('prenom', 'like', "%{$keyword}%")
                ->orWhere('matricule', 'like', "%{$keyword}%");
        })
        ->orWhereHas('matiere', function($query) use ($keyword) {
            $query->where('libelle', 'like', "%{$keyword}%")
                  ->orWhere('code', 'like', "%{$keyword}%");
        })
        ->paginate(10);
        return NoteResource::collection($notes);
    }

    /**
     * Récupérer une note par son ID
     *
     * @param [type] $code
     * @return NoteResource
     */
    public function show($code): NoteResource
    {
        $note = Note::where('id', $code)->with([ 
            'matiere.unite',
            'matiere.notes',
            'inscription.etudiant',
            'inscription.notes'
        ])->first();
        return NoteResource::make($note);
    }


    /**
     * Mettre à jour une note
     *
     * @param [type] $id
     * @param [type] $data
     * @return false
     */
    public function update($id, $data)
    {
        $note = Note::findOrFail($id);
        $note->fill($data);
        if ($note->save()) {
            $note->load([
                'matiere.unite',
                'matiere.notes',
                'inscription.etudiant',
                'inscription.notes'
            ]);
            return $note;
        }
        return false;
    }

    /**
     * Supprimer une note
     *
     * @param [type] $id
     * @return true
     */
    public function delete($id): bool
    {
        $note = Note::find($id);
        if($note->delete()){
            return true;
        }
        return false;
    }
}
