<?php

use Illuminate\Database\Seeder;

class DepositTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\DepositType::create(
            ['name' => 'Недвижимость']
        );
        \App\Models\DepositType::create(
            ['name' => 'Автомобиль']
        );
    }
}
