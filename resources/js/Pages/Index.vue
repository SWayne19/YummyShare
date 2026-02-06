<script setup>
import { Link } from "@inertiajs/vue3";
import Layout from "./Components/Layout.vue";

// Mock data - replace with props later
const featuredRecipes = [
    {
        id: 1,
        title: "Creamy Garlic Tuscan Salmon",
        chef: "Chef Mario",
        time: "25 min",
        calories: "450 kcal",
        rating: 4.8,
        reviews: 120,
        image: "https://images.unsplash.com/photo-1467003909585-2f8a7270028d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
        tag: "Popular"
    },
    {
        id: 2,
        title: "Classic Avocado Toast",
        chef: "Sarah Jenkins",
        time: "10 min",
        calories: "320 kcal",
        rating: 4.9,
        reviews: 85,
        image: "https://images.unsplash.com/photo-1588137372308-15f75323ca8d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
        tag: "Healthy"
    },
    {
        id: 3,
        title: "Berry & Yogurt Smoothie Bowl",
        chef: "FitKitchen",
        time: "15 min",
        calories: "280 kcal",
        rating: 4.7,
        reviews: 42,
        image: "https://images.unsplash.com/photo-1494597564530-871f2b93ac55?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
        tag: "Breakfast"
    },
];
</script>

