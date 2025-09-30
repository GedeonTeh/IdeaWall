<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  title: '',
  description: '',
  tags:['']
})

function addTag(){
  form.tags.push('')
}

function removeTag(index:number){
  form.tags.splice(index,1)
}

function submit() {
  form.post('/ideas',{
    onSuccess:()=>{
      form.reset('title', 'description')
      form.tags = ['']
    }
  })
}
</script>
<template>
  <div class="max-w-5xl mx-auto mt-10 p-6 bg-white rounded-3xl shadow-lg text-gray-900">
    <h2 class="text-2xl font-bold mb-6 text-center">Nouvelle Idée</h2>

    <form @submit.prevent="submit" class="flex flex-wrap gap-6 items-start">
      <!-- Titre -->
      <div class="flex flex-col w-1/3">
        <label class="text-sm font-medium mb-1">Titre</label>
        <input
          v-model="form.title"
          type="text"
          placeholder="Entre un titre..."
          class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        />
        <span v-if="form.errors.title" class="text-sm text-red-500 mt-1">{{ form.errors.title }}</span>
      </div>

      <!-- Description -->
      <div class="flex flex-col w-1/3">
        <label class="text-sm font-medium mb-1">Description</label>
        <textarea
          v-model="form.description"
          rows="4"
          placeholder="Décris ton idée..."
          class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        ></textarea>
        <span v-if="form.errors.description" class="text-sm text-red-500 mt-1">{{ form.errors.description }}</span>
      </div>

      <!-- Tags -->
      <div class="flex flex-col w-1/3">
        <label class="text-sm font-medium mb-2">Tags</label>
        <div v-for="(tag, index) in form.tags" :key="index" class="flex items-center gap-2 mb-2">
          <input
            v-model="form.tags[index]"
            type="text"
            placeholder="Tag..."
            class="border border-gray-300 rounded-lg px-2 py-1 flex-1 focus:outline-none focus:ring-2 focus:ring-blue-400"
          />
          <button type="button" @click="removeTag(index)" class="text-red-500 hover:underline">Supprimer</button>
        </div>
        <button type="button" @click="addTag" class="text-blue-500 hover:underline mb-1">Ajouter un tag</button>
        <span v-if="form.errors.tags" class="text-sm text-red-500">{{ form.errors.tags }}</span>
      </div>

      <!-- Bouton Submit -->
      <div class="flex w-full justify-end">
        <button
          type="submit"
          :disabled="form.processing"
          class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50 transition"
        >
          Ajouter
        </button>
      </div>
    </form>
  </div>
</template>
