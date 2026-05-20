<?php

namespace App\Models;

use App\Enums\Interval;
use Database\Factories\SubscriptionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
