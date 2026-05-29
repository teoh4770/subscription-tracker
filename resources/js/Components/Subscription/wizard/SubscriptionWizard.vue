<script setup lang="ts">

import {Category, Company, PaymentMethod} from "@/types";
import {useStepper} from "@/composables/useStepper";
import WizardStepHeader from "@/Components/Subscription/wizard/WizardStepHeader.vue";
import CompanyList from "@/Components/Subscription/CompanyList.vue";
import SubscriptionFormComp from "@/Components/Subscription/SubscriptionForm.vue";
import {useForm} from "@inertiajs/vue3";
import {watch} from "vue";
import SubscriptionController from "@/actions/App/Http/Controllers/SubscriptionController";

export interface SubscriptionForm {
    name: string;
    company: Company | null;
    price: number;
    billing_period: string | null;
    is_trial: boolean;
    start_date: string;
    payment_method_id: number | null;
    category_id: number | null;
    notes: string;
    image_url: string;
}

const props = defineProps<{
    companies: { data: Company[] };
    categories: { data: Category[] };
    paymentMethods: { data: PaymentMethod[] };
    intervals: string[];
}>();

const {currentStep, previousStep, nextStep} = useStepper();

const currentDate = new Date().toISOString().split('T')[0];
const form = useForm<SubscriptionForm>({
    name: '',
    company: null,
    price: 0,
    billing_period: null,
    is_trial: false,
    start_date: currentDate,
    payment_method_id: null,
    category_id: null,
    notes: '',
    image_url: '',
});

watch(currentStep, (newCurrentStep) => {
    if (newCurrentStep === 0) {
        form.reset();
    }
});

watch(
    () => form.name,
    () => {
        if (form.name) {
            form.image_url = `https://img.logo.dev/name/${form.name}?token=${import.meta.env.VITE_LOGO_DEV_PUBLISHABLE_KEY}`;
        }
    },
);

const selectCompany = (company: Company | null) => {
    if (!company) {
        return;
    }

    form.company = company;

    form.name = form.company?.name ?? '';
    nextStep();
}

const updateName = (name: string) => {
    form.name = name;
}

const submitForm = () => {
    form.submit(SubscriptionController.store());
}
</script>

<template>
    <WizardStepHeader :step="currentStep" @back="previousStep"/>

    <template v-if="currentStep === 0">
        <CompanyList
            :companies="companies"
            @select-company="selectCompany"
            @update-name="updateName"
        />
    </template>

    <template v-if="currentStep === 1">
        <form
            id="subscriptionForm"
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto p-4"
            @submit.prevent="submitForm"
        >
            <SubscriptionFormComp
                :form="form"
                :categories="categories"
                :paymentMethods="paymentMethods"
                :intervals="intervals"
            />
        </form>
    </template>

</template>
