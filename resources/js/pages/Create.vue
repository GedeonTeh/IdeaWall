<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  title: '',
  description: ''
})

function submit() {
  form.post('/ideas',{
    onSuccess:()=>{
      form.reset()
    }
  })
}
</script>

<template>
  <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-2xl shadow-md flex items-center text-black">
    <h2 class="text-xl w-80 font-semibold text-gray-800 mb-6">Nouvelle Idée</h2>

    <form @submit.prevent="submit" class="space-y-6 flex items-center gap-6">
      <!-- Champ titre -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
        <input
          v-model="form.title"
          type="text"
          placeholder="Entre un titre..."
          class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <span v-if="form.errors.title" class="text-sm text-red-500 mt-1">{{ form.errors.title }}</span>
      </div>

      <!-- Champ description -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea
          v-model="form.description"
          rows="4"
          placeholder="Décris ton idée..."
          class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        ></textarea>
        <span v-if="form.errors.description" class="text-sm text-red-500 mt-1">{{ form.errors.description }}</span>
      </div>

      <!-- Bouton -->
      <div class="flex justify-end">
        <button
          type="submit"
          :disabled="form.processing"
          class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50"
        >
          Ajouter
        </button>
      </div>
    </form>
  </div>
</template>
