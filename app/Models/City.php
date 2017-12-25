<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name', 'xaxis', 'yaxis',
    ];

    public function roads()
    {
        return $this->belongsToMany('App\Models\Road', 'cities_to_roads', 'cityId', 'roadId');
    }
}
