<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Like;
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
        // dd($request);
        return back()->with('msg_error', 'Неправильный логин или пароль');

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

    public function profile()
    {
        // $data['stat'] = Like::where('user_id', operator: Auth::id())->where('recipe_id', $data['recipe']->id)->first();
        $recipes = Recipe::where('user_id', Auth::id())->withAvg('comments', 'rating')
            // ->withAvg('likes', 'status')
            ->defaultSort('comments_avg_rating', 'desc')->paginate(5);
        $comments = Comment::with('recipe')->where('email', Auth::user()->email)
            ->defaultSort('created_at', 'desc')->paginate(5);
        //dump($recipes);
        return view('user.profile', compact('recipes', 'comments'));
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'confirm_password' => 'required_with:password|same:password',
            // 'avatar' => 'image',
        ]);

        $input = $request->all();

        // if ($request->hasFile('avatar')) {
        //     $avatarName = time().'.'.$request->avatar->getClientOriginalExtension();
        //     $request->avatar->move(public_path('avatars'), $avatarName);

        //     $input['avatar'] = $avatarName;

        // } else {
        //     unset($input['avatar']);
        // }

        if ($request->filled('password')) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }

        auth()->user()->update($input);

        return back()->with('msg_success', 'Профиль успешно обновлен.');
    }
    public function delсomment($id)
    {
        Comment::destroy($id);
        return back()->with('msg_success', 'Комментарий успешно удален!');
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
