<template>
    <div class="min-h-screen bg-indigo-50">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-4">
                <div class="flex items-center justify-between py-2 lg:py-6">
                    <div class="flex items-center space-x-3">
                        <div
                            class="flex items-center justify-center h-10 w-10 lg:h-12 lg:w-12 rounded-xl bg-blue-400 text-white font-bold text-lg lg:text-xl shadow-lg">
                            IW
                        </div>
                        <div>
                            <h1 class="text-xl lg:text-2xl font-bold text-gray-900">IdeaWall Dashboard</h1>
                            <p class="text-xs lg:text-sm text-gray-600">Tableau de bord Administrateur</p>
                        </div>
                    </div>

                    <div class="relative" ref="userMenuRef">
                        <button @click="isUserMenuOpen = !isUserMenuOpen"
                            class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                            <div
                                class="w-9 h-9 rounded-full bg-blue-400 flex items-center justify-center text-white font-semibold text-sm">
                                {{ getUserInitials() }}
                            </div>
                            <svg class="w-4 h-4 text-gray-500 transition-transform"
                                :class="{ 'rotate-180': isUserMenuOpen }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <Transition name="fade">
                            <div v-if="isUserMenuOpen"
                                class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-1">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">Administrateur</p>
                                    <p class="text-xs text-gray-500 mt-1">admin@ideawall.com</p>
                                </div>
                                <Link href="/logout" method="post" as="button"
                                    class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                Se déconnecter
                                </Link>
                            </div>
                        </Transition>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            <!-- Stats Cards -->
            <div class="flex items-center gap-3 mb-8 animate-slide-up">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-400 shadow-lg">
                    <!-- Stats Icon (Heroicons: Chart Bar) -->
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m4 0v-4a2 2 0 012-2h2a2 2 0 012 2v4m-16 4h20" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-1xl text-center lg:text-3xl font-extrabold text-gray-900 mb-1 drop-shadow-lg">
                        Statistiques Générales sur IdeaWall
                    </h1>
                    <p class="text-sm text-gray-500 font-medium">
                        Aperçu global de l'activité et des performances de la plateforme
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Nombre d'Idées</p>
                            <p class="text-3xl font-bold text-gray-900">{{ stats.totalIdeas }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd"
                                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Utilisateurs</p>
                            <p class="text-3xl font-bold text-gray-900">{{ stats.totalUsers }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Total Votes</p>
                            <p class="text-3xl font-bold text-gray-900">{{ stats.totalVotes }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top 3 Ideas Section -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Top 3 des Idées les plus votés</h2>
                    <button @click="exportTopIdeasToPDF"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition-colors font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Exporter en PDF
                    </button>
                </div>

                <div class="space-y-4">
                    <div v-for="(idea, index) in topIdeas" :key="idea.id"
                        class="flex items-center gap-4 p-4 rounded-lg border-2 transition-all hover:shadow-md"
                        :class="getRankClass(index)">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl"
                                :class="getRankBadgeClass(index)">
                                {{ index + 1 }}
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ idea.title }}</h3>
                            <p class="text-sm text-gray-600 line-clamp-2">{{ idea.description }}</p>
                            <div class="flex items-center gap-4 mt-2">
                                <span class="text-xs text-gray-500">Par {{ idea.user?.name || 'Anonyme' }}</span>
                                <span class="inline-flex items-center gap-1 text-sm font-medium text-blue-400">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                    {{ idea.votes_count }} vote (s)
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button @click="activeTab = 'ideas'"
                            class="py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                            :class="activeTab === 'ideas' ? 'border-blue-400 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'">
                            Toutes les Idées
                        </button>
                        <button @click="activeTab = 'users'"
                            class="py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                            :class="activeTab === 'users' ? 'border-blue-400 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'">
                            Tous les Utilisateurs
                        </button>

                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Ideas Tab -->
                    <div v-if="activeTab === 'ideas'">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Titre</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Auteur</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Votes</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="idea in allIdeas" :key="idea.id" class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ idea.title }}</div>
                                            <div class="text-sm text-gray-500 line-clamp-1">{{ idea.description }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ idea.user?.name || 'Anonyme' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-400">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                                </svg>
                                                {{ idea.votes_count }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ formatDate(idea.created_at) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button @click="confirmDelete(idea)"
                                                class="text-red-600 hover:text-red-900 transition-colors">
                                                Supprimer
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Users Tab -->
                    <div v-if="activeTab === 'users'">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div v-for="user in users" :key="user.id"
                                class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 rounded-full bg-blue-400 flex items-center justify-center text-white font-bold">
                                        {{ getInitials(user.name) }}
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900">{{ user.name }}</h3>
                                        <p class="text-sm text-gray-500">{{ user.email }}</p>
                                        <p class="text-xs text-gray-400 mt-1">{{ user.votes_count || 0 }} votes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Delete Confirmation Modal -->
        <Transition name="modal">
            <div v-if="showDeleteModal"
                class="fixed inset-0 bg-blue-200 bg-opacity-50 flex items-center justify-center z-50 px-4">
                <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
                    <h3 class="text-xl font-bold text-gray-200 mb-4">Confirmer la suppression</h3>
                    <p class="text-gray-600 mb-6">
                        Êtes-vous sûr de vouloir supprimer l'idée "<strong>{{ ideaToDelete?.title }}</strong>" ? Cette
                        action est irréversible.
                    </p>
                    <div class="flex gap-3 justify-end">
                        <button @click="showDeleteModal = false"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Annuler
                        </button>
                        <button @click="deleteIdea"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </Transition>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { router, Link } from '@inertiajs/vue3'
interface Idea {
    id: number
    title: string
    description: string
    votes_count: number
    user?: { id: number; name: string }
    created_at: string
}

interface User {
    id: number
    name: string
    email: string
    votes_count?: number
}

interface Stats {
    totalIdeas: number
    totalUsers: number
    totalVotes: number
}

interface MonthData {
    month: string
    count: number
}

const props = defineProps<{
    stats: Stats
    topIdeas: Idea[]
    allIdeas: Idea[]
    users: User[]
    ideasByMonth: MonthData[]
}>()

const activeTab = ref('ideas')
const isUserMenuOpen = ref(false)
const userMenuRef = ref<HTMLElement | null>(null)
const showDeleteModal = ref(false)
const ideaToDelete = ref<Idea | null>(null)

const getUserInitials = () => {
    return 'AD'
}

const getInitials = (name: string) => {
    return name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2)
}

const formatDate = (date: string) => {
    return new Date(date).toLocaleDateString('fr-FR', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    })
}
const getRankClass = (index: number) => {
    if (index === 0 || index === 1 || index === 2) return 'border-green-300 bg-green-50'

    return 'border-gray-200'
}

