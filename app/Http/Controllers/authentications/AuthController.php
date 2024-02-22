<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.login', ['pageConfigs' => $pageConfigs]);
    }
    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $session = User::where('username', $request->username)->first();
            // dd($session);
            Session::put('name', $session->name);

            $request->session()->regenerate();
            if (request()->user()->role != 'admin') {
                return redirect()->intended('/');
            } else {
                return redirect()->intended('/dashboard');
            }
        }

        return back()->withInput()->withErrors([
            'password' => 'Wrong username or password',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    public function logout_users(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
