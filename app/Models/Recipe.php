<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory;
    use SoftDeletes; //�������� ����������� ��������

    //  protected $table = 'recipes';
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'text',
        'ingredients',
        'timing',
        'calorie',
        'slug',
        'path',
    ];

    protected $dates = ['deleted_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function averageRating()
    {
        return $this->comments()->avg('rating');
    }
}
