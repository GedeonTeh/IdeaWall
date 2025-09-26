<template>
    <div class="container mx-auto mt-5">

        <div class="flex flex-row justify-between items-center bg-gradient-to-r from-blue-500 to-indigo-600 p-4 rounded-2xl ">

            <div class="flex flex-row items-center gap-3">
                <img class="w-16 h-16" src="idee (1).png" alt="Logo">
                <div>
                    <h1 class="font-bold text-3xl text-white">IdeaWall</h1>
                    <p class="text-blue-100 ">L'univers de l'innovation collaborative</p>
                </div>
            </div>


            <div class="flex flex-row gap-4">
                <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 text-white shadow">
                    <img class="w-6 h-6" src="icons8-star-50.png" alt="">
                    <div>
                        <h2 class="text-sm">Idées totales</h2>
                        <p class="font-semibold">123</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 text-white shadow">
                    <img class="w-6 h-6" src="icons8-flash-50.png" alt="">
                    <div>
                        <h2 class="text-sm">Likes totaux</h2>
                        <p class="font-semibold">456</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 text-white shadow">
                    <img class="w-6 h-6" src="icons8-community-50.png" alt="">
                    <div>
                        <h2 class="text-sm">Top idées</h2>
                        <p class="font-semibold">12</p>
                    </div>
                </div>
            </div>


            <Link href=""
                class="flex items-center gap-2 px-4 py-2 rounded-full bg-green-500">
            <img class="size-6" src="icons8-add-32.png" alt="">
            <span>Créer une idée</span>
            </Link>
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

</template>

<script setup lang="ts">

import { Link } from '@inertiajs/vue3'

</script>