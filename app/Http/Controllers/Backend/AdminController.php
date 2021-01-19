<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','permission:view admins'])->only('index');
        $this->middleware(['auth','permission:create admin'])->only(['create','store']);
        $this->middleware(['auth','permission:update admin'])->only(['edit','update']);
        $this->middleware(['auth','permission:delete admin'])->only('destroy');
    }
    public function index()
    {
        $admins=User::role('Admin')->paginate(10);
        return view('backend.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admins.create');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user =new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        $user->assignRole('Admin');
        return redirect()->route('admins.index')->with('success','Admin Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin=User::role('Admin')->findOrfail($id);
        return view('backend.admins.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,id,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $user =User::role('Admin')->findorfail($id);
        $user->name=$request->name;
        $user->email=$request->email;
        if($user->password)
        {
            $user->password=Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('admins.index')->with('success','Admin Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin=User::role('Admin')->findOrfail($id);
        $admin->delete();
        return redirect()->route('admins.index')->with('success','Admin Deleted Successfully');
    }
}
