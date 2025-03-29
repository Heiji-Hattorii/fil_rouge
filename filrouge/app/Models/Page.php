<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'chapitre_id', 'numero_page', 'contenu',
    ];

    public function chapitre()
    {
        return $this->belongsTo(Chapitre::class);
    }
}
