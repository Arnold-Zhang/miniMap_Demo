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
$factory->define(App\Models\City::class, function (Faker\Generator $faker) {
$xaxis = rand(0, 50);
$yaxis = rand(0, 50);
    return [
        'name' => $faker->city,
        'xaxis'   => $xaxis,
		'yaxis'	=> $yaxis,
    ];
});
