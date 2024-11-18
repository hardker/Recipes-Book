@extends('shablons.shablon-main')
@section('titles', 'Рецепт')

@section('styles')
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

        /*
                        .rating-container .form-control:hover,
                        .rating-container .form-control:focus
                        {background: #fff; border: 1px solid #ced4da;}

                        .rating-container textarea:focus,
                        .rating-container input:focus
                        { color: #000; }    */
    </style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none" href="/">Главная</a></li>
    <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none" href="{{ route('cat', $category->slug) }}">Книга</a></li>
    <li class="breadcrumb-item active" aria-current="page">Рецепт</li>
@endsection

@section('main_content')
    <h1 class="text-center"> {{ $recipe->title }}</h1>
    <div class="container">
        <div class="container text-left">
            <div class="row justify-content-start">
                <div class="col-4">
                    <img src="{{ asset($recipe->path) }}" alt="{{ $recipe->slug }}" widht="300" height="300" id='image'
                        onError="this.src='../img/img_not_found.gif'; this.onerror=null">
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
                <h3>Приготовление рецепта</h3>
                {{-- <div class="text-nowrap bg-body-secondary border"> --}}
                <div class="lh-sm fs-5" style="white-space: break-spaces">
                    {{ $recipe->text }}
                </div>
                <h5>Время приготовления: {{ $recipe->timing }}</h5>
                <br>
                <h5>Калорийность: {{ $recipe->calorie }} калорий</h5>

                <br>
                <h4>Ингредиенты</h4>
                <div class="lh-sm fs-5" style="white-space: break-spaces">
                    {{ $recipe->ingredients }}
                </div>
            </div>
            <!-- Избранное -->
            @auth
                <div class=" whitespace-nowrap flex justify-between w-max gap-5">
                    @if (!$stat or $stat->status == false)
                        <a href="{{ route('InFavorite', ['id' => $recipe->id, 'status' => '1']) }}" class="btn btn-outline-danger">
                            <i width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"></i>
                            Добавить в избранное
                        </a>
                    @else
                        <a href="{{ route('InFavorite', ['id' => $recipe->id, 'status' => '0']) }}" class="btn btn-outline-danger">
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
                                <span class="font-weight-bold ml-2">{{ $comment->name }}</span>
                                {!! str_repeat('<span><i style="font-size: 1rem; color:#deb217; " class="bi bi-star-fill"></i></span>', floor($comment->rating)) !!}
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
                <form class="py-2 px-4" style="box-shadow: 0 0 10px 0 #ddd;" action="{{ route('comment.add') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                    <!-- Всплывающее сообщение-->
                    @if (Session::has('msg_success'))
                        <div class="fade show toast-container position-fixed bottom-0 end-0 p-2 text-bg-primary border-0" role="alert"
                            aria-live="assertive" aria-atomic="true" data-bs-delay="1000" data-bs-autohide="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    <strong>ПОЗДРАВЛЯЮ!</strong><br>
                                    {!! session('msg_success') !!}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                    aria-label="Закрыть"></button>
                            </div>
                        </div>
                    @endif


                    {{-- <div class="row justify-content-end mb-1">
                        <div class="col-sm-8 float-right">
                            @if (Session::has('msg_success'))
                                <div class="alert alert-success alert-dismissible p-2">
                                    <a href="?" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>ПОЗДРАВЛЯЮ!</strong> {!! session('msg_success') !!}
                                </div>
                            @endif
                        </div>
                    </div> --}}


                    <p class="font-weight-bold ">Оставьте отзыв о рецепте:</p>
                    <div class="form-group row ">
                        <div class=" col-sm-6">
                            {{-- Если пользователь авторизован, то заполняем его имя, емаил.  --}}
                            @auth
                                <input class="form-control" type="text" name="name" value="{{ Auth::user()->name }}" maxlength="40" required
                                    readonly />
                            @endauth
                            @guest
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Ваше имя"
                                    maxlength="40" required />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endguest

                        </div>
                        <div class="col-sm-6">
                            ОЦЕНИТЕ РЕЦЕПТ:
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            @auth
                                <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}" maxlength="40" required
                                    readonly />
                            @endauth
                            @guest
                                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Ваш Email"
                                    maxlength="80" required />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endguest
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
                            <i width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16"> </i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
