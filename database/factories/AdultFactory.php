<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Adult;
use Faker\Generator as Faker;

$factory->define(Adult::class, function (Faker $faker) {
    return [
      'name' => $faker->name,
      'primary' => $faker->boolean(40),
      'family_id' => $faker->numberBetween(1, 10)
    ];
});
