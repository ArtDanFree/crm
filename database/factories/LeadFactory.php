<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Lead::class, function (Faker $faker) {
    return [
        'chin_id' => 2,
        'underwriter_id' => 3,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'surname' => $faker->name,
        'money' => $faker->numberBetween(5000, 50000),
        'phone' => $faker->phoneNumber,
        'status_id' => $faker->numberBetween(1, 4),
        'deposit_type_id'  => $faker->numberBetween(1, 2),
        'city_id'  => $faker->numberBetween(1, 10),
        'source_id'  => $faker->numberBetween(1, 16),
        'taken_at' =>$faker->dateTimeInInterval($startDate = 'now', $interval = '+ 1 hours', $timezone = null),
        'completed_at' =>$faker->dateTimeInInterval($startDate = 'now', $interval = '+ 5 hours', $timezone = null),
    ];
});
