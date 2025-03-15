<template>
    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-gray-900 p-6 rounded-lg w-1/2 shadow-lg">
            <h2 class="text-2xl font-bold text-white mb-4">Adicionar Usuário</h2>

            <form @submit.prevent="submit">
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <input v-model="form.name" type="text" placeholder="Nome"
                        class="p-3 border rounded bg-gray-800 text-white w-full" required />
                    <input v-model="form.email" type="email" placeholder="Email"
                        class="p-3 border rounded bg-gray-800 text-white w-full" required />
                    <input v-model="form.registration_number" type="text" placeholder="Número de Cadastro"
                        class="p-3 border rounded bg-gray-800 text-white w-full" required />
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
import { ref, defineEmits } from "vue";

const emit = defineEmits(["close", "save"]);

const isOpen = ref(true);

const form = ref({
    name: "",
    email: "",
    registration_number: "",
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
