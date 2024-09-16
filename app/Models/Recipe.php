<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
  use HasFactory;
  //  protected $table = 'recipes';
  protected $fillable = [
    'category_id',
    'title',
    'text',
    'ingredients',
    'timing',
    'calorie',
    'slug',
    'path',
];

  public function category() :BelongsTo
  {
    return $this->belongsTo(Category::class);
  }
  public function comments() :HasMany
  {
      return $this->hasMany(Comment::class);
  }
  public function averageRating()
  {
      return $this->comments()->avg('rating');
  }
}