<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Category;

use App\Orchid\Layouts\Category\CategoryEditLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Category;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CategoryEditScreen extends Screen
{
    /**
     * @var Category
     */
    public $category;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Category $category): iterable
    {
        return [
            'category' => $category,
            //    'permission' => $Category->getStatusPermission(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Редактировать категорию';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Позволяет изменить имя и уникальный URL категории.';
    }

    /**
     * The permissions required to access this screen.
     */
    public function permission(): ?iterable
    {
        return [
            'platform.categories',
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->method('remove')
                ->canSee($this->category->exists),
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
            Layout::block([
                CategoryEditLayout::class,
            ])
                ->title('Категория')
                ->description('Defines a set of privileges that grant users access to various services and allow them to perform specific tasks or operations.'),
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, Category $category)
    {
        $request->validate([
            'category.name_cat' => 'required',
            'category.description' => 'required',
            'category.slug' => [
                'required',
                Rule::unique(Category::class, 'slug')->ignore($category),
            ],
        ]);


        $category->fill($request->get('category'));
        //  dd($request->hasFile('path'));
        is_null($request->path) ? null : $category->path = $request->path;

        $category->save();
        //    dd($category);
        Toast::info('Категория сохранена');

        return redirect()->route('platform.categories');
    }

    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Category $category)
    {
        $category->delete();

        Toast::info('Категория удалена');

        return redirect()->route('platform.categories');
    }
}
