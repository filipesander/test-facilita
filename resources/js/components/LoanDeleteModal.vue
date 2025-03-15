<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';

const props = defineProps<{ loanId: number }>();
const emit = defineEmits(['close', 'delete']);

const confirmDelete = () => {
    emit('delete', props.loanId);
    emit('close');
};
</script>

<template>
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-gray-900 p-6 rounded-lg shadow-lg w-96 text-white">
            <h2 class="text-xl font-bold mb-4">🗑️ Confirmar Exclusão</h2>
            <p>Tem certeza que deseja excluir este empréstimo?</p>
            <div class="flex justify-end gap-4 mt-4">
                <button @click="emit('close')" class="px-4 py-2 bg-gray-700 rounded">Cancelar</button>
                <button @click="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded">Excluir</button>
            </div>
        </div>
    </div>
</template>
