<?php

namespace App\Models;

use App\Models\Road;
use Illuminate\Support\Facades\DB;

class Common {

    /**
    * 两城市之间的最短距离
    * @param 第一个城市的id
    * @param 第二个城市的id
    * @return arr 城市最短距离以及路径
    */
    public static function citiesDistance($idA, $idB){

        // 获取端点(城市id),去重并重置索引
        $citiesIds = array_values( array_unique( DB::table('cities_to_roads')->pluck('cityId')->toArray() ) );

        // 若存在没有道路的城市,直接距离返回 '-'
        if (!in_array($idA, $citiesIds) || !in_array($idB, $citiesIds)) {
            return ['distance' => '-'];
        }

        // 去掉A城市id
        $key=array_search($idA ,$citiesIds);
        array_splice($citiesIds,$key,1);

        // 将键值换成城市id
        $points = [];
        foreach ($citiesIds as $value) {
            $points[$value] = $value;
        }

        // A城市所有道路id
        $roadsA = City::find($idA)->roads->toArray();
        $roadsIdA = [];
        foreach ($roadsA as $road) {
            $roadsIdA[] = $road['id'];
        }

        // 初始化A城市到个点的距离
        $distances = [];
        foreach ($points as $v) {
            $distances[$v]['distance'] = INF;
            $distances[$v]['trace'] = City::find($idA)->name . " -> " . City::find($v)->name;
        }

        foreach ($roadsIdA as $rId) {
            $cities = DB::table('cities_to_roads')->where('roadId', $rId)->pluck('cityId')->toArray();
            if (!empty($cities)) {
                $id = array_values( array_diff($cities, [$idA]) )[0];
                $distances[$id]['distance'] = Road::find($rId)->distance;
            }
        }

        return $distances;


        // return $citiesIds;
    }
}
