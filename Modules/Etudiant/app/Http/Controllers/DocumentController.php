<?php

namespace Modules\Etudiant\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Etudiant\Http\Requests\DocumentRequest;
use Modules\Etudiant\Repositories\DocumentRepository;
use Modules\Etudiant\Transformers\DocumentResource;
use Illuminate\Support\Facades\Storage;

class DocumentController extends CoreController
{
   protected DocumentRepository $repository;

    public function __construct(DocumentRepository $repository){
        $this->repository = $repository;
    }
    

    /**
     * Création d'un document légal
     *
     * @param DocumentRequest $request
     * @return JsonResponse
     */
    public function store(DocumentRequest $request): JsonResponse {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $year = date('Y'); // Obtenir l'année actuelle
            $libelle = $data['libelle']; // Obtenir le libellé du document
            $timestamp = time(); // Générer un timestamp
            $fileName = "{$year}.{$libelle}.{$timestamp}.{$file->getClientOriginalExtension()}"; // Construire le nom du fichier

            $filePath = $file->storeAs('documents', $fileName, 'public'); // Stocker le fichier avec le nouveau nom
            $data['lien'] = $filePath;
        } else {
            return $this->returnError('Aucun fichier fourni.');
        }

        $document = $this->repository->store($data);

        if (!$document) {
            return $this->returnError('Une erreur est survenue lors de la création du document.');
        } else {
            return $this->returnSuccess('Document ajouté avec succès.', new DocumentResource($document));
        }
    }


    /**
     * Liste des documents
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->repository->paginate();
    }

    /**
     * Afficher un document
     * @param [type] $id
     * @return DocumentResource
     */
    public function show($id){

        return $this->repository->show($id);
    }


    /**
     * Rechercher un document
     *
     * @param [type] $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword)
    {
        return $this->repository->search($keyword);

    }


/**
 * Mise à jour d'un document légal
 *
 * @param DocumentRequest $request
 * @param int $id
 * @return JsonResponse
 */
public function update(DocumentRequest $request, $id): JsonResponse
{
   
    $data = $request->validated();
    $document = $this->repository->getById($id);

    if (!$document) {
        return $this->returnError('Document non trouvé.');
    }

    if ($request->hasFile('file')) {
        
        if ($document->lien) {
            Storage::disk('public')->delete($document->lien);
        }

        $filePath = $request->file('file')->store('documents', 'public');
        $data['lien'] = $filePath;
    }

    $updatedDocument = $this->repository->update($document, $data);

    if (!$updatedDocument) {
        return $this->returnError('Une erreur est survenue lors de la mise à jour du document.');
    }

    return $this->returnSuccess('Document mis à jour avec succès.', new DocumentResource($updatedDocument));
}

}
