<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id', 'nbr_episodes', 'nbr_saisons', 'date_debut', 'date_fin', 'producteur',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}
