<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
	public function index()
	{
		$subscriptions = Subscription::query()->get();

		return Inertia::render('Subscriptions/Index', [
			// note: create a subscription resource
			'subscriptions' => SubscriptionResource::collection($subscriptions)
		]);
	}

	public function create()
	{
	}

	public function store(Request $request)
	{
	}

	public function show(Subscription $subscription)
	{
	}

	public function edit(Subscription $subscription)
	{
	}

	public function update(Request $request, Subscription $subscription)
	{
	}

	public function destroy(Subscription $subscription)
	{
	}
}
