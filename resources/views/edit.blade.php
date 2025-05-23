@extends('shablons.shablon-main')
@section('titles', 'Редактирование рецепта')

@section('breadcrumb')
    <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none" href="/">Главная</a></li>
    <li class="breadcrumb-item active" aria-current="page">Редактирование рецепта</li>
@endsection

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endsection

@section('main_content')

    <h1 class="text-center"> <a>РЕДАКТИРОВАНИЕ РЕЦЕПТА В КНИГЕ</a></h1>
    <div class="container">
        <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('recipe.upd', ['slug' => $recipe->slug]) }}" id="image-upload">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="category_id" class="h4 form-label">Категория рецепта<span class="text-danger">*</span></label>
                    <select class="form-select @error('category_id') is-invalid @enderror" aria-label="Выбор категории" id='category_id'
                        name="category_id" required data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="***Выберите категорию***">
                        {{-- <option value>Выберите категорию</option> --}}
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected($category->id == $recipe->category_id)>
                                {{ $category->name_cat }}</option>
                        @endforeach
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="title"class="h4 form-label">Уникальное имя рецепта<span class="text-danger">*</span></label>
                    <input type="text" id='title' name="title" value="{{ $recipe->title }}"
                        class="form-control @error('title') is-invalid @enderror" placeholder="Уникальное имя" required readonly data-bs-toggle="tooltip"
                        data-bs-placement="bottom" data-bs-title="***Имя изменить нельзя***">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label for="images"class="h4 form-label">Выберите фото рецепта</label>
                    <img id="preview-images" src="{{ asset($recipe->path) }}" alt="{{ $recipe->slug }}" alt="preview image"
                        class="img-fluid height: auto max-width: 300px" onError="this.src='../img/img_not_found.gif'; this.onerror=null">
                    <input aria-describedby="images_file" type="file" id='images' name="images" class="form-control"
                        accept=".jpg,.jpeg,.bmp,.png,.gif,.webp">
                </div>
                <div class="col-md fw-bold">
                    {{-- <div style="white-space: pre-wrap"> --}}
                    <i>
                        {{-- <h4>Описание рецепта</h4> --}}
                        <label for="description" class="h4 form-label">Описание рецепта</label>
                        <textarea class="h4 form-control" name="description" rows="8" placeholder="Введите описание" maxlength="1000">{{ $recipe->description }}</textarea>
                    </i>

                </div>
            </div>
            <br>
            <div>
                {{-- <div style="white-space: pre-wrap;"> --}}
                <div class="col">
                    {{-- <h4>Приготовление рецепта<span class="text-danger">*</span></h4> --}}
                    <label for="text"class="h4 form-label">Приготовление рецепта<span class="text-danger">*</span></label>
                    <textarea class="form-control @error('text') is-invalid @enderror" name="text" rows="6 " placeholder="Введите приготовление" required>{{ $recipe->text }}</textarea>
                    @error('text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="col">
                    {{-- <h4>Время приготовления</h4>                       --}}
                    <label for="timing"class="h4 form-label">Время приготовления</label>
                    <input type="text" id='timing' name="timing" value="{{ $recipe->timing }}" class="form-control"
                        placeholder="Введите время приготовления рецепта">
                </div>
                <br>
                <div class="col">
                    {{-- <h4>Калорийность</h4>                       --}}
                    <label for="calorie"class="h4 form-label">Калорийность в калориях</label>
                    <input type="text" id='calorie' name="calorie" value="{{ $recipe->calorie }}" class="form-control"
                        placeholder="Введите калорийность рецепта" maxlength="40">
                </div>
                <br>
                <div class="col">
                    <label for="ingredients" class="h4 form-label">Ингредиенты рецепта<span class="text-danger">*</span></label>
                    <textarea class="form-control @error('ingredients') is-invalid @enderror" name="ingredients" rows="6 " placeholder="Введите ингредиенты рецепта"
                        required>{{ $recipe->ingredients }}</textarea>
                    @error('ingredients')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            {{-- @if (!is_null($recipe->edit_id)) --}}
            <div class="col">
                <button type="submit" class="btn btn-outline-primary me-2">Сохранить рецепт
                    <i width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"> </i>
                </button>
                <a class="btn btn-outline-primary me-2" href="{{ url()->previous() }}">
                    <i width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-up" viewBox="0 0 16 16"> </i>
                    Вернуться
                </a>
            </div>
            {{-- @endif --}}
        </form>
    </div>
    {{-- Скрипт предпросмотра картинки --}}
    <script type="text/javascript">
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#images').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-images').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
    {{-- Скрипт подсказок --}}
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

@endsection
