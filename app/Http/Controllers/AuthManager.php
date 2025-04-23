<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;
class AuthManager extends Controller
{
    function login()
    {
        return view('login');
    }

    function registration()
    {
        return view('registration');
    }

    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else if ($user->role === 'organization_admin') {
                return redirect()->route('org.dashboard');
            } else if ($user->role === 'patient') {
                return redirect()->intended();
            }else{
                return redirect()->route('user.index');
            }
        }
        return redirect(route('login'))->with('error', 'Invalid login details');
    }

    function registrationPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number'=> 'required|string',
            'address'=>'required|string',
            'password' => 'required|min:6|confirmed',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone_number'] = $request->phone_number;
        $data['address'] = $request->address;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if (!$user) {
            return redirect(route('registration'))->with('error', 'Registration Failed, try again.');
        }
        return redirect(route('login'))->with('success', 'Registration successful, login now.');
    }
    function logout()
    {
        Auth::logout();
        FacadesSession::flush();
        return redirect(route('login'));
    }


}
