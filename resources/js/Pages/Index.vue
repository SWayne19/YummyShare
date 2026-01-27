<script setup>
import { Link } from "@inertiajs/vue3";
import Layout from "./Components/Layout.vue";

// Mock Data for Design Visualization
// (Replace these with real props from your Laravel controller later)
const categories = [
    { name: 'Breakfast', icon: '🍳', color: 'bg-yellow-100 text-yellow-700' },
    { name: 'Vegan', icon: '🥗', color: 'bg-green-100 text-green-700' },
    { name: 'Desserts', icon: '🍰', color: 'bg-pink-100 text-pink-700' },
    { name: 'Seafood', icon: '🍤', color: 'bg-blue-100 text-blue-700' },
    { name: 'Fast Food', icon: '🍔', color: 'bg-orange-100 text-orange-700' },
];

const featuredRecipes = [
    {
        id: 1,
        title: "Creamy Garlic Tuscan Salmon",
        chef: "Chef Mario",
        time: "25 min",
        calories: "450 kcal",
        image: "https://images.unsplash.com/photo-1467003909585-2f8a7270028d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
        tag: "Popular"
    },
    {
        id: 2,
        title: "Classic Avocado Toast",
        chef: "Sarah Jenkins",
        time: "10 min",
        calories: "320 kcal",
        image: "https://images.unsplash.com/photo-1588137372308-15f75323ca8d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
        tag: "Healthy"
    },
    {
        id: 3,
        title: "Berry & Yogurt Smoothie Bowl",
        chef: "FitKitchen",
        time: "15 min",
        calories: "280 kcal",
        image: "https://images.unsplash.com/photo-1494597564530-871f2b93ac55?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
        tag: "Breakfast"
    },
];
</script>

