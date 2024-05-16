<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [1,2,3];

        foreach ($payments as $payment) {
            Payment::create(['reservation_id' => $payment]);
        }
    }
}