<template>
    <Layout>
        <div class="space-y-20 pb-12">

            <section
                class="relative h-screen min-h-[600px] w-full -mt-24 flex items-center justify-center overflow-hidden">

                <div class="absolute inset-0 z-0">
                    <video autoplay loop muted playsinline class="h-full w-full object-cover"
                        poster="/videos/poster.jpg">
                        <source src="/videos/home.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                    <div class="absolute inset-0 bg-black/40"></div>
                </div>

                <div class="relative z-10 mx-auto max-w-4xl text-center px-4 pt-20 animate-fade-in-up">
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-white/30 bg-white/10 px-4 py-1.5 backdrop-blur-md mb-6 shadow-sm transition-transform hover:scale-105 cursor-default">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                        </span>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">#1 Food Community</span>
                    </div>

                    <h1 class="text-5xl font-black tracking-tight text-white sm:text-7xl leading-tight drop-shadow-lg">
                        Cook Like a Pro,<br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-300 to-red-600">Share
                            with the World.</span>
                    </h1>

                    <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-200 leading-relaxed drop-shadow-md">
                        Discover thousands of tested recipes from home cooks. Join the community, save your favorites,
                        and start your culinary journey today.
                    </p>

                    <div
                        class="mx-auto mt-10 flex max-w-lg items-center gap-2 rounded-2xl bg-white/90 p-2 shadow-2xl backdrop-blur-sm transition-all focus-within:ring-4 focus-within:ring-orange-500/30">
                        <div class="pl-4 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" placeholder="What do you want to cook?"
                            class="w-full border-none bg-transparent text-gray-900 placeholder-gray-500 focus:ring-0 text-base outline-none h-12">
                        <button
                            class="rounded-xl bg-gray-900 px-8 py-3 font-bold text-white transition-all hover:bg-orange-600 hover:shadow-lg">
                            Search
                        </button>
                    </div>
                </div>

                <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="white" class="w-8 h-8 opacity-75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
            </section>

            <section class="animate-fade-in-up animation-delay-400 mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8 px-2">
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Fresh from the Kitchen</h2>
                </div>

                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div v-for="recipe in featuredRecipes" :key="recipe.id"
                        class="group relative flex flex-col overflow-hidden rounded-[2rem] bg-white transition-all duration-500 hover:shadow-2xl hover:shadow-gray-200/50">

                        <div class="relative h-72 w-full overflow-hidden">
                            <div class="absolute inset-0 bg-gray-200 animate-pulse" v-if="!recipe.image"></div>
                            <img :src="recipe.image" :alt="recipe.title"
                                class="h-full w-full object-cover transition-transform duration-200 group-hover:scale-110">

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60">
                            </div>

                            <div class="absolute top-4 left-4">
                                <span
                                    class="inline-flex items-center rounded-full bg-white/90 px-3 py-1 text-xs font-bold uppercase tracking-wide text-gray-900 backdrop-blur-md shadow-sm">
                                    {{ recipe.tag }}
                                </span>
                            </div>

                            <button
                                class="absolute top-4 right-4 flex h-10 w-10 items-center justify-center rounded-full bg-white/20 backdrop-blur-md text-white transition-all hover:bg-white hover:text-red-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-5 h-5">
                                    <path
                                        d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3.25 7.502 3.25c1.548 0 3.09.661 4.113 1.772A5.253 5.253 0 0 1 16.036 3.25c2.788 0 5.253 2.072 5.253 5.003 0 3.923-2.438 7.11-4.739 9.253a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                </svg>
                            </button>

                            <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end text-white">
                                <div class="flex items-center gap-1 text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-4 h-4 text-orange-400">
                                        <path fill-rule="evenodd"
                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ recipe.rating }} <span class="text-white/70 text-xs">({{ recipe.reviews
                                        }})</span>
                                </div>
                                <div
                                    class="flex items-center gap-1 text-xs font-medium bg-black/30 px-2 py-1 rounded-lg backdrop-blur-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-3.5 h-3.5">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ recipe.time }}
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-1 flex-col p-6">
                            <h3
                                class="text-xl font-bold text-gray-900 group-hover:text-orange-600 transition-colors line-clamp-2 mb-2">
                                {{ recipe.title }}
                            </h3>

                            <div class="flex items-center gap-3 text-sm text-gray-500 mb-6">
                                <span class="flex items-center gap-1">
                                    <span class="text-orange-500">🔥</span> {{ recipe.calories }}
                                </span>
                                <span class="h-1 w-1 rounded-full bg-gray-300"></span>
                                <span>Easy</span>
                            </div>

                            <div class="mt-auto flex items-center justify-between border-t border-gray-100 pt-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-8 w-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-xs ring-2 ring-white shadow-sm">
                                        {{ recipe.chef.charAt(0) }}
                                    </div>
                                    <span class="text-sm font-bold text-gray-700">{{ recipe.chef }}</span>
                                </div>
                                <button
                                    class="rounded-full bg-gray-50 p-2 text-gray-400 transition-all hover:bg-orange-50 hover:text-orange-600">
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

            <section class="animate-fade-in-up animation-delay-600 mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
                <div
                    class="relative overflow-hidden rounded-[2.5rem] bg-gray-900 px-6 py-16 text-center shadow-2xl sm:px-12">
                    <div class="absolute top-0 left-0 -mt-10 h-64 w-64 rounded-full bg-orange-500/20 blur-[100px]">
                    </div>
                    <div class="absolute bottom-0 right-0 -mb-10 h-64 w-64 rounded-full bg-red-500/20 blur-[100px]">
                    </div>

                    <div class="relative z-10">
                        <h2 class="text-3xl font-black tracking-tight text-white sm:text-5xl">
                            Got a Secret Recipe?
                        </h2>
                        <p class="mx-auto mt-6 max-w-xl text-lg text-gray-300 leading-relaxed">
                            Share your culinary masterpiece with thousands of foodies. Build your profile and inspire
                            others to cook.
                        </p>
                        <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                            <Link href="/recipes/create"
                                class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-orange-500 to-red-600 px-8 py-4 text-base font-bold text-white shadow-lg shadow-orange-500/30 transition-transform hover:scale-105">
                                Start Sharing
                            </Link>
                            <Link href="/aboutus"
                                class="inline-flex items-center justify-center rounded-xl bg-white/10 px-8 py-4 text-base font-bold text-white backdrop-blur-sm transition-colors hover:bg-white/20">
                                Learn More
                            </Link>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </Layout>
</template>

<style scoped>
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
}

.animation-delay-200 {
    animation-delay: 0.2s;
}

.animation-delay-400 {
    animation-delay: 0.4s;
}

.animation-delay-600 {
    animation-delay: 0.6s;
}
</style>
