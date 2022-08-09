<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ExportType;
class ExportTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $exportTypeList = ExportType::where('deleted_at','')->get();
        return view('admin.exportType.index',compact('exportTypeList'));
    }
    public function create()
    {
        return view('admin.exportType.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $exportType = new ExportType;
        $exportType->name = $request->name;
        $exportType->status = $request->status;
        $exportType->userType = $request->userType;
        $exportType->save();
        return redirect()->route('admin.exportType.index')->with('success','Export Type Created Successfully');
    }
    public function edit($id)
    {
        $exportTypeData = ExportType::find($id);
        return view('admin.exportType.edit',compact('exportTypeData'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $exportType = ExportType::find($id);
        $exportType->name = $request->name;
        $exportType->status = $request->status;
        $exportType->userType = $request->userType;
        $exportType->save();
        return redirect()->route('admin.exportType.index')->with('success','Export Type Updated Successfully');
    }
    public function destroy(Request $request,$id)
    {
        $exportType = ExportType::find($id);
        $exportType->deleted_at = Carbon::now();
        $exportType->save();
        $request->session()->flash('success', 'Export Type deleted successfully.');
    }
}
