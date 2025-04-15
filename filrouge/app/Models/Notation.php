<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','content_id','note',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
