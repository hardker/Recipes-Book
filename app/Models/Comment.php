<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
class Comment extends Model
{
    use HasFactory;
    use AsSource, Filterable;

    protected $fillable = [
        'name',
        'email',
        'recipe_id',
        'comment',
        'rating',
    ];

    protected $allowedFilters = [
        'id' => Where::class,
        'name' => Like::class,
        'email' => Like::class,
        'updated_at' => WhereDateStartEnd::class,
        'created_at' => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'recipe_id',
        'rating',
        'category_id',
        'updated_at',
        'created_at',

    ];
    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }
}
