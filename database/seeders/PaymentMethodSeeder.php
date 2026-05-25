<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    private array $paymentMethods = [
        ['name' => 'Visa',        'type' => 'credit_card'],
        ['name' => 'Mastercard',  'type' => 'credit_card'],
        ['name' => 'Amex',        'type' => 'credit_card'],
        ['name' => 'Visa Debit',  'type' => 'debit_card'],
        ['name' => 'PayPal',      'type' => 'paypal'],
        ['name' => 'Apple Pay',   'type' => 'apple_pay'],
        ['name' => 'Google Pay',  'type' => 'google_pay'],
        ['name' => 'Bank Transfer', 'type' => 'bank_transfer'],
    ];

	public function run(): void
	{
        foreach ($this->paymentMethods as $method) {
            PaymentMethod::query()->firstOrCreate(
                ['name' => $method['name']],
                ['type' => $method['type']],
            );
        }
	}
}
