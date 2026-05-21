<script setup lang="ts">
defineProps<{
    progress: number;
    remainingDays: number;
}>();
</script>

<template>
    <div
        class="radial-progress text-primary text-xs text-center"
        :style="{
            '--value': progress,
            '--size': '3rem',
            '--thickness': '2px',
        }"
        :aria-valuenow="progress"
        role="progressbar"
    >
        <span>{{ remainingDays }}</span>
        <span>days</span>
    </div>
</template>
