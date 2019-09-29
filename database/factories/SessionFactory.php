<?php

use Faker\Generator as Faker;
use App\Models\Session;
use Carbon\Carbon;

$factory->define(Session::class, function (Faker $faker) {

    $now = Carbon::now();
    $later = $now->addWeeks(10);
    return [
      'date' => $faker->dateTimeThisMonth(),
    ];
});