<template>
    <Layout>
        <div class="space-y-16 pb-12">

            <section class="relative z-10 mx-auto max-w-4xl text-center pt-8 animate-fade-in-up">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-orange-200 bg-orange-50/50 px-4 py-1.5 backdrop-blur-sm mb-6 transition-transform hover:scale-105 cursor-default">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                    </span>
                    <span class="text-xs font-bold uppercase tracking-wider text-orange-700">#1 Food Community</span>
                </div>

                <h1 class="text-5xl font-black tracking-tight text-gray-900 sm:text-7xl leading-tight">
                    Cook Like a Pro,<br />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">Share with
                        the World.</span>
                </h1>

                <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-600 leading-relaxed">
                    Discover thousands of tested recipes from home cooks. Join the community, save your favorites, and
                    start your culinary journey today.
                </p>

                <div
                    class="mx-auto mt-8 flex max-w-lg items-center gap-2 rounded-2xl bg-white p-2 shadow-2xl shadow-orange-500/10 ring-1 ring-gray-100 transition-all focus-within:ring-2 focus-within:ring-orange-500/50">
                    <div class="pl-4 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" placeholder="What do you want to cook?"
                        class="w-full border-none bg-transparent text-gray-900 placeholder-gray-400 focus:ring-0 text-base">
                    <button
                        class="rounded-xl bg-gray-900 px-6 py-2.5 font-bold text-white transition-colors hover:bg-gray-800">
                        Search
                    </button>
                </div>
            </section>

            <section class="animate-fade-in-up animation-delay-200">
                <div class="flex items-center justify-between mb-6 px-2">
                    <h2 class="text-xl font-bold text-gray-900">Explore Categories</h2>
                    <a href="#" class="text-sm font-semibold text-orange-600 hover:text-orange-700">View all &rarr;</a>
                </div>

                <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide">
                    <button v-for="cat in categories" :key="cat.name"
                        class="group flex flex-shrink-0 items-center gap-3 rounded-2xl border border-white bg-white/60 px-5 py-3 shadow-sm backdrop-blur-sm transition-all hover:bg-white hover:shadow-md hover:scale-105">
                        <span :class="['flex h-8 w-8 items-center justify-center rounded-full text-lg', cat.color]">
                            {{ cat.icon }}
                        </span>
                        <span class="font-bold text-gray-700 group-hover:text-gray-900">{{ cat.name }}</span>
                    </button>
                </div>
            </section>

            <section class="animate-fade-in-up animation-delay-400">
                <div class="flex items-center justify-between mb-6 px-2">
                    <h2 class="text-xl font-bold text-gray-900">Fresh from the Kitchen</h2>
                </div>

                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div v-for="recipe in featuredRecipes" :key="recipe.id"
                        class="group relative flex flex-col overflow-hidden rounded-3xl bg-white shadow-lg shadow-gray-200/50 ring-1 ring-gray-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-orange-200/50">
                        <div class="relative h-64 w-full overflow-hidden">
                            <div class="absolute inset-0 bg-gray-200 animate-pulse" v-if="!recipe.image"></div>
                            <img :src="recipe.image" :alt="recipe.title"
                                class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div
                                class="absolute top-4 left-4 rounded-full bg-white/90 px-3 py-1 text-xs font-bold uppercase tracking-wide text-gray-900 backdrop-blur-md">
                                {{ recipe.tag }}
                            </div>
                            <button
                                class="absolute top-4 right-4 rounded-full bg-white/90 p-2 text-gray-400 backdrop-blur-md transition-colors hover:text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5">
                                    <path
                                        d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.16-1.1c-1.077-1.092-2.843-2.893-4.335-5.274C2.528 7.575 2.5 5.524 4.095 3.93c1.332-1.333 3.376-1.483 4.904-.491l.001.001.002.001.002.001h.001l.001.001A.76.76 0 0 1 9.652 4l.001.001.001.001h.001l.001.001.001.001.001.001A4.542 4.542 0 0 1 11 3.5c1.528-.992 3.572-.842 4.905.492 1.594 1.594 1.625 3.645-.04 6.596-1.492 2.38-3.258 4.182-4.336 5.274a20.763 20.763 0 0 1-1.159 1.1l-.019.01-.005.003h-.001Z" />
                                </svg>
                            </button>
                        </div>

                        <div class="flex flex-1 flex-col p-6">
                            <div class="flex items-center gap-2 text-xs font-medium text-gray-500 mb-3">
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-4 h-4 text-orange-500">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ recipe.time }}
                                </span>
                                <span>•</span>
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-4 h-4 text-orange-500">
                                        <path fill-rule="evenodd"
                                            d="M10 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16Zm-.25 10.45v-3.3l2.25 1.65-2.25 1.65Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ recipe.calories }}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-orange-600 transition-colors">
                                {{ recipe.title }}
                            </h3>

                            <div class="mt-auto pt-6 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="h-8 w-8 rounded-full bg-gray-100 ring-2 ring-white">
                                        <svg class="h-full w-full text-gray-300" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-700">{{ recipe.chef }}</span>
                                </div>
                                <button
                                    class="rounded-lg p-2 text-gray-400 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="animate-fade-in-up animation-delay-600">
                <div
                    class="relative overflow-hidden rounded-3xl bg-gray-900 px-6 py-12 text-center shadow-2xl sm:px-12">
                    <div class="absolute top-0 left-0 -mt-10 h-64 w-64 rounded-full bg-orange-500/20 blur-[100px]">
                    </div>
                    <div class="absolute bottom-0 right-0 -mb-10 h-64 w-64 rounded-full bg-red-500/20 blur-[100px]">
                    </div>

                    <div class="relative z-10">
                        <h2 class="text-3xl font-black tracking-tight text-white sm:text-4xl">
                            Got a Secret Recipe?
                        </h2>
                        <p class="mx-auto mt-4 max-w-xl text-lg text-gray-300">
                            Share your culinary masterpiece with thousands of foodies. Build your profile and inspire
                            others to cook.
                        </p>
                        <div class="mt-8 flex justify-center gap-4">
                            <Link href="/recipes/create"
                                class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-orange-500 to-red-600 px-8 py-4 text-base font-bold text-white shadow-lg shadow-orange-500/30 transition-transform hover:scale-105">
                                Start Sharing
                            </Link>
                            <button
                                class="inline-flex items-center justify-center rounded-xl bg-white/10 px-8 py-4 text-base font-bold text-white backdrop-blur-sm transition-colors hover:bg-white/20">
                                Learn More
                            </button>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </Layout>
</template>

<style scoped>
/* Keyframes for Entry Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
    opacity: 0;
    /* Start invisible */
}

/* Staggered Delays */
.animation-delay-200 {
    animation-delay: 0.2s;
}

.animation-delay-400 {
    animation-delay: 0.4s;
}

.animation-delay-600 {
    animation-delay: 0.6s;
}

/* Utility to hide scrollbar but keep functionality */
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
