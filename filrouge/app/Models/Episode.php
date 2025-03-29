<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $fillable = [
        'anime_id', 'numero_episode', 'contenu', 'date_ajout',
    ];

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}
