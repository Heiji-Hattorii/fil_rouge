<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'titre', 'description', 'type', 'genre', 'datePublication',
    ];

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function notations()
    {
        return $this->hasMany(Notations::class);
    }

    public function bibliotheques()
    {
        return $this->hasMany(Bibliotheque::class);
    }
}
