<?php

namespace Database\Factories;

use App\Enums\Interval;
use App\Models\Category;
use App\Models\Company;
use App\Models\PaymentMethod;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'price' => $this->faker->numberBetween(100, 1000),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'company_id' => Company::factory(),
            'payment_method_id' => PaymentMethod::factory(),
            'billing_period' => Interval::MONTHLY->value,
            'start_date' => Carbon::now(),
            'next_billing_date' => Carbon::now()->addDays(30),
            'active' => true,
            'is_trial' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
