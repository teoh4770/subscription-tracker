<script setup lang="ts">
import { Trash2 } from 'lucide-vue-next';
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import {Subscription} from "@/types";

defineProps<{
    subscription: {
        data: Subscription;
    };
}>();

defineEmits(['delete']);

const isOpened = ref(false);
</script>

<template>
    <button
        class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-red-50 text-red-600 ring-1 ring-inset ring-red-600/20 transition hover:bg-red-100 dark:bg-red-500/10 dark:text-red-400 dark:ring-red-500/20 dark:hover:bg-red-500/20"
        @click="isOpened = true"
        data-test="open-delete-modal-button"
    >
        <Trash2 class="size-[1.2em]" />
    </button>

    <Modal :show="isOpened" @close="isOpened = false">
        <div class="p-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Delete Subscription</h3>
            <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                Are you sure you want to delete this subscription?
                This action cannot be undone.
            </p>
            <div class="mt-6 flex justify-end gap-3">
                <SecondaryButton @click="isOpened = false" data-test="cancel-button">
                    Cancel
                </SecondaryButton>
                <DangerButton
                    @click="$emit('delete')"
                    data-test="delete-button"
                >
                    Delete
                </DangerButton>
            </div>
        </div>
    </Modal>
</template>
