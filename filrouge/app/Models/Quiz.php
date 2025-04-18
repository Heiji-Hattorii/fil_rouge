<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'user_id', 'titre', 'description', 'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
{
    return $this->hasMany(Question::class);
}

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
