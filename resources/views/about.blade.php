@extends('shablons.shablon-main')
@section('titles', 'О сайте')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">О сайте</li>
        </ol>
    </nav>
@endsection
@section('main_content')
Сайт выполниен в рамках курсовой работы, на базе laravel.
@endsection