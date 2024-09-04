<!DOCTYPE html>
<html lang="ru" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titles', 'Recipes-Book')</title>
    {{-- @vite('resources/css/app.css') --}}
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">

</head>

<body>

    <script src="{{ asset('css/bootstrap.min.js')}}" ></script>
    @include('components.header')


    <main>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('main_content')
    </main>

    @include('components.footer')

</body>

</html>
