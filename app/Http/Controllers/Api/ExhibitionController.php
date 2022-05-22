<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exhibitions;
use App\Models\Images;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ExhibitionResource;
class ExhibitionController extends Controller
{
    public function list(){
        $exhibition=Exhibitions::all();
        $images=Images::all();
        if (count($exhibition) <= 0){
            $response = ['msg' => 'This table is empty'];
            return response($response, 200);
        }
        return ExhibitionResource::collection($exhibition);
    }
}
