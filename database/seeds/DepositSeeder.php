<?php

use Illuminate\Database\Seeder;

class DepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Deposit::create([
            'name' => 'Автомобиль на стоянке',
            'deposit_type_id' => 2
        ]);
        \App\Models\Deposit::create([
            'name' => 'ПТС',
            'deposit_type_id' => 2
        ]);
        \App\Models\Deposit::create([
            'name' => 'Земля',
            'deposit_type_id' => 1
        ]);
        \App\Models\Deposit::create([
            'name' => 'Квартира',
            'deposit_type_id' => 1
        ]);
        \App\Models\Deposit::create([
            'name' => 'Дом',
            'deposit_type_id' => 1
        ]);
        \App\Models\Deposit::create([
            'name' => 'Поручитель',
        ]);
        \App\Models\Deposit::create([
            'name' => 'Заёмщик юридическое лицо',
        ]);

    }
}
