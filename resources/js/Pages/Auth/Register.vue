<script setup>
import { useForm, Head, Link } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post('/register', {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />
    <Layout>
        <div class="min-h-[60vh] flex items-center justify-center px-4 py-8">
            <div class="w-full max-w-md">

                <div class="text-center mb-5">
                    <h1 class="text-2xl sm:text-3xl font-black text-gray-900 dark:text-white tracking-tight">
                        Join <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">YummyShare</span>
                    </h1>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Create an account to start sharing recipes</p>
                </div>

                <form @submit.prevent="submit"
                    class="space-y-4 p-5 sm:p-6 rounded-2xl bg-white/70 dark:bg-gray-900/70 border border-white/60 dark:border-gray-800 shadow-xl backdrop-blur-2xl">

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700 dark:text-gray-200 ml-1">Full Name</label>
                        <input v-model="form.name" type="text" autocomplete="name" required
                            class="glass-input w-full"
                            :class="{ 'ring-2 ring-red-500': form.errors.name }"
                            placeholder="John Cook" />
                        <p v-if="form.errors.name" class="text-red-500 dark:text-red-400 text-sm ml-1">{{ form.errors.name }}</p>
                    </div>

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
                        <input v-model="form.password" type="password" autocomplete="new-password" required
                            class="glass-input w-full"
                            :class="{ 'ring-2 ring-red-500': form.errors.password }"
                            placeholder="Min 8 characters" />
                        <p v-if="form.errors.password" class="text-red-500 dark:text-red-400 text-sm ml-1">{{ form.errors.password }}</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700 dark:text-gray-200 ml-1">Confirm Password</label>
                        <input v-model="form.password_confirmation" type="password" autocomplete="new-password" required
                            class="glass-input w-full"
                            placeholder="Repeat password" />
                    </div>

                    <button type="submit" :disabled="form.processing"
                        class="w-full rounded-xl bg-gradient-to-r from-orange-500 to-red-600 px-6 py-3 font-bold text-white transition-all hover:shadow-lg hover:scale-[1.02] active:scale-[0.98] disabled:opacity-70 disabled:scale-100">
                        {{ form.processing ? 'Creating account...' : 'Create Account' }}
                    </button>

                    <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                        Already have an account?
                        <Link href="/login" class="font-bold text-orange-600 dark:text-orange-400 hover:text-orange-700">Sign in</Link>
                    </p>
                </form>
            </div>
        </div>
    </Layout>
</template>
