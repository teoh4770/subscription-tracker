<script setup lang="ts">
import {Category, Company, PaymentMethod} from "@/types";
import {computed} from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";

const props = defineProps<{
    form: any;
    companies?: { data: Company[] };
    categories: { data: Category[] };
    paymentMethods: { data: PaymentMethod[] };
    intervals: string[];
}>();

const companyLogoUrl = computed(() => {
    if (props.form.company?.logo_url) {
        return props.form.company.logo_url;
    }

    const name = props.form.company?.name ?? props.form.name;
    return name
        ? `https://img.logo.dev/name/${name}?token=${import.meta.env.VITE_LOGO_DEV_PUBLISHABLE_KEY}`
        : 'https://placehold.co/56';
});

const selectedPaymentMethod = computed(() => {
    return props.paymentMethods.data.find(
        (paymentMethod) => paymentMethod.id === props.form.payment_method_id
    );
});

const capitalize = (str: string) => {
    return str.charAt(0).toUpperCase() + str.slice(1);
}
</script>

<template>
    <div class="flex flex-col gap-4">
        <!--    Detail card preview       -->
        <article class="rounded-xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="p-5">
                <div class="flex items-start justify-between">
                    <h2 class="text-base font-semibold text-gray-900 dark:text-white">
                        {{ form.company?.name ?? form.name }}
                    </h2>

                    <figure class="rounded-xl">
                        <img
                            class="aspect-square w-14 rounded-xl object-contain p-1"
                            :src="companyLogoUrl"
                            :alt="form.company?.name ?? form.name"
                        />
                    </figure>
                </div>

                <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">
                    ${{ form.price }}
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400"
                    >/ {{ form.billing_period }}</span
                    >
                </p>

                <div class="mt-4 flex items-end justify-between">
                    <dl class="space-y-0.5 text-xs text-gray-500 dark:text-gray-400">
                        <div class="flex gap-1">
                            <dt class="font-medium">Started:</dt>
                            <dd>{{ form.start_date }}</dd>
                        </div>
                    </dl>

                    <div class="flex gap-2">
                        <span
                            v-if="form.is_trial"
                            class="inline-flex items-center rounded-full bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10 dark:bg-blue-400/10 dark:text-blue-400 dark:ring-blue-400/30"
                        >
                            Trial
                        </span>
                        <span
                            v-if="form.payment_method_id"
                            class="inline-flex items-center rounded-full bg-gray-50 px-2 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 dark:bg-gray-400/10 dark:text-gray-400 dark:ring-gray-400/20"
                        >
                            {{ selectedPaymentMethod?.name }}
                        </span>
                    </div>
                </div>
            </div>
        </article>

        <!--    Form inputs        -->
        <div class="rounded-xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="space-y-6 p-6">
                <div>
                    <InputLabel for="name" value="Subscription Name" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="price" value="Price" />
                    <div class="relative mt-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input
                            id="price"
                            type="number"
                            step="0.01"
                            min="0"
                            v-model="form.price"
                            class="block w-full rounded-md border-gray-300 pl-7 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                        />
                    </div>
                    <InputError class="mt-2" :message="form.errors.price" />
                </div>

                <div>
                    <InputLabel for="billing_period" value="Period" />
                    <select
                        id="billing_period"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                        v-model="form.billing_period"
                    >
                        <option :value="null">-- Select a period --</option>
                        <option
                            v-for="interval in intervals"
                            :key="interval"
                            :value="interval"
                        >
                            {{ capitalize(interval) }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.billing_period" />
                </div>

                <div>
                    <InputLabel for="start_date" value="Start Date" />
                    <input
                        id="start_date"
                        type="date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                        v-model="form.start_date"
                    />
                    <InputError class="mt-2" :message="form.errors.start_date" />
                </div>

                <div>
                    <InputLabel for="payment_method" value="Payment Method" />
                    <select
                        id="payment_method"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                        v-model="form.payment_method_id"
                    >
                        <option :value="null">None</option>
                        <option
                            v-for="method in paymentMethods.data"
                            :key="method.id"
                            :value="method.id"
                        >
                            {{ method.name }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.payment_method_id" />
                </div>

                <div>
                    <InputLabel for="category" value="Category" />
                    <select
                        id="category"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                        v-model="form.category_id"
                    >
                        <option :value="null">None</option>
                        <option
                            v-for="category in categories.data"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.category_id" />
                </div>

                <div>
                    <InputLabel for="notes" value="Notes (Optional)" />
                    <textarea
                        id="notes"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                        v-model="form.notes"
                        rows="3"
                        placeholder="Write your notes here..."
                    />
                    <InputError class="mt-2" :message="form.errors.notes" />
                </div>

                <div class="flex items-center gap-3">
                    <Checkbox
                        id="is_trial"
                        :checked="form.is_trial"
                        @update:checked="(val) => form.is_trial = val"
                    />
                    <label for="is_trial" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Trial subscription
                    </label>
                </div>
                <InputError :message="form.errors.is_trial" />
            </div>
        </div>
    </div>
</template>
