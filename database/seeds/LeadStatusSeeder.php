<?php

use App\Models\LeadStatus;
use Illuminate\Database\Seeder;

class LeadStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadStatus::create([
          'name' => 'На проверку'
        ]);
        LeadStatus::create([
            'name' => 'Проверяется'
        ]);
        LeadStatus::create([
            'name' => 'Одобрен'
        ]);
        LeadStatus::create([
            'name' => 'Отказ'
        ]);
        LeadStatus::create([
            'name' => 'На доработку'
        ]);
        LeadStatus::create([
            'name' => 'Клиент'
        ]);
    }
}
