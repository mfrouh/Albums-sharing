<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function albums()
    {
        $albums=Album::public()->latest()->take(9)->get();
        return view('frontend.pages.index',compact('albums'));
    }
    public function morealbum(Request $request)
    {
        if($request->id)
        {
            $albums=Album::public()->latest()->where('id','<',$request->id)->take(3)->get();
        }
        return response()->json($albums);
    }
    public function getgallery($id)
    {
        $gallery=Album::findorfail($id)->gallery;
        return response()->json($gallery);
    }
}
