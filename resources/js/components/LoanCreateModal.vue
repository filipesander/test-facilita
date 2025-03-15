<template>
    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-gray-900 p-6 rounded-lg w-1/2 shadow-lg">
            <h2 class="text-2xl font-bold text-white mb-4">📖 Novo Empréstimo</h2>

            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="user" class="block text-gray-300 text-sm mb-1">👤 Usuário</label>
                    <select v-model="form.library_user_id" id="user"
                        class="p-3 border rounded bg-gray-800 text-white w-full">
                        <option value="" disabled selected>Selecione um usuário</option>
                        <option v-for="user in users" :key="user.id" :value="user.id">
                            {{ user.name }}
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="book" class="block text-gray-300 text-sm mb-1">📚 Livro</label>
                    <select v-model="form.book_id" id="book"
                        class="p-3 border rounded bg-gray-800 text-white w-full">
                        <option value="" disabled selected>Selecione um livro</option>
                        <option v-for="book in books" :key="book.id" :value="book.id">
                            {{ book.name }}
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="due_date" class="block text-gray-300 text-sm mb-1">📅 Data de Devolução</label>
                    <input v-model="form.due_date" id="due_date" type="date"
                        class="p-3 border rounded bg-gray-800 text-white w-full">
                </div>

                <div class="flex justify-end gap-4">
                    <button type="button" @click="close"
                        class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, defineProps, defineEmits } from "vue";

const props = defineProps<{ users: { id: number; name: string }[], books: { id: number; name: string }[] }>();
const emit = defineEmits(["close", "save"]);

const isOpen = ref(true);

const form = ref({
    library_user_id: "",
    book_id: "",
    due_date: "",
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
