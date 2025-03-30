@extends('shablons.shablon-main')
@section('titles', 'О сайте')
@section('breadcrumb')
    <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none" href="/">Главная</a></li>
    <li class="breadcrumb-item active" aria-current="page">О сайте</li>
@endsection
@section('main_content')

    <div class="container">
        <h1 class="text-success text-center"> Сайт выполнен в рамках курсовой работы, на базе laravel.</h1>
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm border-primary">
                    <div class="card-header py-3 text-bg-primary border-primary">
                        <h4 class="my-0 fw-normal">ВСЕГО рецептов</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">{{ $totalRecipe }}</h1>
                        {{-- <button type="button" class="w-100 btn btn-lg btn-outline-primary">Sign up for free</button> --}}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm border-primary">
                    <div class="card-header py-3 text-bg-primary border-primary">
                        <h4 class="my-0 fw-normal">ВСЕГО просмотров</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">{{ $totalViews }}</h1>
                        {{-- <button type="button" class="w-100 btn btn-lg btn-primary">Get started</button> --}}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm border-primary">
                    <div class="card-header py-3 text-bg-primary border-primary">
                        <h4 class="my-0 fw-normal">Оценок и комментариев</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">{{ $totalComments }}</h1>
                        {{-- <button type="button" class="w-100 btn btn-lg btn-primary">Contact us</button> --}}
                    </div>
                </div>
            </div>
            @if (Auth::check() && Auth::user()->isAdmin())
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm border-primary">
                        <div class="card-header py-3 text-bg-primary border-primary">
                            <h4 class="my-0 fw-normal">ВСЕГО пользователей</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">{{ $totalUsers }}</h1>
                            {{-- <button type="button" class="w-100 btn btn-lg btn-outline-primary">Sign up for free</button> --}}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm border-primary">
                        <div class="card-header py-3 text-bg-primary border-primary">
                            <h4 class="my-0 fw-normal">Средняя оценка</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">{{ number_format($totalRating, 1) }}</h1>
                            {{-- <button type="button" class="w-100 btn btn-lg btn-primary">Get started</button> --}}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm border-primary">
                        <div class="card-header py-3 text-bg-primary border-primary">
                            <h4 class="my-0 fw-normal">В избранном</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">{{ $totalFav }}</h1>
                            {{-- <button type="button" class="w-100 btn btn-lg btn-primary">Contact us</button> --}}
                        </div>
                    </div>
                </div>

        </div>


        <!-- Подключение ApexCharts.js и stats.js файла -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <!-- Графики -->
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Графики</h2>

        <div class="row  row-cols-1 row-cols-md-2 mb-2 text-center">
            <div class="col">
                <div class="card md-6 rounded-3 shadow-sm border-primary">
                    <div class="card-header py-3 text-bg-primary border-primary">
                        <h4 class="my-0 fw-normal">Добавлено рецептов по месяцам</h4>
                    </div>
                    <div class="card-body" id="recipesChart"></div>
                </div>
            </div>
            <div class="col">
                <div class="card md-6 rounded-3 shadow-sm border-primary">
                    <div class="card-header py-3 text-bg-primary border-primary">
                        <h4 class="my-0 fw-normal">Прокомментировано по месяцам</h4>
                    </div>
                    <div class="card-body" id="commentsChart"> </div>
                </div>
            </div>
            <div class="col">
                <div class="card md-6 rounded-3 shadow-sm border-primary">
                    <div class="card-header py-3 text-bg-primary border-primary">
                        <h4 class="my-0 fw-normal">Просмотрено страниц</h4>
                    </div>
                    <div class="card-body" id="pageViewsChart"></div>
                </div>
            </div>
            <div class="col">
                <div class="card md-6 rounded-3 shadow-sm border-primary">
                    <div class="card-header py-3 text-bg-primary border-primary">
                        <h4 class="my-0 fw-normal">Рецепты по категориям</h4>
                    </div>
                    <div class="card-body" id="recByCatChart"> </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // График количества рецептов по месяцам
        const recipesData = {!! json_encode($recipesByMonth) !!};
        const recipesChart = new ApexCharts(document.querySelector("#recipesChart"), {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'Количество рецептов',
                data: recipesData.data
            }],
            xaxis: {
                categories: recipesData.labels
            }
        });
        recipesChart.render();

        // График количества комментариев по месяцам 
        const commentsData = {!! json_encode($commentsByMonth) !!};
        const commentsChart = new ApexCharts(document.querySelector("#commentsChart"), {
            chart: {
                type: 'bar'
            },
            series: [{
                name: 'Количество комментариев',
                data: commentsData.data
            }],
            xaxis: {
                categories: commentsData.labels
            }
        });
        commentsChart.render();

        // График количества просмотров страниц
        const statisticsData = {!! json_encode($statisticsData) !!};
        const pageViewsChart = new ApexCharts(document.querySelector("#pageViewsChart"), {
            chart: {
                type: 'area'
            },
            series: [{
                name: 'Количество просмотров',
                data: statisticsData.data
            }],
            xaxis: {
                categories: statisticsData.pageViewsLabels
            }
        });
        pageViewsChart.render();

        // График рецептов по категориям

        const recipesByCategories = {!! json_encode($recipesByCategories) !!};
        const recByCatChart = new ApexCharts(document.querySelector("#recByCatChart"), {
            chart: {
                type: 'donut'
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                label: 'ВСЕГО',
                                show: true,
                            }
                        }
                    }
                }
            },
            series: recipesByCategories.data,
            labels: recipesByCategories.labels,

        });
        recByCatChart.render();
    </script>
    <div class="container">
        <div class="d-flex">
            <div class="p-2 w-100">
                <h1 class="text-primary ">Лог активности пользователей</h1>
            </div>
            <div class="p-2 flex-shrink-1 ">
                <form action="{{ route('dellogs') }}" method="POST">
                    @csrf
                    <button class="btn btn-warning" type="submit"><b>Очистить таблицу</b></button>
                </form>
            </div>
        </div>
        <table class="table table-bordered border-primary table-hover">
            <tr>
                <th>№</th>
                <th>Дата и время</th>
                <th>URL</th>
                {{-- <th>Method</th> --}}
                <th>IP</th>
                <th width="470px">Браузер</th>
                <th>User Id</th>
                <th>Действие</th>
            </tr>
            @if ($logs->count())
                @foreach ($logs as $key => $log)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td class="text-primary">{{ $log->created_at }}</td>
                        <td class="text-success">
                            <a href=" {{ $log->url }}">{{ $log->url }}</a>
                        </td>
                        {{-- <td><label class="label label-info">{{ $log->method }}</label></td> --}}
                        <td class="text-info">{{ $log->ip }}</td>
                        <td class="text-danger">{{ $log->agent }}</td>
                        <td>{{ $log->user_id }}</td>
                        <td>
                            <form action="{{ route('dellog', $log->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Всплывающее сообщение-->
                    @if (Session::has('msg_success'))
                        <div class="fade show toast-container position-fixed bottom-0 end-0 p-2 text-bg-primary border-0"
                            role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="1000"
                            data-bs-autohide="true">
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
                @endforeach
            @endif
        </table>
    </div>

    @endif

@endsection
