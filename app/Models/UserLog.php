<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;

class UserLog extends Model
{
    use HasFactory;
    use HasFactory;
    use AsSource, Filterable;

    protected $fillable = [
        'subject', 'user_id', 'url', 'platform', 'ip', 'agent'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $allowedFilters = [
        'ip' => Where::class,
        'subject' => Like::class,
        'url' => Like::class,
        'agent' => Like::class,
        'updated_at' => WhereDateStartEnd::class,
        'created_at' => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'id',
        'subject',
        'user_id',
        'url',
        'ip',
        'agent',
        'updated_at',
        'created_at',

    ];


}
