<script setup lang="ts">
import { ref, computed } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import BookModal from '@/components/BookModal.vue';
import BookEditModal from '@/components/BookEditModal.vue';
import BookDeleteModal from '@/components/BookDeleteModal.vue';

const props = defineProps<{
    books: {
        id: number;
        name: string;
        author: string;
        register_number: string;
        status: string;
        genre: { id: number; name: string };
    }[];
    genres: { id: number; name: string }[];
}>();


const showCreateModal = ref(false);
const showEditModal = ref(false);
const showDeleteModal = ref(false);

const selectedBook = ref<any>({});

const search = ref('');
const author = ref('');
const status = ref('');

// Filtros
const filteredBooks = computed(() => {
    return props.books.filter((book) => {
        return (
            (!search.value || book.name.toLowerCase().includes(search.value.toLowerCase())) &&
            (!author.value || book.author.toLowerCase().includes(author.value.toLowerCase())) &&
            (!status.value || book.status.toLowerCase() === status.value.toLowerCase())
        );
    });
});

// Métodos para abrir modais
const openEditModal = (book: any) => {
    selectedBook.value = { ...book };
    showEditModal.value = true;
};

const openDeleteModal = (book: any) => {
    selectedBook.value = book;
    showDeleteModal.value = true;
};

// Cria um livro
const saveBook = (bookData: any) => {
    router.post('/books', bookData, {
        onSuccess: () => {
            showCreateModal.value = false;
        },
        onError: (errors) => {
            console.error("Erro ao salvar livro:", errors);
        }
    });
};

// Atualiza um livro
const updateBook = (bookData: any) => {
    router.put(`/books/${bookData.id}`, bookData, {
        onSuccess: () => {
            showEditModal.value = false;
        },
        onError: (errors) => {
            console.error("Erro ao atualizar livro:", errors);
        }
    });
};

// Exclui livro
const deleteBook = (bookId: number) => {
    router.delete(`/books/${bookId}`, {
        onSuccess: () => {
            showDeleteModal.value = false;
        },
        onError: (errors) => {
            console.error("Erro ao excluir livro:", errors);
        }
    });
};
</script>

<template>
    <Head title="Lista de Livros" />

    <AppLayout>
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">📚 Lista de Livros</h1>
                <button @click="showCreateModal = true"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                    + Novo Livro
                </button>
            </div>

            <!-- Filtros -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <input v-model="search" type="text" placeholder="🔍 Buscar por nome..."
                    class="p-3 border rounded-lg bg-gray-800 text-white w-full focus:ring-2 focus:ring-indigo-500">
                <input v-model="author" type="text" placeholder="✍️ Buscar por autor..."
                    class="p-3 border rounded-lg bg-gray-800 text-white w-full focus:ring-2 focus:ring-indigo-500">
                <select v-model="status" class="p-3 border rounded-lg bg-gray-800 text-white w-full focus:ring-2 focus:ring-indigo-500">
                    <option value="">📌 Todos</option>
                    <option value="disponível">✅ Disponível</option>
                    <option value="emprestado">❌ Emprestado</option>
                </select>
            </div>

            <div class="overflow-x-auto bg-gray-900 rounded-lg p-4">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-3">📖 Nome</th>
                            <th class="p-3">✍️ Autor</th>
                            <th class="p-3">📄 Registro</th>
                            <th class="p-3">🏷️ Gênero</th>
                            <th class="p-3">📌 Status</th>
                            <th class="p-3 text-center">⚙️ Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="book in filteredBooks" :key="book.id" class="border-b border-gray-700 text-white hover:bg-gray-800">
                            <td class="p-3">{{ book.name }}</td>
                            <td class="p-3">{{ book.author }}</td>
                            <td class="p-3">{{ book.register_number }}</td>
                            <td class="p-3">{{ book.genre.name }}</td>
                            <td class="p-3">
                                <span :class="book.status === 'disponível' ? 'text-green-400' : 'text-red-400'">
                                    {{ book.status }}
                                </span>
                            </td>
                            <td class="p-3 flex justify-center gap-4">
                                <button @click="openEditModal(book)" class="text-yellow-400 hover:text-yellow-300">✏️ Editar</button>
                                <button @click="openDeleteModal(book)" class="text-red-500 hover:text-red-400">🗑️ Excluir</button>
                            </td>
                        </tr>
                        <tr v-if="filteredBooks.length === 0">
                            <td colspan="6" class="text-center p-6 text-gray-400">Nenhum livro encontrado 😞</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <BookModal v-if="showCreateModal" @close="showCreateModal = false" @save="saveBook" :genres="props.genres" />
        <BookEditModal v-if="showEditModal" @close="showEditModal = false" @save="updateBook" :book="selectedBook" :genres="props.genres" />
        <BookDeleteModal v-if="showDeleteModal && selectedBook" :bookId="selectedBook?.id" @close="showDeleteModal = false" @delete="deleteBook" />
    </AppLayout>
</template>
