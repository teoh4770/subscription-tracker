<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Support\Facades\Redirect;

class SubscriptionActivateController extends Controller
{
    public function __invoke(Subscription $subscription)
    {
        $subscription->update([
            'active' => true
        ]);

        return Redirect::route('subscriptions.show', ['subscription' => $subscription]);

    }
}
