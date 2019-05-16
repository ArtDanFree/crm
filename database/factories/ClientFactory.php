<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Client::class, function (Faker $faker) {
    return [
        'lead_id' => $faker->numberBetween(1, 5),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'surname' => $faker->name,
        'phone' => $faker->phoneNumber,

    ];
});
