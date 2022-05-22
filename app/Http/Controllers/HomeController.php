<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\activationApplicants;
use App\Models\EventsImages;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $events=EventsImages::get();
        return view('home',[
            'events'=>$events,
        ]);
    }

    public function create(){
        return view("addNews");
    }

    public function activate(Request $request){
        $activation=activationApplicants::find(1);
        if($request->has('activation')){
            $activation->activation=true;
            $activation->save();
        }else{
            $activation->activation=false;
            $activation->save();
        }
            return redirect('/home');
    }


        //List EventsImgs Functioin
        public function list(){
        $news=EventsImages::get();
        return view("home",[
            'news'=>$news,
        ]);
    }


}
