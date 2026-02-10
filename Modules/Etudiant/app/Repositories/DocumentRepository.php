<?php

namespace Modules\Etudiant\Repositories;

use Modules\Etudiant\Models\Document;
use Modules\Etudiant\Transformers\DocumentResource;

class DocumentRepository
{
    public function getById(int $id)
    {
        return Document::find($id);
    }


    public function store($data)
    {
        $document = new Document;
        $document->fill($data);
        if ($document->save()) {
            return $document;
        }
        return false;
    }


    public function update($data, $id)
    {
        $document = Document::find($id);
        $document->fill($data);
        if ($document->save()) {
            return $document;
        }
        return false;
    }


    public function destroy($id)
    {
        $document = Document::find($id);
        if ($document->delete()) {
            return true;
        }
        return false;
    }


    public function search($keyword)
    {
        $document = Document::where('libelle', 'like', "%$keyword%")->paginate(10);
        return DocumentResource::collection($document);
    }


    public function paginate()
    {
        $document = Document::orderBy('id', 'desc')->paginate(10);
        return DocumentResource::collection($document);
    }

    /**
     * Récupérer un document par son ID
     *
     * @param [type] $id
     * @return DocumentResource
     */
    public function show($id)
    {
        $document = Document::where('id', $id)->first();
        return DocumentResource::make($document);
    }

}
