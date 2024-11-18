@extends('shablons.shablon-main')
@section('titles', 'Регистрация')
@section('styles')
    <style>
        html,
        body {
            height: 100%;
        }

        .form-regin {
            max-width: 400px;
            padding: 1rem;
        }

    </style>
@endsection

@section('main_content')

    <div class="form-regin w-100 m-auto">
        <h1 class="h2">Форма регистрации</h1>
        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="form-floating mb-3">
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="name">Введите Имя</label>
            </div>
            <div class="form-floating">
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="email">Введите Email</label>
            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="password">Введите пароль</label>
            </div>
            <div class="form-floating">
                <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                <label for="password_confirmation">Подтвердите пароль</label>
            </div>

            <button type="submit" class="btn btn-primary">Регистрация</button>
            <a href="{{ route('login') }}" class="ms-3">Уже зарегистрированы?</a>

        </form>

    </div>


@endsection
