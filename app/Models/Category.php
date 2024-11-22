<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    use HasFactory;
    //     protected $table = 'recipes';

    protected $fillable = [
        'name_cat',
        'description',
        'images',
        'slug',];

    public function recipes() : HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    public function likes() : HasManyThrough
    {
        return $this->hasManyThrough(Like::class, Recipe::class);
    }
}
