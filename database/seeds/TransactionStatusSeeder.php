<?php
use App\Models\TransactionStatus;
use Illuminate\Database\Seeder;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      TransactionStatus::create([
        'name' => 'Проверка анкеты'
      ]);
      TransactionStatus::create([
        'name' => 'Подписан'
      ]);
      TransactionStatus::create([
        'name' => 'Выдан'
      ]);
      TransactionStatus::create([
        'name' => 'Отказ'
      ]);
      TransactionStatus::create([
        'name' => 'Закрыта'
      ]);
      TransactionStatus::create([
        'name' => 'Назначить встречу'
      ]);
      TransactionStatus::create([
        'name' => 'Встреча назначена'
      ]);
    }
}
