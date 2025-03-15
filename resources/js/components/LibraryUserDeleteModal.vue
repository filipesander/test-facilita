<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';

const props = defineProps<{ userId: number }>();
const emit = defineEmits(["close", "delete"]);

const confirmDelete = () => {
    emit("delete", props.userId);
    emit("close");
};
</script>

<template>
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-gray-900 p-6 rounded-lg w-1/3 shadow-lg text-center">
            <h2 class="text-2xl font-bold text-white mb-4">Tem certeza?</h2>
            <p class="text-gray-300">Essa ação não pode ser desfeita.</p>
            <div class="flex justify-center gap-4 mt-4">
                <button @click="emit('close')" class="px-4 py-2 bg-gray-600 text-white rounded">Cancelar</button>
                <button @click="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded">Excluir</button>
            </div>
        </div>
    </div>
</template>
