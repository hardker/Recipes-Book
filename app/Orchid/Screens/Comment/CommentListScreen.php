<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Comment;


use App\Orchid\Layouts\Comment\CommentListLayout;
use Illuminate\Http\Request;
use App\Models\Comment;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;


class CommentListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'comments' => Comment::with('recipe')->filters()->defaultSort('id', 'desc')->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Комментарии';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Полный список комментариев к рецептам c авторами и рейтингами. С возможностью сортировки и фильтрации данных.';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.comments',
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [ ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            CommentListLayout::class,
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
    public function remove(Request $request): void
    {
        Comment::findOrFail($request->get('id'))->delete();
        Toast::info('Комментарий успешно удален');
    }
}
