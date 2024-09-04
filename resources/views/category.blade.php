@extends('shablons.shablon-main')
@section('titles', 'Категории')

@section('main_content')
    {{-- @include('includes.categories') --}}

    <h1> {{ $title }}</h1>

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

                {{-- <a href="{{route('getRecipesByCategory',$cat->slug)}}">{{$cat->name_cat}}</a> --}}
            </div>
        </a>
    @endforeach
@endsection
