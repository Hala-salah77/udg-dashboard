<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    //Store Function
    function store(Request $request){

        $validated = $request->validate([
            'enTitle' => 'required|unique:news|max:100',
            'arTitle' => 'required|unique:news|max:100',
            'enDesc' => 'required',
            'link' => 'string',
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
            $new->save();
            return response()->json($new);
        }

    //List Functioin
        function list(){
            $news=News::get();
            return response()->json($news);
    }

}
