<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
    progress: number;
    remainingDays: number;
}>();

const radius = 22;
const circumference = 2 * Math.PI * radius;
const strokeDashoffset = computed(() => {
    const clampedProgress = Math.min(Math.max(props.progress, 0), 100);
    return circumference * (1 - clampedProgress / 100);
});
</script>

<template>
    <div
        class="relative flex items-center justify-center w-12 h-12"
        :aria-valuenow="progress"
        role="progressbar"
    >
        <svg class="w-full h-full -rotate-90" viewBox="0 0 48 48">
            <!-- Background circle -->
            <circle
                cx="24"
                cy="24"
                :r="radius"
                stroke-width="2"
                stroke="currentColor"
                fill="transparent"
                class="text-gray-100"
            />
            <!-- Progress circle -->
            <circle
                cx="24"
                cy="24"
                :r="radius"
                stroke-width="2"
                stroke="currentColor"
                fill="transparent"
                :stroke-dasharray="circumference"
                :stroke-dashoffset="strokeDashoffset"
                class="text-indigo-600 transition-all duration-300 ease-in-out"
                stroke-linecap="round"
            />
        </svg>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
            <span class="text-xs font-bold text-gray-900 leading-none">{{ remainingDays }}</span>
            <span class="text-[8px] font-medium text-gray-500 uppercase tracking-tighter">days</span>
        </div>
    </div>
</template>
