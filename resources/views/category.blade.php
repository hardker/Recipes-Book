@extends('shablons.shablon-main')
@section('titles', 'Книга')
@section('breadcrumb')
    <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none" href="/">Главная</a></li>
    <li class="breadcrumb-item active " aria-current="page">{{ $bread }}</li>
@endsection
@section('main_content')
    <h1 class="text-center"> {{ $title }}
        @if (Route::current()->getName() == 'search')
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Сортировать рецепты по
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('search', ['query' => $query, 'sort' => 'title']) }}">алфавиту</a></li>
                    <li><a class="dropdown-item"
                            href="{{ route('search', ['query' => $query, 'sort' => 'category_id', 'flag' => 'asc']) }}">категориям</a></li>
                    <li><a class="dropdown-item"
                            href="{{ route('search', ['query' => $query, 'sort' => 'comments_avg_rating', 'flag' => 'desc']) }}">рейтингу</a>
                    </li>
                </ul>
            </div>
        @endif
    </h1>
    <div class="container-md">
        @if (count($recipes))
            @foreach ($recipes as $rec)
                <h2 class="mx-auto"> {{ $rec->title }}</h2>
                <a class="text-decoration-none" href="{{ route('recipe', $rec->slug) }}">
                    <div class="row justify-content-start">
                        <div class="clearfix">
                            <img src="{{ asset($rec->path) }}" alt="{{ $rec->title }}" class="float-start mb-3 me-md-3"
                                style="height: 250px; width: 250px;" onError="this.src='/img/img_not_found.gif'; this.onerror=null">
                            Описание рецепта
                            <div>
                                {{ mb_substr($rec->description, 0, 250) }}
                                ...
                                <br>
                            </div>
                            Время приготовления
                            {{ $rec->timing }}
                            <br>
                            Калорийность
                            {{ $rec->calorie }}
                            калорий
                            <div class="rating">
                                Рейтинг:
                                {!! str_repeat('<span><i style="font-size: 1rem; color:#deb217;" class="bi bi-star-fill"></i></span>', floor($rec->comments_avg_rating)) !!}
                                {!! str_repeat('<span><i class="bi bi-star"></i></span>', 5 - floor($rec->comments_avg_rating)) !!}
                                {{ number_format($rec->comments_avg_rating, 1) }}
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            <p> {{ $recipes->appends(Request::except('page'))->links('components.pagination') }}</p>
        @else
            <div class="alert alert-danger" role="alert">
                Записей не найдено.
                @if ($bread === 'Поиск')
                    Проверьте правильность написания
                @else
                    @auth()
                        <div class="alert alert-primary" role="alert">
                            Добавьте любимые рецепты в избранное нажав на кнопку снизу каждого рецепта
                        @else
                            Для добавления любимых рецептов в избранное пожалуйста <a href="{{ route('login') }}" class="ms-0"> авторизируйтесь</a>
                        </div>
                    @endauth
                @endif
            </div>
        @endif
    </div>
@endsection
