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

        $citiesIds = City::pluck('id')->toArray();
        $randomIds = array_rand($citiesIds, 2);
        $cityA = City::find($citiesIds[$randomIds[0]])->toArray();
        $cityB = City::find($citiesIds[$randomIds[1]])->toArray();

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
                    'distance'  =>  $road->distance,
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
            'cityA' =>  $cityA,
            'cityB' =>  $cityB,
        ];
        return view('index', $param);
    }
}
