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
            return ['shortests' => INF,
                     'traces' => City::find($idA)->name . " to " . City::find($idB)->name
                ];
        }

        //各城市最短路径及距离初始化
        foreach ($citiesIds as $v) {
            $traces[$v] = City::find($idA)->name;
        }
        $traces[$idA] .= " to " . City::find($idA)->name;
        $shortests[$idA] = 0;    // 已获得最短路径的城市

        // 去掉A城市id
        $tmp = $citiesIds;    // 未获得最短路径的城市
        $key=array_search($idA ,$tmp);
        array_splice($tmp, $key, 1);
        foreach ($tmp as $cityId ) {
            $distances[$cityId] = INF; // 未获最短路径城市初始化为无穷大
        }

        // $shortests -> 最短路径城市及距离
        // $distances -> 未获得最短城市及距离
        for ($i = 0; $i < count($citiesIds)-1 ; $i++) {

            // 若提前结束, 提前跳出
            if (empty($distances)) {
                break;
            }

            foreach ($distances as $currentCity => $currentDis) {
                //当前目标城市所有道路id
                $roadsId = [];
                $roads = City::find($currentCity)->roads->toArray();
                foreach ($roads as $road) {
                    $roadsId[] = $road['id'];
                }
                // 获取当前目标城市直连城市的距离和id
                $linkInfos = [];
                foreach ($roadsId as $rId) {
                    $cities = DB::table('cities_to_roads')->where('roadId', $rId)->pluck('cityId')->toArray();
                    if (!empty($cities)) {
                        $id = array_values( array_diff($cities, [$currentCity]) )[0];   // 该道路连接城市id
                        $linkInfos[$id] = Road::find($rId)->distance;
                    }
                }
                //若直连城市中含有已找到最短路径的城市，则更新当前目标城市的距离
                foreach ($linkInfos as $linkId => $linkDis) {
                    if (array_key_exists($linkId, $shortests)) {
                        if ($currentDis > ($shortests[$linkId] + $linkInfos[$linkId])) {
                            $distances[$currentCity] = $shortests[$linkId] + $linkInfos[$linkId];
                            if ($linkId == $idA) {
                                $traces[$currentCity] = City::find($idA)->name . " to " . City::find($currentCity)->name;
                            }else {
                                $traces[$currentCity] = $traces[$linkId] . " to " . City::find($currentCity)->name;
                            }
                        }
                    }
                }

            }

            $newShortests = array_keys($distances, min($distances));
            foreach ($newShortests as $newShortId) {
                $shortests[$newShortId] = $distances[$newShortId];
                unset($distances[$newShortId]);
            }
        }

        foreach ($traces as $key => $value) {
            if ($shortests[$key] == INF) {
                $traces[$key] .= " to " . City::find($key)->name;
            }
        }
        return [
            'shortests' => $shortests,
            'traces' => $traces

        ];

    }
}
