<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        $title = 'Login Admin';

        return view('admin.auth.login')->with(compact('title'));
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:200',
            'password' => 'required|max:200'
        ]);
        $data = $request->all();

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return redirect('admin/home');
        }
        return redirect('admin/login')->with('error', 'You not admin!');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
