@extends('shablons.shablon-main')
@section('titles', 'Главная страница')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Главная</li>
@endsection

@section('main_content')
    <div class="container">
        <h1><i> Категории</i></h1>
    </div>
    <div class="container">

        @foreach ($categories as $cat)
            <a href={{ route('cat', $cat->slug) }}>
                <div>
                    <img src="{{ asset($cat->images) }}" alt="{{ $cat->name_cat }}" widht="250" height="250"
                        onError="this.src='/img/img_not_found.gif'; this.onerror=null">
                    <i><b>{{ $cat->name_cat }}</b></i>
                </div>
            </a>
            <br>
        @endforeach
    </div>
@endsection
