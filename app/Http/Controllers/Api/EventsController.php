<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventsImages;
class EventsController extends Controller
{
    public function list(){
        $events=EventsImages::all();
        if (count($events) <= 0){
            $response = ['msg' => 'This table is empty'];
            return response($response, 200);
        }
        $response = ['events' => $events];
        return response($response, 200);

    }
}
