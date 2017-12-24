<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function roads()
    {
        return $this->belongsToMany('App\Models\Road', 'CitiesToRoads', 'cityId', 'roadId');
    }
}
