<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes; //Программное удаление
    use AsSource, Filterable;

    protected $fillable = [
        'name_cat',
        'description',
        'path',
        'slug',
    ];
    protected $allowedFilters = [
        'id' => Where::class,
        'name_cat' => Like::class,
        'deleted_at' => WhereDateStartEnd::class,
        'updated_at' => WhereDateStartEnd::class,
        'created_at' => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'id',
        'name_cat',
        'slug',
        'deleted_at',
        'updated_at',
        'created_at',
    ];
    protected $dates = ['deleted_at'];
    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    public function likes(): HasManyThrough
    {
        return $this->hasManyThrough(Like::class, Recipe::class);
    }
}
