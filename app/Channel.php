<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['title', 'slug', 'color'];

    /**
     * Return route key name.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
