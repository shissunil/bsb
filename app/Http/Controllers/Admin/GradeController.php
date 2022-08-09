<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Grade;
class GradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $gradeList = Grade::where('deleted_at','')->get();
        return view('admin.grade.index',compact('gradeList'));
    }
    public function create()
    {
        return view('admin.grade.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $grade = new Grade;
        $grade->name = $request->name;
        $grade->status = $request->status;
        $grade->userType = $request->userType;
        $grade->save();
        return redirect()->route('admin.grade.index')->with('success','Grade Created Successfully');
    }
    public function edit($id)
    {
        $gradeData = Grade::find($id);
        return view('admin.grade.edit',compact('gradeData'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $grade = Grade::find($id);
        $grade->name = $request->name;
        $grade->status = $request->status;
        $grade->userType = $request->userType;
        $grade->save();
        return redirect()->route('admin.grade.index')->with('success','Grade Updated Successfully');
    }
    public function destroy(Request $request,$id)
    {
        $grade = Grade::find($id);
        $grade->deleted_at = Carbon::now();
        $grade->save();
        $request->session()->flash('success', 'Grade deleted successfully.');
    }
}
