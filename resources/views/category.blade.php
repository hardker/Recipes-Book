@extends('shablons.shablon-main')
@section('titles', 'Категории')

@section('main_content')
    {{-- @include('includes.categories') --}}

    <h1> {{ $title }}</h1>
    <div class="container">
        @if (count($recipes))
            @foreach ($recipes as $rec)
                {{-- <a href={{ route('cat', $cat->slug) }}> --}}
                <h2> {{ $rec->title }}</h2>
                <a class="text-decoration-none" href="{{ route('recipe', $rec->slug) }}">
                    <div class="row justify-content-start">
                        <div class="col-4">

                            <img src="{{ asset('img/' . $rec->slug . '.jpeg') }}" alt="{{ $rec->title }}" widht="250"
                                height="250">
                        </div>
                        <div class="col-5">
                            <div class="container text-left">
                                Описание рецепта
                                <div>
                                    {{ mb_substr($rec->description, 0, 250) }}
                                    ...
                                    <br>
                                    <!--{{ $rec->description }}-->
                                </div>
                                Время приготовления
                                {{ $rec->timing }}
                                <br>
                                Калорийность
                                {{ $rec->calorie }}
                                калорий


                                <div class="rating">
                                    Рейтинг:
                                    {!! str_repeat(
                                        '<span><i style="font-size: 1rem; color:#deb217;" class="bi bi-star-fill"></i></span>',
                                        floor($rec->comments_avg_rating),
                                    ) !!}
                                    {!! str_repeat('<span><i class="bi bi-star"></i></span>', 5 - floor($rec->comments_avg_rating)) !!}
                                    {{ number_format($rec->comments_avg_rating, 1) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach


            <p> {{ $recipes->links('includes.pagination') }}</p>
        @else
            <div>
                Добавьте любимые рецепты в избранное нажав на кнопку снизу каждого рецепта
            </div>

        @endif

    @endsection
