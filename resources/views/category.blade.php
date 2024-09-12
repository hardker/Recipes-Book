@extends('shablons.shablon-main')
@section('titles', 'Категории')

@section('main_content')
    {{-- @include('includes.categories') --}}

    <h1> {{ $title }}</h1>
    @if (count($recipes))
        @foreach ($recipes as $rec)
            {{-- <a href={{ route('cat', $cat->slug) }}> --}}
            <a href="{{ route('recipe', $rec->slug) }}">{{ $rec->title }}
                <div>
                    <h2> {{ $rec->title }}</h2>
                    <img src="{{ asset('img/' . $rec->slug . '.jpeg') }}" alt="{{ $rec->title }}">
                    Описание рецепта
                    <div class="text-indent">
                        {{ $rec->description }}
                    </div>
                    Время приготовления
                    {{ $rec->timing }}
                    Калорийность
                    {{ $rec->calorie }}
                    калорий
                </div>
            </a>
            <div class="rating">
                Рейтинг:
                {{ $rec->likes_avg_rating }}
                {!! str_repeat('<span><i class="bi bi-star-fill"></i></span>', floor($rec->likes_avg_rating)) !!}
                {!! str_repeat('<span><i class="bi bi-star"></i></span>', 5 - floor($rec->likes_avg_rating)) !!}
            </div>
        @endforeach


        <p> {{ $recipes->links('includes.pagination') }}</p>
    @else
        <div>
            Добавьте любимые рецепты в избранное нажав на кнопку снизу каждого рецепта
        </div>

    @endif

@endsection
