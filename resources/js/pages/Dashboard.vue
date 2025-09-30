<template>
    <div class="m-5">

        <div class="flex flex-row justify-between items-center bg-blue-400 p-4 rounded-2xl ">

            <div class="flex items-center space-x-3">
                <div class="flex items-center justify-center h-10 w-10 lg:h-12 lg:w-12 rounded-xl bg-green-400  text-white font-bold text-lg lg:text-xl shadow-lg"
                    id="logo-fallback">
                    IW
                </div>
                <div>
                    <h1 class="text-xl lg:text-2xl font-bold text-gray-900">IdeaWall</h1>
                    <p class="text-xs lg:text-sm text-gray-600 dark:text-gray-400">Partageons nos idées</p>
                </div>
            </div>



            <div class="flex flex-row gap-4 absolute left-1/2 transform -translate-x-1/2">
                <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 text-white shadow">
                    <svg class="w-5 h-5 text-blue-200" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 3.18l7 3.5v6.32c0 4.28-2.95 8.28-7 9.5-4.05-1.22-7-5.22-7-9.5V8.68l7-3.5zM11 11h2v6h-2v-6zm0-4h2v2h-2V7z"/>
                    </svg>
                    <div>
                        <h2 class="text-sm">Idées totales</h2>
                        <p class="font-semibold">123</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 text-white shadow">
                    <svg class="w-5 h-5 text-red-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <div>
                        <h2 class="text-sm">Likes totaux</h2>
                        <p class="font-semibold">456</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 text-white shadow">
                    <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <div>
                        <h2 class="text-sm">Top idées</h2>
                        <p class="font-semibold">12</p>
                    </div>
                </div>
            </div>


            <div class="flex-1 flex justify-end">
                <button
                    @click="isCreateModalOpen = true"
                    class="flex items-center gap-2 px-4 py-2 bg-green-500 text-white font-bold rounded-lg shadow hover:bg-green-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="hidden sm:inline">Poster une idée</span>
                </button>
            </div>
            <div class="relative" ref="userMenuRef">
                <button @click="isUserMenuOpen = !isUserMenuOpen"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg  transition-colors">
                    <div
                        class="w-9 h-9 rounded-full bg-green-500 flex items-center justify-center text-white font-semibold text-sm">
                        {{ $page.props.auth.user.name.charAt(0).toUpperCase() }}
                    </div>

                    <svg class="w-4 h-4 text-gray-500 transition-transform" :class="{ 'rotate-180': isUserMenuOpen }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <Transition name="fade">
                    <div v-if="isUserMenuOpen"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ $page.props.auth.user.name }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $page.props.auth.user.email }}</p>
                        </div>
                        <Link href="/logout" method="post" as="button"
                            class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                        Se déconnecter
                        </Link>
                    </div>
                </Transition>
            </div>
        </div>


        <div class="text-center mt-16">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Transformez vos idées en réalité</h1>
            <p class="text-gray-600 mb-6">Rejoignez une communauté d'innovateurs et collaborez pour créer l'avenir</p>


            <div class="relative max-w-xl mx-auto">
                <input type="text" placeholder="Rechercher une idée brillante..."
                    class="w-full px-5 py-3 pl-12 rounded-full border border-gray-300  ">
                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m21 21-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

        </div>
    </div>
    
    <div class="bg-white">
        <!-- Modal Create -->
        <Create :isOpen="isCreateModalOpen" @close="isCreateModalOpen = false" />
        
        <div v-if="props.ideas.length > 0" class="grid gap-4">
            <Heading v-for="idea in props.ideas" :key="idea.id" :idea="idea" />
        </div>
        <p v-else class="text-gray-500">Pas du de publications pour l'instant</p>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { Link } from '@inertiajs/vue3'
import Heading from './Heading.vue'
import Create from './Create.vue'

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
    ideas: Idea[]
}>()

const isUserMenuOpen = ref(false)
const isCreateModalOpen = ref(false)
const userMenuRef = ref<HTMLElement | null>(null)

// Fermer le menu quand on clique à l'extérieur
const handleClickOutside = (event: MouseEvent) => {
    if (userMenuRef.value && !userMenuRef.value.contains(event.target as Node)) {
        isUserMenuOpen.value = false
    }
}

onMounted(() => {
    document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside)
})
</script>