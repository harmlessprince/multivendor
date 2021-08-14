<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $paymentMethods = ['card', 'cash on delivery'];
        foreach ($paymentMethods as $key => $paymentMethod) {
            PaymentMethod::firstOrCreate(['payment_method' => $paymentMethod]);
        }
    }
}
