@extends('shablons.shablon-main')
@section('titles', 'Книга')
@section('breadcrumb')
            <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none" href="/">Главная</a></li>
            <li class="breadcrumb-item active " aria-current="page">{{ $bread }}</li>
@endsection
@section('main_content')
    <h1 class="text-center"> {{ $title }}</h1>

    <div class="container">
        @if (count($recipes))
            @foreach ($recipes as $rec)
                {{-- <a href={{ route('cat', $cat->slug) }}> --}}
                <h2> {{ $rec->title }}</h2>
                <a class="text-decoration-none" href="{{ route('recipe', $rec->slug) }}" >
                    <div class="row justify-content-start">
                        <div class="col-3">
                            <img src="{{ asset($rec->path) }}" alt="{{ $rec->title }}" widht="250" height="250" onError="this.src='/img/img_not_found.gif'; this.onerror=null">
                        </div>
                        <div class="col-6">
                            <div class="container text-left">
                                Описание рецепта
                                <div>
                                    {{ mb_substr($rec->description, 0, 250) }}
                                    ...
                                    <br>
                                    <!--{{ $rec->description }}-->
                                </div>
                                Время приготовления
                                {{ $rec->timing }}
                                <br>
                                Калорийность
                                {{ $rec->calorie }}
                                калорий

                                <div class="rating">
                                    Рейтинг:
                                    {!! str_repeat(
                                        '<span><i style="font-size: 1rem; color:#deb217;" class="bi bi-star-fill"></i></span>',
                                        floor($rec->comments_avg_rating),
                                    ) !!}
                                    {!! str_repeat('<span><i class="bi bi-star"></i></span>', 5 - floor($rec->comments_avg_rating)) !!}
                                    {{ number_format($rec->comments_avg_rating, 1) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            <p> {{ $recipes->links('components.pagination') }}</p>
        @else
            <div>
                @auth()
                    В избранном пока ничего нет.
                    Добавьте любимые рецепты в избранное нажав на кнопку снизу каждого рецепта
                @else
                    Для добавления любимых рецептов в избранное пожалуйста <a href="{{ route('login') }}" class="ms-0">
                        авторизируйтесь</a>
                @endauth
            </div>
        @endif
    </div>
@endsection
