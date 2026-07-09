<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AdminLayout from "./Layout.vue";

defineProps({
    stats: Object,
    recentRecipes: Array,
});

const statCards = [
    { key: 'totalUsers', label: 'Total Users', color: 'blue', icon: 'users' },
    { key: 'totalRecipes', label: 'Total Recipes', color: 'green', icon: 'recipes' },
    { key: 'pendingRecipes', label: 'Pending Approval', color: 'orange', icon: 'pending' },
    { key: 'totalCategories', label: 'Categories', color: 'purple', icon: 'categories' },
];

const statusColors = {
    approved: 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300',
    pending: 'bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-300',
    rejected: 'bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300',
};
</script>

<template>
    <Head title="Admin Dashboard" />
    <AdminLayout>
        <div class="space-y-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-gray-900 dark:text-white">Dashboard</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Overview of your YummyShare platform</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div v-for="card in statCards" :key="card.key"
                    class="rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-4 sm:p-5 shadow-sm">
                    <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">{{ card.label }}</p>
                    <p class="text-xl sm:text-2xl font-black text-gray-900 dark:text-white">{{ stats[card.key] }}</p>
                </div>
            </div>

            <!-- Recent Recipes -->
            <div class="rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between px-4 sm:px-5 py-3 border-b border-gray-100 dark:border-gray-800">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Recent Recipes</h2>
                    <Link href="/admin/recipes" class="text-sm font-semibold text-orange-600 dark:text-orange-400 hover:text-orange-700">View all &rarr;</Link>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <th class="text-left px-4 sm:px-5 py-3 font-semibold text-gray-500 dark:text-gray-400">Title</th>
                                <th class="text-left px-4 py-3 font-semibold text-gray-500 dark:text-gray-400 hidden sm:table-cell">Author</th>
                                <th class="text-left px-4 py-3 font-semibold text-gray-500 dark:text-gray-400 hidden md:table-cell">Category</th>
                                <th class="text-left px-4 py-3 font-semibold text-gray-500 dark:text-gray-400">Status</th>
                                <th class="text-left px-4 py-3 font-semibold text-gray-500 dark:text-gray-400 hidden lg:table-cell">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="recipe in recentRecipes" :key="recipe.id"
                                class="border-b border-gray-50 dark:border-gray-800/50 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-4 sm:px-5 py-3 font-semibold text-gray-900 dark:text-white">{{ recipe.title }}</td>
                                <td class="px-4 py-3 text-gray-600 dark:text-gray-400 hidden sm:table-cell">{{ recipe.author_name }}</td>
                                <td class="px-4 py-3 text-gray-600 dark:text-gray-400 hidden md:table-cell">{{ recipe.category?.name || '-' }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-bold capitalize" :class="statusColors[recipe.status]">
                                        {{ recipe.status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-500 dark:text-gray-400 hidden lg:table-cell">{{ recipe.created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div v-if="!recentRecipes?.length" class="p-10 text-center text-gray-400 dark:text-gray-500">
                    No recipes yet.
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
