<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reply::class, function (Faker $faker) {

	$time1 = $faker->dateTimeThisMonth();
	$time2 = $faker->dateTimeThisMonth($time1);

    return [
        'content' => $faker->sentence(),
        'created_at' => $time1,
        'updated_at' => $time2,
    ];
});
