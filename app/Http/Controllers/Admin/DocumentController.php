<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\DocumentMaster;
class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $documentList = DocumentMaster::where('deleted_at','')->get();
        return view('admin.document.index',compact('documentList'));
    }
    public function create()
    {
        return view('admin.document.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $document = new DocumentMaster;
        $document->name = $request->name;
        $document->status = $request->status;
        $document->userType = $request->userType;

        $document->save();
        return redirect()->route('admin.document.index')->with('success','Document Created Successfully');
    }
    public function edit($id)
    {
        $documentData = DocumentMaster::find($id);
        return view('admin.document.edit',compact('documentData'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $document = DocumentMaster::find($id);
        $document->name = $request->name;
        $document->status = $request->status;
        $document->userType = $request->userType;
        $document->save();
        return redirect()->route('admin.document.index')->with('success','Document Updated Successfully');
    }
    public function destroy(Request $request,$id)
    {
        $document = DocumentMaster::find($id);
        $document->deleted_at = Carbon::now();
        $document->save();
        $request->session()->flash('success', 'Document deleted successfully.');
    }
}
