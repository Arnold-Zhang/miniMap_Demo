<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Road extends Model
{
    protected $fillable = [
        'distance',
    ];

    public function cities()
    {
        return $this->belongsToMany('App\Models\City', 'CitiesToRoads', 'roadId', 'cityId');
    }
}
