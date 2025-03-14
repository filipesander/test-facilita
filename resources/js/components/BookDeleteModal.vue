<script setup lang="ts">
import { router } from "@inertiajs/vue3";

const props = defineProps<{
    bookId: number;
}>();

const emit = defineEmits(["close"]);

const confirmDelete = () => {
    router.delete(`/books/${props.bookId}`, {
        onSuccess: () => emit("close"),
    });
};
</script>

<template>
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-gray-900 p-6 rounded-lg w-96 shadow-lg">
            <h2 class="text-xl font-bold text-white mb-4">⚠️ Confirmar Exclusão</h2>
            <p class="text-white mb-4">Tem certeza que deseja excluir este livro? Esta ação não pode ser desfeita.</p>
            <div class="flex justify-between">
                <button @click="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded">Excluir</button>
                <button @click="emit('close')" class="px-4 py-2 bg-gray-600 text-white rounded">Cancelar</button>
            </div>
        </div>
    </div>
</template>
