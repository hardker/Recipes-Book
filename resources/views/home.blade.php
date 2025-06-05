@extends('shablons.shablon-main')
@section('titles', 'Главная страница')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Главная</li>
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 d-none d-sm-block">
                <img class="img-fluid d-flex justify-content-end" style="height: 900px;" src="img/book.png">
            </div>
            <div class="col-12 col-sm-8">
                <h1 class="text-center"><i> Категории</i></h1>
                @foreach ($categories as $cat)
                    <a class="text-decoration-none" href={{ route('cat', $cat->slug) }}>
                        <div class='clearfix'>
                            <div class="col-12 col-xl-8 align-self-center fw-bold">
                                <i class="h2"><b>{{ $cat->name_cat }}</b></i><br><br>
                                <img src="{{ asset($cat->path) }}" alt="{{ $cat->name_cat }}" class="rounded col-12 col-sm-4 float-start mb-3 me-3"
                                    style="" onError="this.src='/img/img_not_found.gif'; this.onerror=null">
                                <i> {{ $cat->description }} </i>
                            </div>
                        </div>
                    </a>
                    <br>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container-md">
        <br>
        <h3 class=" ">Лучшие рецепты</h3>
        <br>
        <!--карусель-->
        <div id="carousel" class="carousel carousel-dark slide" data-bs-ride="carousel">
            @if (count($recipesCarousel))
                <div class="carousel-inner">
                    @foreach ($recipesCarousel as $index => $recipe)
                        <div class="carousel-item {{ $index == 2 ? 'active' : '' }}">
                            <figure>
                                <a class="text-decoration-none" href="{{ route('recipe', $recipe->slug) }}">
                                    <div class="row justify-content-start">
                                        <div class="col-12">
                                            <img src="{{ asset($recipe->path) }}" alt="{{ $recipe->title }}" class="float-start mb-3 me-md-3"
                                                style="height: 250px; width: 250px;" onError="this.src='/img/img_not_found.gif'; this.onerror=null"
                                                alt="{{ $recipe->title }}">
                                            <h2> {{ $recipe->title }}</h2>
                                            <div class="container text-left">
                                                <div class="d-none d-sm-block">
                                                    Описание рецепта
                                                    {{ mb_substr($recipe->description, 0, 200) }}
                                                    ...
                                                    <br>
                                                </div>
                                                Время приготовления
                                                {{ $recipe->timing }}
                                                <br>
                                                Калорийность
                                                {{ $recipe->calorie }}
                                                калорий
                                                <div class="rating">
                                                    Рейтинг:
                                                    {!! str_repeat('<span><i style="font-size: 1rem; color:#deb217;" class="bi bi-star-fill"></i></span>', floor($recipe->comments_avg_rating)) !!}
                                                    {!! str_repeat('<span><i class="bi bi-star"></i></span>', 5 - floor($recipe->comments_avg_rating)) !!}
                                                    {{ number_format($recipe->comments_avg_rating, 1) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </figure>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Предыдущий</span>
                </button>
                <button class="carousel-control-next " type="button" data-bs-target="#carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon " aria-hidden="true"></span>
                    <span class="visually-hidden">Следующий</span>
                </button>
            @else
                <h4>Жаль, но рецепты не найдены!</h4>
            @endif
        </div>
    </div>
@endsection
