<script setup>
import { Head, router, Link } from "@inertiajs/vue3";
import { computed, ref, watch, onMounted, onUnmounted } from "vue";
import Layout from "../Components/Layout.vue";

const props = defineProps({
    recipes: { type: Object, required: true },
    categories: { type: Array, default: () => [] },
    filters: { type: Object, default: () => ({}) },
});

const search = ref(props.filters.search || "");
const selectedCategory = ref(props.filters.category || "");
const selectedDifficulty = ref(props.filters.difficulty || "");
const maxTime = ref(props.filters.max_time || "");

const categoryOpen = ref(false);
const difficultyOpen = ref(false);
const categoryRef = ref(null);
const difficultyRef = ref(null);
const categorySearch = ref("");

const difficulties = [
    { id: "easy", label: "Easy" },
    { id: "medium", label: "Medium" },
    { id: "hard", label: "Hard" },
];

const hasActiveFilters = computed(() => !!search.value || !!selectedCategory.value || !!selectedDifficulty.value || !!maxTime.value);

const selectedCategoryName = computed(() => {
    if (!selectedCategory.value) return "";
    const cat = props.categories.find(c => c.id == selectedCategory.value);
    return cat ? cat.name : "";
});

const selectedDifficultyLabel = computed(() => {
    if (!selectedDifficulty.value) return "";
    const d = difficulties.find(d => d.id === selectedDifficulty.value);
    return d ? d.label : "";
});

const filteredCategories = computed(() => {
    if (!categorySearch.value) return props.categories;
    return props.categories.filter(c => c.name.toLowerCase().includes(categorySearch.value.toLowerCase()));
});

const selectCategory = (id) => {
    selectedCategory.value = id;
    categoryOpen.value = false;
    categorySearch.value = "";
};

const selectDifficulty = (id) => {
    selectedDifficulty.value = id;
    difficultyOpen.value = false;
};

const handleClickOutside = (e) => {
    if (categoryRef.value && !categoryRef.value.contains(e.target)) {
        categoryOpen.value = false;
        categorySearch.value = "";
    }
    if (difficultyRef.value && !difficultyRef.value.contains(e.target)) {
        difficultyOpen.value = false;
    }
};

onMounted(() => document.addEventListener('click', handleClickOutside));
onUnmounted(() => document.removeEventListener('click', handleClickOutside));

const debounce = (fn, delay) => {
    let timeout;
    return (...args) => { clearTimeout(timeout); timeout = setTimeout(() => fn(...args), delay); };
};

