<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function store(Request $request)
    {
        // Validation and storage logic
        $request->validate(['rating' => 'required|integer|between:1,5']);
        $rating = new Like($request->all());
        // Attach user ID to the rating
        $rating->user_id = auth()->id();
        $rating->save();
        return back()->with('message', 'Rating submitted successfully!');
    }

    public function update(Rating $rating, Request $request)
    {
        // Update logic
        $request->validate(['rating' => 'required|integer|between:1,5']);
        $rating->update($request->all());
        return back()->with('message', 'Rating updated successfully!');
    }
}
