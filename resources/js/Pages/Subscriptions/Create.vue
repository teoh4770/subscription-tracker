<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3'

defineProps<{}>()
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Create"/>

    </AuthenticatedLayout>
</template>
