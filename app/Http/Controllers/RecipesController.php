<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
//use Illuminate\Support\Facades\URL;
//use Illuminate\Support\Facades\Redirect;
//use Str;

class RecipesController extends Controller
{
    public function index($slug)
    {
        $data['recipe'] = Recipe::whereNotNull('edit_id')->with('comments')->where('slug', $slug)->first();
        $data['category'] = $data['recipe']->category;
        $data['avtor_count'] = Recipe::whereNotNull('edit_id')->where('user_id', $data['recipe']->user_id)->count();
        $data['avtor'] = $data['recipe']->user;
        $data['stat'] = Like::where('user_id', Auth::id())->where('recipe_id', $data['recipe']->id)->first();

        //dump($data);
        return view('/recipe', $data);
    }

    public function in_favorite($id, $status)
    {
        $like = Like::where('user_id', Auth::id())->where('recipe_id', $id)->first();
        if ($like) {
            if ($like->status) {
                $like->status = false;
            } else {
                $like->status = true;
            }
            $like->save();
        } else {
            Like::updateOrCreate([
                'user_id' => Auth::id(),
                'recipe_id' => $id,
                'status' => true,
            ]);
        }
        return redirect()->back();
    }

    public function add_comment(Request $request)
    {
        $request->validate([
            'name' => 'max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|between:1,5',
        ]);
        Comment::updateOrCreate([
            'recipe_id' => $request->recipe_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);
        return back()->with('msg_success', 'Ваш отзыв успешно добавлен!');
    }

    public function new_recipe()
    {
        $categories = Category::all();
        //    dump($categories);
        return view('create', compact('categories'));
    }

    public function add_recipe(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|unique:recipes|max:255',
            'text' => 'required',
            'ingredients' => 'required',
            'calorie' => 'nullable|integer',
        ]);

        $slug = $this->translit_slug($request->title);
        $path = null;
        if ($request->hasFile('images')) {
            $name = $slug.'.'.$request->images->extension();
            $request->images->storeAs('public', $name);
            $path = 'storage/'.$name;
        }

        //      dump($path);
        Recipe::Create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => trim($request->description),
            'text' => trim($request->text),
            'ingredients' => trim($request->ingredients),
            'timing' => $request->timing,
            'calorie' => $request->calorie,
            'slug' => $slug,
            'path' => $path,
        ]);

        return back()->with('msg_success', 'Ваш рецепт направлен на модерацию!');
    }
    public function edit_recipe($slug)
    {
        $data['recipe'] = Recipe::firstWhere('slug', $slug);
        $data['categories'] = Category::all();
        // dump($data);
        return view('edit', $data);
    }

    public function del_recipe($slug)
    {

        $recipe = Recipe::firstWhere('slug', $slug);
        $slug = Category::find($recipe->category_id)->slug;
        //  dd($slug);     
        $recipe->delete();
        return to_route('cat', $slug)->with('msg_success', 'Рецепт успешно удален!');
    }
    public function upd_recipe($slug, Request $request)
    {
        $recipe = Recipe::firstWhere('slug', $slug);
        $request->validate([
            'category_id' => 'required',
            'text' => 'required',
            'ingredients' => 'required',
            'calorie' => 'nullable|integer',
        ]);
        //dump($request);
        $slug = $this->translit_slug($request->title);
        $path = null;
        if ($request->hasFile('images')) {
            $name = $slug.'.'.$request->images->extension();
            $request->images->storeAs('public', $name);
            $path = 'storage/'.$name;
            $recipe->path = $path;
        }
        $recipe->category_id = $request->category_id;
        $recipe->title = $request->title;
        $recipe->description = trim($request->description);
        $recipe->text = trim($request->text);
        $recipe->ingredients = trim($request->ingredients);
        $recipe->timing = $request->timing;
        $recipe->calorie = $request->calorie;
        $recipe->save();
        //dd($request);
        return back()->with('msg_success', 'Изменения успешно сохранены!');
        //return to_route('recipe', $slug)->with('msg_success', 'Изменения успешно сохранены!');
    }
    public function pdf_recipe($slug)
    {
        $data['recipe'] = Recipe::firstWhere('slug', $slug);
        $data['category'] = $data['recipe']->category;
        //$data['avtor_count'] = Recipe::where('user_id', $data['recipe']->user_id)->count();
        $data['avtor'] = $data['recipe']->user;
        // $data['stat'] = Like::where('user_id', Auth::id())->where('recipe_id', $data['recipe']->id)->first();
        $data['date'] = date('d.m.Y H:i:s');
        //  dd($data);     
        //Pdf::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        //return view('shablons/recipe_pdf', $data);
        $pdf = Pdf::loadView('shablons/recipe_pdf', $data);
        return $pdf->download($slug.'.pdf');//->with('msg_success', 'PDF успешно сохранен!');
    }
    public function translit_slug($value): string
    {
        $converter = [
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'e',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'y',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sch',
            'ь' => '',
            'ы' => 'y',
            'ъ' => '',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',
        ];
        $value = mb_strtolower($value);
        $value = strtr($value, $converter);
        $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
        $value = mb_ereg_replace('[-]+', '-', $value);
        $value = trim($value, '-');

        return $value;
    }
}
