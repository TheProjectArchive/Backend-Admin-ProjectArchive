<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// import file model Person
use App\Contact;

class ContactController extends Controller
{
    // mengambil semua data
    public function all()
    {
        return Contact::all();
    }

    // mengambil data by id
    public function show($id)
    {
        return Contact::find($id);
    }

    // menambah data
    public function store(Request $request)
    {
        return Contact::create($request->all());
    }

    // mengubah data
    public function update($id, Request $request)
    {
        $contact = Contact::find($id);
        $contact->update($request->all());
        return $contact;
    }

    // menghapus data
    public function delete($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return 204;
    }
}
