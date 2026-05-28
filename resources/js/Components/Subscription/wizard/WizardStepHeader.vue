<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowLeft } from 'lucide-vue-next';
import SubscriptionController from '@/actions/App/Http/Controllers/SubscriptionController';

defineProps<{
    step: number;
}>();

defineEmits<{
    back: [];
}>();
</script>

<template>
    <template v-if="step === 0">
        <div class="flex items-center justify-between">
            <Link
                :href="SubscriptionController.index().url"
                class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-600 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700"
                aria-label="Go back button"
            >
                <ArrowLeft class="size-[1.2em]" />
            </Link>

            <p class="font-bold text-gray-900 dark:text-white">Companies</p>

            <div class="pointer-events-none invisible px-4 py-2 text-sm font-semibold">
                Create
            </div>
        </div>
    </template>
    <template v-if="step === 1">
        <div
            class="flex items-center justify-between"
            data-test="create-subscription-header-two"
        >
            <button
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-600 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700"
                aria-label="Previous Step"
                @click="$emit('back')"
            >
                <ArrowLeft class="size-[1.2em]" />
            </button>

            <p class="font-bold text-gray-900 dark:text-white">Create Subscription</p>

            <button
                type="submit"
                class="rounded-lg px-4 py-2 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-50 dark:text-indigo-400 dark:hover:bg-indigo-500/10"
                form="subscriptionForm"
            >
                Create
            </button>
        </div>
    </template>
</template>
