<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link, router} from "@inertiajs/vue3";
import SubscriptionController from "@/actions/App/Http/Controllers/SubscriptionController";
import {Subscription} from "@/types";
import {ArrowLeft, CreditCard, Pen, Tag} from "lucide-vue-next";
import SubscriptionDetailCard from "@/Components/Subscription/SubscriptionDetailCard.vue";
import SubscriptionInfoCard from "@/Components/Subscription/SubscriptionInfoCard.vue";
import DeleteSubscriptionButton from "@/Components/Subscription/DeleteSubscriptionButton.vue";
import SubscribeButton from "@/Components/Subscription/SubscribeButton.vue";

const props = defineProps<{
    subscription: {
        data: Subscription;
    };
}>();


function activate(subscription: Subscription) {
    // todo: logic to activate subscription through controller
}

function deactivate(subscription: Subscription) {
    // todo: logic to deactivate subscription through controller
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Show"/>

        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto p-4"
        >
            <div
                class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
            >
                <div class="flex items-center justify-between">
                    <Link
                        :href="SubscriptionController.index().url"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-600 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700"
                        aria-label="Go back button"
                    >
                        <ArrowLeft class="size-[1.2em]"/>
                    </Link>

                    <p class="font-bold text-gray-900 dark:text-white">Subscription Detail</p>

                    <Link
                        :href="SubscriptionController.edit(subscription.data).url"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-600 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700"
                        aria-label="Edit subscription button"
                    >
                        <Pen class="size-[1.2em]"/>
                    </Link>
                </div>

                <SubscriptionDetailCard :subscription="subscription.data"/>

                <div class="grid grid-cols-2 gap-4">
                    <SubscriptionInfoCard
                        :icon="CreditCard"
                        label="Payment"
                        :value="subscription.data.payment_method?.name"
                    />
                    <SubscriptionInfoCard
                        :icon="Tag"
                        label="Category"
                        :value="subscription.data.category?.name"
                    />
                </div>

                <article
                    class="rounded-xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="p-5">
                        <div class="flex justify-between text-sm font-medium">
                            <span class="text-gray-600 dark:text-gray-400">Days until renewal</span>
                            <span class="text-gray-600"
                            >{{
                                    subscription.data.days_until_next_billing
                                }}
                            days</span
                            >
                        </div>
                        <div class="mt-3 h-2 w-full overflow-hidden rounded-full bg-gray-200 dark:bg-gray-700">
                            <div
                                class="h-full bg-indigo-600 transition-all duration-300 dark:bg-indigo-500"
                                :style="{ width: subscription.data.billing_cycle_progress + '%' }"
                            ></div>
                        </div>
                    </div>
                </article>

                <article v-if="subscription.data.notes"
                         class="rounded-xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="p-5">
                        <dt class="text-sm text-gray-500 dark:text-gray-400">
                            <span>Notes</span>
                        </dt>
                        <dd class="mt-1 font-semibold text-gray-900 dark:text-white">{{ subscription.data.notes }}</dd>
                    </div>
                </article>

                <!--   todo: action buttons like delete   -->
                <div class="flex gap-3">
                    <DeleteSubscriptionButton :subscription="subscription.data"
                                              @delete="router.delete(SubscriptionController.destroy(subscription.data).url)"/>

                    <SubscribeButton
                        :is-subscription-active="subscription.data.active"
                        @activate="activate(subscription.data)"
                        @deactivate="deactivate(subscription.data)"
                    />

                    <Link
                        :href="SubscriptionController.edit(subscription.data).url"
                        class="flex flex-1 items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                    >
                        <Pen class="size-[1.2em]"/>
                        Edit
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
