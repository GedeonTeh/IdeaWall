<script setup lang="ts">
import AuthenticatedSessionController from '@/actions/App/Http/Controllers/Auth/AuthenticatedSessionController';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { request } from '@/routes/password';
import { Form, Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { home } from '@/routes';
import { Link } from '@inertiajs/vue3';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();
</script>

<template>
    <AuthBase > 
        <Head title="Connexion IdeaWall" />
        <div class="sm:mx-auto sm:w-full sm:max-w-md mb-8">
            <div class="flex justify-center items-center space-x-3">
                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-blue-400 text-white font-bold text-xl shadow-lg"
                    id="logo-fallback">
                    IW
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 ">IdeaWall</h1>
                    <p class="text-sm text-gray-600 ">Partageons nos idées</p>
                </div>
            </div>
        </div>
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-12 px-6 shadow-2xl rounded-3xl  border-blue-200 relative overflow-hidden">

                <div class="relative">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900  mb-2">
                            Bienvenue !
                        </h2>
                        <p class="text-gray-600">
                            Connectez-vous à votre compte IdeaWall
                        </p>
                    </div>
                    <div v-if="status" class="mb-4 text-center text-sm font-medium text-blue-600">
                        {{ status }}
                    </div>

                    <Form v-bind="AuthenticatedSessionController.store.form()" :reset-on-success="['password']"
                        v-slot="{ errors, processing }" class="flex flex-col gap-6">
                        <div class="grid gap-6">
                            <div class="grid gap-2">
                                <Label for="email" class="text-gray-700 font-medium">Adresse Email</Label>
                                <Input id="email" type="email" name="email"
                                    class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                                    required autofocus :tabindex="1" autocomplete="email"
                                    placeholder="email@example.com" />
                                <InputError :message="errors.email" />
                            </div>

                            <div class="grid gap-2">
                                <div class="flex items-center justify-between">
                                    <Label for="password" class="text-gray-700 font-medium">Mot de passe</Label>
                                    <TextLink v-if="canResetPassword" :href="request()" class="text-sm" :tabindex="5">
                                        Mot de passe oublié
                                    </TextLink>
                                </div>
                                <Input id="password" type="password"
                                    class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500  transition-all duration-200"
                                    name="password" required :tabindex="2" autocomplete="current-password"
                                    placeholder="................" />
                                <InputError :message="errors.password" />
                            </div>

                            <div class="flex items-center justify-between">
                                <Label for="remember" class="flex items-center space-x-3">
                                    <Checkbox id="remember" name="remember" :tabindex="3" />
                                    <span>Remember me</span>
                                </Label>
                            </div>

                            <Button type="submit"
                                class="w-full justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-blue-400 hover:bg-blue-500  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5"
                                :tabindex="4" :disabled="processing" data-test="login-button">
                                <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin" />
                                Connexion
                            </Button>
                        </div>

                        <div class="text-center text-sm text-muted-foreground">
                            Pas encore de compte ?
                            <TextLink :href="register()" :tabindex="5">Créer un compte gratuitement</TextLink>
                        </div>
                    </Form>

                </div>

            </div>

        </div>

        <div class="mt-12 text-center">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                © 2025 IdeaWall. Tous droits réservés.
            </p>
        </div>
    </AuthBase>
</template>
<!-- <template>
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-green-50 dark:from-gray-900 dark:via-gray-800 dark:to-emerald-900 flex flex-col justify-center">
        <Head title="Connexion - FactureZen" />
        
        
       

     
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white dark:bg-gray-800 py-12 px-6 shadow-2xl rounded-3xl border border-green-100 dark:border-green-800/30 relative overflow-hidden">
               
                <div class="absolute -top-6 -left-6 h-32 w-32 rounded-full bg-gradient-to-r from-green-200 to-emerald-200 opacity-20 blur-2xl dark:from-green-800 dark:to-emerald-800"></div>
                <div class="absolute -bottom-6 -right-6 h-32 w-32 rounded-full bg-gradient-to-r from-emerald-200 to-green-200 opacity-20 blur-2xl dark:from-emerald-800 dark:to-green-800"></div>
                
                <div class="relative">


              

                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <InputLabel for="email" value="Adresse email" class="text-gray-700 dark:text-gray-300 font-medium" />
                            
                            <TextInput
                                id="email"
                                type="email"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="votre@email.com"
                            />
                            
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div>
                            <InputLabel for="password" value="Mot de passe" class="text-gray-700 dark:text-gray-300 font-medium" />
                            
                            <TextInput
                                id="password"
                                type="password"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                            />
                            
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <Checkbox 
                                    name="remember" 
                                    v-model:checked="form.remember"
                                    class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-700 dark:focus:border-emerald-400"
                                />
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Se souvenir de moi</span>
                            </label>

                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-sm text-emerald-600 hover:text-emerald-500 dark:text-emerald-400 dark:hover:text-emerald-300 font-medium transition-colors duration-200"
                            >
                                Mot de passe oublié ?
                            </Link>
                        </div>

                        <div class="space-y-4">
                            <PrimaryButton
                              "
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                <span v-if="form.processing" class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Connexion...
                                </span>
                                <span v-else>Se connecter</span>
                            </PrimaryButton>
                        </div>
                    </form>

                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                            Pas encore de compte ?
                            <Link
                                :href="route('register')"
                                class="font-medium text-emerald-600 hover:text-emerald-500 dark:text-emerald-400 dark:hover:text-emerald-300 transition-colors duration-200 ml-1"
                            >
                                Créer un compte gratuitement
                            </Link>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="mt-12 text-center">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                © 2024 FactureZen. Tous droits réservés.
            </p>
        </div>
    </div>
</template> -->
