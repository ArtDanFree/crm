<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Payment::class, function (Faker $faker) {
    return [
        'transaction_id' => $faker->numberBetween(1, 100),
        'body_payment' => $faker->numberBetween(1000, 50000),
        'percent_payment' => $faker->numberBetween(1000, 10000),
        'penalty_payment' => $faker->numberBetween(0, 5000),
    ];
});
