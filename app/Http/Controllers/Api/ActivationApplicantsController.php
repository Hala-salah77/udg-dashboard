<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\activationApplicants;
class ActivationApplicantsController extends Controller
{
    public function getActivate(Request $request){
        $activation=activationApplicants::find(1);
        return ($activation);
    }
}
