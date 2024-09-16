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
            <div class="my-3">
                <label for="email" class="form-label">Электронный адрес</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="my-3">
                <label for="password" class="form-label">Пароль</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-check text-start my-3">
                <input name="remember" class="form-check-input" type="checkbox" id="remember">
                <label class="form-check-label" for="remember">
                    Запомнить меня
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit" class="btn btn-primary">ВХОД</button>
        </form>
    </div>
@endsection
