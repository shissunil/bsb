<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\UserType;

class UserTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $userTypeList = UserType::where('deleted_at','')->get();
        return view('admin.userType.index',compact('userTypeList'));
    }
    public function create()
    {
        return view('admin.userType.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $userType = new UserType;
        $userType->name = $request->name;
        $userType->status = $request->status;
        $userType->userType = $request->userType;
        $userType->save();
        return redirect()->route('admin.userType.index')->with('success','User Type Created Successfully');
    }
    public function edit($id)
    {
        $userTypeData = UserType::find($id);
        return view('admin.userType.edit',compact('userTypeData'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $userType = UserType::find($id);
        $userType->name = $request->name;
        $userType->status = $request->status;
        $userType->userType = $request->userType;
        $userType->save();
        return redirect()->route('admin.userType.index')->with('success','User Type Updated Successfully');
    }
    public function destroy(Request $request,$id)
    {
        $userType = UserType::find($id);
        $userType->deleted_at = Carbon::now();
        $userType->save();
        $request->session()->flash('success', 'User Type deleted successfully.');
    }
}
