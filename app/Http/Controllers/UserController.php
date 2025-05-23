<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;


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
            'password' => ['required', 'confirmed'],
        ]);

        //dd($request->all());
        User::create($request->all());

        //  event(new Registered($user));
        //  Auth::login($user);
        return redirect()->route('login')->with('msg_success', 'Регистрация выполнена');
    }

    public function login()
    {
        return view('user.login');
    }

    public function loginAuth(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', ''],
        ]);
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect()->intended('fav')->with('msg_success', Auth::user()->name.' Вы успешно авторизованы!');
        }

        return back()->withError(['email' => 'Неправильный логин или пароль']);
        //   dump($request->boolean('remember'));
        //   dd($request->all());
        //  return view('user.login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function yandex() // перенаправляем юзера на яндекс Auth
    {
        return Socialite::driver('yandex')->redirect();
    }

    public function yandexCallback() // принимаем возвращаемые данные и работаем с ними
    {
        $user = Socialite::driver('yandex')->user();
        // используем firstOrCreate для проверки есть ли такие пользователи в нашей БД
        $user = User::firstOrCreate(
            ['email' => $user->email,],
            [
                'name' => $user->user['display_name'], // display_name - переменаая хранящая полное ФИО пользователя
                'password' => Hash::make(Str::random(24)),
            ]
        );
        // dd($user);
        Auth::login($user, true);
        if (Auth::check()) {
            return redirect()->intended('fav')->with('msg_success', value: 'Добро пожаловать '.Auth::user()->name.'!');
        }
    }

    public function telegram()
    {
        return Socialite::driver('telegram')->redirect();
        //return Socialite::with('telegram')->stateless(false)->redirect();

    }

    public function telegramCallback()
    {
        $user = Socialite::driver('telegram')->user();

        // используем firstOrCreate для проверки есть ли такие пользователи в нашей БД
        $user = User::firstOrCreate(
            ['email' => $user->id.'@telegram.user'],
            [
                'name' => $user->user['first_name'], // display_name - переменаая хранящая полное ФИО пользователя
                'password' => Hash::make(Str::random(24)),
            ]
        );
        //dd($user);
        Auth::login($user, true);
        if (Auth::check()) {
            return redirect()->intended('fav')->with('msg_success', value: 'Добро пожаловать '.Auth::user()->name.'!');
        }

    }

}
