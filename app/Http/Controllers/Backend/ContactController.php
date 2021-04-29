<?php

namespace App\Http\Controllers\Backend;

use App\Models\Contact;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends BackendController
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view($this->_pages . 'contact.index', compact('contacts'));
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail(base64_decode($id));
        $contact->delete();
        return redirect()->back()->with('status', 'Contact Message Deleted !!');
    }
}
