<script setup lang="ts">

import {SubscriptionFilterEnum} from "@/composables/useSubscriptions";

const model = defineModel<SubscriptionFilterEnum>({ required: true });
</script>

<template>
    <div class="inline-flex rounded-lg bg-gray-100 p-1">
        <template
            v-for="filter in [
                SubscriptionFilterEnum.All,
                SubscriptionFilterEnum.Active,
                SubscriptionFilterEnum.Cancelled,
            ]"
            :key="filter"
        >
            <button
                type="button"
                class="inline-flex items-center justify-center whitespace-nowrap rounded-md px-3 py-1.5 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 disabled:pointer-events-none disabled:opacity-50"
                :class="[
                    model === filter
                        ? 'bg-white text-gray-900 shadow-sm'
                        : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200/50'
                ]"
                @click="model = filter"
            >
                {{ filter }}
            </button>
        </template>
    </div>
</template>
