<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\File;
class NewsController extends Controller
{
     //Create Function
    public function create(){
        return view("addNews");
    }
     //Store Function
    public function store(Request $request){

        $validated = $request->validate([
            'enTitle' => 'required|unique:news|max:100',
            'arTitle' => 'required|unique:news|max:100',
            'enDesc' => 'required',
            'arDesc' => 'required',
            'image' => 'required|image',
        ]);
        if($request->hasFile('image')){
            $image=$request->file('image');
            $name=time().\Str::random(30).'.'.$image->getClientOriginalExtension();
            $destinationPath=public_path('/imgs');
            $image->move($destinationPath,$name);
            $imageName='imgs/'.$name;
        }
            $new=new News();
            $new->enTitle=$request->enTitle;
            $new->arTitle=$request->arTitle;
            $new->enDesc=$request->enDesc;
            $new->arDesc=$request->arDesc;
            $new->link=$request->link;
            $new->image=$imageName;
            if($request->has('activationLink'))
                $new->activationLink=true;
            else
                $new->activationLink=false;
            $new->save();
            return redirect('/listNews');
        }

    //List Functioin
    public function list(){
            $news=News::all();
            if (count($news) <= 0) {
                return view('empty');
            }
            return view("listNews",['news'=>$news,]);
    }


    //Update Function
    function update(Request $request, $id){
        $validated = $request->validate([
            'enTitle' => 'required|max:100',
            'arTitle' => 'required|max:100',
            'enDesc' => 'required',
            'arDesc' => 'required',
            'image' => 'required|image',
        ]);
        $new=News::find($id);
        $new->enTitle=$request->enTitle;
        $new->arTitle=$request->arTitle;
        $new->enDesc=$request->enDesc;
        $new->arDesc=$request->arDesc;
        $new->link=$request->link;

        if($request->hasFile('image')){
            $image=$request->file('image');
            $name=time().\Str::random(30).'.'.$image->getClientOriginalExtension();
            $destinationPath=public_path('/imgs');
            $image->move($destinationPath,$name);
            $imageName='imgs/'.$name;
            if(isset( $new->image))
                File::delete(public_path('imgs/' . $new->image));
                $new->image=$imageName;
        }
        if($request->has('activationLink'))
                $new->activationLink=true;
            else
                $new->activationLink=false;
        $new->save();
        return redirect('/listNews');
    }


    public function deleteNew($id)
    {
        $new = News::find($id);
        $new->delete();
        return redirect('/listNews');
    }
}
