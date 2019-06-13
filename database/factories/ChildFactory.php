<?php

use Faker\Generator as Faker;
use App\Models\Child;

$factory->define(Child::class, function (Faker $faker) {
    return [
      'name' => $faker->firstName,
      'birth_year' => $faker->numberBetween(2000,2019),
      'special_requirements' => $faker->sentence,
      'family_id' => $faker->numberBetween(1, 100)
    ];
});


