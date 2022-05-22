<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsersInfos;

class UsersInfoController extends Controller
{
    public function listUsersInfo(){
        $info=UsersInfos::all();
        return $info;
    }

    public function sendUsersInfo(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mobile' => 'required|max:18|min:10',
            'fname' => 'nullable|string',
            'lname' => 'nullable|string',
        ]);
        $request = request()->all();
        if(UsersInfos::create($request)==true){
            return response()->json([
                'message' => 'Your Data is Sent'
            ]);
        };
    }
}
