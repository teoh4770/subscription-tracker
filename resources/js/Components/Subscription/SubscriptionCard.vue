<script setup lang="ts">
import { computed } from 'vue';
import type { Subscription } from '@/types';
import DayRing from "@/Components/Subscription/DayRing.vue";

const props = defineProps<{
    subscription: Subscription;
}>();

const companyLogo = computed(() => {
    return props.subscription.company?.logo_url
        ?? props.subscription.image_url
        ?? "https://placehold.co/48";
});
</script>

<template>
    <article class="rounded-xl bg-white border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-4 flex flex-row items-center">
            <figure
                class="rounded-full shrink-0"
                :style="{
                    background: subscription.company?.primary_color ?? undefined
                }"
            >
                <img
                    class="w-12 aspect-square rounded-full object-contain p-1"
                    :src="companyLogo"
                    :alt="subscription.company?.name"
                />
            </figure>

            <div class="ml-4">
                <h2 class="text-sm font-semibold text-gray-900">{{ subscription.name }}</h2>
                <p class="text-xs text-gray-500">${{ subscription.price }} / {{ subscription.billing_period }}</p>
                <span v-show="!subscription.active" class="inline-flex items-center rounded-full border border-red-200 bg-red-50 px-2 py-0.5 text-xs font-medium text-red-700">Cancelled</span>
            </div>

            <div class="ml-auto flex items-center">
                <slot name="actions">
                    <DayRing
                        :progress="subscription.billing_cycle_progress"
                        :remaining-days="subscription.days_until_next_billing"
                    />
                </slot>
            </div>
        </div>
    </article>
</template>
