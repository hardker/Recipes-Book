<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PDF {{ $recipe->title }} </title>
    <style>
        body {
            font-family: "DejaVu Serif,  sans-serif";
            font-size: 12px;
            margin: -10px;
            padding: -10px, 10px;
        }

        .container {
            font-size: 12px;
        }

        .header {
            text-align: center;

            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>

<body>

    <table>
        <tr>
            <td>
                <img src="{{ public_path('img/logo.png') }}" alt="Логотип" style="height: 30px;">
            </td>
            <td>
                <p>Рецепт сохранен: {{ $date }}</p>
            </td>
        </tr>
    </table>

    <div class="header">
        <h1> {{ $recipe->title }}</h1>
    </div>
    <div class="container">
        <table>
            <tr>
                <td>
                    @if (file_exists(public_path($recipe->path)))
                        <img src="{{ public_path($recipe->path) }}" alt="{{ $recipe->slug }}" widht="200" height="200">
                    @else
                        <img src="{{ public_path('img/img_not_found.gif') }}" alt="img_not_found" widht="200" height="200">
                    @endif
                </td>
                <td style="padding: 10px">
                    <h3>Описание рецепта</h3>
                    <div style="white-space: pre-line">
                        <i> {{ $recipe->description }} </i>
                    </div>
                </td>
            </tr>
        </table>
        <h3>Приготовление рецепта</h3>
        {{-- <div class="text-nowrap bg-body-secondary border"> --}}
        <div style="white-space: pre-line">
            {{ $recipe->text }}
        </div>
        <table>
            <tr>
                <td>
                    <h3>Время приготовления: {{ $recipe->timing }}</h3>
                </td>
                <td>
                    <h3>Калорийность: {{ $recipe->calorie }} калорий</h3>
                </td>
            </tr>
        </table>
        <h3>Ингредиенты</h3>
        <div style="white-space: pre-line">
            {{ $recipe->ingredients }}
        </div>
        <table>
            <tr>
                <td>
                    <h2 style="text-align: center">ПРИЯТНОГО АППЕТИТА!!! </h2>
                    Автор рецепта: {{ $avtor->name }}
                </td>
                <td>
                    <img src="{{ public_path('img/sign.jpg') }}" alt="Подпись" style="height: 40px;">
                </td>
            </tr>
        </table>

    </div>
</body>

</html>
