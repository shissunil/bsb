<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\Permission;
use App\Models\User;
use App\Models\ChatHead;
use App\Models\Chat;
use App\Models\Order;
use App\Models\AssignEmployee;
use Carbon\Carbon;
use Session;
class ChatController extends Controller
{
	public function index(Request $request)
	{
		$roleId = Session('id');
		$userData = Session::get('role_id');
	    $chatHeads = ChatHead::where('deleted_at','')->where('chat_type','1')->get();
	    $groupChat = ChatHead::where('deleted_at','')->where('chat_type','0')->get();
	 	$user = User::where('deleted_at','')->where('role_id','5')->get();
	    // $lastMassage = Chat::where('chat_head_id',$userData)->orderBy('chat_head_id')->latest('id','message')->first();
 		 //$lastMassage = Chat::latest()->first();
                    //dd($lastMassage);
		return view('admin.chat.chat',compact('user','chatHeads','groupChat'));
	}
	public function harsh()
	{	
		$roleId = Session('id');
		$userData = Session::get('role_id');
	    $chatHeads = ChatHead::where('deleted_at','')->where('chat_type','1')->get();
	    $groupChat = ChatHead::where('deleted_at','')->where('chat_type','0')->get();
	 	$user = User::where('deleted_at','')->where('role_id','5')->get();
		return view('admin.chat.harsh',compact('user','chatHeads','groupChat'));
	}
	// public function view($id)
	// {	
	// 	$orderData = Order::findOrFail($id);
 //        $assignEmployeeList = Assign
	//Employee::where('deleted_at','')->where('order_id',$id)->get();
 //        $assignEmployeeId = '';
 //        if (count($assignEmployeeList) > 0)
 //        {
 //            foreach($assignEmployeeList as $employee)
 //            {
 //                $assignEmployeeId .= $employee->user_id.',';
 //            }
 //        }
 //        $assignEmployeeId = rtrim($assignEmployeeId,',');
 //        $assignEmployeeId = explode(',',$assignEmployeeId);
 //        $employeeList = User::where('deleted_at','')->whereNotIn('id',$assignEmployeeId)->where('role_id','5')->where('status','1')->get();
 //        $chatList = Chat::where('deleted_at','')->where('order_id',$id)->get();
 //        $chatHeadData = ChatHead::where('deleted_at','')->where('order_id',$id)->first();
 //        return redirect()->route('admin.chat.submitChat');
 //        //return view('admin.chat.chat',compact('orderData','assignEmployeeList','employeeList','chatList','chatHeadData'));
	// }
	public function store(Request $request)
	{	
		
		$roleId = Session('id');
		$userId = Session::get('id');
		//dd($userData);
		$userData = ChatHead::where('deleted_at','')->where('recever_id',$request->name)->where('sender_id',$userId)->first();
		if($userData)
		{
			return redirect()->route('admin.chat.harsh');
		}
		else
		{
			$Chat = new ChatHead;
			$Chat->order_id = '0';
			$Chat->sender_id =$roleId;
			$Chat->recever_id = $request->name;
			$Chat->chat_type = "1";
			$Chat->deleted_at = "";
		//dd($Chat);
		$Chat->save();
		}

		return redirect()->route('admin.chat.showMessage');
	}
	public function getMessage(Request $request)
	{
		$chatHeadId = $request->chat_head_id;
		$chatHeadData = ChatHead::find($chatHeadId);
		$chatList = Chat::where('deleted_at','')->where('chat_head_id',$chatHeadId)->get();
		$lastMassage = Chat::where('chat_head_id',$chatHeadId)->latest('message')->first();
		$assignEmployeeList = AssignEmployee::where('deleted_at','')->where('order_id',$chatHeadId)->get();
		return view('admin.chat.getMessage',compact('chatHeadData','chatList','lastMassage','assignEmployeeList',));
	}

	public function showMessage(Request $request)
	{
		$chatHeadId = $request->chat_head_id;
		$chatHeadData = ChatHead::find($chatHeadId);
		//dd($chatHeadData)
		// $chatName = ChatHead::where('deleted_at','')->get();
		$chatList = Chat::where('deleted_at','')->where('chat_head_id',$chatHeadId)->get();
		return view('admin.chat.showMessage',compact('chatHeadData','chatList'));
	}
	public function destroy(Request $request,$id)
	{
		// $Chat =ChatHead::find($id);
		// $Chat->deleted_at= Carbon::now();
		// $Chat->save();
		// //$Chat->delete();
		// $request->session()->flash('success','Your Chat is deleted.');
	// 	//return redirect()->route('admin.chat.index');
	}
	public function submitChat(Request $request)
    {
    	// dd($request);
        $message = $request->message ?? '';
        // $attachId = $request->attach_file ?? '';
        if ($message != '')
        {
            $chat = new Chat;
            $chat->chat_head_id = $request->chat_head_id; 
            $chat->sender_id = Auth::id(); 
            $chat->order_id = ''; 
            $chat->recever_id = $request->recever_id;
            $chat->message =  $request->message;
            // if($chat)
            // {
            // 	$chat->message = $request->message;
            // }
            // else
            // {
            // 	$chat->message = $request->attach_file;
            // }


	        // if ($request->hasfile("attach_file")) 
	        // {
	        //     $file = $request->file("attach_file");
	        //     $extension = $file->getClientOriginalName();
	        //     $filename = time() . "." . $extension;
	        //     $file->move("public/attach_file", $filename);
	        //    	$chat->message= $filename;
	        // }
	        // else
	        // {
	        //     $chat->message = $request->message;;
	        // }
            $chat->deleted_at =""; 
           	//dd($chat->message);
            $chat->save();
        }
        $offset = $request->offset ?? 0;
        // $chatList = Chat::where('deleted_at','')->where('recever_id',$request->recever_id)->get();
        $chatList = Chat::where('deleted_at','')->where('chat_head_id',$request->chat_head_id)->get();
         //dd($chatList);
        return view('admin.chat.showMessage',compact('chatList'));
    }

}

