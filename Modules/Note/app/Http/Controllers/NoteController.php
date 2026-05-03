<?php

namespace Modules\Note\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Academique\Models\Classe;
use Modules\Academique\Models\Matiere;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Note\Http\Requests\NoteRequest;
use Modules\Note\Models\Note;
use Modules\Note\Repositories\NoteRepository;
use Modules\Note\Transformers\NoteResource;

class NoteController extends CoreController
{
    protected NoteRepository $noteRepository;

    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    /**
     * Liste notes sans pagination
     *
     * @return AnonymousResourceCollection
     */
    public function list() {
        return $this->noteRepository->index();
    }

    /**
     * Liste des notes
     *
     */
    public function index(Request $request)
    {
        $inscriptionId = $request->query('inscription_id');
        $classeId = $request->query('classe_id');
        if (!$inscriptionId || !$classeId) {
            return response()->json([
                'message' => 'classe_id et inscription_id requis'
            ], 422);
        }
        // 1. récupérer toutes les matières de la classe
        $matieres = Classe::with('matieres')->find($classeId)?->matieres ?? collect();

        //2. récupérer les notes de l'étudiant
        $notes = Note::where('inscription_id', $inscriptionId)->get()->groupBy('matiere_id');
        $result = [];
        foreach ($matieres as $matiere) {
            $matiereNotes = $notes->get($matiere->id);
            $item = [
                'matiere_id' => $matiere->id,
                'matiere' => $matiere->libelle,
                'coefficient' => $matiere->coefficient,
                'CC1' => null,
                'CC2' => null,
                'EXAM' => null,
            ];
            if ($matiereNotes) {
                foreach ($matiereNotes as $note) {

                    if ($note->libelle === 'CC1') {
                        $item['CC1'] = (float) $note->valeur;
                    }
                    if ($note->libelle === 'CC2') {
                        $item['CC2'] = (float) $note->valeur;
                    }
                    if ($note->libelle === 'EXAM') {
                        $item['EXAM'] = (float) $note->valeur;
                    }
                }
            }
            $result[] = $item;
        }
        return response()->json([
            'data' => $result
        ]);
    }


    /**
     * Création d'une note
     *
     * @param NoteRequest $request
     * @return JsonResponse
     */
    public function store(NoteRequest $request): JsonResponse
    {
        $data = $request->validated();
        $note = $this->noteRepository->store($data);
        if(!$note){
            return $this->returnError('Une erreur est survenue lors de la création d\'une note académique');
        } else {
            return $this->returnSuccess('Note académique créé avec succès', $note);
        }
    }


    /**
     * Afficher une note
     *
     * @param [type] $id
     * @return NoteResource
     */
    public function show($id)
    {
        return $this->noteRepository->show($id);
    }


    /**
     * Rechercher une note
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection
    {
        return $this->noteRepository->search($keyword);
    }


    /**
     * Mise à jour d'une session
     *
     * @param NoteRequest $request
     * @param [type] $id
     * @return JsonResponse
     */
    public function update(NoteRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $note = $this->noteRepository->update($id, $data);
        if(!$note){
            return $this->returnError('Une erreur est survenue lors de la mise à jour de la note académique');
        } else {
            return $this->returnSuccess('Note académique mis à jour avec succès', $note);
        }
    }


    /**
     * Suppression d'une note
     *
     * @param [type] $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $res = $this->noteRepository->delete($id);
        if(!$res){
            return $this->returnError('Une erreur est survenue lors de la suppression de la note');
        } else {
            return $this->returnSuccess('Note supprimé avec succès');
        }
    }
}
