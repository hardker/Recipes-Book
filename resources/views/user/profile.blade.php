@extends('shablons.shablon-main')
@section('titles', 'Профиль пользователя')
@section('main_content')
    <h1 class="h2 text-center">Профиль пользователя {{ auth()->user()->name }}</h1>

    <div class="container">
        <div class="card">
            <div class="card-header">{{ ' Редактирование профиля ' }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.profile.save') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- @if (session('success'))
                            <div class="alert alert-success" role="alert" class="text-danger">
                                {{ session('success') }}
                            </div>
                        @endif --}}

                    {{-- <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Avatar: </label>
                                <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}"  autocomplete="avatar">
  
                                @error('avatar')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
  
                            <div class="mb-3 col-md-6">
                                <img src="/avatars/{{ auth()->user()->avatar }}" style="width:80px;margin-top: 10px;">
                            </div>
  
                        </div> --}}

                    <div class="row">
                        <div class="form-floating mb-3 col-md-6">
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                value="{{ auth()->user()->name }}" autofocus="" placeholder="Name">
                            @error('name')
                                <span role="alert" class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="name" class="form-label"> Введите Имя </label>
                        </div>
                        <div class="form-floating mb-3 col-md-6">
                            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                value="{{ auth()->user()->email }}" placeholder="Email">
                            @error('email')
                                <span role="alert" class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="email" class="form-label">Введите Email </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-floating mb-3 col-md-6">

                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="Password">
                            @error('password')
                                <span role="alert" class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="password" class="form-label"> Введите пароль </label>
                        </div>

                        <div class="form-floating mb-3 col-md-6">
                            <input name="password_confirmation" class="form-control" type="password" id="password_confirmation"
                                placeholder="Confirm Password">
                            @error('password_confirmation')
                                <span role="alert" class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="password_confirmation" class="form-label">Подтвердите пароль </label>
                        </div>
                    </div>

                    {{-- <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Phone: </label>
                                <input class="form-control" type="text" id="phone" name="phone" value="{{ auth()->user()->phone }}" autofocus="" >
                                @error('phone')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
   
                            <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">City: </label>
                                <input class="form-control" type="text" id="city" name="city" value="{{ auth()->user()->city }}" autofocus="" >
                                @error('city')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                    <div class="row mb-0">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                                {{ 'Обновить профиль' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <!-- Таблица рецептов пользователя-->
            <div class="card col-md-6">
                <div class="card-header">{{ 'Добавленные рецепты  ' }}</div>
                <div class="card-body">
                    <table class="table table-responsive table-sm table-bordered border-primary table-hover">
                        @if ($recipes->count())
                            <tr>
                                {{-- <th>№</th> --}}
                                <th width="470px">Название</th>
                                <th>Рейтинг</th>
                                <th>Добавлен</th>
                                <th>&#9989;</th>
                            </tr>
                            @foreach ($recipes as $key => $recipe)
                                <tr>
                                    {{-- <td>{{ ++$key }}</td> --}}
                                    {{-- <td>{{ $recipe->id }}</td> --}}
                                    <td class="text-success ">
                                        <a href=" {{ 'recipe/' . $recipe->slug }}">
                                            <label class="label label-success">{{ $recipe->title }}</label>
                                        </a>
                                    </td>
                                    <td class="text-info">{{ round($recipe->comments_avg_rating, 2) }}</td>
                                    <td class="text-primary">{{ $recipe->created_at->format('d.m.y') }}</td>
                                    <td class="text-primary">{{ is_null($recipe->edit_id) ? '--' : 'Да' }}</td>
                                </tr>
                            @endforeach
                        @else
                            <a href="{{ route('recipe.new') }}" class="btn btn-outline-primary me-2"> ДОБАВИТЬ РЕЦЕПТ </a>
                        @endif
                    </table>
                    <p> {{ $recipes->appends(Request::except('page'))->links('components.pagination') }}</p>
                </div>
            </div>
            <!-- Таблица комментариев пользователя-->
            <div class="card col-md-6">
                <div class="card-header">{{ 'Добавленные комментарии  ' }}</div>
                <div class="card-body">
                    <table class="table table-responsive table-sm table-bordered border-primary table-hover">
                        @if ($comments->count())
                            <tr>
                                {{-- <th>№</th> --}}
                                <th width="200px">Рецепт</th>
                                <th width="470px">Комментарий</th>
                                <th>Введен</th>
                                <th class="text-center">&#10062;</th>
                            </tr>
                            @foreach ($comments as $key => $comment)
                                <tr>
                                    {{-- <td>{{ ++$key }}</td> --}}
                                    {{-- <td>{{ $comment->id }}</td> --}}
                                    <td class="text-success">
                                        <a href=" {{ 'recipe/' . $comment->recipe->slug }}">
                                            <label class="label label-success">{{ $comment->recipe->title }}</label>
                                        </a>
                                    </td>
                                    <td class="text-info">
                                        {{ mb_substr($comment->comment, 0, 80) }}
                                        ...
                                        <br>
                                    </td>
                                    <td class="text-primary">{{ $comment->created_at->format('d.m.y') }}</td>
                                    <td>
                                        <form action="{{ route('delсomment', $comment->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm" type="submit">&#10060;</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            КОММЕНТАРИИ НЕ НАЙДЕНЫ!!!
                        @endif
                    </table>
                    <p> {{ $comments->appends(Request::except('page'))->links('components.pagination') }}</p>
                </div>
            </div>
        </div>




    @endsection
