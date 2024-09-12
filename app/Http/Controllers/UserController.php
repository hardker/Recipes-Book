<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        //dd($request->all());
        User::create($request->all());
      //  event(new Registered($user));
      //  Auth::login($user);
        return redirect()->route('login')->with('success', 'Регистрация выполнена');
    }

    public function login()
    {
        return view('user.login');
    }
    public function loginAuth(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', '']
        ]);
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->intended('fav')->with('success','Добро пожаловать '.Auth::user()->name.'!');
        }
        return back()->withError (['email'=>'Неправильный логин или пароль', ]);
     //   dump($request->boolean('remember'));
     //   dd($request->all());
        //  return view('user.login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function dashboard()
    {
        return view('user.dashboard');
    }
}