<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventsImages;
use Illuminate\Support\Facades\File;
class EventsImagesController extends Controller
{

    //Create Function
    public function create(){
        return view("addEvents");
    }
     //Store Function
    public function store(Request $request){
        $validated = $request->validate([
            'image' => 'required|image',
        ]);
        if($request->hasFile('image')){
            $image=$request->file('image');
            $name=time().\Str::random(30).'.'.$image->getClientOriginalExtension();
            $destinationPath=public_path('/imgs');
            $image->move($destinationPath,$name);
            $imageName='imgs/'.$name;
        }
            $event=new EventsImages();
            $event->image=$imageName;
            $event->link=$request->link;
            if($request->has('activationLink'))
                $event->activationLink=true;
            else
                $event->activationLink=false;

            $event->save();
            return redirect('/listEvents');
        }

    //List Functioin
    public function list(){
        $events=EventsImages::all();
        if (count($events) <= 0) {
            return view('empty');
        }
        return view("listEvents",['events'=>$events,]);
    }


    //Update Function
    function update(Request $request, $id){
        $validated = $request->validate([
            'image' => 'required|image',
        ]);
        $event=EventsImages::find($id);
        if($request->hasFile('image')){
            $image=$request->file('image');
            $name=time().\Str::random(30).'.'.$image->getClientOriginalExtension();
            $destinationPath=public_path('/imgs');
            $image->move($destinationPath,$name);
            $imageName='imgs/'.$name;
            if(isset( $event->image))
                File::delete(public_path('imgs/' . $event->image));
                $event->image=$imageName;
            }
                $event->link=$request->link;
                if($request->has('activationLink'))
                    $event->activationLink=true;
                else
                    $event->activationLink=false;
        $event->save();
        return redirect('/listEvents');
    }


    public function deleteEvent($id)
    {
        $event = EventsImages::find($id);
        $event->delete();
        return redirect('/listEvents');
    }


}
