<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $fillable = [
        'user_id','content_id','chapitre_id','episode_id','comment',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function chapitre()
    {
        return $this->belongsTo(Chapitre::class);
    }

    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
