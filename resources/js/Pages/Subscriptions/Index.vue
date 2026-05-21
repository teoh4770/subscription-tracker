<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Subscription} from "@/types";
import SubscriptionFilterTabs from "@/Components/Subscription/SubscriptionFilterTabs.vue";
import {useSubscriptions} from "@/composables/useSubscriptions";
import SubscriptionController from "@/actions/App/Http/Controllers/SubscriptionController";
import SubscriptionCard from "@/Components/Subscription/SubscriptionCard.vue";

const props = defineProps<{
    subscriptions: {
        data: Subscription[];
    };
}>()

const { filter, filteredSubscriptions } = useSubscriptions(
    () => props.subscriptions.data,
)
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Index"/>

        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div class="grid gap-2">
                <p class="text-lg font-bold text-gray-900">Subscriptions</p>
                <SubscriptionFilterTabs v-model="filter"/>
            </div>

            <template
                v-for="subscription in filteredSubscriptions"
                :key="subscription.id"
            >
                <Link :href="SubscriptionController.show(subscription.id).url">
                    <SubscriptionCard :subscription="subscription"/>
                </Link>
            </template>

            <Link
                :href="SubscriptionController.create().url"
                class="w-full inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors"
            >
                Add Subscriptions
            </Link>
        </div>
    </AuthenticatedLayout>
</template>
