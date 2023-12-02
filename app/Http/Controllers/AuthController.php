<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    public function getRegister()
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    public function postRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        Auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'You account successfully created and logged in!');
    }
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            
            return redirect()->route('dashboard')->with('success', 'Login successfull.');
        }

        return redirect()->back()->withErrors(['Invalid email or password.']);
    } 

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
