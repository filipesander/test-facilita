<script setup lang="ts">
import { ref, computed } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import { useToast } from "vue-toastification";
import AppLayout from '@/layouts/AppLayout.vue';
import LibraryUserEditModal from '@/components/LibraryUserEditModal.vue';
import LibraryUserDeleteModal from '@/components/LibraryUserDeleteModal.vue';
import LibraryUserCreateModal from '@/components/LibraryUserCreateModal.vue';

const toast = useToast();
const props = defineProps<{
    users: { id: number; name: string; email: string; registration_number: string }[];
}>();

const showCreateModal = ref(false);
const showEditModal = ref(false);
const showDeleteModal = ref(false);
const selectedUser = ref<any>({});
const search = ref('');

const filteredUsers = computed(() => {
    return props.users.filter((user) =>
        !search.value || user.name.toLowerCase().includes(search.value.toLowerCase())
    );
});

const openCreateModal = () => {
    showCreateModal.value = true;
};

const openEditModal = (user: any) => {
    selectedUser.value = { ...user };
    showEditModal.value = true;
};

const openDeleteModal = (user: any) => {
    selectedUser.value = user;
    showDeleteModal.value = true;
};

// Cria um usuário
const saveUser = (userData: any) => {
    router.post('/users-library', userData, {
        onSuccess: () => {
            showCreateModal.value = false;
            toast.success("👤 Usuário cadastrado com sucesso!");
        },
        onError: () => {
            toast.error("❌ Erro ao cadastrar usuário.");
        }
    });
};

// Atualiza um usuário
const updateUser = (userData: any) => {
    router.put(`/users-library/${userData.id}`, userData, {
        onSuccess: () => {
            showEditModal.value = false;
            toast.success("✏️ Usuário atualizado com sucesso!");
        },
        onError: () => {
            toast.error("❌ Erro ao atualizar usuário.");
        }
    });
};

// Exclui um usuário
const deleteUser = (userId: number) => {
    router.delete(`/users-library/${userId}`, {
        onSuccess: () => {
            toast.success("🗑️ Usuário excluído com sucesso!");
            router.reload(); // Garante a atualização dos dados
        },
        onError: (errors) => {
            toast.error("❌ Erro ao excluir usuário.");
            console.error("Erro ao excluir usuário:", errors);
        }
    });
};

</script>

<template>
    <Head title="Usuários da Biblioteca" />

    <AppLayout>
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">👥 Usuários da Biblioteca</h1>
                <button @click="openCreateModal"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                    + Novo Usuário
                </button>
            </div>

            <div class="mb-4">
                <input v-model="search" type="text" placeholder="🔍 Buscar por nome..."
                    class="p-3 border rounded-lg bg-gray-800 text-white w-full focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="overflow-x-auto bg-gray-900 rounded-lg p-4">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-3">👤 Nome</th>
                            <th class="p-3">📧 Email</th>
                            <th class="p-3">🔢 Número de Cadastro</th>
                            <th class="p-3 text-center">⚙️ Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in filteredUsers" :key="user.id"
                            class="border-b border-gray-700 text-white hover:bg-gray-800">
                            <td class="p-3">{{ user.name }}</td>
                            <td class="p-3">{{ user.email }}</td>
                            <td class="p-3">{{ user.registration_number }}</td>
                            <td class="p-3 flex justify-center gap-4">
                                <button @click="openEditModal(user)"
                                    class="text-yellow-400 hover:text-yellow-300">✏️ Editar</button>
                                <button @click="openDeleteModal(user)"
                                    class="text-red-500 hover:text-red-400">🗑️ Excluir</button>
                            </td>
                        </tr>
                        <tr v-if="filteredUsers.length === 0">
                            <td colspan="4" class="text-center p-6 text-gray-400">Nenhum usuário encontrado 😞</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <LibraryUserCreateModal v-if="showCreateModal" @close="showCreateModal = false" @save="saveUser" />
        <LibraryUserEditModal v-if="showEditModal" :user="selectedUser" @close="showEditModal = false"
            @save="updateUser" />
        <LibraryUserDeleteModal v-if="showDeleteModal" :userId="selectedUser?.id"
            @close="showDeleteModal = false" @delete="deleteUser" />
    </AppLayout>
</template>
