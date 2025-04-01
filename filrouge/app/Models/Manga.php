<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id', 'nbr_chapitres', 'date_debut', 'date_fin', 'auteur',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function chapitres()
    {
        return $this->hasMany(Chapitre::class);
    }
}
