<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    protected $fillable = ['nom','icone'];

    public function contents() {
        return $this->hasMany(Content::class);
    }
}
