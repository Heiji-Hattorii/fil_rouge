<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manga extends Content
{
    protected $fillable = [
        'content_id', 'nbr_chapitres', 'nbr_volumes', 'date_debut', 'date_fin', 'auteur',
    ];

    public function chapitres()
    {
        return $this->hasMany(Chapitre::class);
    }
}
