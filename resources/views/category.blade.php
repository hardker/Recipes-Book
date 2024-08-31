@extends('shablons.shablon-main')
@section('titles', 'Категории')

@section('main_content')
    {{-- @include('includes.categories') --}}
    {{-- <h1> Категории</h1> --}}
    @foreach ($recipes as $rec)
        {{-- <a href={{ route('cat', $cat->slug) }}> --}}
        <a href="#">{{($rec->title) }}
            <div>
                <img src="{{ asset('img/' . $rec->slug . '.jpeg') }}" alt="{{ $rec->title }}">
                {{ $rec->title }}
                {{--  --}}

                {{-- <a href="{{route('getRecipesByCategory',$cat->slug)}}">{{$cat->name_cat}}</a> --}}
            </div>
        </a>
    @endforeach
@endsection
