<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipesController extends Controller
{


    public function index($slug)
    {
        $data['recipe'] = Recipe::where('slug', $slug)->first();
        $data['category'] = $data['recipe']->category->name_cat;
        $data['stat'] = Like::where('user_id', Auth::id())->where('recipe_id', $data['recipe']->id)->first();
        $data['rat'] = $data['recipe']->averageRating();
        //   $data['rat'] = Like::where('recipe_id', $data['recipe']->id)->avg('rating');
        //   $data['rat_user'] = Like::where('user_id', Auth::id())->where('recipe_id', $data['recipe']->id)->first();
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
}