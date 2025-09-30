<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'

defineProps<{
  isOpen: boolean
}>()

const emit = defineEmits<{
  close: []
}>()

const form = useForm({
  title: '',
  description: '',
  tags: ['']
})

function addTag() {
  form.tags.push('')
}

function removeTag(index: number) {
  form.tags.splice(index, 1)
}

function submit() {
  form.post('/ideas', {
    onSuccess: () => {
      form.reset('title', 'description')
      form.tags = ['']
      emit('close')
    }
  })
}

function closeModal() {
  emit('close')
}
</script>

<template>
  <Transition name="modal">
    <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4">
      <!-- Conteneur -->
      <div class="w-full max-w-3xl bg-white rounded-2xl shadow-2xl border border-gray-200 max-h-[92vh] overflow-y-auto">

        <!-- Header -->
        <div class="flex items-center justify-between p-5 bg-blue-400 rounded-t-2xl">
          <h2 class="text-xl font-bold text-white">Nouvelle Idée</h2>
          <button @click="closeModal" class="text-white hover:text-gray-200 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Formulaire -->
        <form @submit.prevent="submit" class="p-6 space-y-6">

          <!-- Titre (pleine ligne) -->
          <div class="flex flex-col w-full">
            <label class="text-sm font-medium text-gray-700 mb-2">Titre</label>
            <input
              v-model="form.title"
              type="text"
              placeholder="Entre un titre..."
              class="border border-gray-300 bg-gray-50 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <span v-if="form.errors.title" class="text-sm text-red-500 mt-1">
              {{ form.errors.title }}
            </span>
          </div>

          <!-- Description (pleine ligne) -->
          <div class="flex flex-col w-full">
            <label class="text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea
              v-model="form.description"
              rows="4"
              placeholder="Décris ton idée..."
              class="border border-gray-300 bg-gray-50 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
            ></textarea>
            <span v-if="form.errors.description" class="text-sm text-red-500 mt-1">
              {{ form.errors.description }}
            </span>
          </div>

          <!-- Tags -->
          <div class="flex flex-col w-full">
            <label class="text-sm font-medium text-gray-700 mb-2">Tags</label>
            <div class="space-y-3">
              <div
                v-for="(tag, index) in form.tags"
                :key="index"
                class="flex items-center gap-3"
              >
                <input
                  v-model="form.tags[index]"
                  type="text"
                  placeholder="Tag..."
                  class="border border-gray-300 bg-gray-50 rounded-lg px-4 py-2 flex-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <button
                  type="button"
                  @click="removeTag(index)"
                  class="px-3 py-2 text-red-500 hover:text-red-600 bg-red-50 rounded-lg transition"
                >
                  Supprimer
                </button>
              </div>
            </div>
            <button
              type="button"
              @click="addTag"
              class="mt-3 text-blue-600 hover:text-blue-800 font-medium text-sm"
            >
              + Ajouter un tag
            </button>
            <span v-if="form.errors.tags" class="text-sm text-red-500 mt-1">
              {{ form.errors.tags }}
            </span>
          </div>

          <!-- Boutons -->
          <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
            <button
              type="button"
              @click="closeModal"
              class="px-5 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition"
            >
              Annuler
            </button>
            <button
              type="submit"
              :disabled="form.processing"
              class="px-5 py-2 bg-green-500 flex items-center gap-2 text-white rounded-lg hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed transition"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-3-8M5 3l7 6-3 2-2-3z" />
              </svg>
              {{ form.processing ? 'Publication...' : 'Publier l\'idée' }}
            </button>
          </div>
        </form>

      </div>
    </div>
  </Transition>
</template>


<style scoped>
.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}

.modal-enter-active .max-w-5xl,
.modal-leave-active .max-w-5xl {
  transition: transform 0.3s ease;
}

.modal-enter-from .max-w-5xl,
.modal-leave-to .max-w-5xl {
  transform: scale(0.95);
}
</style>
