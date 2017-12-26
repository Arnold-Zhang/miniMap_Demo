<?php

namespace App\Http\Controllers;

use Common;
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

        // 随机选取两个城市
        $citiesIds = City::pluck('id')->toArray();
        $randomIds = array_rand($citiesIds, 2);
        $cityA = City::find($citiesIds[$randomIds[0]])->toArray();
        $cityB = City::find($citiesIds[$randomIds[1]])->toArray();

        // 两个城市最短距离与路径 arr
        $distances = Common::citiesDistance($cityA['id'], $cityB['id']);
        $shortestDistance = $distances[$cityB['id']];
        // var_dump($shortestDistance);
        // var_dump($test);
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
