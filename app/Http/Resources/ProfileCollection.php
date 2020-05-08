<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProfileCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public $collects = 'App\Http\Resources\Profile';

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
