<script setup lang="ts">
// import {ref} from 'vue';
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
</script>

<template>
        <div >
            <div class="mb-8 space-y-0.5 bg-white text-black p-2 rounded-xl shadow ">  
              <h2 class="text-xl font-bold">{{ props.idea.title }}</h2>
              <p class="text-gray-700 mt-2">{{ props.idea.description }}</p>    
            </div>
            <div class="mt-2 text-sm text-gray-400">
              Posté par
              <span v-if="props.idea.user">{{ props.idea.user.name }}</span>
              <span v-else>Anonyme</span>
              • {{ new Date(props.idea.created_at).toLocaleDateString() }}
            </div>
        </div>
</template>
<style>

</style>