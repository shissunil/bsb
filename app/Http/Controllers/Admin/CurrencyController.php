<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Currency;
class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $currencyList = Currency::where('deleted_at','')->get();
        return view('admin.currency.index',compact('currencyList'));
    }
    public function create()
    {
        return view('admin.currency.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $currency = new Currency;
        $currency->name = $request->name;
        $currency->status = $request->status;
        $currency->userType = $request->userType;
        $currency->save();
        return redirect()->route('admin.currency.index')->with('success','Currency Created Successfully');
    }
    public function edit($id)
    {
        $currencyData = Currency::find($id);
        return view('admin.currency.edit',compact('currencyData'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $currency = Currency::find($id);
        $currency->name = $request->name;
        $currency->status = $request->status;
        $currency->userType = $request->userType;
        $currency->save();
        return redirect()->route('admin.currency.index')->with('success','Currency Updated Successfully');
    }
    public function destroy(Request $request,$id)
    {
        $currency = Currency::find($id);
        $currency->deleted_at = Carbon::now();
        $currency->save();
        $request->session()->flash('success', 'Currency deleted successfully.');
    }
}
