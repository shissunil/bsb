<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ExportCapacity;

class ExportCapacityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $exportCapacityList = ExportCapacity::where('deleted_at','')->get();
        return view('admin.exportCapacity.index',compact('exportCapacityList'));
    }
    public function create()
    {
        return view('admin.exportCapacity.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $exportCapacity = new ExportCapacity;
        $exportCapacity->name = $request->name;
        $exportCapacity->status = $request->status;
        $exportCapacity->userType = $request->userType;

        $exportCapacity->save();
        return redirect()->route('admin.exportCapacity.index')->with('success','Export Capacity Added Successfully');
    }
    public function edit($id)
    {
        $exportCapacityData = ExportCapacity::find($id);
        return view('admin.exportCapacity.edit',compact('exportCapacityData'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $exportCapacity = ExportCapacity::find($id);
        $exportCapacity->name = $request->name;
        $exportCapacity->status = $request->status;
        $exportCapacity->userType = $request->userType;
        $exportCapacity->save();
        return redirect()->route('admin.exportCapacity.index')->with('success','Export Capacity Updated Successfully');
    }
    public function destroy(Request $request,$id)
    {
        $exportCapacity = ExportCapacity::find($id);
        $exportCapacity->deleted_at = Carbon::now();
        $exportCapacity->save();
        $request->session()->flash('success', 'Export Capacity deleted successfully.');
    }
}
