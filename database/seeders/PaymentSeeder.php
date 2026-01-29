<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            ['payment_method' => 'Transfer Bank'],
            ['payment_method' => 'E-Wallet'],
            ['payment_method' => 'Cash'],
        ];

        foreach ($payments as $payment) {
            Payment::create(['payment_method' => $payment['payment_method']]);
        }
    }
}
