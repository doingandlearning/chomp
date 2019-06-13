<?php

use Faker\Generator as Faker;
use App\Models\Venue;

$factory->define(Venue::class, function (Faker $faker) {
    return [
      'name' => $faker->sentence,
      'address' => $faker->address,
      'contact_name' => $faker->name,
      'contact_number' => $faker->phoneNumber,
      'capacity' => $faker->numberBetween(20,50),
    ];
});
