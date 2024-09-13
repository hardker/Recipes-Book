@extends('shablons.shablon-main')
@section('titles', 'Рецепты')

@section('main_content')
    {{-- @include('includes.categories') --}}

    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

        .rating-container .form-control:hover,
        .rating-container .form-control:focus {
            background: #fff;
            border: 1px solid #ced4da;
        }

        .rating-container textarea:focus,
        .rating-container input:focus {
            color: #000;
        }

        /* End */
    </style>
    <h1 class="text-center"> {{ $recipe->title }}</h1>
    <div class="container">
        <div class="container text-left">
            <div class="row justify-content-start">
                <div class="col-4">
                    <img src="{{ asset('img/' . $recipe->slug . '.jpeg') }}" alt="{{ $recipe->slug }}" widht="300"
                        height="300">
                </div>
                <div class="col-6"; font-weight:bold>
                    <br>
                    <h4>Описание рецепта</h4>
                    <div style="white-space: pre-wrap">
                        <i> {{ $recipe->description }} </i>
                    </div>
                </div>
            </div>
            <div>
                <h4>Приготовление рецепта</h4>
                <div style="white-space: pre-wrap;">
                    {{ $recipe->text }}
                </div>
                <h4>Время приготовления</h4>
                {{ $recipe->timing }}
                <br>
                <h4>Калорийность</h4>
                {{ $recipe->calorie }}
                калорий
                <br>
                <h4>Ингредиенты</h4>
                <div style="white-space: pre-wrap;">
                    {{ $recipe->ingredients }}
                </div>
            </div>
            <!-- Избранное -->
            @auth
                <div class=" whitespace-nowrap flex justify-between w-max gap-5">
                    @if (!$stat or $stat->status == false)
                        <a href="{{ route('InFavorite', ['id' => $recipe->id, 'status' => '1']) }}"
                            class="btn btn-outline-danger">
                            <i width="16" height="16" fill="currentColor" class="bi bi-heart-fill"
                                viewBox="0 0 16 16"></i>
                            Добавить в избранное
                        </a>
                    @else
                        <a href="{{ route('InFavorite', ['id' => $recipe->id, 'status' => '0']) }}"
                            class="btn btn-outline-danger">
                            <i width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            </i>
                            Убрать из избранного
                        </a>
                    @endif
                </div>
            @endauth

        </div>

        <!-- Отзывы -->



        <div data-spy="scroll" data-target="#navbar-example2" data-offset="0">

            <div class="row mt-5">
                <h4>Отзывы о рецепте:</h4>
                <div class="col-sm-12 mt-5">
                    @foreach ($recipe->comments as $comment)
                        <div class=" review-content">
                            <p class="mt-1"> Отзыв
                                {{-- <img src="https://www.w3schools.com/howto/img_avatar.png" class="avatar "> --}}
                                <span class="font-weight-bold ml-2">{{ $comment->name }}</span>
                                {{-- <span class="font ml-2">{{ $comment->email }}</span> --}}
                                {!! str_repeat(
                                    '<span><i style="font-size: 1rem; color:#deb217; " class="bi bi-star-fill"></i></span>',
                                    floor($comment->rating),
                                ) !!}
                                {!! str_repeat('<span><i class="bi bi-star"></i></span>', 5 - floor($comment->rating)) !!}
                                {{ number_format($comment->rating, 1) }}
                            </p>
                            <p class="description ">
                                {{ $comment->comment }}
                            </p>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Новый комментарий -->
    <div class="container">
        <div class="row">
            <div class="col-sm-10 mt-4 ">
                <form class="py-2 px-4" style="box-shadow: 0 0 10px 0 #ddd;" action="{{ route('CommentCreate') }}"
                    method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                    <div class="row justify-content-end mb-1">
                        <div class="col-sm-8 float-right">
                            @if (Session::has('flash_msg_success'))
                                <div class="alert alert-success alert-dismissible p-2">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>ПОЗДРАВЛЯЮ!</strong> {!! session('flash_msg_success') !!}.
                                </div>
                            @endif
                        </div>
                    </div>


                    <p class="font-weight-bold ">Оставьте отзыв о рецепте:</p>
                    <div class="form-group row">
                        <div class=" col-sm-6">
                            <input class="form-control" type="text" name="name" placeholder="Ваше имя" maxlength="40"
                                required />
                        </div>
                        <div class="col-sm-6">
                            ОЦЕНИТЕ РЕЦЕПТ:
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-sm-6">
                            <input class="form-control" type="email" name="email" placeholder="Ваш Email" maxlength="80"
                                required />
                        </div>
                        <div class="col-sm-6">
                            <div class="rate">
                                <input type="radio" id="star5" class="rate" name="rating" value="5" />
                                <label for="star5" title="5 звезд">5 stars</label>
                                <input type="radio" id="star4" class="rate" name="rating" value="4" />
                                <label for="star4" title="4 звезды">4 stars</label>
                                <input type="radio" checked id="star3" class="rate" name="rating" value="3" />
                                <label for="star3" title="3 звезды">3 stars</label>
                                <input type="radio" id="star2" class="rate" name="rating" value="2">
                                <label for="star2" title="2 звезды">2 stars</label>
                                <input type="radio" id="star1" class="rate" name="rating" value="1" />
                                <label for="star1" title="1 звезда">1 star</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <div class="col-sm-12 ">
                            <textarea class="form-control" name="comment" rows="6 " placeholder="Ваш комментарий" maxlength="200"></textarea>
                        </div>
                    </div>
                    <div class="mt-3 ">
                        <button type="submit" class="btn btn-outline-primary me-2">Отправить
                            <i width="16" height="16" fill="currentColor" class="bi bi-send"
                                viewBox="0 0 16 16"> </i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
