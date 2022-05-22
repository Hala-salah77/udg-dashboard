<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicants;
class ApplicantsController extends Controller
{
    public function listApplicants(){
        $apps=Applicants::all();
        if (count($apps) <= 0) {
            return view('empty');
        }
        return view("listApplicants",['apps'=>$apps,]);
    }
    public function deleteApplicant($id)
    {
        $new = Applicants::find($id);
        $new->delete();
        return redirect('/listApplicants');
    }
}
