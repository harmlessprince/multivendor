<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         //
         $orderStatuses = ['pending', 'processing', 'completed', 'decline'];
         foreach ($orderStatuses as $key => $orderStatus) {
             OrderStatus::firstOrCreate(['order_status' => $orderStatus]);
         }
    }
}
