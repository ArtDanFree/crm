<?php

use Illuminate\Database\Seeder;

class TransactionWaiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TransactionWaiver::create([
            'name' => 'Высокая процентная ставка'
        ]);
        \App\Models\TransactionWaiver::create([
            'name' => 'Маленькая сумма'
        ]);
        \App\Models\TransactionWaiver::create([
            'name' => 'Подписание ДКП, соглашения'
        ]);
        \App\Models\TransactionWaiver::create([
            'name' => 'Долго (уже занял в другом месте)'
        ]);
    }
}
