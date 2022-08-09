<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\DealType;

class DealTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $dealTypeList = DealType::where('deleted_at','')->get();
        return view('admin.dealType.index',compact('dealTypeList'));
    }
    public function create()
    {
        return view('admin.dealType.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $dealType = new DealType;
        $dealType->name = $request->name;
        $dealType->status = $request->status;
        $dealType->userType = $request->userType;
        $dealType->save();
        return redirect()->route('admin.dealType.index')->with('success','Deal Type Created Successfully');
    }
    public function edit($id)
    {
        $dealTypeData = DealType::find($id);
        return view('admin.dealType.edit',compact('dealTypeData'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $dealType = DealType::find($id);
        $dealType->name = $request->name;
        $dealType->status = $request->status;
        $dealType->userType = $request->userType;
        $dealType->save();
        return redirect()->route('admin.dealType.index')->with('success','Deal Type Updated Successfully');
    }
    public function destroy(Request $request,$id)
    {
        $dealType = DealType::find($id);
        $dealType->deleted_at = Carbon::now();
        $dealType->save();
        
        $request->session()->flash('success', 'Deal Type deleted successfully.');
    }
}
