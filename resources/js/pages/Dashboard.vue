<script setup lang="ts">

import Heading from './Heading.vue';
import Create from './Create.vue';
// Définir le type Idea (les champs doivent correspondre à ta table "ideas")
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
// Props envoyées depuis ton contrôleur Laravel
const props = defineProps<{
  ideas: Idea[]
}>()
</script>

<template>

    <div class="bg-white">
        <Create />
        <div v-if="props.ideas.length > 0" class="grid gap-4">
            <Heading v-for="idea in props.ideas" :key="idea.id" :idea="idea"/>
        </div>
        <p v-else class="text-gray-500">Pas du de publications pour l'instant</p>
    </div>            
</template>
