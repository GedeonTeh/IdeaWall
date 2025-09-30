<script setup lang="ts">
import { ref } from 'vue';

interface Idea {
  id: number
  title: string
  description: string
  user?: {
    id: number
    name: string
  }
  created_at: string
}

const props = defineProps<{
  idea: Idea
}>()

const formatDate = (date: string) => {
  const createdDate = new Date(date)
  return createdDate.toLocaleDateString('fr-FR', { 
    day: 'numeric', 
    month: 'long', 
    year: 'numeric' 
  })
}

const getInitials = (name?: string) => {
  if (!name) return 'A'
  return name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2)
}
</script>

<template>
  <article 
    class="bg-blue-50 border border-gray-100 rounded-lg p-6 hover:shadow-lg hover:border-blue-400 cursor-pointer mt-10 ml-29 mr-29"
  >
    <div class="flex items-start justify-between mb-4">
      <div class="flex-1">
        <h2 class="text-xl font-semibold text-gray-900 mb-2 leading-tight">
          {{ props.idea.title }}
        </h2>
      </div>
    </div> 
    <p class="text-gray-600 leading-relaxed mb-6">
      {{ props.idea.description }}
    </p>
    <div class="flex items-center justify-between pt-4 border-t border-sky-600">
      <div class="flex items-center gap-3">
        <div 
          class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-medium text-white"
          :class="props.idea.user ? 'bg-green-600' : 'bg-gray-400'"
        >
          {{ getInitials(props.idea.user?.name) }}
        </div>
        <div class="flex flex-col">
          <span class="text-sm font-medium text-gray-900">
            {{ props.idea.user?.name || 'Anonyme' }}
          </span>
          <span class="text-xs text-gray-500">
            {{ formatDate(props.idea.created_at) }}
          </span>
        </div>
      </div>
    </div>
  </article>
</template>