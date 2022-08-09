<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Material;
class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $materialList = Material::where('deleted_at','')->get();
        return view('admin.material.index',compact('materialList'));
    }
    public function create()
    {
        return view('admin.material.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $material = new Material;
        $material->name = $request->name;
        $material->status = $request->status;
        $material->userType = $request->userType;
        $material->save();
        return redirect()->route('admin.material.index')->with('success','Material Created Successfully');
    }
    public function edit($id)
    {
        $materialData = Material::find($id);
        return view('admin.material.edit',compact('materialData'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $material = Material::find($id);
        $material->name = $request->name;
        $material->status = $request->status;
        $material->userType = $request->userType;
        $material->save();
        return redirect()->route('admin.material.index')->with('success','Material Updated Successfully');
    }
    public function destroy(Request $request,$id)
    {
        $material = Material::find($id);
        $material->deleted_at = Carbon::now();
        $material->save();
        $request->session()->flash('success', 'Material deleted successfully.');
    }
}
