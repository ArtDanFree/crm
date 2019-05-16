<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepositTypeSeeder::class);
        factory(\App\Models\City::class, 10)->create();
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TransactionStatusSeeder::class);
        $this->call(LeadStatusSeeder::class);
        $this->call(DepositSeeder::class);
        $this->call(SourceTableSeeder::class);
        $this->call(TransactionWaiverSeeder::class);
//        factory(\App\Models\Lead::class, 5)->create();
//        factory(\App\Models\Client::class, 5)->create();
//        factory(\App\Models\Transaction::class, 10)->create();
/*        factory(\App\Models\Payment::class, 50)->create();*/
    }
}
