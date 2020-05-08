<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Immagable extends MorphPivot
{
    protected $table = 'immagables';

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function immagable()
    {
        return $this->morphTo();
    }
}
