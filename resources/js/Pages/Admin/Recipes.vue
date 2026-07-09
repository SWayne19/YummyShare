<script setup>
import { Head, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import AdminLayout from "./Layout.vue";

const props = defineProps({
    recipes: Object,
    filters: Object,
});

const search = ref(props.filters?.search || "");
const statusFilter = ref(props.filters?.status || "");

let searchTimeout;
watch([search, statusFilter], () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get("/admin/recipes", {
            search: search.value || undefined,
            status: statusFilter.value || undefined,
        }, { preserveState: true, replace: true });
    }, 300);
});

const approve = (recipe) => router.post(`/admin/recipes/${recipe.id}/approve`, {}, { preserveScroll: true });
const reject = (recipe) => router.post(`/admin/recipes/${recipe.id}/reject`, {}, { preserveScroll: true });

const confirmDelete = ref(null);
const deleteRecipe = (recipe) => {
    if (confirmDelete.value === recipe.id) {
        router.delete(`/admin/recipes/${recipe.id}`, { preserveScroll: true });
        confirmDelete.value = null;
    } else {
        confirmDelete.value = recipe.id;
        setTimeout(() => { confirmDelete.value = null; }, 3000);
    }
};

const statusColors = {
    approved: 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300',
    pending: 'bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-300',
    rejected: 'bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300',
};

const getMainImage = (recipe) => {
    if (!recipe.images?.length) return null;
    return recipe.images.find(img => img.is_main)?.image_path || recipe.images[0]?.image_path;
};
</script>

<template>
    <Head title="Manage Recipes" />
    <AdminLayout>
        <div class="space-y-6">
            <div>
                <h1 class="text-2xl sm:text-3xl font-black text-gray-900 dark:text-white">Recipes</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Review and manage submitted recipes</p>
            </div>

            <!-- Filters -->
            <div class="flex flex-col sm:flex-row gap-3">
                <input v-model="search" type="text" placeholder="Search recipes..."
                    class="flex-1 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500 transition-all" />
                <select v-model="statusFilter"
                    class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-sm text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            <!-- Recipe Cards -->
            <div class="space-y-4">
                <div v-for="recipe in recipes.data" :key="recipe.id"
                    class="rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                    <div class="flex flex-col sm:flex-row">
                        <!-- Image -->
                        <div class="sm:w-48 h-40 sm:h-auto bg-gray-100 dark:bg-gray-800 flex-shrink-0">
                            <img v-if="getMainImage(recipe)" :src="getMainImage(recipe)" :alt="recipe.title" loading="lazy"
                                class="h-full w-full object-cover" />
                            <div v-else class="h-full w-full flex items-center justify-center text-gray-400 dark:text-gray-600 text-sm">
                                No image
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 p-5 sm:p-6 flex flex-col justify-between gap-4">
                            <div>
                                <div class="flex flex-wrap items-start gap-2 mb-2">
                                    <h3 class="font-bold text-gray-900 dark:text-white text-lg flex-1 min-w-0">{{ recipe.title }}</h3>
                                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-bold capitalize flex-shrink-0"
                                        :class="statusColors[recipe.status]">
                                        {{ recipe.status }}
                                    </span>
                                </div>

                                <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-gray-500 dark:text-gray-400">
                                    <span>By <strong class="text-gray-700 dark:text-gray-300">{{ recipe.author_name }}</strong></span>
                                    <span v-if="recipe.category">{{ recipe.category.name }}</span>
                                    <span v-if="recipe.user" class="text-xs">(User: {{ recipe.user.name }})</span>
                                    <span>{{ recipe.cook_time }} min</span>
                                    <span class="capitalize">{{ recipe.difficulty }}</span>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <button v-if="recipe.status !== 'approved'" @click="approve(recipe)"
                                    class="rounded-lg px-4 py-2 text-xs font-bold bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400 hover:bg-emerald-100 dark:hover:bg-emerald-900/50 transition-colors">
                                    Approve
                                </button>
                                <button v-if="recipe.status !== 'rejected'" @click="reject(recipe)"
                                    class="rounded-lg px-4 py-2 text-xs font-bold bg-amber-50 dark:bg-amber-950/50 text-amber-700 dark:text-amber-400 hover:bg-amber-100 dark:hover:bg-amber-900/50 transition-colors">
                                    Reject
                                </button>
                                <a :href="`/recipes/${recipe.id}`" target="_blank"
                                    class="rounded-lg px-4 py-2 text-xs font-bold text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                    View
                                </a>
                                <button @click="deleteRecipe(recipe)"
                                    class="rounded-lg px-4 py-2 text-xs font-bold transition-colors"
                                    :class="confirmDelete === recipe.id
                                        ? 'bg-red-600 text-white'
                                        : 'text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/30'">
                                    {{ confirmDelete === recipe.id ? 'Confirm Delete?' : 'Delete' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="!recipes.data?.length" class="rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-10 text-center text-gray-400 dark:text-gray-500">
                No recipes found.
            </div>

            <!-- Pagination -->
            <div v-if="recipes.links?.length > 3" class="flex items-center justify-center gap-1">
                <button v-for="link in recipes.links" :key="link.label" :disabled="!link.url"
                    @click="link.url && router.get(link.url, {}, { preserveState: true })"
                    class="min-w-[2rem] rounded-lg px-3 py-1.5 text-xs font-semibold transition"
                    :class="!link.url ? 'text-gray-300 dark:text-gray-600' : link.active ? 'bg-gray-900 dark:bg-orange-600 text-white' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800'"
                    v-html="link.label" />
            </div>
        </div>
    </AdminLayout>
</template>
