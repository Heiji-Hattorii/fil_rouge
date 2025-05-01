<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'type',
        'category_id',
        'datePublication',
        'photo'
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

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

}
