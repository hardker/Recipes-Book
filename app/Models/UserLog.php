<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject', 'user_id', 'url', 'platform', 'ip', 'agent'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }




}
