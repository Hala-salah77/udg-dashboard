<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;
class ContactsController extends Controller
{
    public function list()
    {
        $contacts = Contacts::all();
        if (count($contacts) <= 0) {
            return view('empty');
        }
        return view("listMessages", ['contacts'=> $contacts]);
    }
    public function deleteContact($id)
    {
        $contacts = Contacts::find($id);
        $contacts->delete();
        return redirect('/listMessages');
    }
}
