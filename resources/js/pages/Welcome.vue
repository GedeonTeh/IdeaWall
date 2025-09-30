<script setup lang="ts">
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="min-h-screen bg-indigo-50">
        <header class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between py-4 lg:py-6">
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center justify-center h-10 w-10 lg:h-12 lg:w-12 rounded-xl bg-blue-400  text-white font-bold text-lg lg:text-xl shadow-lg"
                            id="logo-fallback">
                            IW
                        </div>
                        <div>
                            <h1 class="text-xl lg:text-2xl font-bold text-gray-900">IdeaWall</h1>
                            <p class="text-xs lg:text-sm text-gray-600 dark:text-gray-400">Partageons nos idées</p>
                        </div>
                    </div>

                    <nav class="flex items-center space-x-4">
                        <Link v-if="$page.props.auth.user" :href="dashboard()"
                            class="inline-flex items-center rounded-lg bg-blue-500 px-4 py-2 text-sm font-medium text-white shadow-sm transition-all hover:bg-blue-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Acceuil
                        </Link>

                        <template v-else>
                            <Link :href="login()"
                                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-blue-400 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                            Se connecter
                            </Link>

                            <Link :href="register()"
                                class="inline-flex items-center rounded-lg bg-blue-400 px-4 py-2 text-sm font-medium text-white shadow-sm transition-all hover:bg-blue-400 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            S'enregistrer
                            </Link>
                        </template>
                    </nav>
                </div>
            </div>
        </header>
        <main class="relative pt-20 lg:pt-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-2 lg:gap-16 py-12 lg:py-20">

                    <div class="flex flex-col justify-center">
                        <h1
                            class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl ">
                            Partagez vos
                            <span class="bg-blue-400 bg-clip-text text-transparent">
                                idées
                            </span>
                            sans soucis
                        </h1>

                        <p class="mt-6 text-lg leading-8 text-gray-600 ">
                            IdeaWall est la meilleur solution qu'il vous faut si vous désirez partager les
                            différentes idées que vous avec et que vous aimeriez faire connaitre
                        </p>

                        <div class="mt-10 flex flex-col sm:flex-row gap-4">
                            <Link v-if="!$page.props.auth.user" :href="register()"
                                class="inline-flex items-center justify-center rounded-lg bg-blue-400 px-8 py-3 text-base font-semibold text-white shadow-lg transition-all hover:from-indigo-700 hover:to-blue-700 hover:shadow-xl hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Commencer maintenant
                            <svg class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                            </Link>

                        </div>
                        <div class="mt-12 grid grid-cols-3 gap-8">
                            <div class="text-center group">
                                <div class="text-3xl font-bold bg-blue-400 bg-clip-text text-transparent ">
                                    1000+</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Utilisateurs
                                </div>
                            </div>
                            <div class="text-center group">
                                <div class="text-3xl font-bold bg-blue-400 bg-clip-text text-transparent ">
                                    25k+</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium"> D'Idées partagées
                                </div>
                            </div>
                            <div class="text-center group">
                                <div class="text-3xl font-bold bg-blue-400 bg-clip-text text-transparent ">
                                    99.9%</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Disponibilité</div>
                            </div>
                        </div>
                    </div>
                    <!-- Image/Visual améliorée -->
                    <img src="/images/undraw_ideas_vn7a%20(1).svg" alt="Illustration idées" loading="lazy" />
                </div>
            </div>

            <!-- Features Section améliorée -->
            <div
                class="">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-20">
                        <h2 class="text-4xl font-bold text-gray-900 sm:text-5xl">
                            Tout ce dont vous avez besoin
                        </h2>
                        <br>
                        <div class="w-24 h-1 bg-gradient-to-r from-indigo-600 to-blue-600 mx-auto mb-6"></div>
                        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                            Des fonctionnalités puissantes conçues pour simplifier votre gestion de facturation et faire
                            croître
                            votre entreprise
                        </p>
                    </div>

                    <div class="grid gap-8 lg:grid-cols-3">
                        <!-- Feature 1 -->
                        <div
                            class="group bg-white rounded-3xl p-10 shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 ">
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-2xl  text-blue-600  group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3
                                class="mt-8 text-2xl font-bold text-gray-900 group-hover:text-blue-600  transition-colors">
                                Partage instantané
                            </h3>
                            <p class="mt-4 text-gray-600  text-lg leading-relaxed">
                                Publiez vos idées en quelques secondes et inspirez la communauté sans effort.
                            </p>
                          
                        </div>

                        <!-- Feature 2 -->
                        <div
                            class="group rounded-3xl bg-white p-10 shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-r from-indigo-100 to-blue-100 text-indigo-600 group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <h3
                                class="mt-8 text-2xl font-bold text-gray-900  group-hover:text-indigo-600 transition-colors">
                                Suivi collaboratif
                            </h3>
                            <p class="mt-4 text-gray-600 text-lg leading-relaxed">
                                Suivez les réactions, commentaires et évolutions de vos idées en temps réel.
                            </p>
                            <div
                                class="mt-6 flex items-center text-indigo-600  font-semibold group-hover:text-blue-600 transition-colors">
                            
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div
                            class="group rounded-3xl bg-white p-10 shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-600  group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3
                                class="mt-8 text-2xl font-bold text-gray-900  group-hover:text-blue-600 transition-colors">
                                Sécurité & confidentialité
                            </h3>
                            <p class="mt-4 text-gray-600 text-lg leading-relaxed">
                                Vos idées sont protégées grâce à un chiffrement avancé et une gestion privée des données.
                            </p>
                            <div
                                class="mt-6 flex items-center text-blue-600 font-semibold group-hover:text-indigo-600 transition-colors">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section améliorée -->
            <div class="py-20 relative overflow-hidden">
                <div class="absolute inset-0">
                </div>
                <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8 relative">
                    <h2 class="text-4xl font-bold text-gray-900 sm:text-5xl mb-6">
                        Prêt à
                        <span class="bg-blue-500 bg-clip-text text-transparent">partager</span>
                        vos idées?
                    </h2>
                    <p class="text-xl text-gray-600  mb-4 max-w-2xl mx-auto">
                        Rejoignez les milliers d'utilisateurs qui font confiance à IdeaWall pour partager et
                        découvrir de
                        nouvelles idées chaque jour.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <Link v-if="!$page.props.auth.user" :href="register()"
                            class="inline-flex items-center justify-center rounded-xl bg-blue-500 px-10 py-4 text-lg font-bold text-white shadow-xl transition-all hover:bg-blue-600 hover:shadow-2xl hover:-translate-y-2">
                        Commencer maintenant
                        </Link>


                    </div>
                </div>
            </div>
        </main>
        <footer
            class="border-t border-gray-200 bg-gradient-to-r from-white/90 via-green-50/50 to-white/90 py-8 backdrop-blur-sm">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="flex justify-center items-center mb-4">
                        <div class="w-8 h-1 bg-blue-400"></div>
                        <p class="mx-4 text-lg font-semibold text-gray-700">IdeaWall</p>
                        <div class="w-8 h-1 bg-blue-400"></div>
                    </div>
                    <p class="text-xs text-gray-500">
                        © 2025 IdeaWall. Tous droits réservés.
                    </p>
                </div>
            </div>
        </footer>

    </div>

</template>
