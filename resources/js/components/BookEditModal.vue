<script setup lang="ts">
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps<{
    book: {
        id: number;
        name: string;
        author: string;
        register_number: string;
        status: string;
        genre_id: number;
    };
    genres: { id: number; name: string }[];
}>();

const emit = defineEmits(["close"]);

const form = ref({
    name: props.book.name,
    author: props.book.author,
    register_number: props.book.register_number,
    status: props.book.status,
    genre_id: props.book.genre_id,
});

// Atualiza o formulário se o livro mudar
watch(() => props.book, (newBook) => {
    form.value = { ...newBook };
}, { deep: true });

const submit = () => {
    router.put(`/books/${props.book.id}`, form.value, {
        onSuccess: () => emit("close"),
    });
};
</script>

<template>
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-gray-900 p-6 rounded-lg w-96 shadow-lg">
            <h2 class="text-xl font-bold text-white mb-4">✏️ Editar Livro</h2>
            <input v-model="form.name" type="text" placeholder="Nome do Livro" class="w-full p-2 mb-2 bg-gray-800 text-white rounded">
            <input v-model="form.author" type="text" placeholder="Autor" class="w-full p-2 mb-2 bg-gray-800 text-white rounded">
            <input v-model="form.register_number" type="text" placeholder="Registro" class="w-full p-2 mb-2 bg-gray-800 text-white rounded">
            <select v-model="form.genre_id" class="w-full p-2 mb-2 bg-gray-800 text-white rounded">
                <option v-for="genre in genres" :key="genre.id" :value="genre.id">{{ genre.name }}</option>
            </select>
            <select v-model="form.status" class="w-full p-2 mb-4 bg-gray-800 text-white rounded">
                <option value="disponível">✅ Disponível</option>
                <option value="indisponível">❌ Indisponível</option>
            </select>
            <div class="flex justify-between">
                <button @click="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Salvar</button>
                <button @click="emit('close')" class="px-4 py-2 bg-red-600 text-white rounded">Cancelar</button>
            </div>
        </div>
    </div>
</template>
