<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Exhibitions;
use App\Models\Images;

class ExhibitionsController extends Controller
{
        //Create Function
        public function create(){
            return view("addExhibition");
        }

         //Store Function
        public function store(Request $request){
            //dd($request);
            $validated = $request->validate([
                'arTitle' => 'required|string|max:100|unique:exhibitions',
                'enTitle' => 'required|string|max:100|unique:exhibitions',
                'image' => 'image',
            ]);
                $exhibition=new Exhibitions();
                $exhibition->arTitle=$request->arTitle;
                $exhibition->enTitle=$request->enTitle;
                $exhibition->link=$request->link;
                if($request->has('activationLink'))
                    $exhibition->activationLink=true;
                else
                    $exhibition->activationLink=false;
                $exhibition->save();
            if($request->hasFile("images")){
                $images=$request->file('images');
                foreach($images as $image){
                    $name=time().\Str::random(30).'.'.$image->getClientOriginalExtension();
                    $destinationPath=public_path('/imgs');
                    $image->move($destinationPath,$name);
                    $imageName='imgs/'.$name;
                    $images=new Images();
                    $images->exhibitions_id=$exhibition->id;
                    $images->image=$imageName;
                    $images->save();
            }
        }
                return redirect('/listExhibitions');
            }

        //List Functioin
        public function list(){
            $exhibition=Exhibitions::all();
            if (count($exhibition) <= 0) {
                return view('empty');
            }
            return view("listExhibitions",['exhibition'=>$exhibition,]);
        }


        //Update Function
        function update(Request $request,$id){

            $user = Auth()->user();
            $validated = $request->validate([
                'arTitle' => 'required|string|max:100',
                'enTitle' => 'required|string|max:100',
                'image' => 'image',
            ]);

            $exhibition=Exhibitions::find($id);

            $exhibition->arTitle=$request->arTitle;
            $exhibition->enTitle=$request->enTitle;
            $exhibition->link=$request->link;
                if($request->has('activationLink'))
                    $exhibition->activationLink=true;
                else
                    $exhibition->activationLink=false;
            $exhibition->save();

            if($request->hasFile("images")){
                $images=$request->file('images');
                foreach($images as $image){
                    $name=time().\Str::random(30).'.'.$image->getClientOriginalExtension();
                    $destinationPath=public_path('/imgs');
                    $image->move($destinationPath,$name);
                    $imageName='imgs/'.$name;
                    $images=new Images();
                if(isset( $request->images))
                    File::delete(public_path('imgs/' . $images->image));
                    $images->exhibitions_id=$exhibition->id;
                    $images->image=$imageName;
                    $images->save();
                }
            }
            return redirect('/listExhibitions');
        }


        public function deleteExhibition($id)
        {
            $exhibition = Exhibitions::find($id);
            $exhibition->delete();
            return redirect('/listExhibitions');
        }
}
