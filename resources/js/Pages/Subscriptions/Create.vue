<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3'
import {Category, Company, PaymentMethod} from "@/types";
import SubscriptionWizard from "@/Components/Subscription/wizard/SubscriptionWizard.vue";

defineProps<{
    companies: { data: Company[] };
    categories: { data: Category[] };
    paymentMethods: { data: PaymentMethod[] };
    intervals: string[];
}>();
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Create"/>

        <div
            class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <SubscriptionWizard
                :companies="companies"
                :categories="categories"
                :paymentMethods="paymentMethods"
                :intervals="intervals"
            />
        </div>
    </AuthenticatedLayout>
</template>
