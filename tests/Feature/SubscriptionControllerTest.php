<?php

namespace Tests\Feature;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class SubscriptionControllerTest extends TestCase
{
    use RefreshDatabase;

    // -------------------------------------------------------------------------
    // index
    // -------------------------------------------------------------------------

    public function test_unauthenticated_user_cannot_access_subscriptions_index(): void
    {
        $this->get(route('subscriptions.index'))
            ->assertRedirect(route('login'));
    }

    public function test_subscription_index_returns_paginated_list(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $subscriptions = Subscription::factory(10)->for($user)->create();

        $this->get(route('subscriptions.index'))
            ->assertSuccessful()
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->component('Subscriptions/Index')
                ->has('subscriptions.data', $subscriptions->count())
            );
    }

    // -------------------------------------------------------------------------
    // create
    // -------------------------------------------------------------------------

    public function test_unauthenticated_user_cannot_access_subscriptions_create(): void
    {
        $this->get(route('subscriptions.create'))
            ->assertRedirect(route('login'));
    }

    public function test_subscription_create_returns_create_page(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get(route('subscriptions.create'))
            ->assertSuccessful()
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->component('Subscriptions/Create')
            );
    }

    // -------------------------------------------------------------------------
    // store
    // -------------------------------------------------------------------------

    public function test_unauthenticated_user_cannot_store_a_subscription(): void
    {
        $this->post(route('subscriptions.store'), [])
            ->assertRedirect(route('login'));
    }

    public function test_subscription_store_creates_a_subscription(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = Subscription::factory()->make()->toArray();

        $this->post(route('subscriptions.store'), $payload)->assertRedirect(route('subscriptions.index'));

        $this->assertDatabaseHas('subscriptions', [
            'company_id' => $payload['company_id'],
        ]);
    }

    public function test_subscription_store_requires_price(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = Subscription::factory()->make(['price' => null])->toArray();

        $this->post(route('subscriptions.store'), $payload)
            ->assertSessionHasErrors('price');
    }

    public function test_subscription_store_requires_billing_period(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = Subscription::factory()->make(['billing_period' => null])->toArray();

        $this->post(route('subscriptions.store'), $payload)
            ->assertSessionHasErrors('billing_period');
    }

    public function test_subscription_store_requires_start_date(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = Subscription::factory()->make(['start_date' => null])->toArray();

        $this->post(route('subscriptions.store'), $payload)
            ->assertSessionHasErrors('start_date');
    }

    // -------------------------------------------------------------------------
    // show
    // -------------------------------------------------------------------------

    public function test_unauthenticated_user_cannot_access_subscriptions_show(): void
    {
        $subscription = Subscription::factory()->create();

        $this->get(route('subscriptions.show', $subscription))
            ->assertRedirect(route('login'));
    }

    public function test_subscription_show_returns_subscription_detail(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $subscription = Subscription::factory()->create();

        $this->get(route('subscriptions.show', $subscription))
            ->assertSuccessful()
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->component('Subscriptions/Show')
                ->has('subscription.data')
            );
    }

    // -------------------------------------------------------------------------
    // edit
    // -------------------------------------------------------------------------

    public function test_unauthenticated_user_cannot_access_subscriptions_edit(): void
    {
        $subscription = Subscription::factory()->create();

        $this->get(route('subscriptions.edit', $subscription))
            ->assertRedirect(route('login'));
    }

    public function test_subscription_edit_returns_edit_page(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $subscription = Subscription::factory()->create();

        $this->get(route('subscriptions.edit', $subscription))
            ->assertSuccessful()
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->component('Subscriptions/Edit')
                ->has('subscription.data')
            );
    }

    // -------------------------------------------------------------------------
    // update
    // -------------------------------------------------------------------------

    public function test_unauthenticated_user_cannot_update_a_subscription(): void
    {
        $subscription = Subscription::factory()->create();

        $this->put(route('subscriptions.update', $subscription), [])
            ->assertRedirect(route('login'));
    }

    public function test_subscription_update_modifies_the_subscription(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $subscription = Subscription::factory()->create();
        $payload = Subscription::factory()->make()->toArray();

        $this->put(route('subscriptions.update', $subscription), $payload)
            ->assertRedirect(route('subscriptions.show', $subscription));

        $this->assertDatabaseHas('subscriptions', [
            'id' => $subscription->id,
            'company_id' => $payload['company_id'],
        ]);
    }

    // -------------------------------------------------------------------------
    // destroy
    // -------------------------------------------------------------------------

    public function test_unauthenticated_user_cannot_delete_a_subscription(): void
    {
        $subscription = Subscription::factory()->create();

        $this->delete(route('subscriptions.destroy', $subscription))
            ->assertRedirect(route('login'));
    }

    public function test_subscription_destroy_deletes_the_subscription(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $subscription = Subscription::factory()->create();

        $this->delete(route('subscriptions.destroy', $subscription))
            ->assertRedirect(route('subscriptions.index'));

        $this->assertDatabaseMissing('subscriptions', [
            'id' => $subscription->id,
        ]);
    }
}
