<?php

use App\Subscription;
use Illuminate\Database\Seeder;

class SubcritionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $standard = Subscription::updateOrCreate(['name' => 'Standard', 'amount' => 149.00]);
        $top = Subscription::updateOrCreate(['name' => 'Top!', 'amount' => 249.00]);
    }
}
