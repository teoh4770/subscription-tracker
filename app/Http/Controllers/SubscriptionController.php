<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Resources\SubscriptionResource;
use App\Models\Category;
use App\Models\Company;
use App\Models\PaymentMethod;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::query()->get();

        return Inertia::render('Subscriptions/Index', [
            'subscriptions' => SubscriptionResource::collection($subscriptions)
        ]);
    }

    public function create()
    {
        $companies = Company::query()->get();
        $categories = Category::query()->get();
        $paymentMethods = PaymentMethod::query()->get();

        return Inertia::render('Subscriptions/Create', [
            'companies' => CompanyResource::collection($companies),
            'categories' => CategoryResource::collection($categories),
            'paymentMethods' => PaymentMethodResource::collection($paymentMethods),
        ]);
    }

    public function store(SubscriptionRequest $request)
    {
        Subscription::query()->create([
            ...$request->validated(),
            'user_id' => Auth::id(),
            'active' => true,
        ]);

        return Redirect::route('subscriptions.index');
    }

    public function show(Subscription $subscription)
    {
        return Inertia::render('Subscriptions/Show', [
            'subscription' => SubscriptionResource::make($subscription)
        ]);
    }

    public function edit(Subscription $subscription)
    {
        return Inertia::render('Subscriptions/Edit', [
            'subscription' => SubscriptionResource::make($subscription)
        ]);
    }

    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->update($request->validated());

        return Redirect::route('subscriptions.show', ['subscription' => $subscription]);
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return Redirect::route('subscriptions.index');
    }
}
