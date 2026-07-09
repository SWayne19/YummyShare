<script setup>
import { useForm, Head, Link } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post('/login', {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Login" />
    <Layout>
        <div class="min-h-[70vh] flex items-center justify-center px-4 py-12">
            <div class="w-full max-w-md">

                <div class="text-center mb-8">
                    <h1 class="text-3xl sm:text-4xl font-black text-gray-900 dark:text-white tracking-tight">
                        Welcome <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">Back</span>
                    </h1>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Sign in to share your recipes</p>
                </div>

                <form @submit.prevent="submit"
                    class="space-y-5 p-6 sm:p-8 rounded-[2rem] bg-white/70 dark:bg-gray-900/70 border border-white/60 dark:border-gray-800 shadow-xl backdrop-blur-2xl">

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700 dark:text-gray-200 ml-1">Email</label>
                        <input v-model="form.email" type="email" autocomplete="email" required
                            class="glass-input w-full"
                            :class="{ 'ring-2 ring-red-500': form.errors.email }"
                            placeholder="your@email.com" />
                        <p v-if="form.errors.email" class="text-red-500 dark:text-red-400 text-sm ml-1">{{ form.errors.email }}</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700 dark:text-gray-200 ml-1">Password</label>
                        <input v-model="form.password" type="password" autocomplete="current-password" required
                            class="glass-input w-full"
                            :class="{ 'ring-2 ring-red-500': form.errors.password }"
                            placeholder="********" />
                        <p v-if="form.errors.password" class="text-red-500 dark:text-red-400 text-sm ml-1">{{ form.errors.password }}</p>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input v-model="form.remember" type="checkbox"
                                class="rounded border-gray-300 dark:border-gray-600 text-orange-500 focus:ring-orange-500 dark:bg-gray-800" />
                            <span class="text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                        </label>
                    </div>

                    <button type="submit" :disabled="form.processing"
                        class="w-full rounded-xl bg-gradient-to-r from-orange-500 to-red-600 px-8 py-4 font-bold text-white transition-all hover:shadow-lg hover:scale-[1.02] active:scale-[0.98] disabled:opacity-70 disabled:scale-100">
                        {{ form.processing ? 'Signing in...' : 'Sign In' }}
                    </button>

                    <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                        Don't have an account?
                        <Link href="/register" class="font-bold text-orange-600 dark:text-orange-400 hover:text-orange-700">Create one</Link>
                    </p>
                </form>
            </div>
        </div>
    </Layout>
</template>
