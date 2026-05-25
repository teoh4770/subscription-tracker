<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SubscriptionSeeder extends Seeder
{
	public function run(): void
	{
        $user = User::where('email', 'test@example.com')->first();

        $subscriptions = [
            // Weekly
            [
                'price' => 4.99,
                'billing_period' => 'weekly',
                'start_date' => Carbon::parse('2025-10-06'),
                'active' => true,
                'is_trial' => false,
                'company' => 'Crunchyroll',
            ],
            [
                'price' => 2.99,
                'billing_period' => 'weekly',
                'start_date' => Carbon::parse('2026-01-05'),
                'active' => true,
                'is_trial' => false,
                'company' => 'Paramount+',
            ],
            // Monthly
            [
                'price' => 10.99,
                'billing_period' => 'monthly',
                'start_date' => Carbon::parse('2025-10-18'),
                'active' => true,
                'is_trial' => false,
                'company' => 'Spotify',
            ],
            [
                'price' => 13.99,
                'billing_period' => 'monthly',
                'start_date' => Carbon::parse('2025-11-01'),
                'active' => true,
                'is_trial' => false,
                'company' => 'Disney+',
            ],
            [
                'price' => 9.99,
                'billing_period' => 'monthly',
                'start_date' => Carbon::parse('2025-12-03'),
                'active' => true,
                'is_trial' => false,
                'company' => 'Apple TV+',
            ],
            [
                'price' => 15.99,
                'billing_period' => 'monthly',
                'start_date' => Carbon::parse('2026-01-01'),
                'active' => false,
                'is_trial' => false,
                'company' => 'Netflix',
            ],
            [
                'price' => 30.00,
                'billing_period' => 'monthly',
                'start_date' => Carbon::parse('2026-02-12'),
                'active' => true,
                'is_trial' => false,
                'company' => 'Claude Pro',
            ],
            [
                'price' => 7.00,
                'billing_period' => 'monthly',
                'start_date' => Carbon::parse('2026-03-01'),
                'active' => true,
                'is_trial' => false,
                'company' => 'YouTube Premium',
            ],
            [
                'price' => 15.00,
                'billing_period' => 'monthly',
                'start_date' => Carbon::parse('2026-03-06'),
                'active' => true,
                'is_trial' => false,
                'company' => 'Audible',
            ],
            // Quarterly
            [
                'price' => 49.99,
                'billing_period' => 'quarterly',
                'start_date' => Carbon::parse('2025-10-01'),
                'active' => true,
                'is_trial' => false,
                'company' => 'HBO Max',
            ],
            [
                'price' => 29.99,
                'billing_period' => 'quarterly',
                'start_date' => Carbon::parse('2026-01-15'),
                'active' => true,
                'is_trial' => false,
                'company' => 'Hulu',
            ],
            // Yearly
            [
                'price' => 180.00,
                'billing_period' => 'yearly',
                'start_date' => Carbon::parse('2026-01-22'),
                'active' => true,
                'is_trial' => false,
                'company' => 'New York Times',
            ],
        ];

        foreach ($subscriptions as $subscription) {
            $company = $subscription['company']
                ? Company::query()->where('name', $subscription['company'])->first()
                : null;

            Subscription::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'company_id' => $company?->id,
                    'billing_period' => $subscription['billing_period'],
                    'start_date' => $subscription['start_date'],
                ],
                [
                    'name' => $company?->name,
                    'price' => $subscription['price'],
                    'active' => $subscription['active'],
                    'is_trial' => $subscription['is_trial'],
                    'category_id' => $company?->category_id,
                    'payment_method_id' => 1,
                ]
            );
        }
	}
}
