<!DOCTYPE html>
<html lang="ru" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titles', 'Recipes-Book')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- <link rel="icon" type="image/png" href="favicon.png"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- <link href="{{ asset('css/bootstrap-icons.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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


    @include('components.header')

    <div class="container my-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom overflow-hidden text-center bg-body-tertiary border rounded-3">
                @yield('breadcrumb')
            </ol>
        </nav>
    </div>

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

        {{-- @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif --}}

        @yield('main_content')

        <!-- Всплывающее сообщение-->
        @if (Session::has('msg_success'))
            <div id="liveToast" class="toast fade hide toast-container position-fixed bottom-0 end-0 p-2 text-bg-primary border-0" role="status"
                aria-live="polite" aria-atomic="true" data-bs-delay="10000">
                <div class="d-flex">
                    <div class="toast-body">
                        <strong>ПОЗДРАВЛЯЮ!</strong><br>
                        {!! session('msg_success') !!}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Закрыть"></button>
                </div>
            </div>
            <script>
                const toastBtstr = bootstrap.Toast.getOrCreateInstance(document.getElementById('liveToast'))
                toastBtstr.show()
            </script>
        @endif
    </main>

    @include('components.footer')


</body>


</html>
