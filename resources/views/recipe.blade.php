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
                @if ($status)
                    <a href="{{ route('InFavorite', ['id' => $recipe->id, 'status' => '0']) }}"
                        class="p-2 hover:bg-zinc-300 rounded w-100 bg-gray-200 dark:text-black">Убрать из избранного
                    </a>
                @else
                    <a href="{{ route('InFavorite', ['id' => $recipe->id, 'status' => '1']) }}"
                        class="p-2 hover:bg-zinc-300 rounded w-100 bg-gray-200 dark:text-black">Добавить в избранное
                @endif
            </div>
        @endauth
    </div>
@endsection
