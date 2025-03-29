<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $fillable = [
        'content_id','user_id', 'comment',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
