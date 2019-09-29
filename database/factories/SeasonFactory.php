<?php

use Faker\Generator as Faker;
use App\Models\Season;

$factory->define(App\Models\Season::class, function (Faker $faker) {
    return [
      'name' => $faker->sentence,
      'open' => $faker->boolean
    ];
});
