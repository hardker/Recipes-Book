<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titles')</title>
</head>

<body>
    <div class="top-line">
        <div class="container">
            <a href='/' class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="" >
            </a>
            <div class="user-account">
                <span class="user-account__text"> Личный кабинет </span>

            </div>
        </div>
    </div>
    <main>
        @yield('main_content')
    </main>
</body>

</html>
