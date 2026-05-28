<script setup lang="ts">
import {Company} from "@/types";
import {computed, ref} from "vue";
import {Search} from "lucide-vue-next";

const props = defineProps<{
    companies: { data: Company[] };
}>();

defineEmits<{
    (e: 'select-company', company: Company | null): void;
    (e: 'update-name', name: string): void;
}>();

const searchInput = ref('');

const filteredCompanyList = computed(() => {
    return props.companies.data.filter((company) =>
        company.name.toLowerCase().includes(searchInput.value.toLowerCase()),
    );
});

</script>

<template>
    <article class="rounded-xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="p-5">
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <Search class="size-5 text-gray-400" />
                </div>
                <input
                    type="search"
                    v-model="searchInput"
                    @input="$emit('update-name', searchInput)"
                    class="block w-full rounded-lg border-gray-200 pl-10 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:placeholder-gray-500"
                    placeholder="Search companies..."
                />
            </div>

            <template v-if="filteredCompanyList.length > 0">
                <ul
                    class="mt-4 divide-y divide-gray-100 rounded-lg border border-gray-100 bg-white shadow-sm dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-800"
                    data-test="company-list"
                >
                    <li
                        v-for="company in filteredCompanyList"
                        :key="company.id"
                        :id="String(company.id)"
                        class="flex cursor-pointer items-center gap-3 p-3 transition hover:bg-gray-50 dark:hover:bg-gray-700/50"
                        @click="$emit('select-company', company)"
                        data-test="company-list-item"
                    >
                        <div class="shrink-0 rounded-full border border-gray-100 bg-white p-1 dark:border-gray-600 dark:bg-gray-700">
                            <img
                                class="size-8 object-contain"
                                :src="company.logo_url"
                                :alt="company.name"
                            />
                        </div>
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ company.name }}</p>
                    </li>
                </ul>
            </template>
            <template v-else>
                <button
                    class="mt-4 flex w-full items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    @click="$emit('select-company', null)"
                >
                    Company not found. Create your own
                </button>
            </template>
        </div>
    </article>
</template>
