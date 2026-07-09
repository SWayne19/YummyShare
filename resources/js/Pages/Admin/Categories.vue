<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import AdminLayout from "./Layout.vue";

const props = defineProps({
    categories: Object,
    filters: Object,
});

const search = ref(props.filters?.search || "");

let searchTimeout;
watch(search, () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get("/admin/categories", {
            search: search.value || undefined,
        }, { preserveState: true, replace: true });
    }, 300);
});

const showModal = ref(false);
const editingCategory = ref(null);

const form = useForm({
    name: '',
    description: '',
    image: '',
});

const openCreate = () => {
    editingCategory.value = null;
    form.reset();
    form.clearErrors();
    showModal.value = true;
};

const openEdit = (category) => {
    editingCategory.value = category;
    form.name = category.name;
    form.description = category.description || '';
    form.image = category.image || '';
    form.clearErrors();
    showModal.value = true;
};

const submitForm = () => {
    if (editingCategory.value) {
        form.put(`/admin/categories/${editingCategory.value.id}`, {
            onSuccess: () => { showModal.value = false; },
            preserveScroll: true,
        });
    } else {
        form.post('/admin/categories', {
            onSuccess: () => { showModal.value = false; form.reset(); },
            preserveScroll: true,
        });
    }
};

const confirmDelete = ref(null);

const deleteCategory = (category) => {
    if (confirmDelete.value === category.id) {
        router.delete(`/admin/categories/${category.id}`, { preserveScroll: true });
        confirmDelete.value = null;
    } else {
        confirmDelete.value = category.id;
        setTimeout(() => { confirmDelete.value = null; }, 3000);
    }
};
</script>

<template>
    <Head title="Manage Categories" />
    <AdminLayout>
        <div class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-xl sm:text-2xl font-black text-gray-900 dark:text-white">Categories</h1>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Manage recipe categories</p>
                </div>
                <button @click="openCreate"
                    class="inline-flex items-center gap-2 rounded-xl bg-gray-900 dark:bg-white/10 px-4 py-2.5 text-sm font-bold text-white hover:bg-black dark:hover:bg-white/20 transition-all shadow-sm">
                    + Add Category
                </button>
            </div>

            <input v-model="search" type="text" placeholder="Search categories..."
                class="w-full sm:max-w-xs rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2.5 text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500 transition-all" />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div v-for="category in categories.data" :key="category.id"
                    class="rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden group">

                    <div class="relative h-32 bg-gray-100 dark:bg-gray-800 overflow-hidden">
                        <img v-if="category.image" :src="category.image" :alt="category.name" loading="lazy"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <div v-else class="h-full w-full flex items-center justify-center text-gray-400 dark:text-gray-600">
                            No image
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="flex items-start justify-between gap-2 mb-2">
                            <h3 class="font-bold text-gray-900 dark:text-white text-base">{{ category.name }}</h3>
                            <span class="inline-flex items-center rounded-full bg-gray-100 dark:bg-gray-800 px-2.5 py-1 text-xs font-semibold text-gray-600 dark:text-gray-400 flex-shrink-0">
                                {{ category.recipes_count || 0 }} recipes
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4">{{ category.description || 'No description' }}</p>

                        <div class="flex gap-2">
                            <button @click="openEdit(category)"
                                class="flex-1 rounded-lg px-3 py-2 text-xs font-semibold text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors text-center">
                                Edit
                            </button>
                            <button @click="deleteCategory(category)"
                                class="rounded-lg px-3 py-2 text-xs font-semibold transition-colors"
                                :class="confirmDelete === category.id
                                    ? 'bg-red-600 text-white'
                                    : 'text-red-600 dark:text-red-400 border border-red-200 dark:border-red-900 hover:bg-red-50 dark:hover:bg-red-950/30'">
                                {{ confirmDelete === category.id ? 'Confirm?' : 'Delete' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="!categories.data?.length" class="rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-10 text-center text-gray-400 dark:text-gray-500">
                No categories found.
            </div>

            <div v-if="categories.links?.length > 3" class="flex items-center justify-center gap-1">
                <button v-for="link in categories.links" :key="link.label" :disabled="!link.url"
                    @click="link.url && router.get(link.url, {}, { preserveState: true })"
                    class="min-w-[2rem] rounded-lg px-3 py-1.5 text-xs font-semibold transition"
                    :class="!link.url ? 'text-gray-300 dark:text-gray-600' : link.active ? 'bg-gray-900 dark:bg-orange-600 text-white' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800'"
                    v-html="link.label" />
            </div>
        </div>

        <!-- Modal -->
        <transition enter-active-class="transition duration-200 ease-out" enter-from-class="opacity-0" enter-to-class="opacity-100"
            leave-active-class="transition duration-150 ease-in" leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-if="showModal" class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50" @click.self="showModal = false">
                <div class="w-full max-w-md rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl p-5 sm:p-6 space-y-5"
                    @click.stop>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">{{ editingCategory ? 'Edit Category' : 'Create Category' }}</h2>

                    <form @submit.prevent="submitForm" class="space-y-4">
                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-200">Name</label>
                            <input v-model="form.name" type="text" required
                                class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-3 py-2.5 text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500" />
                            <p v-if="form.errors.name" class="text-red-500 text-xs">{{ form.errors.name }}</p>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-200">Description</label>
                            <textarea v-model="form.description" rows="3"
                                class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-3 py-2.5 text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500 resize-none"></textarea>
                            <p v-if="form.errors.description" class="text-red-500 text-xs">{{ form.errors.description }}</p>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-200">Image URL</label>
                            <input v-model="form.image" type="text" required placeholder="https://..."
                                class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-3 py-2.5 text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500" />
                            <p v-if="form.errors.image" class="text-red-500 text-xs">{{ form.errors.image }}</p>
                            <div v-if="form.image" class="mt-2 h-24 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-800">
                                <img :src="form.image" alt="Preview" class="h-full w-full object-cover" />
                            </div>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="showModal = false"
                                class="flex-1 rounded-xl border border-gray-200 dark:border-gray-700 px-4 py-2.5 text-sm font-bold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" :disabled="form.processing"
                                class="flex-1 rounded-xl bg-gradient-to-r from-orange-500 to-red-600 px-4 py-2.5 text-sm font-bold text-white hover:shadow-lg transition-all disabled:opacity-70">
                                {{ form.processing ? 'Saving...' : (editingCategory ? 'Update' : 'Create') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </transition>
    </AdminLayout>
</template>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
