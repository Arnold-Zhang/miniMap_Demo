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

        // 若存在A或B没有道路,直接距离返回 '-'
        if (!in_array($idA, $citiesIds) || !in_array($idB, $citiesIds)) {
            // return ['distance' => '-'];
            return [
                $idB => ['distance' => INF,
                         'trace' => City::find($idA)->name . " -> " . City::find($idB)->name
                        ]
            ];
        }

        // 最短路径集合初始化
        foreach ($citiesIds as $v) {
            $shortests[$v] = [
                'distance' => INF,
                'trace' => City::find($idA)->name,
            ];
        }
        $shortests[$idA]['distance'] = 0;
        $S = [$idA];    // 已获得最短路径的城市

        // 去掉A城市id
        $D = $citiesIds;    // 未获得最短路径的城市
        $key=array_search($idA ,$D);
        array_splice($D,$key,1);
        foreach ($D as $cityId ) {
            $tmpIds[$cityId] = INF; // 未获最短路径城市初始化为无穷大
        }

        // 算法开始
        for ($i = 0; $i < count($citiesIds)-1 ; $i++) {
            $min = INF;

            for ($j =  0; $j < count($citiesIds); $j++) {
                $tmpId = $citiesIds[$j]; // 当前目标点
                if ($tmpId == $idA) {
                    continue;
                }

                //当前目标城市所有道路id
                $roadsId = [];
                $roads = City::find($tmpId)->roads->toArray();
                foreach ($roads as $road) {
                    $roadsId[] = $road['id'];
                }
                // 获取当前目标城市直连城市的距离和id
                $linkInfos = [];
                foreach ($roadsId as $rId) {
                    $cities = DB::table('cities_to_roads')->where('roadId', $rId)->pluck('cityId')->toArray();
                    if (!empty($cities)) {
                        $id = array_values( array_diff($cities, [$tmpId]) )[0];
                        $linkInfos[] = ['id' => $id, 'distance' => Road::find($rId)->distance];
                    }
                }

                //若直连城市中含有已找到最短路径的城市，则更新当前目标城市的距离
                foreach ($linkInfos as $linkInfo) {

                    if (in_array($linkInfo['id'], $S)) {
                        if ($tmpIds[$tmpId] > $shortests[$linkInfo['id']]['distance'] + $linkInfo['distance']) {
                            $tmpIds[$tmpId] = $shortests[$linkInfo['id']]['distance'] + $linkInfo['distance'];
                        }
                    }
                }
            }



            $shortestId = array_keys($tmpIds, min($tmpIds))[0];
            // var_dump($shortestId);
            $shortests[$shortestId] = [
                'distance' => min($tmpIds),
                'trace' => $shortests[$shortestId]['trace'] . ' -> ' . City::find($shortestId)->name,
            ];
            array_push($S, $shortestId);
            // $tmpIds = array_diff($tmpIds, [$shortestId => $tmpIds[$shortestId]]);
        }
// var_dump($shortests);exit;
    }
}
