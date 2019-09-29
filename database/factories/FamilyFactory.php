<?php

use Faker\Generator as Faker;
use App\Models\Family;

$factory->define(Family::class, function (Faker $faker) {
    return [
      'contact_number' => $faker->phoneNumber,
      'consent' => true,
      'picture_authority' => $faker->randomElement([true, false]),
      'postcode' => $faker->postcode,
    ];
});
