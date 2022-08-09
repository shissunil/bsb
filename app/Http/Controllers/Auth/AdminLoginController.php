<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        // dd(bcrypt($request->password));
        if (Auth::attempt($credentials, $request->remember)) {

            $user = auth()->user();
            //$user = auth()->user();
            $request->session()->put("email", $user->email);
            $request->session()->put("id", $user->id);  
            $request->session()->put("role_id", $user->role_id);
            if ($user->status=='1') {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                Auth::logout();
                return back()->with('error', 'This account is not activated. Please contact the administrator.');
            }
        }

        return back()->withError('Invalid login credentials')->withInput($request->only('email'));
    }
    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
