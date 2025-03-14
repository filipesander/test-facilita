<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowLeft } from 'lucide-vue-next';

defineProps<{
  title?: string;
  description?: string;
}>();
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-950 via-gray-900 to-gray-800 p-4">
    <div class="relative w-full max-w-md rounded-lg border border-gray-800 bg-gray-900/60 px-6 py-8 shadow-xl backdrop-blur-sm">

      <Link href="/" class="absolute left-4 top-4 flex items-center gap-2 text-sm text-gray-400 hover:text-white transition-colors">
        <ArrowLeft class="h-4 w-4"/>
        Voltar
      </Link>

      <div class="mb-6 text-center" v-if="title">
        <h2 class="text-3xl font-bold text-white">{{ title }}</h2>
        <p v-if="description" class="mt-2 text-sm text-gray-400">{{ description }}</p>
      </div>

      <slot />
    </div>
  </div>
</template>
