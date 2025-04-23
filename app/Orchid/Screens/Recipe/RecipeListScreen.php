<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Recipe;

use App\Orchid\Layouts\Recipe\RecipeListLayout;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class RecipeListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'recipes' => Recipe::with('category')
                ->with('user')->withTrashed()
                ->withAvg('comments', 'rating')->filters()
                ->defaultSort('id', 'desc')->paginate(),
            // 'recipes' => Recipe::filters(RecipeFiltersLayout::class)->defaultSort('id', 'desc')->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Рецепты';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Полный список всех рецептов, включая удаленные.  С возможностью сортировки и фильтрации данных.';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.recipes',
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
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->route('recipe.new'),
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
            RecipeListLayout::class,
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
        Recipe::findOrFail($request->get('id'))->delete();
        Toast::info('Рецепт успешно удален');
    }
}
