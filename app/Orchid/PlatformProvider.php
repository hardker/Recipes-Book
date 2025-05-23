<?php

declare(strict_types=1);

namespace App\Orchid;

use App\Models\Recipe;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
       // $count=
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [

            Menu::make('Категории')
                ->icon('bs.collection')
                ->title('Книга')
                ->route('platform.categories'),

            Menu::make('Рецепты')
                ->icon('bs.book')
                ->route('platform.recipes')
                ->badge(function () {
                    return Recipe::whereNull('edit_id')->count();
                }),

            Menu::make('Комментарии')
                ->icon('bs.chat-left-text')
                ->route('platform.comments')
                ->divider(),

            Menu::make('Аналитика')
                ->icon('bs.graph-up-arrow')
                ->route('platform.analitics')
                ->divider(),

            // Menu::make('Get Started')
            //     ->icon('bs.book')
            //     ->title('Navigation')
            //     ->route(config('platform.index')),

            // Menu::make('Sample Screen')
            //     ->icon('bs.collection')
            //     ->route('platform.example')
            //     ->badge(fn () => 6),

            // Menu::make('Form Elements')
            //     ->icon('bs.card-list')
            //     ->route('platform.example.fields')
            //     ->active('*/examples/form/*'),

            // Menu::make('Layouts Overview')
            //     ->icon('bs.window-sidebar')
            //     ->route('platform.example.layouts'),

            // Menu::make('Grid System')
            //     ->icon('bs.columns-gap')
            //     ->route('platform.example.advanced'),

            // Menu::make('Charts')
            //     ->icon('bs.bar-chart')
            //     ->route('platform.example.charts'),

            // Menu::make('Cards')
            //     ->icon('bs.card-text')
            //     ->route('platform.example.cards')
            //     ->divider(),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title('Контроль доступа'),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),

            Menu::make('Статистика')
                ->icon('bs.person-vcard')
                ->route('platform.systems.userlogs')
                ->permission('platform.systems.userlogs')
                ->divider(),


            Menu::make('Documentation')
                ->title('Docs Orchid')
                ->icon('bs.box-arrow-up-right')
                ->url('https://orchid.software/ru/docs')
                ->target('_blank'),

            Menu::make('Changelog')
                ->icon('bs.box-arrow-up-right')
                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
                ->target('_blank')
                ->badge(fn () => Dashboard::version(), Color::DARK),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users'))
                ->addPermission('platform.systems.userlogs', 'Статистика пользователей'),
            ItemPermission::group('Книга')
                ->addPermission('platform.categories', 'Категории')
                ->addPermission('platform.recipes', 'Рецепты')
                ->addPermission('platform.comments', 'Комментарии')
                ->addPermission('platform.analytics', 'Аналитика')
                ->addPermission('platform.reports', 'Отчеты')
        ];
    }
}
