<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Link::class, function (Faker $faker) {
	$time1 = $faker->dateTimeThisMonth();
	$time2 = $faker->dateTimeThisMonth($time1);
	
    return [
        'title' => $faker->name,
        'link' => $faker->url,
        'created_at' => $time1,
        'updated_at' => $time2,
    ];
});
