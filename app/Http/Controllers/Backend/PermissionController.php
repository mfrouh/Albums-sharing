<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','permission:view permissions'])->only('index');
        $this->middleware(['auth','permission:create permission'])->only(['create','store']);
        $this->middleware(['auth','permission:update permission'])->only(['edit','update']);
        $this->middleware(['auth','permission:delete permission'])->only('destroy');
    }
    public function index()
    {
       $permissions=Permission::paginate(10);
       return view('Backend.permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.permissions.create');
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
            'name'=>'required|unique:permissions'
        ]);
        Permission::create(['name'=>$request->name]);
        return redirect('/permissions')->with('success','Permission Created Successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission=Permission::findById($id);
        return view('Backend.permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|unique:permissions,name,'.$id,
        ]);
        DB::table('permissions')->where('id',$id)->update(['name'=>$request->name]);
        return redirect('/permissions')->with('success','Permission Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::findById($id)->delete();
        return back()->with('success','Permission Deleted Successfully');
    }
}
