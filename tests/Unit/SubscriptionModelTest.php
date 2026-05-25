<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Company;
use App\Models\PaymentMethod;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class SubscriptionModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_subscription_belongs_to_company()
    {
        $company = Company::factory()->create();
        $subscription = Subscription::factory()
            ->for($company)
            ->create();

        $this->assertTrue($subscription->company->is($company));
    }

    public function test_that_subscription_belongs_to_category()
    {
        $category = Category::factory()->create();
        $subscription = Subscription::factory()
            ->for($category)
            ->create();

        $this->assertTrue($subscription->category->is($category));
    }

    public function test_that_subscription_belongs_to_payment_method()
    {
        $paymentMethod = PaymentMethod::factory()->create();
        $subscription = Subscription::factory()
            ->for($paymentMethod)
            ->create();

        $this->assertTrue($subscription->paymentMethod->is($paymentMethod));
    }

    public function test_changing_billing_period_to_weekly_updates_next_billing_date(): void
    {
        $subscription = Subscription::factory()->create([
            'billing_period' => 'monthly',
            'start_date' => '2025-01-01',
        ]);

        $subscription->update(['billing_period' => 'weekly']);

        $this->assertEquals('2025-01-08', $subscription->fresh()->next_billing_date->toDateString());
    }

    public function test_changing_billing_period_to_monthly_updates_next_billing_date(): void
    {
        $subscription = Subscription::factory()->create([
            'billing_period' => 'weekly',
            'start_date' => '2025-01-01',
        ]);

        $subscription->update(['billing_period' => 'monthly']);

        $this->assertEquals('2025-02-01', $subscription->fresh()->next_billing_date->toDateString());
    }

    public function test_changing_billing_period_to_quarterly_updates_next_billing_date(): void
    {
        $subscription = Subscription::factory()->create([
            'billing_period' => 'monthly',
            'start_date' => '2025-01-01',
        ]);

        $subscription->update(['billing_period' => 'quarterly']);

        $this->assertEquals('2025-04-01', $subscription->fresh()->next_billing_date->toDateString());
    }

    public function test_changing_billing_period_to_yearly_updates_next_billing_date(): void
    {
        $subscription = Subscription::factory()->create([
            'billing_period' => 'monthly',
            'start_date' => '2025-01-01',
        ]);

        $subscription->update(['billing_period' => 'yearly']);

        $this->assertEquals('2026-01-01', $subscription->fresh()->next_billing_date->toDateString());
    }

    public function test_changing_start_date_updates_next_billing_date(): void
    {
        $subscription = Subscription::factory()->create([
            'billing_period' => 'monthly',
            'start_date' => '2025-01-01',
        ]);

        $subscription->update(['start_date' => '2025-03-15']);

        $this->assertEquals('2025-04-15', $subscription->fresh()->next_billing_date->toDateString());
    }

    public function test_verify_if_subscription_are_due_within_7_days()
    {
        Carbon::setTestNow('2025-01-26');

        $subscription = Subscription::factory()->create([
            'billing_period' => 'monthly',
            'start_date' => '2025-01-01',
        ]);

        $this->assertTrue($subscription->isDueWithinDays());
    }
}
