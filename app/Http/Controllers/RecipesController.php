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
         dd($data); 
        $data['status'] = Like::where('user_id', Auth::id())->where('recipe_id', $data['recipe']->id)->first();
     
        return view('/recipe', $data);

    }

    public function in_favorite($id, $status)
    {
        //   $user = Auth::user();
        $like = Like::where('user_id', Auth::id())->where('recipe_id', $id)->first();
        //dd ($user);
        if ($like) {
            if ($like->status) {
                $like->status = false;
            } else {
                $like->status = true;
            }
            $like->save();
        } else {

            Like::create([
                //$like_info=([
                'user_id' => Auth::id(),
                'recipe_id' => $id,
                'status' => true,
            ]);

            //dd ($like_info);

        }
        return redirect()->back();

    }
}