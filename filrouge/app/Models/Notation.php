<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notation extends Model
{
    protected $fillable = [
        'content_id','user_id', 'note',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
