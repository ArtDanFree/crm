<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    protected $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Models\User::create([
            'email' => 'admin@admin.ru',
            'first_name' => 'Администратор',
            'surname' => 'Фамилия',
            'last_name' => 'Отчество',
            'birthday' => $this->faker->dateTimeBetween()->format('Y-m-d'),
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'phone' => $this->faker->phoneNumber,
            'remember_token' => str_random(10),
            'city_id' => rand(1, 10)
        ]);
        $admin->assignRole('Администратор');

        $chin = \App\Models\User::create([
            'email' => 'chin@chin.ru',
            'first_name' => 'Частный инвестор',
            'surname' => 'Фамилия',
            'last_name' => 'Отчество',
            'birthday' => $this->faker->dateTimeBetween()->format('Y-m-d'),
            'phone' => $this->faker->phoneNumber,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
            'city_id' => rand(1, 10)
        ]);
        $chin->assignRole('Частный инвестор');

        $underwriter = \App\Models\User::create([
            'email' => 'underwriter@underwriter.ru',
            'first_name' => 'Андеррайтер',
            'surname' => 'Фамилия',
            'last_name' => 'Отчество',
            'birthday' => $this->faker->dateTimeBetween()->format('Y-m-d'),
            'phone' => $this->faker->phoneNumber,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
            'city_id' => rand(1, 10)
        ]);
        $underwriter->assignRole('Андеррайтер');

        $underwriter2 = \App\Models\User::create([
            'email' => 'underwriter2@underwriter.ru',
            'first_name' => 'Андеррайтер2',
            'surname' => 'Фамилия',
            'last_name' => 'Отчество',
            'birthday' => $this->faker->dateTimeBetween()->format('Y-m-d'),
            'phone' => $this->faker->phoneNumber,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
            'city_id' => rand(1, 10)
        ]);
        $underwriter2->assignRole('Андеррайтер');
    }
}
