<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    protected $fillable = [
        'user_id', 'content', 'style'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
