<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Support\Facades\Redirect;

class SubscriptionDeactivateController extends Controller
{
    public function __invoke(Subscription $subscription)
    {
        $subscription->update([
            'active' => false
        ]);

        return Redirect::route('subscriptions.show', ['subscription' => $subscription]);

    }
}
