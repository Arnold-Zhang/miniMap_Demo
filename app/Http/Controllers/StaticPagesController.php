<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Road;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function home()
    {
        $citiesName = City::orderBy('id')->pluck('name')->toArray();
        $xaxis = City::orderBy('id')->pluck('xaxis')->toArray();
        $yaxis = City::orderBy('id')->pluck('yaxis')->toArray();

        $allRoads = Road::get();
        $roads = [];
        foreach ($allRoads as $road) {
            $cities = $road->cities->toArray();
            $x = [];
            $y = [];
            foreach ($cities as $city) {
                $x[] = $city['xaxis'];
                $y[] = $city['yaxis'];
                $roads[$road->id] = [
                    'id'    =>  $road->id,
                    'xaxis' =>  $x,
                    'yaxis' =>  $y
                ];
            }
        }

        $param = [
            'citiesName'   =>  $citiesName,
            'xaxis' => $xaxis,
            'yaxis' => $yaxis,
            'roads' => $roads,
        ];
        return view('index', $param);
    }
}
