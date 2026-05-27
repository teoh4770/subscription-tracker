<script setup lang="ts">
import type { Component } from 'vue';

defineProps<{
    icon: Component;
    label: string;
    value: string | null | undefined;
}>();
</script>

<template>
    <article class="rounded-lg border border-gray-100 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <dt class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
            <component :is="icon" class="size-[1.2em]" />
            <span>{{ label }}</span>
        </dt>
        <dd class="mt-1 font-semibold text-gray-900 dark:text-white">{{ value }}</dd>
    </article>
</template>
