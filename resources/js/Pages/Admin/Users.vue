<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import AdminLayout from "./Layout.vue";

const props = defineProps({
    users: Object,
    filters: Object,
});

const search = ref(props.filters?.search || "");
const roleFilter = ref(props.filters?.role || "");

let searchTimeout;
watch([search, roleFilter], () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get("/admin/users", {
            search: search.value || undefined,
            role: roleFilter.value || undefined,
        }, { preserveState: true, replace: true });
    }, 300);
});

// Modal state
const showModal = ref(false);
const editingUser = ref(null);

const form = useForm({
    name: '',
    email: '',
    password: '',
    role: 'user',
});

const openCreate = () => {
    editingUser.value = null;
    form.reset();
    form.clearErrors();
    showModal.value = true;
};

const openEdit = (user) => {
    editingUser.value = user;
    form.name = user.name;
    form.email = user.email;
    form.role = user.role;
    form.password = '';
    form.clearErrors();
    showModal.value = true;
};

const submitForm = () => {
    if (editingUser.value) {
        form.put(`/admin/users/${editingUser.value.id}`, {
            onSuccess: () => { showModal.value = false; },
            preserveScroll: true,
        });
    } else {
        form.post('/admin/users', {
            onSuccess: () => { showModal.value = false; form.reset(); },
            preserveScroll: true,
        });
    }
};

const confirmDelete = ref(null);

const deleteUser = (user) => {
    if (confirmDelete.value === user.id) {
        router.delete(`/admin/users/${user.id}`, { preserveScroll: true });
        confirmDelete.value = null;
    } else {
        confirmDelete.value = user.id;
        setTimeout(() => { confirmDelete.value = null; }, 3000);
    }
};

const roleColors = {
    admin: 'bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300',
    user: 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300',
};
</script>

<template>
    <Head title="Manage Users" />
    <AdminLayout>
        <div class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-black text-gray-900 dark:text-white">Users</h1>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Manage platform users</p>
                </div>
                <button @click="openCreate"
                    class="inline-flex items-center gap-2 rounded-xl bg-gray-900 dark:bg-white/10 px-5 py-3 text-sm font-bold text-white hover:bg-black dark:hover:bg-white/20 transition-all shadow-sm">
                    + Add User
                </button>
            </div>

            <!-- Filters -->
            <div class="flex flex-col sm:flex-row gap-3">
                <input v-model="search" type="text" placeholder="Search users..."
                    class="flex-1 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500 transition-all" />
                <select v-model="roleFilter"
                    class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-sm text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500">
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <!-- Table -->
            <div class="rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <th class="text-left px-5 sm:px-6 py-3 font-semibold text-gray-500 dark:text-gray-400">Name</th>
                                <th class="text-left px-4 py-3 font-semibold text-gray-500 dark:text-gray-400 hidden sm:table-cell">Email</th>
                                <th class="text-left px-4 py-3 font-semibold text-gray-500 dark:text-gray-400">Role</th>
                                <th class="text-right px-5 sm:px-6 py-3 font-semibold text-gray-500 dark:text-gray-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in users.data" :key="user.id"
                                class="border-b border-gray-50 dark:border-gray-800/50 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-5 sm:px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-8 w-8 rounded-full bg-orange-100 dark:bg-orange-900/50 flex items-center justify-center text-orange-600 dark:text-orange-400 font-bold text-xs flex-shrink-0">
                                            {{ user.name.charAt(0).toUpperCase() }}
                                        </div>
                                        <span class="font-semibold text-gray-900 dark:text-white truncate">{{ user.name }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-gray-600 dark:text-gray-400 hidden sm:table-cell">{{ user.email }}</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-bold capitalize" :class="roleColors[user.role]">
                                        {{ user.role }}
                                    </span>
                                </td>
                                <td class="px-5 sm:px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button @click="openEdit(user)"
                                            class="rounded-lg px-3 py-1.5 text-xs font-semibold text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                                            Edit
                                        </button>
                                        <button @click="deleteUser(user)"
                                            class="rounded-lg px-3 py-1.5 text-xs font-semibold transition-colors"
                                            :class="confirmDelete === user.id
                                                ? 'bg-red-600 text-white'
                                                : 'text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/30'">
                                            {{ confirmDelete === user.id ? 'Confirm?' : 'Delete' }}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div v-if="!users.data?.length" class="p-10 text-center text-gray-400 dark:text-gray-500">No users found.</div>

                <!-- Pagination -->
                <div v-if="users.links?.length > 3" class="flex items-center justify-center gap-1 px-6 py-4 border-t border-gray-100 dark:border-gray-800">
                    <button v-for="link in users.links" :key="link.label" :disabled="!link.url"
                        @click="link.url && router.get(link.url, {}, { preserveState: true })"
                        class="min-w-[2rem] rounded-lg px-3 py-1.5 text-xs font-semibold transition"
                        :class="!link.url ? 'text-gray-300 dark:text-gray-600' : link.active ? 'bg-gray-900 dark:bg-orange-600 text-white' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800'"
                        v-html="link.label" />
                </div>
            </div>
        </div>

        <!-- Modal -->
        <transition enter-active-class="transition duration-200 ease-out" enter-from-class="opacity-0" enter-to-class="opacity-100"
            leave-active-class="transition duration-150 ease-in" leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-if="showModal" class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50" @click.self="showModal = false">
                <div class="w-full max-w-md rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl p-6 sm:p-8 space-y-5"
                    @click.stop>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ editingUser ? 'Edit User' : 'Create User' }}</h2>

                    <form @submit.prevent="submitForm" class="space-y-4">
                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-200">Name</label>
                            <input v-model="form.name" type="text" required
                                class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-4 py-3 text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500" />
                            <p v-if="form.errors.name" class="text-red-500 text-xs">{{ form.errors.name }}</p>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-200">Email</label>
                            <input v-model="form.email" type="email" required
                                class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-4 py-3 text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500" />
                            <p v-if="form.errors.email" class="text-red-500 text-xs">{{ form.errors.email }}</p>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-200">
                                Password {{ editingUser ? '(leave blank to keep)' : '' }}
                            </label>
                            <input v-model="form.password" type="password" :required="!editingUser"
                                class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-4 py-3 text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500" />
                            <p v-if="form.errors.password" class="text-red-500 text-xs">{{ form.errors.password }}</p>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-200">Role</label>
                            <select v-model="form.role"
                                class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-4 py-3 text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500/30 focus:border-orange-500">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="showModal = false"
                                class="flex-1 rounded-xl border border-gray-200 dark:border-gray-700 px-4 py-3 text-sm font-bold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" :disabled="form.processing"
                                class="flex-1 rounded-xl bg-gradient-to-r from-orange-500 to-red-600 px-4 py-3 text-sm font-bold text-white hover:shadow-lg transition-all disabled:opacity-70">
                                {{ form.processing ? 'Saving...' : (editingUser ? 'Update' : 'Create') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </transition>
    </AdminLayout>
</template>
