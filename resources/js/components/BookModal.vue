<template>
    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-gray-900 p-6 rounded-lg w-1/2 shadow-lg">
            <h2 class="text-2xl font-bold text-white mb-4">Adicionar Livro</h2>

            <form @submit.prevent="submit">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <input v-model="form.name" type="text" placeholder="Nome do livro"
                        class="p-3 border rounded bg-gray-800 text-white w-full" />
                    <input v-model="form.author" type="text" placeholder="Autor"
                        class="p-3 border rounded bg-gray-800 text-white w-full" />
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <input v-model="form.register_number" type="text" placeholder="Número de Registro"
                        class="p-3 border rounded bg-gray-800 text-white w-full" />

                    <select v-model="form.genre_id" class="p-3 border rounded bg-gray-800 text-white w-full">
                        <option value="" disabled selected>📌 Selecione um Gênero</option>
                        <option v-for="genre in genres" :key="genre.id" :value="genre.id">
                            {{ genre.name }}
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <select v-model="form.status" class="p-3 border rounded bg-gray-800 text-white w-full">
                        <option value="disponível">✅ Disponível</option>
                        <option value="emprestado">❌ Emprestado</option>
                    </select>
                </div>

                <div class="flex justify-end gap-4">
                    <button type="button" @click="close"
                        class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>


<script setup lang="ts">
import { ref, defineProps, defineEmits } from "vue";

const props = defineProps<{ genres: { id: number; name: string }[] }>();
const emit = defineEmits(["close", "save"]);

const isOpen = ref(true);

const form = ref({
    name: "",
    author: "",
    register_number: "",
    genre_id: null,
    status: "disponível",
});

function close() {
    isOpen.value = false;
    emit("close");
}

function submit() {
    emit("save", form.value);
    close();
}
</script>
