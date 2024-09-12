@extends('shablons.shablon-main')
@section('titles', 'Рецепты')

@section('main_content')
    {{-- @include('includes.categories') --}}
    <h1> {{ $recipe->title }}</h1>
    <div>
        <img src="{{ asset('img/' . $recipe->slug . '.jpeg') }}" alt="{{ $recipe->slug }}">
        Описание рецепта
        <div style="white-space: pre-wrap;">
            {{ $recipe->description }}
        </div>
        Приготовление рецепта
        <div style="white-space: pre-wrap;">
            {{ $recipe->text }}
        </div>
        Время приготовления
        {{ $recipe->timing }}
        Калорийность
        {{ $recipe->calorie }}
        калорий

        Ингредиенты
        <div style="white-space: pre-wrap;">
            {{ $recipe->ingredients }}
        </div>
        {{-- В избранное --}}
        @auth
            <div class=" whitespace-nowrap flex justify-between w-max gap-5">
                @if (!$stat or $stat->status == false)
                    <a href="{{ route('InFavorite', ['id' => $recipe->id, 'status' => '1']) }}" class="btn btn-outline-danger">
                        <i width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"></i>
                        Добавить в избранное
                    </a>
                @else
                    <a href="{{ route('InFavorite', ['id' => $recipe->id, 'status' => '0']) }}" class="btn btn-outline-danger">
                        <i width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"> </i>
                        Убрать из избранного
                    </a>
                @endif
            </div>
        @endauth

        <div class="rating">
              {{-- {{ $rat}} --}}

              Рейтинг: {{ number_format($rat, 1) }}</p>

            {!! str_repeat('<span><i class="bi bi-star-fill"></i></span>', floor($rat)) !!}
            {!! str_repeat('<span><i class="bi bi-star"></i></span>', 5 - floor($rat)) !!}
        </div>
      
    </div>
@endsection
