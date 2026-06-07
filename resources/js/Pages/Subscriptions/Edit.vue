<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3'
import {Category, Company, PaymentMethod, Subscription} from "@/types";
import {watch} from "vue";
import SubscriptionFormComp from "@/Components/Subscription/SubscriptionForm.vue";
import SubscriptionController from "@/actions/App/Http/Controllers/SubscriptionController";
import {ArrowLeft} from "lucide-vue-next";

const props = defineProps<{
    subscription: { data: Subscription };
    companies: { data: Company[] };
    categories: { data: Category[] };
    paymentMethods: { data: PaymentMethod[] };
    intervals: string[];
}>();

interface SubscriptionForm {
    name: string;
    company_id: number | null;
    price: number;
    billing_period: string | null;
    is_trial: boolean;
    start_date: string;
    payment_method_id: number | null;
    category_id: number | null;
    notes: string;
    image_url: string;
    active: boolean;
}

const form = useForm<SubscriptionForm>({
    name: props.subscription.data.name,
    company_id: props.subscription.data.company?.id ?? null,
    price: props.subscription.data.price,
    billing_period: props.subscription.data.billing_period,
    is_trial: props.subscription.data.is_trial,
    start_date: props.subscription.data.start_date,
    payment_method_id: props.subscription.data.payment_method?.id ?? null,
    category_id: props.subscription.data.category?.id ?? null,
    notes: props.subscription.data.notes ?? '',
    image_url: props.subscription.data.image_url ?? '',
    active: props.subscription.data.active,
});

watch(
    () => form.name,
    () => {
        if (form.name && !props.subscription.data.company) {
            form.image_url = `https://img.logo.dev/name/${form.name}?token=${import.meta.env.VITE_LOGO_DEV_PUBLISHABLE_KEY}`;
        }
    },
);

const submitForm = () => {
    form.patch(SubscriptionController.update(props.subscription.data).url);
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Edit Subscription"/>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex h-full flex-1 flex-col gap-4 overflow-x-auto p-4">
            <div class="flex items-center justify-between">
                <Link
                    :href="SubscriptionController.show(subscription.data).url"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-600 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700"
                    aria-label="Go back button"
                >
                    <ArrowLeft class="size-[1.2em]"/>
                </Link>

                <p class="font-bold text-gray-900 dark:text-white">Edit Subscription</p>

                <button
                    type="submit"
                    class="rounded-lg px-4 py-2 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-50 dark:text-indigo-400 dark:hover:bg-indigo-500/10"
                    form="subscriptionForm"
                    :disabled="form.processing"
                >
                    Update
                </button>
            </div>

            <form
                id="subscriptionForm"
                class="flex flex-col gap-4"
                @submit.prevent="submitForm"
            >
                <SubscriptionFormComp
                    :form="form"
                    :categories="categories"
                    :paymentMethods="paymentMethods"
                    :intervals="intervals"
                    is-editing
                />
            </form>
        </div>
    </AuthenticatedLayout>
</template>
