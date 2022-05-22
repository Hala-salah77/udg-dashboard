<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contacts;
class ContactsController extends Controller
{
    public function listContacts(){
        $contacts=Contacts::all();
        return $contacts;
    }

    public function sendContactInfo(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'msg' => 'nullable',
            'mobile' => 'required|max:18|min:10',
            'fname' => 'nullable|string',
            'lname' => 'nullable|string',
            'stNumber'=>'string'
        ]);
        $request = request()->all();
        if(Contacts::create($request)==true){
            return response()->json([
                'message' => 'Your Missage is Sent'
            ]);
        };
    }

}
