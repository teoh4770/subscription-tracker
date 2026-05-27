<script setup lang="ts">
import { computed } from 'vue';
import type { Subscription } from '@/types';

const props = defineProps<{
    subscription: Subscription;
}>();

const companyLogo = computed(() => {
    return props.subscription.company?.logo_url
        ?? props.subscription.image_url
        ?? "https://placehold.co/56";
});
</script>

<template>
    <article class="rounded-xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="p-5">
            <div class="flex items-start justify-between">
                <h2 class="text-base font-semibold text-gray-900 dark:text-white">
                    {{ subscription.name }}
                </h2>

                <figure
                    class="rounded-xl"
                    :style="{
                        background:
                            subscription.company?.primary_color ?? undefined,
                    }"
                >
                    <img
                        class="aspect-square w-14 rounded-xl object-contain p-1"
                        :src="companyLogo"
                        :alt="subscription.company?.name ?? subscription.name"
                    />
                </figure>
            </div>

            <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">
                ${{ subscription.price }}
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    / {{ subscription.billing_period }}
                </span>
            </p>

            <div class="mt-4 flex items-end justify-between">
                <dl class="space-y-0.5 text-xs text-gray-500 dark:text-gray-400">
                    <div class="flex gap-1">
                        <dt class="font-medium">Started:</dt>
                        <dd>{{ subscription.start_date }}</dd>
                    </div>
                    <div class="flex gap-1">
                        <dt class="font-medium">Next Billing:</dt>
                        <dd>
                            {{ subscription.next_billing_date }}
                        </dd>
                    </div>
                </dl>

                <span
                    v-if="subscription.active"
                    class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20"
                >
                    Active
                </span>
                <span
                    v-else
                    class="inline-flex items-center rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20 dark:bg-red-500/10 dark:text-red-400 dark:ring-red-500/20"
                >
                    Cancelled
                </span>
            </div>
        </div>
    </article>
</template>
