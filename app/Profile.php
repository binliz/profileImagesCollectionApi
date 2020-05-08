<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Profile extends Model
{
    public function images()
    {
        return $this->morphToMany(Image::class,'immagable',Immagable::class);
    }
}
