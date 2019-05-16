<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Transaction::class, function (Faker $faker) {
    return [
        'chin_id' => 2,
        'underwriter_id' => 3,
        'client_id' => $faker->numberBetween(1, 5),
        'status_id' => $faker->numberBetween(1, 7),
        'gave_money' => $faker->boolean,
        'signed' => $faker->boolean,
        'money' => $faker->numberBetween(10000, 500000),
        'percent' => $faker->numberBetween(5, 30),
        'schema' => $faker->numberBetween(0, 1),
        'add_two_payments' => false ,
        'period' => $faker->numberBetween(12, 36),
        'deposit_type_id' => $faker->numberBetween(1, 2),
        'waiver_id' => $faker->numberBetween(1, 4),
    ];
});
