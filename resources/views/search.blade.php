@extends('shablons.shablon-main')
@section('titles', 'Категории')

@section('main_content')
    {{-- @include('includes.categories') --}}
    {{-- <h1> Категории</h1> --}}
    @foreach ($results as $result)
        {{-- <a href={{ route('cat', $cat->slug) }}> --}}
        <a href="{{ route('recipe', $result->slug) }}">{{ $result->title }}
            <div>

                <h1> {{ $result->title }}</h1>

                <img src="{{ asset($result->path) }}" alt="{{ $result->title }}" onError="this.src='../img/img_not_found.gif'; this.onerror=null">
                {{ $result->title }}

                Описание рецепта
                <div class="text-indent">
                    {{ $result->description }}
                </div>
                Время приготовления
                {{ $result->timing }}
                Калорийность
                {{ $result->calorie }}
                калорий
            </div>
        </a>
    @endforeach

    <p> {{ $results->links('components.pagination') }}</p>
@endsection
