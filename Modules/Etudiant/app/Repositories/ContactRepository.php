<?php

namespace Modules\Etudiant\Repositories;

use Modules\Etudiant\Models\Contact;
use Modules\Etudiant\Transformers\ContactResource;

class ContactRepository
{
    public function store($data)
    {
        $contact = new Contact();
        $contact->fill($data);
        if ($contact->save()) {
            return $contact;
        }
        return false;
    }

    public function paginate()
    {
        $contact = Contact::orderBy('id', 'desc')->paginate(10);
        return ContactResource::collection($contact);
    }

    public function search($keyword)
    {
        $contact = Contact::where('nom', 'like', "%$keyword%")
            ->orWhere('prenom', 'like', "%$keyword%")
            ->orWhere('telephone', 'like', "%$keyword%")
            ->paginate(10);
        return ContactResource::collection($contact);
    }

    public function show($id): ContactResource
    {
        $contact = Contact::find($id);
        return new ContactResource($contact);
    }

    public function update($data, $id)
    {
        $contact = Contact::find($id);
        $contact->fill($data);
        if ($contact->save()) {
            return $contact;
        }
        return false;
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        if ($contact->delete()) {
            return true;
        }
        return false;
    }
}
