<?php

namespace App\Http\Requests;

use App\Enums\Interval;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriptionRequest extends FormRequest
{
	public function rules(): array
	{
		return [
            'name' => ['required', 'string'],
            'price' => ['required', 'gte:0', 'decimal:0,2'],
            'billing_period' => ['required', Rule::in(Interval::cases())],
            'category_id' => ['nullable', 'exists:categories,id'],
            'company_id' => ['nullable', 'exists:companies,id'],
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'start_date' => ['required', 'date'],
            'next_billing_date' => ['nullable', 'date', 'after:start_date'],
            'notes' => ['nullable', 'string'],
            'image_url' => ['nullable', 'url'],
            'is_trial' => ['required', 'boolean'],
            'active' => ['sometimes', 'boolean'],
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
