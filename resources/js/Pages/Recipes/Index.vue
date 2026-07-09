<script setup>
import { Head, router, Link } from "@inertiajs/vue3";
import { computed, ref, watch } from "vue";
import Layout from "../Components/Layout.vue";

const props = defineProps({
    recipes: {
        type: Object,
        required: true,
    },
    categories: {
        type: Array,
        default: () => [],
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});

const search = ref(props.filters.search || "");
const selectedCategory = ref(props.filters.category || "");
const selectedDifficulty = ref(props.filters.difficulty || "");
const maxTime = ref(props.filters.max_time || "");

const hasActiveFilters = computed(() => {
    return (
        !!search.value ||
        !!selectedCategory.value ||
        !!selectedDifficulty.value ||
        !!maxTime.value
    );
});

const difficulties = [
    { id: "easy", label: "Easy" },
    { id: "medium", label: "Medium" },
    { id: "hard", label: "Hard" },
];

const debounce = (fn, delay) => {
    let timeout;
    return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => fn(...args), delay);
    };
};

watch(
    [search, selectedCategory, selectedDifficulty, maxTime],
    debounce(() => {
        const params = {
            search: search.value || undefined,
            category: selectedCategory.value || undefined,
            difficulty: selectedDifficulty.value || undefined,
            max_time: maxTime.value || undefined,
        };

        router.get("/recipes", params, {
            preserveScroll: true,
            preserveState: true,
            replace: true,
        });
    }, 300)
);

const clearFilters = () => {
    search.value = "";
    selectedCategory.value = "";
    selectedDifficulty.value = "";
    maxTime.value = "";
};

const visibleRecipes = computed(() => props.recipes?.data || []);
</script>

