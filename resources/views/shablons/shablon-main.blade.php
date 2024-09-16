<!DOCTYPE html>
<html lang="ru" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titles', 'Recipes-Book')</title>
    {{-- @vite('resources/css/app.css') --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.min.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> --}}
  
    <style>
        body {
            background-color: #fdf5e6;
            margin: 0px;
            width: 100%;
            height: 100%;
            overflow: scroll;
        }
  /* <!--Обводим значки при наведении --> */
        [class*="btn"],
        h2,
        p {

            /* border: 2px; */
            i:hover {
                -webkit-text-stroke: 2px;
            }
        }
    </style>
    @yield('styles')

</head>

<body>

    <script src="{{ asset('css/bootstrap.min.js') }}"></script>
    @include('components.header')
    @yield('breadcrumb')

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
