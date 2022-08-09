<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Chat;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $offerList = Offer::where('deleted_at','')->get();
        //dd($offerList);
        return view('admin.offers.index',compact('offerList'));
    }
    public function view($id)
    {
        $offerData = Offer::find($id);
        //dd($offerData);
        // $assignEmployee = AssignEmployee::where('deleted_at','')->select('user_id')->where('offer_id',$id)->get()->toArray();
        $chatList = Chat::where('deleted_at','')->where('order_id',$id)->get();
        return view('admin.offers.view',compact('offerData','chatList'));
    }
    public function offerMediaDownload($filename)
    {
        $filepath = storage_path(). "/uploads/offerMedia/".$filename;
        if ( file_exists( $filepath ) ) 
        {
            return \Response::download( $filepath, $filename);
        } 
        else
        {
            return redirect()->back()->with('error','Requested file does not exist on our server!');
        }
       // dd($filepath);
    }
    public function changeStatus(Request $request)
    {
        $offerId = $request->offer_id;
        $offerStatus = $request->offer_status;
        $offerData = Offer::find($offerId);
        if ($offerData)
        {
            $offerData->status = $offerStatus;
            $offerData->save();
        }
        // return $request->session()->flash('success', 'Grade deleted successfully.');
    }


     //Bayer Offer


    public function buyerindex()
    {
        $buyerOfferList = Offer::where('user_id','4')->where('deleted_at','')->get();
        //dd($buyerOfferList);
        return view('admin.buyerOffer.index',compact('buyerOfferList'));
    }
    public function bayerview($id)
    {
        $offerData = Offer::find($id);
        //dd($offerData);
        // $assignEmployee = AssignEmployee::where('deleted_at','')->select('user_id')->where('offer_id',$id)->get()->toArray();
        $chatList = Chat::where('deleted_at','')->where('order_id',$id)->get();
        return view('admin.buyerOffer.view',compact('offerData','chatList'));
    }
    // public function bayerofferMediaDownload($filename)
    // {
    //     $filepath = storage_path(). "/uploads/offerMedia/".$filename;
    //     if ( file_exists( $filepath ) ) 
    //     {
    //         return \Response::download( $filepath, $filename);
    //     } 
    //     else
    //     {
    //         return redirect()->back()->with('error','Requested file does not exist on our server!');
    //     }
    //    // dd($filepath);
    // }
    // public function bayerchangeStatus(Request $request)
    // {
    //     $offerId = $request->offer_id;
    //     $bayerOffertatus = $request->offer_status;
    //     $offerData = Offer::find($offerId);
    //     if ($offerData)
    //     {
    //         $offerData->status = $offerStatus;
    //         $offerData->save();
    //     }
    //     // return $request->session()->flash('success', 'Grade deleted successfully.');
    // }
}
