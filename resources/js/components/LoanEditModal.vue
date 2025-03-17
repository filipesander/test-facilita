<script setup lang="ts">
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const toast = useToast();
const props = defineProps(["loan"]);
const emit = defineEmits(["close", "update"]);

const loanStatus = ref(props.loan.status);

const updateStatus = () => {
    router.put(`/loans/${props.loan.id}/status`, { status: loanStatus.value }, {
        onSuccess: () => {
            toast.success("📖 Status atualizado com sucesso!");
            emit('close');
        },
        onError: () => {
            toast.error("❌ Erro ao atualizar status.");
        }
    });
};
</script>

<template>
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-gray-900 p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold text-white mb-4">Editar Status do Empréstimo</h2>

            <label class="block text-white">Status</label>
            <select v-model="loanStatus" class="w-full p-2 border rounded bg-gray-800 text-white">
                <option value="emprestado">Emprestado</option>
                <option value="devolvido">Devolvido</option>
                <option value="atrasado">Atrasado</option>
            </select>

            <div class="mt-4 flex justify-end gap-2">
                <button @click="$emit('close')" class="px-4 py-2 bg-gray-600 text-white rounded">Cancelar</button>
                <button @click="updateStatus" class="px-4 py-2 bg-blue-600 text-white rounded">Salvar</button>
            </div>
        </div>
    </div>
</template>


