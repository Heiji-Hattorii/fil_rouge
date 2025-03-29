<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Content
{
    protected $fillable = [
        'content_id', 'nbr_episodes', 'nbr_saisons', 'date_debut', 'date_fin', 'producteur',
    ];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}
