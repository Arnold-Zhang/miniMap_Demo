<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Road::class, function (Faker\Generator $faker) {
    $citiesIds = App\Models\City::pluck('id')->toArray();
    $randomIds = array_rand($citiesIds, 2);
    $cityA = App\Models\City::find($citiesIds[$randomIds[0]]);
    $cityB = App\Models\City::find($citiesIds[$randomIds[1]]);

    $cityARoads = $cityA->roads;
    $cityBRoads = $cityB->roads;

    // 获取两个城市已有道路Ids
    $cityARoadIds = [];
    $cityBRoadIds = [];
    foreach ($cityARoads as $cityARoad) {
        $cityARoadIds[] = $cityARoad->id;
    }
    foreach ($cityBRoads as $cityBRoad) {
        $cityBRoadIds[] = $cityBRoad->id;
    }

    // 若道路已经存在
    if (array_intersect($cityARoadIds, $cityBRoadIds)) {
        return [
            'result' => false,
        ];
    }

    $road = new App\Models\Road();
    $road->distance = sqrt(pow(abs($cityA->xaxis - $cityB->xaxis), 2) + pow(abs($cityA->yaxis - $cityB->yaxis), 2));
    $road->save();
    $road->cities()->attach($cityA->id);
    $road->cities()->attach($cityB->id);
    
    return [
        'result' => true,
    ];
});
