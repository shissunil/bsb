<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function buyer()
    {
        $userList = User::where('id', '!=', Auth::id())->where('role_id',3)->orderBy('id', 'DESC')->get();
        return view('admin.user.index', compact('userList'));
    }
    public function seller()
    {
        $userList = User::where('id', '!=', Auth::id())->where('role_id',4)->orderBy('id', 'DESC')->get();
        return view('admin.user.seller', compact('userList'));
    }
}
