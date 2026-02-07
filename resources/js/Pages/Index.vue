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

defineProps({
    categories: Array
});
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

            <section class="space-y-20 pb-20 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="relative z-10 mx-auto max-w-4xl text-center pt-8 reveal-card">
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-orange-200 bg-orange-50/50 px-4 py-1.5 backdrop-blur-sm mb-6 shadow-sm cursor-default transition-transform hover:scale-105">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                        </span>
                        <span class="text-xs font-bold uppercase tracking-wider text-orange-700">Curated
                            Collections</span>
                    </div>

                    <h1 class="text-5xl font-black tracking-tight text-gray-900 sm:text-7xl mb-6">
                        Find Your <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">Flavor</span>
                    </h1>

                    <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                        Journey through our culinary collections. From quick bites to gourmet feasts, discover the
                        perfect
                        dish for every palate.
                    </p>
                </div>

                <div class="space-y-16">

                    <Link v-for="(category, index) in categories" :key="category.id"
                        :href="`/?category=${category.slug}`"
                        class="group relative block h-[500px] sm:h-[600px] w-full overflow-hidden rounded-[3rem] shadow-xl transition-all duration-700 hover:shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] hover:-translate-y-1 reveal-card"
                        :class="{ 'md:w-[95%] md:ml-auto': index % 2 !== 0, 'md:w-[95%] md:mr-auto': index % 2 === 0 }">
                        <div class="absolute inset-0 h-full w-full overflow-hidden bg-gray-200">
                            <!-- Removed image hover scale effect class -->
                            <img :src="category.image" :alt="category.name"
                                class="h-full w-full object-cover transition-transform duration-[1.5s] ease-out" />
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-60 transition-opacity duration-500 group-hover:opacity-75">
                        </div>

                        <div class="absolute inset-0 flex flex-col justify-end p-8 sm:p-14">

                            <div class="transform transition-all duration-500 translate-y-4 group-hover:translate-y-0">

                                <div
                                    class="mb-4 opacity-0 transform -translate-y-4 transition-all duration-500 delay-100 group-hover:opacity-100 group-hover:translate-y-0">
                                    <span
                                        class="inline-block px-3 py-1 rounded-lg bg-white/20 backdrop-blur-md text-white text-xs font-bold uppercase tracking-widest border border-white/20">
                                        Collection #{{ index + 1 }}
                                    </span>
                                </div>

                                <h2
                                    class="text-5xl sm:text-7xl font-black text-white mb-4 tracking-tighter drop-shadow-lg">
                                    {{ category.name }}
                                </h2>

                                <div class="max-w-2xl">
                                    <p
                                        class="text-lg sm:text-xl font-medium text-gray-200 line-clamp-2 leading-relaxed mb-8 opacity-90 group-hover:text-white transition-colors">
                                        {{ category.description }}
                                    </p>
                                </div>

                                <div class="flex items-center gap-4">
                                    <span
                                        class="group-hover:pl-2 transition-all duration-300 flex items-center gap-2 text-white font-bold text-lg tracking-wide">
                                        Explore Recipes
                                        <div
                                            class="h-10 w-10 rounded-full bg-orange-600 flex items-center justify-center transform transition-transform duration-300 group-hover:rotate-45 group-hover:bg-white group-hover:text-orange-600 shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                            </svg>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </Link>

                </div>

                <!-- Animated Spotlight "More categories coming soon..." -->
                <div class="text-center pt-10 reveal-card">
                    <div class="relative inline-block">
                        <span class="spotlight z-0"></span>
                        <p class="relative z-10 text-gray-400 font-medium font-semibold text-xl px-7 py-4"
                            style="text-shadow: 0 4px 32px rgba(255,255,255,0.20);">
                            More categories coming soon...
                        </p>
                    </div>
                </div>

            </section>

            <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-20 space-y-16">

                <div class="text-center mb-12 reveal-on-scroll">
                    <h2 class="text-3xl font-black text-gray-900 tracking-tight sm:text-5xl">Fresh from the Kitchen</h2>
                    <p class="mt-4 text-xl text-gray-500">Curated picks for your daily inspiration.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <Link v-for="(recipe, index) in featuredRecipes" :key="recipe.id" :href="`/recipes/${recipe.id}`"
                        class="group relative block h-[500px] w-full overflow-hidden rounded-[2.5rem] shadow-xl transition-all duration-500 hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.25)] hover:-translate-y-2 reveal-on-scroll"
                        :style="{ transitionDelay: `${index * 100}ms` }">
                        <div class="absolute inset-0 h-full w-full overflow-hidden bg-gray-200">
                            <!-- Removed image hover scale effect class -->
                            <img :src="recipe.image" :alt="recipe.title"
                                class="h-full w-full object-cover transition-transform duration-[1.2s] ease-out" />
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 transition-opacity duration-500 group-hover:opacity-70">
                        </div>

                        <div class="absolute top-6 left-6 z-10">
                            <span
                                class="inline-flex items-center gap-2 rounded-full bg-white/20 backdrop-blur-md px-4 py-2 text-sm font-bold text-white border border-white/20 shadow-sm transition-transform duration-300 group-hover:scale-105">
                                <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                                {{ recipe.tag }}
                            </span>
                        </div>

                        <div class="absolute inset-0 flex flex-col justify-end p-8 sm:p-10">
                            <div class="transform transition-all duration-500 translate-y-4 group-hover:translate-y-0">

                                <div
                                    class="flex items-center gap-4 text-orange-300 font-bold text-sm tracking-wider uppercase mb-3 opacity-0 transform -translate-y-2 transition-all duration-500 delay-75 group-hover:opacity-100 group-hover:translate-y-0">
                                    <span>{{ recipe.time }}</span>
                                    <span class="h-1 w-1 rounded-full bg-white/50"></span>
                                    <span>{{ recipe.calories }}</span>
                                </div>

                                <h3
                                    class="text-3xl sm:text-4xl font-black text-white mb-6 leading-tight drop-shadow-md">
                                    {{ recipe.title }}
                                </h3>

                                <div class="flex items-center justify-between border-t border-white/20 pt-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-10 w-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white border border-white/30 font-bold">
                                            {{ recipe.chef.charAt(0) }}
                                        </div>
                                        <div class="flex flex-col text-white">
                                            <span class="text-xs font-medium opacity-80 uppercase tracking-wide">Recipe
                                                By</span>
                                            <span class="text-sm font-bold">{{ recipe.chef }}</span>
                                        </div>
                                    </div>

                                    <div
                                        class="h-12 w-12 rounded-full bg-white text-gray-900 flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover:rotate-45 group-hover:bg-orange-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                        </svg>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </Link>
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

@keyframes spotlightMove {
    0% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.72;
    }

    50% {
        transform: translate(-50%, -60%) scale(1.08);
        opacity: 1;
    }

    100% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.7;
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

.spotlight {
    position: absolute;
    left: 50%;
    top: 50%;
    pointer-events: none;
    z-index: 1;
    width: 240px;
    height: 66px;
    transform: translate(-50%, -50%);
    border-radius: 60px;
    background: radial-gradient(ellipse at center, rgba(255, 180, 80, 0.22) 0%, rgba(255, 140, 55, 0.15) 60%, rgba(255, 255, 255, 0) 100%);
    filter: blur(9px);
    animation: spotlightMove 2.2s ease-in-out infinite alternate;
    opacity: 0.7;
}
</style>
