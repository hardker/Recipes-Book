<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\UserLog;

use App\Models\UserLog;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;


class UserLogListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'userLogs';
    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', '№')->cantHide()->width('60')->sort(),

            TD::make('created_at', 'Дата создания')->filter(TD::FILTER_DATE_RANGE)->sort()
                ->usingComponent(DateTimeSplit::class, upperFormat: 'd.m.Y', lowerFormat: 'H:i:s'),

            TD::make('url', 'URL')->cantHide()->filter(TD::FILTER_TEXT)->width('200')->sort()
                ->popover('Кликнув на URL можно перейти по данному адресу')
                ->render(fn ($model) => "<a style='color:#007bff' href='{$model->url}'>{$model->url} </a>"),

            TD::make('ip', 'IP/GPS.')->width('120')->filter(TD::FILTER_TEXT)->sort()->align(TD::ALIGN_CENTER)
                ->popover('Кликнув на IP можно узнать местоположение пользователя')
                ->render(fn (UserLog $userLog) => ModalToggle::make($userLog->ip)
                    ->modal('IpUserModal')
                    ->modalTitle('Местонахождение IP: '.$userLog->ip.' ')
                    ->asyncParameters(['userLog' => $userLog->id,])
                ),

            TD::make('agent', 'Браузер')->filter(TD::FILTER_TEXT)->width('350'),

            TD::make('user_id', 'Пользователь')->width('110')->sort()
                ->render(fn ($model) => is_null($model->user) ?
                    //  "<img src='../img/img_not_found.gif' alt='recipes not found'class='mw-100 d-block img-fluid rounded-1 w-100'>"
                    "<b style='color:#dc3545'> Аноним </b> "
                    : $model->user->name),

            TD::make('updated_at', 'Дата обновления')->defaultHidden()->filter(TD::FILTER_DATE_RANGE)->sort()
                ->usingComponent(DateTimeSplit::class, upperFormat: 'd.m.Y', lowerFormat: 'H:i:s'),

            TD::make(__('Actions'))->align(TD::ALIGN_CENTER)->width('10px')
                ->render(function (userlog $userlog) {
                    return
                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm('Вы уверены, что хотите удалить запись.')
                            ->method('remove', ['id' => $userlog->id,])
                    ;
                }),
        ];
    }
    
}
