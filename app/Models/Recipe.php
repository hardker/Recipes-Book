<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Metrics\Chartable;


class Recipe extends Model
{
    use HasFactory;
    use SoftDeletes; //Программное удаление
    use AsSource, Filterable, Chartable;

    protected $fillable = [
        'category_id',
        'user_id',
        'edit_id',
        'title',
        'text',
        'ingredients',
        'timing',
        'calorie',
        'slug',
        'path',
    ];

    protected $allowedFilters = [
        //'id' => Where::class,
        'title' => Like::class,
        'slug' => Like::class,
        'deleted_at' => WhereDateStartEnd::class,
        'updated_at' => WhereDateStartEnd::class,
        'created_at' => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'id',
        'title',
        'slug',
        'user_id',
        'edit_id',
        'category_id',
        'deleted_at',
        'updated_at',
        'created_at',
        'comments_avg_rating'
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

    //    public function likes(): HasMany
    // {
    //     return $this->hasMany( App.Models.Like::class);
    // }


    // public function averageRating()
    // {
    //     return $this->comments()->avg('rating');
    // }
    public function editor()
    {
        return $this->belongsTo(User::class, 'edit_id');
    }
    /**
     * Разрешить публикацию рецепта
     */
    // public function enable() {
    //     $this->edit_id = auth()->user()->id;
    //     $this->update();
    // }
}
