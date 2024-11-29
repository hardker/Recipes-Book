@extends('shablons.shablon-main')
@section('titles', 'Новый рецепт')

@section('breadcrumb')
    <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none" href="/">Главная</a></li>
    <li class="breadcrumb-item active" aria-current="page">Добавление рецепта</li>
@endsection

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endsection

@section('main_content')
    <h1 class="text-center"> <a>ДОБАВЛЕНИЕ РЕЦЕПТА В КНИГУ</a></h1>
    <div class="container">
        <div class="container text-left">
            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('recipe.add') }}" id="image-upload">
                <div class="form-group">
                    @csrf
                    <div class="row justify-content-start">
                        <div class="col-lg-6 form-group">
                            <label for="category_id" class="h4 form-label">Категория рецепта<span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" aria-label="Выбор категории" id='category_id'
                                name="category_id" required>
                                <option value>Выберите категорию</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                        {{ $category->name_cat }}</option>
                                @endforeach
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="title"class="h4 form-label">Уникальное имя рецепта<span class="text-danger">*</span></label>
                            <input type="text" id='title' name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror" placeholder="Введите уникальное имя" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row justify-content-start">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="images"class="h4 form-label">Выберите фото рецепта</label>
                            <img id="preview-images" src="/img/img_not_found.gif" alt="preview image" widht="300" height="300">
                            <input aria-describedby="images_file" type="file" id='images' name="images" class="form-control"
                                accept=".jpg,.jpeg,.bmp,.png,.gif,.webp">
                        </div>
                    </div>

                    <div class="col-6"; font-weight:bold>
                        {{-- <div style="white-space: pre-wrap"> --}}
                        <i>
                            <div class="form-group">
                                {{-- <h4>Описание рецепта</h4> --}}
                                <label for="description" class="h4 form-label">Описание рецепта</label>
                                <textarea class="h4 form-control" name="description" rows="8" placeholder="Введите описание" maxlength="1000">{{ old('description') }}</textarea>
                            </div>
                        </i>
                        {{-- </div> --}}
                    </div>
                </div>
                <br>
                <div>

                    {{-- <div style="white-space: pre-wrap;"> --}}
                    <div class="form-group">
                        {{-- <h4>Приготовление рецепта<span class="text-danger">*</span></h4> --}}
                        <label for="text"class="h4 form-label">Приготовление рецепта<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('text') is-invalid @enderror" name="text" rows="6 " placeholder="Введите приготовление" required>{{ old('text') }}</textarea>
                        @error('text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                    {{-- </div> --}}
                    <br>

                    <div class="form-group">
                        {{-- <h4>Время приготовления</h4>                       --}}
                        <label for="timing"class="h4 form-label">Время приготовления</label>
                        <input type="text" id='timing' name="timing" value="{{ old('timing') }}" class="form-control"
                            placeholder="Введите время приготовления рецепта">
                    </div>
                    <br>

                    <div class="form-group">
                        {{-- <h4>Калорийность</h4>                       --}}
                        <label for="calorie"class="h4 form-label">Калорийность в калориях</label>
                        <input type="text" id='calorie' name="calorie" value="{{ old('calorie') }}" class="form-control"
                            placeholder="Введите калорийность рецепта" maxlength="40">
                    </div>

                    <br>
                    <div class="form-group">
                        <label for="ingredients" class="h4 form-label">Ингредиенты рецепта<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('ingredients') is-invalid @enderror" name="ingredients" rows="6 " placeholder="Введите ингредиенты рецепта"
                            required>{{ old('ingredients') }}</textarea>
                        @error('ingredients')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- </div> --}}
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary me-2">Сохранить рецепт
                        <i width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"> </i>
                    </button>
            </form>
        </div>
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

@endsection
