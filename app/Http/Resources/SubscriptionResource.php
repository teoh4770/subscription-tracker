<?php

namespace App\Http\Resources;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/** @mixin Subscription */
class SubscriptionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $startDate = Carbon::parse($this->start_date);
        $nextBillingDate = Carbon::parse($this->next_billing_date);
        $totalDays = $startDate->diffInDays($nextBillingDate);
        $daysUntilNextBilling = today()->diffInDays($nextBillingDate);
        $billingCycleProgress = $totalDays > 0 ? round(($totalDays - $daysUntilNextBilling) / $totalDays * 100) : 0;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'billing_period' => $this->billing_period,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'start_date' => $startDate->format('Y-m-d'),
            'next_billing_date' => $nextBillingDate->toFormattedDateString(),
            'days_until_next_billing' => $daysUntilNextBilling,
            'billing_cycle_progress' => $billingCycleProgress,
            'active' => $this->active,
            'notes' => $this->notes,
            'image_url' => $this->image_url,
            'is_trial' => $this->is_trial,
            'payment_method' => new PaymentMethodResource($this->paymentMethod),
            'category' => new CategoryResource($this->category),
            'company' => new CompanyResource($this->company),
        ];
    }
}
