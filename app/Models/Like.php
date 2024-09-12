<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'recipe_id',
        'status',
        'rating',
    ];

    public function recipe() :BelongsTo
    {
      return $this->belongsTo(Recipe::class);
    }
    public function user() :BelongsTo
    {
      return $this->belongsTo(User::class);
    }


}

