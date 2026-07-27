<script setup>
import { Link, router } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import Layout from "./Components/Layout.vue";

defineProps({
    categories: Array,
    featuredRecipes: Array,
});

const searchQuery = ref("");

const handleSearch = () => {
    if (searchQuery.value.trim()) {
        router.get("/recipes", { search: searchQuery.value.trim() });
    }
};

onMounted(() => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: "0px 0px -40px 0px" });

    document.querySelectorAll('.reveal-on-scroll').forEach((el) => observer.observe(el));
});
</script>

<template>
    <Layout>
        <div class="space-y-0 pb-0">

            <!-- Hero Section -->
            <section class="relative h-screen min-h-[520px] w-full -mt-16 flex items-center justify-center overflow-hidden">
                <div class="absolute inset-0 z-0">
                    <video autoplay loop muted playsinline preload="metadata" class="h-full w-full object-cover"
                        poster="/videos/poster.jpg">
                        <source src="/videos/home.mp4" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/40 to-black/70"></div>
                </div>

                <div class="relative z-10 mx-auto max-w-4xl text-center px-4 pt-14">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 px-4 py-1.5 mb-6">
                        <span class="text-sm font-semibold text-white/90">Join thousands of home cooks worldwide</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-black tracking-tight text-white leading-[1.1] drop-shadow-lg">
                        Cook Like a Pro,<br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-300 to-red-500">Share
                            with the World.</span>
                    </h1>

                    <p class="mx-auto mt-5 max-w-2xl text-base sm:text-lg text-gray-200/90 leading-relaxed">
                        Discover thousands of tested recipes from home cooks around the globe. Save your favorites and start your culinary journey today.
                    </p>

                    <form @submit.prevent="handleSearch"
                        class="mx-auto mt-8 flex max-w-lg items-center gap-2 rounded-2xl bg-white/90 dark:bg-white/10 p-1.5 shadow-2xl backdrop-blur-sm transition-all focus-within:ring-4 focus-within:ring-orange-500/30 focus-within:bg-white dark:focus-within:bg-white/15">
                        <div class="pl-4 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input v-model="searchQuery" type="text" placeholder="What do you want to cook?"
                            class="w-full border-none bg-transparent text-gray-900 dark:text-white placeholder-gray-400 focus:ring-0 text-base outline-none h-10">
                        <button type="submit"
                            class="rounded-xl bg-gray-900 dark:bg-orange-600 px-5 sm:px-6 py-2.5 font-bold text-white transition-all hover:bg-orange-600 dark:hover:bg-orange-500 hover:shadow-lg whitespace-nowrap active:scale-95">
                            Search
                        </button>
                    </form>
                </div>

                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 animate-bounce">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="white" class="w-6 h-6 opacity-75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
            </section>

            <!-- Browse by Category -->
            <section class="py-16 sm:py-20 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10 sm:mb-14 reveal-on-scroll">
                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight text-gray-900 dark:text-white mb-4">
                        Browse by <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">Category</span>
                    </h2>
                    <p class="text-base sm:text-lg text-gray-500 dark:text-gray-400 max-w-2xl mx-auto">
                        From quick bites to gourmet feasts, find the perfect collection for your next meal.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    <Link v-for="(category, index) in categories" :key="category.id"
                        :href="`/recipes?category=${category.id}`"
                        class="group relative block h-[240px] sm:h-[280px] overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-1 reveal-on-scroll"
                        :style="{ transitionDelay: `${index * 80}ms` }">

                        <div class="absolute inset-0 bg-gray-200 dark:bg-gray-800">
                            <img :src="category.image" :alt="category.name" loading="lazy"
                                class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110" />
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-70 group-hover:opacity-80 transition-opacity duration-500"></div>

                        <div class="absolute inset-0 flex flex-col justify-end p-5 sm:p-6">
                            <div class="transform transition-all duration-500 translate-y-2 group-hover:translate-y-0">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="inline-block px-2.5 py-0.5 rounded-full bg-orange-500/20 backdrop-blur-sm text-orange-300 text-xs font-bold border border-orange-500/20">
                                        {{ category.recipes_count || 0 }} {{ (category.recipes_count || 0) === 1 ? 'Recipe' : 'Recipes' }}
                                    </span>
                                </div>
                                <h3 class="text-xl sm:text-2xl font-black text-white mb-1 tracking-tight">{{ category.name }}</h3>
                                <p class="text-sm text-gray-300 line-clamp-2 leading-relaxed opacity-0 max-h-0 group-hover:opacity-100 group-hover:max-h-20 transition-all duration-500">
                                    {{ category.description }}
                                </p>
                            </div>

                            <div class="absolute top-4 right-4 h-9 w-9 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </div>
                        </div>
                    </Link>
                </div>

                <div class="text-center mt-10 reveal-on-scroll">
                    <Link href="/recipes"
                        class="inline-flex items-center gap-2 rounded-full bg-gray-100 dark:bg-white/10 px-6 py-3 text-sm font-bold text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-white/20 transition-all hover:-translate-y-0.5 shadow-sm">
                        View All Recipes
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </Link>
                </div>
            </section>

            <!-- Featured Recipes -->
            <section v-if="featuredRecipes && featuredRecipes.length > 0"
                class="py-16 sm:py-20 bg-gray-50 dark:bg-gray-900/50">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-10 sm:mb-14 gap-4 reveal-on-scroll">
                        <div>
                            <h2 class="text-3xl sm:text-4xl font-black tracking-tight text-gray-900 dark:text-white mb-3">
                                Latest <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">Recipes</span>
                            </h2>
                            <p class="text-base sm:text-lg text-gray-500 dark:text-gray-400 max-w-xl">
                                Fresh from our community of passionate home cooks.
                            </p>
                        </div>
                        <Link href="/recipes"
                            class="inline-flex items-center gap-2 text-sm font-bold text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 transition-colors whitespace-nowrap">
                            See all recipes
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </Link>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                        <Link v-for="(recipe, index) in featuredRecipes" :key="recipe.id"
                            :href="`/recipes/${recipe.id}`"
                            class="group block bg-white dark:bg-gray-900 rounded-2xl overflow-hidden shadow-md hover:shadow-xl border border-gray-100 dark:border-gray-800 transition-all duration-500 hover:-translate-y-1 reveal-on-scroll"
                            :style="{ transitionDelay: `${index * 80}ms` }">

                            <div class="relative h-48 sm:h-52 overflow-hidden bg-gray-200 dark:bg-gray-800">
                                <img :src="(recipe.images && recipe.images.find(img => img.is_main)?.image_path) || (recipe.images && recipe.images[0]?.image_path) || 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80'"
                                    :alt="recipe.title" loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" />

                                <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                                    <span v-if="recipe.category"
                                        class="inline-flex items-center rounded-full bg-white/90 dark:bg-gray-900/80 backdrop-blur-sm px-2.5 py-1 text-xs font-bold text-gray-700 dark:text-gray-200 shadow-sm">
                                        {{ recipe.category.name }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-white/90 dark:bg-gray-900/80 backdrop-blur-sm px-2.5 py-1 text-xs font-bold shadow-sm"
                                        :class="{
                                            'text-green-600 dark:text-green-400': recipe.difficulty === 'easy',
                                            'text-orange-600 dark:text-orange-400': recipe.difficulty === 'medium',
                                            'text-red-600 dark:text-red-400': recipe.difficulty === 'hard'
                                        }">
                                        <span class="h-1.5 w-1.5 rounded-full"
                                            :class="{
                                                'bg-green-500': recipe.difficulty === 'easy',
                                                'bg-orange-500': recipe.difficulty === 'medium',
                                                'bg-red-500': recipe.difficulty === 'hard'
                                            }"></span>
                                        {{ recipe.difficulty ? recipe.difficulty.charAt(0).toUpperCase() + recipe.difficulty.slice(1) : '' }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-4 sm:p-5">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-1 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors">
                                    {{ recipe.title }}
                                </h3>

                                <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mb-4">
                                    <span class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        {{ recipe.cook_time }} min
                                    </span>
                                    <span class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                        </svg>
                                        {{ recipe.servings }} servings
                                    </span>
                                </div>

                                <div class="flex items-center justify-between pt-3 border-t border-gray-100 dark:border-gray-800">
                                    <div class="flex items-center gap-2.5">
                                        <div class="h-7 w-7 rounded-full bg-orange-100 dark:bg-orange-900/50 flex items-center justify-center text-orange-600 dark:text-orange-400 font-bold text-xs">
                                            {{ recipe.author_name ? recipe.author_name.charAt(0).toUpperCase() : 'U' }}
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ recipe.author_name || 'Unknown Chef' }}</span>
                                    </div>
                                    <div class="h-8 w-8 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400 group-hover:bg-orange-500 group-hover:text-white transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </div>
                </div>
            </section>

            <!-- Stats -->
            <section class="py-14 sm:py-16 border-y border-gray-100 dark:border-gray-800 reveal-on-scroll">
                <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 text-center">
                        <div>
                            <p class="text-3xl sm:text-4xl font-black text-gray-900 dark:text-white">10K+</p>
                            <p class="mt-1 text-sm font-semibold text-gray-500 dark:text-gray-400">Recipes Shared</p>
                        </div>
                        <div>
                            <p class="text-3xl sm:text-4xl font-black text-orange-600 dark:text-orange-400">8K+</p>
                            <p class="mt-1 text-sm font-semibold text-gray-500 dark:text-gray-400">Active Cooks</p>
                        </div>
                        <div>
                            <p class="text-3xl sm:text-4xl font-black text-gray-900 dark:text-white">45+</p>
                            <p class="mt-1 text-sm font-semibold text-gray-500 dark:text-gray-400">Countries</p>
                        </div>
                        <div>
                            <p class="text-3xl sm:text-4xl font-black text-orange-600 dark:text-orange-400">4.9</p>
                            <p class="mt-1 text-sm font-semibold text-gray-500 dark:text-gray-400">User Rating</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="py-16 sm:py-20 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 reveal-on-scroll">
                <div class="relative overflow-hidden rounded-2xl sm:rounded-[2rem] bg-orange-50 dark:bg-gray-900 px-6 py-12 sm:py-16 text-center shadow-2xl sm:px-12 border border-orange-100 dark:border-gray-800">
                    <div class="absolute top-0 left-0 -mt-10 h-64 w-64 rounded-full bg-orange-500/15 dark:bg-orange-500/20 blur-[100px]"></div>
                    <div class="absolute bottom-0 right-0 -mb-10 h-64 w-64 rounded-full bg-red-500/15 dark:bg-red-500/20 blur-[100px]"></div>

                    <div class="relative z-10">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-black tracking-tight text-gray-900 dark:text-white">
                            Got a Secret Recipe?
                        </h2>
                        <p class="mx-auto mt-4 sm:mt-5 max-w-xl text-base sm:text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                            Share your culinary masterpiece with thousands of foodies. Build your profile and inspire
                            others to cook.
                        </p>
                        <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                            <Link href="/recipes/create"
                                class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-orange-500 to-red-600 px-7 py-3 text-base font-bold text-white shadow-lg shadow-orange-500/30 transition-all hover:scale-105 hover:shadow-orange-500/50 active:scale-95">
                                Start Sharing
                            </Link>
                            <Link href="/aboutus"
                                class="inline-flex items-center justify-center rounded-xl bg-gray-900 dark:bg-white/10 px-7 py-3 text-base font-bold text-white backdrop-blur-sm transition-all hover:bg-gray-800 dark:hover:bg-white/20">
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
.reveal-on-scroll {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
}

.reveal-on-scroll.is-visible {
    opacity: 1;
    transform: translateY(0);
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
</style>
