<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";

const props = defineProps({
    recipe: {
        type: Object,
        required: true,
    },
    mainImage: {
        type: Object,
        default: () => null,
    },
});

const fallbackImage =
    "https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1600&q=80";
</script>

<template>
    <Layout>

        <Head :title="recipe.title" />

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10 space-y-10">
            <nav class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                    <Link href="/recipes" class="inline-flex items-center gap-1 hover:text-gray-900 dark:hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd"
                                d="M7.707 14.707a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414l4-4A1 1 0 0 1 8.707 6.293L6.414 8.5H17a1 1 0 1 1 0 2H6.414l2.293 2.207a1 1 0 0 1 0 1.414Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Back to recipes</span>
                    </Link>
                    <span class="text-gray-300 dark:text-gray-600">/</span>
                    <span class="line-clamp-1 text-gray-700 dark:text-gray-300">{{ recipe.title }}</span>
                </div>
            </nav>

            <section
                class="relative overflow-hidden rounded-3xl bg-white/80 dark:bg-gray-900/80 border border-white/60 dark:border-gray-800 shadow-xl backdrop-blur-xl">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    <div class="relative h-72 sm:h-96 lg:h-full min-h-[300px]">
                        <img :src="mainImage?.image_path || recipe.images?.[0]?.image_path || fallbackImage"
                            :alt="recipe.title" class="h-full w-full object-cover" />

                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>

                        <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-1 text-xs font-semibold text-white backdrop-blur-md border border-white/30">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                {{ recipe.difficulty ? recipe.difficulty.charAt(0).toUpperCase() +
                                    recipe.difficulty.slice(1) : "Recipe" }}
                            </span>
                            <span v-if="recipe.category"
                                class="inline-flex items-center gap-1.5 rounded-full bg-black/40 px-3 py-1 text-[11px] font-semibold text-gray-100 backdrop-blur-md border border-white/10">
                                {{ recipe.category.name }}
                            </span>
                        </div>

                        <div class="absolute bottom-4 left-4 flex flex-wrap gap-3">
                            <div
                                class="inline-flex items-center gap-2 rounded-full bg-white text-gray-900 shadow-lg px-3 py-1.5 text-xs font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span>{{ recipe.cook_time }} min</span>
                            </div>

                            <div
                                class="inline-flex items-center gap-2 rounded-full bg-black/60 text-gray-100 shadow-lg px-3 py-1.5 text-xs font-semibold border border-white/10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.5 14.25v-2.625a4.125 4.125 0 1 1 8.25 0v2.625" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5.25 14.25h13.5L18 19.5H6l-.75-5.25Z" />
                                </svg>
                                <span>By {{ recipe.author_name }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 sm:p-8 lg:p-10 space-y-6">
                        <div class="space-y-3">
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight text-gray-900 dark:text-white">
                                {{ recipe.title }}
                            </h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-[0.16em] font-semibold">
                                Community recipe &bull; YummyShare
                            </p>
                        </div>

                        <div
                            class="grid grid-cols-3 gap-3 sm:gap-4 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-gray-800 p-4">
                            <div class="space-y-1.5">
                                <p class="text-[10px] sm:text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                    Cook Time
                                </p>
                                <p class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">
                                    {{ recipe.cook_time }} min
                                </p>
                            </div>
                            <div class="space-y-1.5">
                                <p class="text-[10px] sm:text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                    Servings
                                </p>
                                <p class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">
                                    {{ recipe.servings }}
                                </p>
                            </div>
                            <div class="space-y-1.5">
                                <p class="text-[10px] sm:text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                    Difficulty
                                </p>
                                <p class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">
                                    {{ recipe.difficulty ? recipe.difficulty.charAt(0).toUpperCase() +
                                        recipe.difficulty.slice(1) : "N/A" }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                        Ingredients
                                        <span v-if="recipe.ingredients?.length"
                                            class="inline-flex items-center justify-center rounded-full bg-orange-50 dark:bg-orange-950/50 px-2.5 py-0.5 text-[11px] font-semibold text-orange-700 dark:text-orange-400 border border-orange-100 dark:border-orange-900">
                                            {{ recipe.ingredients.length }} items
                                        </span>
                                    </h2>
                                </div>

                                <ul v-if="recipe.ingredients?.length"
                                    class="space-y-2 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-gray-800 p-4 max-h-72 overflow-auto">
                                    <li v-for="ing in recipe.ingredients" :key="ing.id"
                                        class="flex items-start justify-between gap-3 text-sm text-gray-800 dark:text-gray-200">
                                        <span class="flex-1">
                                            {{ ing.name.charAt(0).toUpperCase() + ing.name.slice(1) }}
                                        </span>
                                        <span class="text-gray-500 dark:text-gray-400 text-xs font-medium whitespace-nowrap">
                                            {{ ing.pivot?.quantity }} {{ ing.pivot?.unit }}
                                        </span>
                                    </li>
                                </ul>
                                <p v-else class="text-sm text-gray-500 dark:text-gray-400 italic">
                                    No ingredients listed for this recipe.
                                </p>
                            </div>

                            <div class="space-y-4">
                                <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                                    Instructions
                                </h2>
                                <div
                                    class="prose prose-sm sm:prose-base max-w-none text-gray-800 dark:text-gray-200 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-gray-800 rounded-2xl p-4 sm:p-5">
                                    <p v-for="(block, idx) in recipe.instructions.split(/\n{2,}/)" :key="idx"
                                        class="whitespace-pre-line mb-3 last:mb-0">
                                        {{ block }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div v-if="recipe.images && recipe.images.length > 1"
                            class="pt-4 border-t border-gray-100 dark:border-gray-800 space-y-3">
                            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-500 dark:text-gray-400">
                                Gallery
                            </p>
                            <div class="flex gap-3 overflow-x-auto pb-1 -mx-1 px-1">
                                <div v-for="img in recipe.images" :key="img.id"
                                    class="relative h-24 w-32 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 flex-shrink-0">
                                    <img :src="img.image_path" :alt="recipe.title" loading="lazy" class="h-full w-full object-cover" />
                                    <span v-if="img.is_main"
                                        class="absolute top-2 left-2 rounded-full bg-black/60 text-[10px] font-semibold text-white px-2 py-0.5">
                                        Main
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </Layout>
</template>

<style scoped>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
