<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Colour;
class ColourController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $colourList = Colour::where('deleted_at','')->get();
        return view('admin.colour.index',compact('colourList'));
    }
    public function create()
    {
        return view('admin.colour.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $colour = new Colour;
        $colour->name = $request->name;
        $colour->code = $request->code;
        $colour->status = $request->status;
        $colour->userType = $request->userType;
        $colour->save();
        return redirect()->route('admin.colour.index')->with('success','Colour Created Successfully');
    }
    public function edit($id)
    {
        $colourData = Colour::find($id);
        return view('admin.colour.edit',compact('colourData'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $colour = Colour::find($id);
        $colour->name = $request->name;
        $colour->code = $request->code;
        $colour->status = $request->status;
        $colour->userType = $request->userType;
        $colour->save();
        return redirect()->route('admin.colour.index')->with('success','Colour Updated Successfully');
    }
    public function destroy(Request $request,$id)
    {
        $colour = Colour::find($id);
        $colour->deleted_at = Carbon::now();
        $colour->save();
        $request->session()->flash('success', 'Colour deleted successfully.');
    }
}
