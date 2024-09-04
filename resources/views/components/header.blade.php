<script>
    // выпадающий список
    // function toggleDropdown() {
    //     document.getElementById('catalog-text').style.display = 'none';
    //     document.getElementById('catalog-img').style.display = 'none';
    //     var catalogList = document.getElementById("catalog-list");
    //     if (catalogList.style.display === "flex") {
    //         catalogList.style.display = "none";

    //     } else {
    //         catalogList.style.display = "flex";
    //     }
    // }

    // window.onclick = function(event) {
    //     if (!event.target.matches('.button-catalog, .button-catalog *')) {
    //         var catalogList = document.getElementById("catalog-list");
    //         if (catalogList.style.display === "flex") {
    //             catalogList.style.display = "none";
    //             document.getElementById('catalog-text').style.display = 'block';
    //             document.getElementById('catalog-img').style.display = 'block';
    //         }
    //     }
    // }
</script>
<div class="container">
    <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">


        <div class="col-md-3 mb-2 mb-md-0">
            <a href="{{ route('home') }}" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="{{ asset('img/logo.png') }}" alt="Логотип">
            </a>
        </div>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
            <li><a href="#" class="nav-link px-2">Features</a></li>
            <li><a href="#" class="nav-link px-2">Pricing</a></li>
            <li><a href="#" class="nav-link px-2">FAQs</a></li>
            <li><a href="#" class="nav-link px-2">About</a></li>
        </ul>
        <form action="{{ route('search') }}" method="GET"
            class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 icon-link icon-link-hover" role="search">
            @csrf
            <input type="search" class="form-control" name="query" placeholder="Поиск рецептов..."
                aria-label="Search" required>
            <button class="btn btn-primary d-inline-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
                {{-- <img src="/img/search.svg" class="search-icon-svg" alt="ПОИСК"> --}}
            </button>
        </form>

        <div class="col-md-3 text-end">


            @if (Route::has('login'))
                @auth
                    <div class="user-account">
                        <span class="user-account__text"> Добро пожаловать </span>
                    </div>
                    <div class="user-account">
                        <a href="#">{{ auth()->user()->name }}</a>
                    </div>

                    <div class="favorites">
                        <a href="{{ route('fav') }}">
                            МОЯ КНИГА РЕЦЕПТОВ
                        </a>
                    </div>
                    <a href="{{ route('logout') }}">
                        <button type="button" class="btn btn-outline-primary me-2">Выход</button>
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        <button type="button" class="btn btn-outline-primary me-2">Вход</button>
                    </a>
                    <a href="{{ route('register') }}">
                        <button type="button" class="btn btn-outline-primary">Регистрация</button>
                    </a>

                @endauth
            @endif




        </div>
    </header>
</div>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">






    </div>
</nav>

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
</div>
