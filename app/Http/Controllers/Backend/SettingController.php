<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:setting'])->only('index');
    }
    public function index()
    {
       return view('backend.setting.index');
    }

    public function post_change_password(Request $request)
    {
         $this->validate($request,[
             'old_password'=>'required|min:8',
             'password'=>'required|min:8|confirmed'
         ]);
         $user=user::where('id',auth()->user()->id)->first();
         if (Hash::check($request->old_password,$user->password)) {
            $user->password=Hash::make($request->password);
            $user->save();
                 return back()->with('success','Change Password Successfully');
         }
         else {
                 return back()->with('error','Need Current Password');
         }
     }

     public function post_profile_setting(Request $request)
     {
         $this->validate($request,[
             'name'=>'required',
             'email'=>'required|unique:users,email,'.auth()->user()->id,
         ]);
         $user=User::where('id',auth()->user()->id)->first();
         $user->name=$request->name;
         $user->email=$request->email;
         $user->save();
         return back()->with('success','Change Personal Information Succesfully');

     }
}