watch(
    [search, selectedCategory, selectedDifficulty, maxTime],
    debounce(() => {
        router.get("/recipes", {
            search: search.value || undefined,
            category: selectedCategory.value || undefined,
            difficulty: selectedDifficulty.value || undefined,
            max_time: maxTime.value || undefined,
        }, { preserveScroll: true, preserveState: true, replace: true });
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

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 space-y-6">

            <section class="text-center space-y-3 pt-4">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-black tracking-tight text-gray-900 dark:text-white">
                    Explore the
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">YummyShare</span>
                    kitchen
                </h1>
                <p class="max-w-2xl mx-auto text-gray-500 dark:text-gray-400 text-sm sm:text-base">
                    Search, filter, and discover recipes crafted by our community of passionate home cooks.
                </p>
            </section>

            <!-- Compact Filter Bar -->
            <section class="relative z-20">
                <div class="bg-white dark:bg-gray-900/80 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm p-3 space-y-3">

                    <!-- Search -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input v-model="search" type="text" placeholder="Search recipes, ingredients, or chefs..."
                            class="block w-full pl-9 pr-4 py-2 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-gray-700 rounded-lg text-sm text-gray-900 dark:text-white focus:bg-white dark:focus:bg-white/10 focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all placeholder:text-gray-400 dark:placeholder:text-gray-500" />
                    </div>

                    <!-- Filter Row -->
                    <div class="flex flex-wrap items-center gap-2">

                        <!-- Category Combobox -->
                        <div class="relative" ref="categoryRef">
                            <button @click="categoryOpen = !categoryOpen; difficultyOpen = false"
                                class="inline-flex items-center gap-1.5 rounded-lg border px-3 py-1.5 text-sm font-medium transition-all cursor-pointer"
                                :class="selectedCategory
                                    ? 'bg-orange-50 dark:bg-orange-950/40 border-orange-200 dark:border-orange-800 text-orange-700 dark:text-orange-300'
                                    : 'bg-gray-50 dark:bg-white/5 border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                </svg>
                                {{ selectedCategoryName || 'Category' }}
                                <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': categoryOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <transition enter-active-class="transition duration-100 ease-out" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100"
                                leave-active-class="transition duration-75 ease-in" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
                                <div v-if="categoryOpen"
                                    class="absolute left-0 mt-1.5 w-56 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-xl z-50 overflow-hidden">
                                    <div class="p-2 border-b border-gray-100 dark:border-gray-800">
                                        <input v-model="categorySearch" type="text" placeholder="Search categories..."
                                            class="w-full px-2.5 py-1.5 text-sm bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:outline-none focus:ring-1 focus:ring-orange-500/30 focus:border-orange-500" />
                                    </div>
                                    <ul class="max-h-48 overflow-auto p-1">
                                        <li @click="selectCategory('')"
                                            class="px-3 py-1.5 text-sm rounded-lg cursor-pointer transition-colors"
                                            :class="!selectedCategory ? 'bg-orange-50 dark:bg-orange-950/40 text-orange-700 dark:text-orange-300 font-semibold' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5'">
                                            All Categories
                                        </li>
                                        <li v-for="cat in filteredCategories" :key="cat.id" @click="selectCategory(cat.id)"
                                            class="px-3 py-1.5 text-sm rounded-lg cursor-pointer transition-colors"
                                            :class="selectedCategory == cat.id ? 'bg-orange-50 dark:bg-orange-950/40 text-orange-700 dark:text-orange-300 font-semibold' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5'">
                                            {{ cat.name }}
                                        </li>
                                        <li v-if="filteredCategories.length === 0" class="px-3 py-2 text-sm text-gray-400 dark:text-gray-500 italic">
                                            No categories found
                                        </li>
                                    </ul>
                                </div>
                            </transition>
                        </div>

                        <!-- Difficulty Combobox -->
                        <div class="relative" ref="difficultyRef">
                            <button @click="difficultyOpen = !difficultyOpen; categoryOpen = false"
                                class="inline-flex items-center gap-1.5 rounded-lg border px-3 py-1.5 text-sm font-medium transition-all cursor-pointer"
                                :class="selectedDifficulty
                                    ? 'bg-orange-50 dark:bg-orange-950/40 border-orange-200 dark:border-orange-800 text-orange-700 dark:text-orange-300'
                                    : 'bg-gray-50 dark:bg-white/5 border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                </svg>
                                {{ selectedDifficultyLabel || 'Difficulty' }}
                                <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': difficultyOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <transition enter-active-class="transition duration-100 ease-out" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100"
                                leave-active-class="transition duration-75 ease-in" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
                                <div v-if="difficultyOpen"
                                    class="absolute left-0 mt-1.5 w-44 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-xl z-50 overflow-hidden">
                                    <ul class="p-1">
                                        <li @click="selectDifficulty('')"
                                            class="px-3 py-1.5 text-sm rounded-lg cursor-pointer transition-colors"
                                            :class="!selectedDifficulty ? 'bg-orange-50 dark:bg-orange-950/40 text-orange-700 dark:text-orange-300 font-semibold' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5'">
                                            Any Difficulty
                                        </li>
                                        <li v-for="diff in difficulties" :key="diff.id" @click="selectDifficulty(diff.id)"
                                            class="px-3 py-1.5 text-sm rounded-lg cursor-pointer transition-colors flex items-center gap-2"
                                            :class="selectedDifficulty === diff.id ? 'bg-orange-50 dark:bg-orange-950/40 text-orange-700 dark:text-orange-300 font-semibold' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5'">
                                            <span class="h-1.5 w-1.5 rounded-full"
                                                :class="{ 'bg-green-500': diff.id === 'easy', 'bg-orange-500': diff.id === 'medium', 'bg-red-500': diff.id === 'hard' }"></span>
                                            {{ diff.label }}
                                        </li>
                                    </ul>
                                </div>
                            </transition>
                        </div>

                        <!-- Max Time -->
                        <div class="relative flex items-center">
                            <div class="absolute left-2.5 pointer-events-none">
                                <svg class="h-3.5 w-3.5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <input v-model="maxTime" type="number" min="1" placeholder="Max min"
                                class="w-24 pl-8 pr-2 py-1.5 text-sm bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all placeholder:text-gray-400 dark:placeholder:text-gray-500 font-medium" />
                        </div>

                        <!-- Spacer -->
                        <div class="flex-1"></div>

                        <!-- Active filter indicator & Clear -->
                        <div class="flex items-center gap-2">
                            <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 scale-90" enter-to-class="opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-90">
                                <button v-if="hasActiveFilters" @click="clearFilters" type="button"
                                    class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-xs font-bold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-950/30 hover:bg-red-100 dark:hover:bg-red-950/50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Clear
                                </button>
                            </transition>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Recipe Grid -->
            <section class="relative z-10">

                <div v-if="visibleRecipes.length === 0"
                    class="flex flex-col items-center justify-center py-16 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm">
                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-full bg-orange-50 dark:bg-orange-950/50 text-orange-500 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a4.5 4.5 0 1 0-7.18 0M12 10.5v.008h.008V10.5H12Zm0 5.25h.008v.008H12v-.008Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2">No recipes found</h2>
                    <p class="text-base text-gray-500 dark:text-gray-400 max-w-md text-center">
                        We couldn't find anything matching your filters. Try tweaking your search or clearing the filters.
                    </p>
                </div>

                <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                    <Link v-for="(recipe, index) in visibleRecipes" :key="recipe.id" :href="`/recipes/${recipe.id}`"
                        class="group relative block h-[280px] sm:h-[320px] md:h-[380px] w-full overflow-hidden rounded-2xl sm:rounded-[2rem] shadow-xl transition-all duration-500 hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.25)] hover:-translate-y-2 reveal-on-scroll"
                        :style="{ transitionDelay: `${index * 100}ms` }">

                        <div class="absolute inset-0 h-full w-full overflow-hidden bg-gray-200 dark:bg-gray-800">
                            <img :src="(recipe.images && recipe.images.find(img => img.is_main)?.image_path) || (recipe.images && recipe.images[0]?.image_path) || 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80'"
                                :alt="recipe.title" loading="lazy"
                                class="h-full w-full object-cover transition-transform duration-[1.2s] ease-out group-hover:scale-105" />
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 transition-opacity duration-500 group-hover:opacity-70"></div>

                        <div class="absolute top-4 sm:top-6 left-4 sm:left-6 z-10 flex flex-wrap gap-2">
                            <span class="inline-flex items-center gap-2 rounded-full bg-white/20 backdrop-blur-md px-2.5 sm:px-3 py-1 sm:py-1.5 text-xs sm:text-sm font-bold text-white border border-white/20 shadow-sm transition-transform duration-300 group-hover:scale-105">
                                <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                                {{ recipe.difficulty ? recipe.difficulty.charAt(0).toUpperCase() + recipe.difficulty.slice(1) : 'Recipe' }}
                            </span>
                            <span v-if="recipe.category"
                                class="inline-flex items-center gap-2 rounded-full bg-white/20 backdrop-blur-md px-2.5 sm:px-3 py-1 sm:py-1.5 text-xs sm:text-sm font-bold text-white border border-white/20 shadow-sm transition-transform duration-300 group-hover:scale-105">
                                {{ recipe.category.name }}
                            </span>
                        </div>

                        <div class="absolute inset-0 flex flex-col justify-end p-4 sm:p-5 md:p-7">
                            <div class="transform transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                                <div class="flex items-center gap-4 text-orange-300 font-bold text-xs sm:text-sm tracking-wider uppercase mb-3 opacity-0 transform -translate-y-2 transition-all duration-500 delay-75 group-hover:opacity-100 group-hover:translate-y-0">
                                    <span>{{ recipe.cook_time }} MIN</span>
                                    <span class="h-1 w-1 rounded-full bg-white/50"></span>
                                    <span>{{ recipe.servings }} SERVINGS</span>
                                </div>

                                <h3 class="text-xl sm:text-2xl md:text-3xl font-black text-white mb-3 sm:mb-4 leading-tight drop-shadow-md line-clamp-2">
                                    {{ recipe.title }}
                                </h3>

                                <div class="flex items-center justify-between border-t border-white/20 pt-3 sm:pt-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-7 w-7 sm:h-8 sm:w-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white border border-white/30 font-bold text-sm sm:text-lg">
                                            {{ recipe.author_name ? recipe.author_name.charAt(0).toUpperCase() : 'U' }}
                                        </div>
                                        <div class="flex flex-col text-white">
                                            <span class="text-[10px] sm:text-xs font-medium opacity-80 uppercase tracking-wide">Recipe By</span>
                                            <span class="text-xs sm:text-sm font-bold">{{ recipe.author_name || 'Unknown Chef' }}</span>
                                        </div>
                                    </div>
                                    <div class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-white text-gray-900 flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover:rotate-45 group-hover:bg-orange-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </Link>
                </div>

                <div v-if="recipes && recipes.links && recipes.links.length > 3"
                    class="mt-8 flex flex-wrap items-center justify-center gap-2 text-sm">
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
