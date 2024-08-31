@extends('shablons.shablon-main')
@section('titles', 'Главная страница')


@section('main_content')
    {{-- @include('includes.categories') --}}
    <h1> Категории</h1>
    @foreach ($categories as $cat)
        <a href={{ route('cat', $cat->slug) }}>
            <div>
                <img src="{{ asset($cat->images) }}" alt="{{ $cat->name_cat }}">
                {{ $cat->name_cat }}
                {{--  --}}

                {{-- <a href="{{route('getRecipesByCategory',$cat->slug)}}">{{$cat->name_cat}}</a> --}}
            </div>
        </a>
    @endforeach
@endsection
