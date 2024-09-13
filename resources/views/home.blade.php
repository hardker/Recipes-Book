@extends('shablons.shablon-main')
@section('titles', 'Главная страница')


@section('main_content')
    <div class="container">
        <h1><i> Категории</i></h1>
    </div>
    <div class="container">

        @foreach ($categories as $cat)
            <a href={{ route('cat', $cat->slug) }}>
                <div>
                    <img src="{{ asset($cat->images) }}" alt="{{ $cat->name_cat }}" widht="250" height="250">
                    <i><b>{{ $cat->name_cat }}</b></i>
                </div>
            </a>
            <br>
        @endforeach
    </div>
@endsection
