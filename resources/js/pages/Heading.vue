<script setup lang="ts">
import {ref} from 'vue';
interface Props {
    title: string;
    description?: string;
    votes?: number;
}

const props = defineProps<Props>();

const hasVoted = ref(false);
const voteCount = ref(props.votes ?? 0);
</script>

<template>
    <div class="">
        <div class="mb-8 space-y-0.5 bg-white text-black p-2 rounded-xl ">
            <h2 class="text-xl font-semibold tracking-tight text-black">{{ title }}</h2>
            <p v-if="description" class="text-sm  text-black">
                {{ description }}
            </p>
             <div class="mt-4 flex items-center space-x-3">
      <!-- Bouton voter -->
      <button
        @click=""
        :class="[
          'px-3 py-1 rounded-lg font-medium transition',
          hasVoted ? 'bg-emerald-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
        ]"
      >
        {{ hasVoted ? 'Je retire mon vote' : 'Je vote' }}
      </button>

      <!-- Nombre de votes -->
      <span class="text-sm text-gray-700">{{ voteCount }} votes</span>
    </div>
        </div>
    </div>
</template>
<style>

</style>