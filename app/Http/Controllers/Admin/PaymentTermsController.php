<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PaymentTerm;

class PaymentTermsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $paymentTermsList = PaymentTerm::where('deleted_at','')->get();
        return view('admin.paymentTerms.index',compact('paymentTermsList'));
    }
    public function create()
    {
        return view('admin.paymentTerms.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $paymentTerms = new PaymentTerm;
        $paymentTerms->name = $request->name;
        $paymentTerms->status = $request->status;
        $paymentTerms->userType = $request->userType;
        $paymentTerms->save();
        return redirect()->route('admin.paymentTerms.index')->with('success','Payment Terms Created Successfully');
    }
    public function edit($id)
    {
        $paymentTermsData = PaymentTerm::find($id);
        return view('admin.paymentTerms.edit',compact('paymentTermsData'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $paymentTerms = PaymentTerm::find($id);
        $paymentTerms->name = $request->name;
        $paymentTerms->status = $request->status;
        $paymentTerms->userType = $request->userType;
        $paymentTerms->save();
        return redirect()->route('admin.paymentTerms.index')->with('success','Payment Terms Updated Successfully');
    }
    public function destroy(Request $request,$id)
    {
        $paymentTerms = PaymentTerm::find($id);
        $paymentTerms->deleted_at = Carbon::now();
        $paymentTerms->save();
        $request->session()->flash('success', 'Payment Terms deleted successfully.');
    }
}
