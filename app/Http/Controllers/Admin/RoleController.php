<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Carbon\Carbon;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $roleList = Role::where('deleted_at','')->get();
        return view('admin.roles.index',compact('roleList'));
    }
    public function create()
    {
        return view('admin.roles.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $role = new Role;
        $role->name = $request->name;
        $role->status = $request->status;
        $role->save();
        return redirect()->route('admin.roles.index')->with('success','Role Created Successfully');
    }
    public function edit($id)
    {
        $roleData = Role::find($id);
        return view('admin.roles.edit',compact('roleData'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->name;
        $role->status = $request->status;
        $role->save();
        return redirect()->route('admin.roles.index')->with('success','Sub Admin Role Updated Successfully');
    }
    public function destroy(Request $request,$id)
    {
        $role = Role::find($id);
        $role->deleted_at = Carbon::now();
        $role->save();
        $request->session()->flash('success', 'Role deleted successfully.');
    }
}
