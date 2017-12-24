<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['create', 'store']
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

	/*
		用户注册页面
	*/
    public function create()
    {
        return view('users.create');
    }

    /*
    	处理用户注册表单请求
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        session()->flash('success', 'Sign Up Success!');
        return redirect()->route('home', [$user]);
    }
}
