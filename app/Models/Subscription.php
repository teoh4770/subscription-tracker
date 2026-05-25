<?php

namespace App\Models;

use App\Enums\Interval;
use Carbon\CarbonPeriod;
use Database\Factories\SubscriptionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Subscription extends Model
{
    /** @use HasFactory<SubscriptionFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'user_id',
        'category_id',
        'company_id',
        'payment_method_id',
        'billing_period',
        'start_date',
        'next_billing_date',
        'active',
        'notes',
        'image_url',
        'is_trial',
    ];

    protected $casts = [
        'billing_period' => Interval::class,
        'active' => 'bool',
        'start_date' => 'date',
        'next_billing_date' => 'date',
        'is_trial' => 'bool'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    protected function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }

    protected static function booted(): void
    {
        static::creating(function (Subscription $subscription) {
            $subscription->next_billing_date = $subscription->calculateNextBillingDate();
        });

        static::updating(function (Subscription $subscription) {
            if ($subscription->isDirty(['start_date', 'billing_period'])) {
                $subscription->next_billing_date = $subscription->calculateNextBillingDate();
            }
        });
    }

    private function calculateNextBillingDate()
    {
        return match ($this->billing_period) {
            Interval::WEEKLY => $this->start_date->addWeek(),
            Interval::MONTHLY => $this->start_date->addMonth(),
            Interval::QUARTERLY => $this->start_date->addQuarter(),
            Interval::YEARLY => $this->start_date->addYear(),
        };
    }

    public function averageChargeInMonth(): float
    {
        $avgNumberOfWeekInAMonth = 52 / 12;

        return match ($this->billing_period) {
            'weekly' => $this->price * $avgNumberOfWeekInAMonth,
            'monthly' => $this->price,
            'quarterly' => $this->price / 4,
            'yearly' => $this->price / 12,
        };
    }

    public function actualChargeInMonth(Carbon $month): float
    {
        $startOfMonth = $month->copy()->startOfMonth();
        $endOfMonth = $month->copy()->endOfMonth();

        if ($this->start_date->gt($endOfMonth)) {
            return 0;
        }

        $interval = match ($this->billing_period) {
            'weekly' => '1 week',
            'monthly' => '1 month',
            'quarterly' => '3 months',
            'yearly' => '1 year',
        };

        $occurrence = collect(CarbonPeriod::create($this->start_date, $interval, $endOfMonth))
            ->filter(fn ($date) => $date->between($startOfMonth, $endOfMonth))
            ->count();

        return $this->price * $occurrence;
    }

    public function actualChargeInYear(): float
    {
        return match ($this->billing_period) {
            'weekly' => $this->price * 52,
            'monthly' => $this->price * 12,
            'quarterly' => $this->price * 4,
            'yearly' => $this->price,
        };
    }

    public function isDueWithinDays(int $days = 7): bool
    {
        return today()->diffInDays($this->calculateNextBillingDate()) <= $days;
    }

    public function monthlySpendingEntries(): array
    {
        return collect(CarbonPeriod::create(Carbon::parse($this->start_date), '1 month', today()))
            ->map(fn (Carbon $date) => [
                'date' => $date->format('Y-m'),
                'price' => $this->actualChargeInMonth($date),
            ])
            ->all();
    }
}
