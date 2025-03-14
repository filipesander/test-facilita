<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Bem-vindo à Biblioteca" />

  <main class="flex flex-col justify-center items-center min-h-screen bg-gradient-to-br from-gray-950 via-gray-900 to-gray-800 p-4">
    <nav class="fixed top-0 right-0 p-6 flex gap-4">
      <Link
        :href="route('login')"
        class="px-4 py-2 text-gray-300 hover:text-white transition"
      >
        Login
      </Link>
      <Link
        :href="route('register')"
        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-md text-white transition"
      >
        Registrar
      </Link>
    </nav>

    <div class="text-center animate-fade-in">
      <h1 class="text-4xl lg:text-5xl font-bold text-white mb-3">
        Bem-vindo ao sistema de gerenciamento de livros mais completo! 📚
      </h1>
      <p class="text-gray-300 text-lg mt-4">
        Clique em <strong>Registrar</strong> e comece agora mesmo.
      </p>
    </div>
  </main>
</template>

<style scoped>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate {
  animation: fadeIn 1s ease-out;
}

main {
  animation: fadeIn 1s ease;
}
</style>