<template>
    <Layout>

        <Head title="Discover Recipes" />

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10 space-y-12">

            <section class="text-center space-y-4 pt-4">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black tracking-tight text-gray-900 dark:text-white">
                    Explore the
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">YummyShare</span>
                    kitchen
                </h1>
                <p class="max-w-2xl mx-auto text-gray-500 dark:text-gray-400 text-base sm:text-lg">
                    Search, filter, and discover recipes crafted by our community of passionate home cooks.
                </p>
            </section>

            <section class="relative z-20">
                <div
                    class="bg-white dark:bg-gray-900/80 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.06)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.3)] border border-gray-100/80 dark:border-gray-800 p-4 sm:p-6 md:p-8 transition-all duration-300">

                    <div class="relative flex items-center w-full mb-6">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 dark:text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input v-model="search" type="text" placeholder="Search by recipe, ingredient, or chef..."
                            class="block w-full pl-14 pr-4 py-4 bg-gray-50/50 dark:bg-white/5 border border-gray-200 dark:border-gray-700 rounded-2xl text-gray-900 dark:text-white focus:bg-white dark:focus:bg-white/10 focus:ring-4 focus:ring-orange-500/15 focus:border-orange-500 transition-all duration-300 text-base sm:text-lg placeholder:text-gray-400 dark:placeholder:text-gray-500 placeholder:font-medium" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-5">

                        <div class="relative group">
                            <label
                                class="block text-[11px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2 pl-1">Category</label>
                            <div class="relative">
                                <select v-model="selectedCategory"
                                    class="block w-full appearance-none bg-gray-50/50 dark:bg-white/5 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 py-3.5 px-4 pr-10 rounded-xl focus:bg-white dark:focus:bg-white/10 focus:outline-none focus:ring-4 focus:ring-orange-500/15 focus:border-orange-500 transition-all font-medium cursor-pointer">
                                    <option value="">All Categories</option>
                                    <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}
                                    </option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 group-hover:text-orange-500 transition-colors">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="relative group">
                            <label
                                class="block text-[11px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2 pl-1">Difficulty</label>
                            <div class="relative">
                                <select v-model="selectedDifficulty"
                                    class="block w-full appearance-none bg-gray-50/50 dark:bg-white/5 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 py-3.5 px-4 pr-10 rounded-xl focus:bg-white dark:focus:bg-white/10 focus:outline-none focus:ring-4 focus:ring-orange-500/15 focus:border-orange-500 transition-all font-medium cursor-pointer">
                                    <option value="">Any Difficulty</option>
                                    <option v-for="diff in difficulties" :key="diff.id" :value="diff.id">{{ diff.label
                                    }}</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 group-hover:text-orange-500 transition-colors">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="relative group sm:col-span-2 md:col-span-1">
                            <label
                                class="flex justify-between items-end text-[11px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2 pl-1 pr-1">
                                <span>Prep Time</span>
                                <span v-if="maxTime" class="text-orange-500 normal-case tracking-normal">Up to {{
                                    maxTime }} min</span>
                            </label>
                            <div class="relative flex items-center">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input v-model="maxTime" type="number" min="1" placeholder="Max minutes (e.g. 30)"
                                    class="block w-full pl-11 pr-4 py-3.5 bg-gray-50/50 dark:bg-white/5 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:bg-white dark:focus:bg-white/10 focus:outline-none focus:ring-4 focus:ring-orange-500/15 focus:border-orange-500 transition-all font-medium placeholder:text-gray-400 dark:placeholder:text-gray-500" />
                            </div>
                        </div>

                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                        <div class="flex items-center gap-2.5 text-sm font-medium text-gray-500 dark:text-gray-400">
                            <div class="relative flex h-2.5 w-2.5">
                                <span v-if="hasActiveFilters"
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5"
                                    :class="hasActiveFilters ? 'bg-orange-500' : 'bg-gray-300 dark:bg-gray-600'"></span>
                            </div>
                            <span v-if="hasActiveFilters" class="text-gray-700 dark:text-gray-300">Filtering results dynamically...</span>
                            <span v-else>Showing all latest recipes</span>
                        </div>

                        <transition enter-active-class="transition ease-out duration-200"
                            enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0"
                            leave-active-class="transition ease-in duration-150"
                            leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                            <button v-if="hasActiveFilters" @click="clearFilters" type="button"
                                class="text-sm font-bold text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors flex items-center gap-1.5 py-1 px-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-950/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Clear All
                            </button>
                        </transition>
                    </div>
                </div>
            </section>

            <section class="relative z-10 pt-4">

                <div v-if="visibleRecipes.length === 0"
                    class="flex flex-col items-center justify-center py-24 rounded-[2rem] border-2 border-dashed border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm">
                    <div
                        class="mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-orange-50 dark:bg-orange-950/50 text-orange-500 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                            stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.59 14.37a4.5 4.5 0 1 0-7.18 0M12 10.5v.008h.008V10.5H12Zm0 5.25h.008v.008H12v-.008Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-2">No recipes found</h2>
                    <p class="text-base text-gray-500 dark:text-gray-400 max-w-md text-center">
                        We couldn't find anything matching your current filters. Try tweaking your search or clearing
                        the filters above.
                    </p>
                </div>

                <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-10">
                    <Link v-for="(recipe, index) in visibleRecipes" :key="recipe.id" :href="`/recipes/${recipe.id}`"
                        class="group relative block h-[350px] sm:h-[400px] md:h-[500px] w-full overflow-hidden rounded-[2rem] sm:rounded-[2.5rem] shadow-xl transition-all duration-500 hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.25)] hover:-translate-y-2 reveal-on-scroll"
                        :style="{ transitionDelay: `${index * 100}ms` }">

                        <div class="absolute inset-0 h-full w-full overflow-hidden bg-gray-200 dark:bg-gray-800">
                            <img :src="(recipe.images && recipe.images.find(img => img.is_main)?.image_path) || (recipe.images && recipe.images[0]?.image_path) || 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80'"
                                :alt="recipe.title" loading="lazy"
                                class="h-full w-full object-cover transition-transform duration-[1.2s] ease-out group-hover:scale-105" />
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 transition-opacity duration-500 group-hover:opacity-70">
                        </div>

                        <div class="absolute top-4 sm:top-6 left-4 sm:left-6 z-10 flex flex-wrap gap-2">
                            <span
                                class="inline-flex items-center gap-2 rounded-full bg-white/20 backdrop-blur-md px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-bold text-white border border-white/20 shadow-sm transition-transform duration-300 group-hover:scale-105">
                                <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                                {{ recipe.difficulty ? recipe.difficulty.charAt(0).toUpperCase() +
                                    recipe.difficulty.slice(1) : 'Recipe' }}
                            </span>

                            <span v-if="recipe.category"
                                class="inline-flex items-center gap-2 rounded-full bg-white/20 backdrop-blur-md px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-bold text-white border border-white/20 shadow-sm transition-transform duration-300 group-hover:scale-105">
                                {{ recipe.category.name }}
                            </span>
                        </div>

                        <div class="absolute inset-0 flex flex-col justify-end p-6 sm:p-8 md:p-10">
                            <div class="transform transition-all duration-500 translate-y-4 group-hover:translate-y-0">

                                <div
                                    class="flex items-center gap-4 text-orange-300 font-bold text-xs sm:text-sm tracking-wider uppercase mb-3 opacity-0 transform -translate-y-2 transition-all duration-500 delay-75 group-hover:opacity-100 group-hover:translate-y-0">
                                    <span>{{ recipe.cook_time }} MIN</span>
                                    <span class="h-1 w-1 rounded-full bg-white/50"></span>
                                    <span>{{ recipe.servings }} SERVINGS</span>
                                </div>

                                <h3
                                    class="text-2xl sm:text-3xl md:text-4xl font-black text-white mb-4 sm:mb-6 leading-tight drop-shadow-md line-clamp-2">
                                    {{ recipe.title }}
                                </h3>

                                <div class="flex items-center justify-between border-t border-white/20 pt-4 sm:pt-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white border border-white/30 font-bold text-sm sm:text-lg">
                                            {{ recipe.author_name ? recipe.author_name.charAt(0).toUpperCase() : 'U' }}
                                        </div>
                                        <div class="flex flex-col text-white">
                                            <span class="text-[10px] sm:text-xs font-medium opacity-80 uppercase tracking-wide">Recipe
                                                By</span>
                                            <span class="text-xs sm:text-sm font-bold">{{ recipe.author_name || 'Unknown Chef'
                                            }}</span>
                                        </div>
                                    </div>

                                    <div
                                        class="h-10 w-10 sm:h-12 sm:w-12 rounded-full bg-white text-gray-900 flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover:rotate-45 group-hover:bg-orange-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                        </svg>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </Link>
                </div>

                <div v-if="recipes && recipes.links && recipes.links.length > 3"
                    class="mt-12 flex flex-wrap items-center justify-center gap-2 text-sm">
                    <button v-for="link in recipes.links" :key="link.label" type="button" :disabled="!link.url"
                        @click="link.url && router.get(link.url, {}, { preserveScroll: true })"
                        class="min-w-[2.5rem] rounded-full px-3 py-1.5 border text-xs font-semibold transition" :class="[
                            !link.url
                                ? 'border-transparent text-gray-300 dark:text-gray-600 cursor-default'
                                : link.active
                                    ? 'border-gray-900 dark:border-orange-500 bg-gray-900 dark:bg-orange-600 text-white shadow-sm'
                                    : 'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:border-gray-900 dark:hover:border-orange-500 hover:text-gray-900 dark:hover:text-white'
                        ]" v-html="link.label" />
                </div>
            </section>
        </div>
    </Layout>
</template>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance: textfield;
}
</style>
