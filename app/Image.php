<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    public function profiles()
    {
        return $this->morphedByMany(Profile::class, 'immagable');
    }

}
