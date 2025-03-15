<script setup lang="ts">
import { ref, computed } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import { useToast } from "vue-toastification";
import AppLayout from '@/layouts/AppLayout.vue';
import LoanCreateModal from '@/components/LoanCreateModal.vue';
import LoanEditModal from '@/components/LoanEditModal.vue';
import LoanDeleteModal from '@/components/LoanDeleteModal.vue';

const toast = useToast();

const props = defineProps<{
    loans: {
        id: number;
        library_user: { name: string };
        book: { name: string };
        return_date: string;
        status: string;
    }[];
    users: { id: number; name: string }[];
    books: { id: number; name: string }[];
}>();

const showCreateModal = ref(false);
const showEditModal = ref(false);
const showDeleteModal = ref(false);

const selectedLoan = ref<any>(null);
const search = ref("");

const filteredLoans = computed(() => {
    return props.loans.filter((loan) =>
        !search.value || loan.library_user.name.toLowerCase().includes(search.value.toLowerCase())
    );
});

const openEditModal = (loan: any) => {
    selectedLoan.value = { ...loan };
    showEditModal.value = true;
};

const openDeleteModal = (loan: any) => {
    selectedLoan.value = loan;
    showDeleteModal.value = true;
};

// Cria um empréstimo
const saveLoan = (loanData: any) => {
    router.post('/loans', loanData, {
        onSuccess: () => {
            showCreateModal.value = false;
            toast.success("📚 Empréstimo registrado com sucesso!");
        },
        onError: () => {
            toast.error("❌ Erro ao registrar empréstimo.");
        }
    });
};

// Atualiza status do empréstimo
const updateLoanStatus = () => {
    router.put(`/loans/${selectedLoan.value.id}`, { status: selectedLoan.value.status }, {
        preserveState: true,
        onSuccess: () => {
            showEditModal.value = false;
            toast.success("🔄 Status atualizado com sucesso!");
        },
        onError: () => {
            toast.error("❌ Erro ao atualizar o status do empréstimo.");
        }
    });
};

// Deleta um empréstimo
const deleteLoan = (loanId: number) => {
    router.delete(`/loans/${loanId}`, {
        preserveState: true,
        onSuccess: () => {
            showDeleteModal.value = false;
            toast.success("🗑️ Empréstimo excluído com sucesso!");
        },
        onError: () => {
            toast.error("❌ Erro ao excluir empréstimo.");
        }
    });
};
</script>

<template>
    <Head title="Empréstimos" />

    <AppLayout>
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">📚 Empréstimos</h1>
                <button @click="showCreateModal = true"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                    + Novo Empréstimo
                </button>
            </div>

            <input v-model="search" type="text" placeholder="🔍 Buscar por usuário..."
                class="p-3 border rounded-lg bg-gray-800 text-white w-full mb-6 focus:ring-2 focus:ring-indigo-500">

            <div class="overflow-x-auto bg-gray-900 rounded-lg p-4">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-3">👤 Usuário</th>
                            <th class="p-3">📖 Livro</th>
                            <th class="p-3">📅 Data de Devolução</th>
                            <th class="p-3">📌 Status</th>
                            <th class="p-3 text-center">⚙️ Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="loan in filteredLoans" :key="loan.id" class="border-b border-gray-700 text-white hover:bg-gray-800">
                            <td class="p-3">{{ loan.library_user.name }}</td>
                            <td class="p-3">{{ loan.book.name }}</td>
                            <td class="p-3">{{ loan.return_date }}</td>
                            <td class="p-3">
                                <span :class="{
                                    'text-yellow-400': loan.status === 'emprestado',
                                    'text-green-400': loan.status === 'devolvido',
                                    'text-red-400': loan.status === 'atrasado'
                                }">
                                    {{ loan.status }}
                                </span>
                            </td>
                            <td class="p-3 flex justify-center gap-4">
                                <button @click="openEditModal(loan)" class="text-yellow-400 hover:text-yellow-300">✏️ Editar</button>
                                <button @click="openDeleteModal(loan)" class="text-red-500 hover:text-red-400">🗑️ Excluir</button>
                            </td>
                        </tr>
                        <tr v-if="filteredLoans.length === 0">
                            <td colspan="5" class="text-center p-6 text-gray-400">Nenhum empréstimo encontrado 😞</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <LoanCreateModal v-if="showCreateModal"
            @close="showCreateModal = false"
            @save="saveLoan"
            :users="props.users"
            :books="props.books" />

        <LoanEditModal v-if="showEditModal"
            @close="showEditModal = false"
            @save="updateLoanStatus"
            :loan="selectedLoan" />

        <LoanDeleteModal v-if="showDeleteModal"
            @close="showDeleteModal = false"
            @delete="deleteLoan"
            :loanId="selectedLoan?.id" />
    </AppLayout>
</template>
