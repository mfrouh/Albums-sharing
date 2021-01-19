<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function __construct()
   {
       $this->middleware(['auth','permission:dashboard'])->only('index');
   }
   public function index()
   {
     $albums=Album::count();
     $publicalbums=Album::public()->count();
     $privatealbums=Album::private()->count();
     $users=User::role('User')->count();
     $admins=User::role('Admin')->count();
     return view('backend.dashboard.index',compact([
         'albums','publicalbums','privatealbums','users','admins'
     ]));
   }
}
