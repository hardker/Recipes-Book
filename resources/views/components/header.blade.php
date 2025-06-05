<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-auto mb-2 mb-md-0">
            <a href="{{ route('home') }}" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="{{ asset('img/logo.png') }}" alt="Логотип" class="img-fluid" style="height: 60px;">
            </a>
        </div>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{ route('mera_vesa') }}" class="nav-link px-2 link-secondary">Меры веса</a></li>
            {{--  <li><a href="#" class="nav-link px-2">FAQs</a></li> --}}
            <li><a href="{{ route('about') }}" class="nav-link px-2">О НАС</a></li>
        </ul>
        <!-- Поиск-->
        <form action="{{ route('search') }}" method="POST" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 icon-link icon-link-hover" role="search">
            @csrf
            <input type="search" class="form-control" name="query" placeholder="Поиск рецептов..." aria-label="Search" required>
            <button class="btn btn-primary d-inline-flex align-items-center">
                <i width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"> </i>
            </button>
        </form>
        @auth
            <a href="{{ route('fav') }}" class="btn btn-outline-primary me-2"> МОЯ КНИГА РЕЦЕПТОВ </a>
            {{-- @endauth --}}
            <div class="col-md-auto text-end">
                @if (Route::has('login'))
                    <div class="dropdown text-end">
                        {{-- <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" role="button" data-bs-toggle="dropdown"
                aria-expanded="false" data-bs-offset="0,20"> 
                <img src="img/no_user.png" alt="{{ auth()->user()->name }}" width="32" height="32" class="rounded-circle"> </a> --}}
                        {{-- <svg class="bi pe-none" width="32" height="32" role="img" aria-label="Customers">
                     <use xlink:href="#people-circle"></use>  </svg> --}}

                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                            data-bs-auto-close="outside">
                            <i fill="currentColor" class="bi bi-person-circle"> </i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li>
                                <h6 class="dropdown-header">{{ auth()->user()->name }}</h6>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('recipe.new') }}">Добавить рецепт</a></li>
                            @if (Auth::user()->isAdmin())
                                <li><a class="dropdown-item" href="{{ url('admin') }}">Admin Panel</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Профиль</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Выход</a></li>
                        </ul>
                    </div>
                @endif
            </div>
            {{--  @auth
                    <div class="user-account">
                        <span class="text-primary"> Добро пожаловать {{ auth()->user()->name }}</span> --}}
            {{-- <a href="#"></a> --}}
            {{-- </div>
                    <a href="{{ route('recipe.new') }}" class="btn btn-outline-primary me-2"> ДОБАВИТЬ РЕЦЕПТ </a>
                    <a href="{{ route('logout') }}" class="btn btn-outline-primary">Выход</a> --}}
        @else
            <div class="col-md-auto text-end">
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Вход </a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary">Регистрация </a>
            </div>
        @endauth
    </header>
</div>



{{-- <div class="header-buttons">

        @auth

            <a href="{{ route('cart') }}"class="button-catalog-svg"><img src="/img/buttons/korz.svg"
                    class="catalog-img">Корзина</a>
            <a href="{{ route('orders.list') }}"class="button-catalog-svg"><img src="/img/buttons/pos.svg"
                    class="catalog-img">Заказы</a>
            <form action="{{ route('logout') }}" method="POST" class="button-catalog-svg">
                @csrf <!-- Добавляем CSRF токен для безопасности -->
                <button class="button-catalog-svg" type="submit">
                    <img src="/img/buttons/person.svg" class="catalog-img">Выход
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="button-catalog-svg"><img src="/img/buttons/person.svg"
                    class="catalog-img">Вход</a>
            <a href="{{ route('cart') }}"class="button-catalog-svg"><img src="/img/buttons/korz.svg"
                    class="catalog-img">Корзина</a>
            <a href="{{ route('orders.list') }}"class="button-catalog-svg"><img src="/img/buttons/pos.svg"
                    class="catalog-img">Заказы</a>
        @endauth
    </div> --}}
