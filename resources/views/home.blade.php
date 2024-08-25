@extends('shablons.shablon-main')
@section('titles')
    Главная страница
@endsection
@section('main_content')
    @foreach ($categorii as $cat)
        <div>
            <img src="{{ asset('' . $cat->images) }}" >
            {{ $cat->name_cat }}
        </div>
    @endforeach
@endsection