const getRankBadgeClass = (index: number) => {
    if (index === 0 || index === 1 || index === 2) return 'bg-green-400 text-white'

    return 'bg-gray-200 text-gray-600'
}

const confirmDelete = (idea: Idea) => {
    ideaToDelete.value = idea
    showDeleteModal.value = true
}

const deleteIdea = async () => {
    if (!ideaToDelete.value) return

    try {
        await fetch(`/admin/ideas/${ideaToDelete.value.id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        })

        showDeleteModal.value = false
        window.location.reload()
    } catch (error) {
        console.error('Erreur lors de la suppression:', error)
    }
}

const exportTopIdeasToPDF = () => {
    const printWindow = window.open('', '_blank')
    if (!printWindow) return

    const html = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Top 3 Idées - IdeaWall</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 40px; }
                h1 { color: #3B82F6; border-bottom: 3px solid #3B82F6; padding-bottom: 10px; }
                .idea { margin: 30px 0; padding: 20px; border: 2px solid #E5E7EB; border-radius: 10px; }
                .rank { font-size: 24px; font-weight: bold; color: #3B82F6; }
                .title { font-size: 20px; font-weight: bold; margin: 10px 0; }
                .description { color: #666; line-height: 1.6; }
                .meta { color: #999; font-size: 14px; margin-top: 10px; }
            </style>
        </head>
        <body>
            <h1> Top 3 des Idées - IdeaWall</h1>
            <p>Généré le ${new Date().toLocaleDateString('fr-FR')}</p>
            ${props.topIdeas.map((idea, index) => `
                <div class="idea">
                    <div class="rank">#${index + 1}</div>
                    <div class="title">${idea.title}</div>
                    <div class="description">${idea.description}</div>
                    <div class="meta">
                        Par ${idea.user?.name || 'Anonyme'} • ${idea.votes_count} votes
                    </div>
                </div>
            `).join('')}
        </body>
        </html>
    `

    printWindow.document.write(html)
    printWindow.document.close()
    setTimeout(() => {
        printWindow.print()
    }, 250)
}

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

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}

.modal-enter-active>div,
.modal-leave-active>div {
    transition: transform 0.3s ease;
}

.modal-enter-from>div {
    transform: scale(0.9);
}

.modal-leave-to>div {
    transform: scale(0.9);
}

.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slide-up {
    animation: slideUp 0.3s ease-out;
}
</style>