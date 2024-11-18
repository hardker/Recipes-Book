@extends('shablons.shablon-main')
@section('titles', 'Авторизация')
@section('styles')
    <style>
        html,
        body {
            height: 100%;
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }

        /* .form-signin .form-floating:focus-within {
                                                            z-index: 2;
                                                        }*/
    </style>
@endsection

@section('main_content')
    <div class="form-signin w-100 m-auto">
        <form action="{{ route('login.auth') }}" method="post">
            <h1 class="h3 mb-3 fw-normal text-center">АВТОРИЗАЦИЯ</h1>
            @csrf
            <div class="form-floating my-3">

                <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
                <label for="email">Адрес электронной почты</label>
            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                <label for="password">Пароль</label>
            </div>
            <div class="form-check text-start my-3">
                <input name="remember" class="form-check-input" type="checkbox" id="remember">
                <label class="form-check-label" for="remember">
                    Запомнить меня
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit" class="btn btn-primary">ВХОД</button>
        </form>
        <div class="py-3 d-flex align-items-center">
            <hr class="flex-grow-1" />
            <div class="badge bg-secondary">ИЛИ ВВОЙТИ ЧЕРЕЗ</div>
            <hr class="flex-grow-1" />
        </div>
        <!-- Авторизация через соц.сети -->

        {{-- <div class="form-group row mb-0"> --}}
        <div class="col-md-8 offset-md-4">
            <a href="{{ route('yandex') }}" class="btn">
                <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="44" height="44" rx="12" fill="#FC3F1D"></rect>
                    <path
                        d="M24.7406 33.9778H29.0888V9.04445H22.7591C16.3928 9.04445 13.0537 12.303 13.0537 17.1176C13.0537 21.2731 15.2186 23.6164 19.0531 26.1609L21.3831 27.6987L18.3926 25.1907L12.4666 33.9778H17.1817L23.5113 24.5317L21.3097 23.0672C18.6494 21.2731 17.3468 19.8818 17.3468 16.8613C17.3468 14.2069 19.2182 12.4128 22.7775 12.4128H24.7222V33.9778H24.7406Z"
                        fill="white"></path>
                </svg>
            </a>
        </div>

        {{-- <a href="{{ url('login/telegram') }}" class="btn btn-primary">Login with telegram</a> --}}

        {{-- <div class="tgme_widget_login medium nouserpic" id="widget_login"><button class="btn tgme_widget_login_button"
                onclick="return TWidgetLogin.auth();"><i class="tgme_widget_login_button_icon"></i>Log in with Telegram</button></div>

        <script src="//telegram.org/js/widget-frame.js?27"></script>
        <script>
            TWidgetLogin.init('widget_login', 547043436, {
                "origin": "https:\/\/core.telegram.org"
            }, false, "en"); --}}





        {{-- <div class = "tgme_widget_login large nouserpic" id = "widget_login">
            <button class = "btn tgme_widget_login_button" onclick = "return TWidgetLogin.auth();">
                <i class = "tgme_widget_login_button_icon"> </i>
                Войти через Telegram</button>
        </div>


        <script src="https://telegram.org/js/widget-frame.js?22"></script>
        <script>
            TWidgetLogin.init('widget_login', 7705222573, {
                "origin": "https:\/\/core.telegram.org",
                "embed": 1,
                "request_access": "write",
                "return_to": "http:\/\/127.0.0.1:8000\/login"
            }, false);
        </script> --}}




        {!! Socialite::driver('telegram')->getButton() !!}

        {{-- <div class="col-md-8 offset-md-4">
            <a href="{{ route('telegram') }}" class="btn">
                <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="44" height="44" rx="12" fill="#FC3F1D"></rect>
                    <path
                        d="M24.7406 33.9778H29.0888V9.04445H22.7591C16.3928 9.04445 13.0537 12.303 13.0537 17.1176C13.0537 21.2731 15.2186 23.6164 19.0531 26.1609L21.3831 27.6987L18.3926 25.1907L12.4666 33.9778H17.1817L23.5113 24.5317L21.3097 23.0672C18.6494 21.2731 17.3468 19.8818 17.3468 16.8613C17.3468 14.2069 19.2182 12.4128 22.7775 12.4128H24.7222V33.9778H24.7406Z"
                        fill="white"></path>
                </svg>
            </a>
        </div> --}}

        {{-- <button class="btn tgme_widget_login_button" onclick="return TWidgetLogin.auth();"><i class="tgme_widget_login_button_icon"></i>Войти через
            Telegram</button> --}}
        {{-- </div> --}}
        <!-- -->

    </div>

    {{-- <script async src="https://telegram.org/js/telegram-widget.js?22" data-telegram-login="RecipesBookMV_Bot" data-size="large" data-userpic="false"
        data-radius="10" data-onauth="onTelegramAuth(user)" data-request-access="write"></script>
    <script type="text/javascript">
        function onTelegramAuth(user) {
            alert('Logged in as ' + user.first_name + ' ' + user.last_name + ' (' + user.id + (user.username ? ', @' + user.username : '') + ')');
        }
    </script> --}}

@endsection
