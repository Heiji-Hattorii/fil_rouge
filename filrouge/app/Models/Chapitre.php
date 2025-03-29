<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapitre extends Model
{
    //
    protected $fillable = [
        'manga_id', 'nbr_pages', 'date_ajout',
    ];

    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
