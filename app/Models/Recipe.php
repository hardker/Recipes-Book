<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class recipe extends Model
{
  use HasFactory;
  //  protected $table = 'recipes';

  public function category() :BelongsTo
  {
    return $this->belongsTo(Category::class);
  }
  public function likes() :HasMany
  {
      return $this->hasMany(Like::class);
  }
  public function averageRating()
  {
      return $this->likes()->avg('rating');
  }
}