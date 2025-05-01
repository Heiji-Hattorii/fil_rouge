<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membre extends User
{
    //
    public function likes()
{
    return $this->hasMany(Like::class);
}

}
