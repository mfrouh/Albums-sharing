<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','role:User']);
    }
    public function index()
    {
        $albums=Album::where('user_id',auth()->user()->id)->latest()->take(9)->get();
        return view('frontend.pages.album.index',compact('albums'));
    }
    public function morealbum(Request $request)
    {
        if($request->id)
        {
            $albums=Album::where('user_id',auth()->user()->id)->latest()->where('id','<',$request->id)->take(3)->get();
        }
        return response()->json($albums);
    }
    public function privatealbum()
    {
        $albums=Album::private()->where('user_id',auth()->user()->id)->latest()->take(9)->get();
        return view('frontend.pages.album.privatealbums',compact('albums'));
    }
    public function privatemorealbum(Request $request)
    {
        if($request->id)
        {
            $albums=Album::private()->where('user_id',auth()->user()->id)->latest()->where('id','<',$request->id)->take(3)->get();
        }
        return response()->json($albums);
    }

    public function publicalbum()
    {
        $albums=Album::public()->where('user_id',auth()->user()->id)->latest()->take(9)->get();
        return view('frontend.pages.album.publicalbums',compact('albums'));
    }

    public function publicmorealbum(Request $request)
    {
        if($request->id)
        {
            $albums=Album::public()->where('user_id',auth()->user()->id)->latest()->where('id','<',$request->id)->take(3)->get();
        }
        return response()->json($albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.pages.album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $this->validate($request,[
            'name'=>"required|unique:albums,name,null,id,user_id,".auth()->user()->id,
            'type'=>'required|in:public,private',
            'images'=>'required|array',
            'images.*'=>'image|mimes:jpeg,jpg,png,gif|required|max:10000'
            ]);
            $album=auth()->user()->albums()->create(['name'=>$request->name,'type'=>$request->type]);
            if ($request->images) {
            foreach ($request->images as $key => $image) {

                $album->gallery()->create(['url'=>sortimage("storage/albums/$album->id",$image)]);
            }
            }
            return redirect()->route('album.index')->with('suceess','Album Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        return view('frontend.pages.album.edit',compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $this->validate($request,[
            'name'=>"required|unique:albums,name,$album->id,id,user_id,".auth()->user()->id,
            'type'=>'required|in:public,private',
            'images'=>'nullable|array',
            'images.*'=>'image|mimes:jpeg,jpg,png,gif|required|max:10000'
            ]);
            $album->update(['name'=>$request->name,'type'=>$request->type]);
            if ($request->images) {
                foreach ($request->images as $key => $image) {

                    $album->gallery()->create(['url'=>sortimage("storage/albums/$album->id",$image)]);
               }
             }
            return redirect()->route('album.index')->with('suceess','Album Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->gallery()->delete();
        Storage::deleteDirectory('public/albums/'.$album->id);
        $album->delete();
        return response()->json('Album Deleted Successfully');
    }
    public function image($id)
    {
        $image=Image::findorfail($id);
        unlink($image->url);
        Image::findorfail($id)->delete();
        return response()->json('Image Deleted Successfully');
    }

}
