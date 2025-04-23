<?php

declare(strict_types=1);

namespace App\Orchid\Screens\UserLog;

use App\Orchid\Layouts\Userlog\UserLogListLayout;
use Illuminate\Http\Request;
use App\Models\UserLog;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Map;
use Orchid\Support\Color;

class userlogListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'userLogs' => UserLog::with('user')->filters()->defaultSort('id', 'desc')->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Лог активности пользователей';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Лог активности пользователей. С возможностью сортировки и фильтрации данных.';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.systems.userlogs',
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Очистить таблицу')
                ->type(Color::WARNING())
                ->icon('bs.x-circle')
                ->method('clearlogs')
                ->confirm('Вы уверены, что хотите очистить таблицу.'),

            Button::make('Скачать csv')
                ->type(Color::PRIMARY())
                ->icon('bs.download')
                ->method('exportUserLogs')
                ->rawClick()

        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            UserLogListLayout::class,
            Layout::modal('IpUserModal', [
                Layout::rows([
                    Group::make([
                        Label::make('country')->title('Страна'),
                        Label::make('region')->title('Регион'),
                        Label::make('city')->title('Город'),
                    ])->fullWidth(),

                    Map::make('place')->title('Пользователь на карте'),
                ]),
            ])
                ->title('Заголовок окна')
                ->deferred('loadIpUserOpenModal')
                ->withoutApplyButton(),
        ];
    }
    /**
     * @return bool
     */
    protected function striped(): bool
    {
        return true;
    }
    /**
     * Loads user data when opening the modal window.
     *
     * @return array
     */
    public function loadIpUserOpenModal(UserLog $userLog): iterable
    {
        //$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip={$userLog->ip}"));
        // $country = $geo["geoplugin_countryName"];
        // $city = $geo["geoplugin_city"];
        // $lat = $geo["geoplugin_latitude"];
        // $lng = $geo["geoplugin_longitude"];

        $geo = file_get_contents("http://ipinfo.io/$userLog->ip/geo");
        $geo = json_decode($geo, true);
        $country = $geo["country"];
        $city = $geo["city"];
        $region = $geo["region"];
        sscanf($geo["loc"], "%[^,],%s", $lat, $lng);
        return [
            'userLog' => $userLog,
            'country' => $country,
            'region' => $region,
            'city' => $city,
            //'lng' => $lng,
            'place' => ['lat' => $lat, 'lng' => $lng,],
        ];
    }

    public function remove(Request $request): void
    {
        userlog::findOrFail($request->get('id'))->delete();
        Toast::info('Лог успешно удален');
    }

    public function clearlogs(Request $request): void
    {
        UserLog::truncate();
        Toast::info('Таблица успешно очищена');
    }
    public function exportUserLogs()
    {
        $userLogs = UserLog::with('user')->get();
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=UserLog.csv'
        ];
        $columns = ['Дата создания', 'Пользователь', 'IP', 'URL', 'Браузер'];
        $callback = function () use ($userLogs, $columns) {
            $stream = fopen('php://output', 'w');
            fputcsv($stream, $columns);

            foreach ($userLogs as $userLog) {
                fputcsv($stream, [
                    'Дата создания' => $userLog->created_at,
                    'Пользователь' => $userLog->user?->name,
                    'IP' => $userLog->ip,
                    'URL' => $userLog->url,
                    'Браузер' => $userLog->agent,
                ]);
            }
            fclose($stream);
        };
        return response()->stream($callback, 200, $headers);
    }
}
