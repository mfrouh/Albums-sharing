<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:view all users'])->only('index');
        $this->middleware(['auth','permission:delete users'])->only(['destroy']);
    }

    public function index()
    {
       $users=User::role('User')->paginate(9);
       return view('backend.users.index',compact('users'));
    }

    public function destroy($id)
    {
       $user=User::findOrfail($id);
       $user->delete();
       return back()->with('success','User Deleted Successfully');
    }
}
