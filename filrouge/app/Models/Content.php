<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'description', 'type', 'genre', 'datePublication',
    ];
    public function anime()
    {
        return $this->hasOne(Anime::class);
    }

    public function manga()
    {
        return $this->hasOne(Manga::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function notations()
    {
        return $this->hasMany(Notation::class);
    }

    public function bibliotheques()
    {
        return $this->hasMany(Bibliotheque::class);
    }
}
