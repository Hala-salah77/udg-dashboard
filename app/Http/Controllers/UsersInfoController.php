<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersInfos;

class UsersInfoController extends Controller
{
    public function listUsersInfo()
    {
        $usersInfo = UsersInfos::all();
        if (count($usersInfo) <= 0) {
            return view('empty');
        }
        return view('listUsersInfo',['usersInfo'=> $usersInfo]);
    }

    public function deleteUserInfo($id)
    {
        $usersInfo = UsersInfos::find($id);
        $usersInfo->delete();
        return redirect('/listUsersInfo');
    }
}
