<script setup lang="ts">

defineProps<{
    isSubscriptionActive: boolean;
}>();

defineEmits<{
    activate: [],
    deactivate: [],
}>();
</script>

<template>
    <template v-if="!isSubscriptionActive">
        <button
            type="button"
            class="flex-1 rounded-lg bg-green-50 px-4 py-2 text-sm font-semibold text-green-700 ring-1 ring-inset ring-green-600/20 transition hover:bg-green-100 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20 dark:hover:bg-green-500/20"
            data-test="reactivate-button"
            @click="$emit('activate')"
        >
            Mark as Active
        </button>
    </template>
    <template v-else>
        <button
            type="button"
            class="flex-1 rounded-lg bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 ring-1 ring-inset ring-red-600/20 transition hover:bg-red-100 dark:bg-red-500/10 dark:text-red-400 dark:ring-red-500/20 dark:hover:bg-red-500/20"
            data-test="cancel-button"
            @click="$emit('deactivate')"
        >
            Mark as Cancelled
        </button>
    </template>
</template>
