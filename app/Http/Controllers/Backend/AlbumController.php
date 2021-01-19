<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','permission:view all albums'])->only('index');
        $this->middleware(['auth','permission:delete albums'])->only(['destroy']);
    }

    public function index()
    {
       $albums=Album::paginate(10);
       return view('backend.albums.index',compact('albums'));
    }

    public function destroy($id)
    {
       $album=Album::findOrfail($id); 
       $album->delete();
       return back();
    }
}
