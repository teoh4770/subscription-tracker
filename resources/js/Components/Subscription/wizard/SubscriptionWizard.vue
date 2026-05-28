<script setup lang="ts">

import {Category, Company, PaymentMethod} from "@/types";
import {useStepper} from "@/composables/useStepper";
import WizardStepHeader from "@/Components/Subscription/wizard/WizardStepHeader.vue";
import CompanyList from "@/Components/Subscription/CompanyList.vue";

defineProps<{
    companies: { data: Company[] };
    categories: { data: Category[] };
    paymentMethods: { data: PaymentMethod[] };
}>();

const {currentStep, previousStep, nextStep} = useStepper();


</script>

<template>
    <WizardStepHeader :step="currentStep" @back="previousStep"/>

    <template v-if="currentStep === 0">
        <CompanyList
            :companies="companies"
            @select-company="console.log('select company')"
            @update-name="console.log('update name')"
        />
    </template>

    <template v-if="currentStep === 1">
        <!-- form to fill -->
    </template>

</template>
