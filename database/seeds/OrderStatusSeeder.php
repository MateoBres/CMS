<?php

use Illuminate\Database\Seeder;
use App\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stats = ['nuovo', 'in lavorazione', 'evaso completato', 'evaso incompleto', 'consegnato', 'annullato'];
        foreach ($stats as $status) {
            if (OrderStatus::where('name', $status)->first() == null) {
                $orderStat = new OrderStatus();
                $orderStat->name = $status;
                $orderStat->save();
            }
        }
    }
}
