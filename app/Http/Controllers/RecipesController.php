<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipesController extends Controller
{
    public function index($slug)
    {
        $data['recipe'] = Recipe::with('comments')->where('slug', $slug)->first();
        $data['category'] = $data['recipe']->category;
        $data['stat'] = Like::where('user_id', Auth::id())->where('recipe_id', $data['recipe']->id)->first();
        dump($data);
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
            'name' => ['max:255'],
            'email' => ['required', 'email', 'max:255'],
            'rating' => ['required', 'integer', 'between:1,5'],
        ]);
        Comment::updateOrCreate([
            'recipe_id' => $request->recipe_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);
        return back()->with('flash_msg_success', 'Ваш отзыв успешно добавлен!');
    }
    public function new_recipe()
    {
        $categories = Category::all();
        dump($categories);
        return view('create', compact('categories'));
    }
    public function add_recipe(Request $request)
    {
        $request->validate([
            'category_id' => ['required'],
            'title' => ['required', 'unique:Recipes', 'max:255'],
            'text' => ['required'],
            'ingredients' => ['required', ''],
        ]);
        dump($request);
        $slug = $this->translit_slug($request->title);
        $path = null;
        if ($request->hasFile('images')) {
            $name = $slug . "." . $request->images->extension();
            $request->images->storeAs('public', $name);
            $path = 'storage/' . $name;
        }

        dump($path);
        Recipe::updateOrCreate([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'text' => $request->text,
            'ingredients' => $request->ingredients,
            'slug' => $slug,
            'path' => $path,
        ]);
        // return redirect()->back();
        return to_route('recipe', $slug);
    }
    public function translit_slug($value): string
    {
        $converter = array(
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
        );
        $value = mb_strtolower($value);
        $value = strtr($value, $converter);
        $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
        $value = mb_ereg_replace('[-]+', '-', $value);
        $value = trim($value, '-');
        return $value;
    }
}
