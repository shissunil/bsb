<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Order;
use App\Models\AssignEmployee;
use App\Models\User;
use App\Models\Chat;
use App\Models\ChatHead;
use Carbon\Carbon;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $orderList = Order::where('deleted_at','')->get();
        return view('admin.orders.index',compact('orderList'));
    }
    public function view($id)
    {
        // dd(\Auth::user()->hasOneAssignEmployee);
        $orderData = Order::findOrFail($id);
        $assignEmployeeList = AssignEmployee::where('deleted_at','')->where('order_id',$id)->get();
        $assignEmployeeId = '';
        if (count($assignEmployeeList) > 0)
        {
            foreach($assignEmployeeList as $employee)
            {
                $assignEmployeeId .= $employee->user_id.',';
            }
        }
        $assignEmployeeId = rtrim($assignEmployeeId,',');
        $assignEmployeeId = explode(',',$assignEmployeeId);
        $employeeList = User::where('deleted_at','')->whereNotIn('id',$assignEmployeeId)->where('role_id','5')->where('status','1')->get();
        $chatList = Chat::where('deleted_at','')->where('order_id',$id)->get();
        $chatHeadData = ChatHead::where('deleted_at','')->where('order_id',$id)->first();
        return view('admin.orders.view',compact('orderData','assignEmployeeList','employeeList','chatList','chatHeadData'));
    }
    public function assignEmployee(Request $request)
    {
        $request->validate([
            'employee'=> 'required',
        ]);
        foreach($request->employee as $emp)
        {
            $assignEmployee = new AssignEmployee;
            $assignEmployee->order_id = $request->order_id;
            $assignEmployee->user_id = $emp;
            $assignEmployee->save();
        }
        return redirect()->back()->with('success','Employee Assign Successfully');
    }
    public function destroyEmployee(Request $request,$id)
    {
        $employee = AssignEmployee::where('deleted_at','')->find($id);
        $employee->deleted_at = Carbon::now();
        $employee->save();
        $request->session()->flash('success', 'Employee Remove successfully.');
    }


    //Bayer Order
    public function buyerindex()
    {
        $buyerOrderList = Order::where('user_id','4')->where('deleted_at','')->get();
        //dd($buyerOrderList);
        return view('admin.buyerOrder.index',compact('buyerOrderList'));
    }
    public function buyerview($id)
    {
        // dd(\Auth::user()->hasOneAssignEmployee);
        $orderData = Order::findOrFail($id);
        $assignEmployeeList = AssignEmployee::where('deleted_at','')->where('order_id',$id)->get();
        $assignEmployeeId = '';
        if (count($assignEmployeeList) > 0)
        {
            foreach($assignEmployeeList as $employee)
            {
                $assignEmployeeId .= $employee->user_id.',';
            }
        }
        $assignEmployeeId = rtrim($assignEmployeeId,',');
        $assignEmployeeId = explode(',',$assignEmployeeId);
        $employeeList = User::where('deleted_at','')->whereNotIn('id',$assignEmployeeId)->where('role_id','5')->where('status','1')->get();
        $chatList = Chat::where('deleted_at','')->where('order_id',$id)->get();
        $chatHeadData = ChatHead::where('deleted_at','')->where('order_id',$id)->first();
        //dd($chatHeadData);
        return view('admin.orders.view',compact('orderData','assignEmployeeList','employeeList','chatList','chatHeadData'));
    }
    // public function harsh()
    // {
    //     return view('admin.Chat.harsh');
    // }
    
}

