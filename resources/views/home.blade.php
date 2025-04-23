@extends('shablons.shablon-main')
@section('titles', 'Главная страница')
@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Главная</li>
@endsection

@section('main_content')
<div class="container">

</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <img class="img-fluid d-flex justify-content-end" style="height: 900px;" src="img/book.png">
        </div>
        <div class="col-8">
            <h1 class="text-center"><i> Категории</i></h1>
            @foreach ($categories as $cat)
            <a class="text-decoration-none" href={{ route('cat', $cat->slug) }}>
                <div class='row'>
                    <div class="col-4 d-flex justify-content-center">
                        <img src="{{ asset($cat->path) }}" alt="{{ $cat->name_cat }}" widht="250" height="250"
                            onError="this.src='/img/img_not_found.gif'; this.onerror=null">
                    </div>
                    <div class="col-4 align-self-center" ; font-weight:bold>
                        <i class="h2"><b>{{ $cat->name_cat }}</b></i><br><br>
                        <i> {{ $cat->description }} </i>
                    </div>
                </div>
            </a>
            <br>
            @endforeach
        </div>
    </div>

</div>
@endsection