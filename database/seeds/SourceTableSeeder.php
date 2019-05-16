<?php

use Illuminate\Database\Seeder;
use App\Models\Source;

class SourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Source::create([
        'name' => 'Лидогенератор Теймур'
      ]);
      Source::create([
        'name' => 'Электронная почта'
      ]);
      Source::create([
        'name' => 'creditors24.ru'
      ]);
      Source::create([
        'name' => 'Веб-сайт'
      ]);
      Source::create([
        'name' => 'likedengi.ru(скинули в чат)'
      ]);
      Source::create([
        'name' => 'Партнерский лид'
      ]);
      Source::create([
        'name' => 'Соцсети'
      ]);
      Source::create([
        'name' => 'Брокер'
      ]);
      Source::create([
        'name' => 'По рекоммендации'
      ]);
      Source::create([
        'name' => 'Собственный сайт'
      ]);
      Source::create([
        'name' => 'Выставка'
      ]);
      Source::create([
        'name' => 'Интернет-магазин'
      ]);
      Source::create([
        'name' => 'Срафанное радио'
      ]);
      Source::create([
        'name' => 'Повторное обращение'
      ]);
      Source::create([
        'name' => 'Реклама на стекле автомобиля'
      ]);
      Source::create([
        'name' => 'Другое'
      ]);
    }
}
