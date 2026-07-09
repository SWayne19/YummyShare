<script setup>
import { ref, computed, onMounted } from "vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import { useTheme } from "../../composables/useTheme.js";

const { isDark, toggle: toggleTheme, init } = useTheme();
onMounted(() => init());

const page = usePage();
const user = computed(() => page.props.auth?.user);
const currentPath = computed(() => page.url ?? "");
const sidebarOpen = ref(false);

const flash = computed(() => page.props.flash || {});
const showFlash = ref(false);

import { watch } from "vue";
watch(flash, (val) => {
    if (val?.success || val?.error) {
        showFlash.value = true;
        setTimeout(() => (showFlash.value = false), 4000);
    }
}, { deep: true, immediate: true });

const navItems = [
    { name: "Dashboard", href: "/admin", icon: "dashboard" },
    { name: "Users", href: "/admin/users", icon: "users" },
    { name: "Categories", href: "/admin/categories", icon: "categories" },
    { name: "Recipes", href: "/admin/recipes", icon: "recipes" },
];

function isActive(href) {
    if (href === '/admin') return currentPath.value === '/admin';
    return currentPath.value.startsWith(href);
}

const logout = () => router.post('/logout');
</script>

<template>
    <div class="flex min-h-screen bg-gray-50 dark:bg-gray-950 transition-colors duration-300">

        <!-- Mobile overlay -->
        <transition enter-active-class="transition-opacity duration-300" enter-from-class="opacity-0" enter-to-class="opacity-100"
            leave-active-class="transition-opacity duration-300" leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-if="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/50 lg:hidden"></div>
        </transition>

        <!-- Sidebar -->
        <aside :class="[
            'fixed inset-y-0 left-0 z-50 w-64 transform transition-transform duration-300 lg:translate-x-0 lg:static lg:z-auto',
            sidebarOpen ? 'translate-x-0' : '-translate-x-full'
        ]"
            class="flex flex-col bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800">

            <div class="flex items-center justify-between h-14 px-6 border-b border-gray-100 dark:border-gray-800">
                <Link href="/" class="flex items-center gap-2">
                    <span class="text-lg font-extrabold text-gray-900 dark:text-white">
                        Yummy<span class="text-orange-600">Share</span>
                    </span>
                </Link>
                <button @click="sidebarOpen = false" class="lg:hidden p-1 rounded-lg text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-800">
                <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Admin Panel</p>
            </div>

            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <Link v-for="item in navItems" :key="item.href" :href="item.href" @click="sidebarOpen = false"
                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200"
                    :class="isActive(item.href)
                        ? 'bg-orange-50 dark:bg-orange-950/50 text-orange-700 dark:text-orange-400 shadow-sm'
                        : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white'">

                    <!-- Dashboard -->
                    <svg v-if="item.icon === 'dashboard'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                    <!-- Users -->
                    <svg v-else-if="item.icon === 'users'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <!-- Categories -->
                    <svg v-else-if="item.icon === 'categories'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>
                    <!-- Recipes -->
                    <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>

                    {{ item.name }}
                </Link>
            </nav>

            <div class="p-4 border-t border-gray-100 dark:border-gray-800 space-y-2">
                <button @click="toggleTheme"
                    class="flex w-full items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">
                    <svg v-if="isDark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0Z" />
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z" clip-rule="evenodd" />
                    </svg>
                    {{ isDark ? 'Light Mode' : 'Dark Mode' }}
                </button>

                <div class="flex items-center gap-2.5 px-3 py-2">
                    <div class="h-7 w-7 rounded-full bg-orange-100 dark:bg-orange-900/50 flex items-center justify-center text-orange-600 dark:text-orange-400 font-bold text-sm">
                        {{ user?.name?.charAt(0)?.toUpperCase() }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ user?.name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ user?.email }}</p>
                    </div>
                </div>

                <button @click="logout"
                    class="flex w-full items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/30 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Logout
                </button>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top bar -->
            <header class="sticky top-0 z-30 flex items-center h-14 px-4 sm:px-6 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border-b border-gray-200 dark:border-gray-800">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <div class="flex-1"></div>

                <Link href="/" class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors">
                    &larr; Back to Site
                </Link>
            </header>

            <!-- Flash message -->
            <transition enter-active-class="transition duration-300 ease-out" enter-from-class="opacity-0 -translate-y-2" enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition duration-200 ease-in" leave-from-class="opacity-100" leave-to-class="opacity-0">
                <div v-if="showFlash && (flash.success || flash.error)" class="mx-4 sm:mx-6 mt-4">
                    <div class="flex items-center gap-3 rounded-xl border px-3 py-2 text-sm font-bold"
                        :class="flash.success
                            ? 'border-emerald-200 dark:border-emerald-800 bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-300'
                            : 'border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-950/50 text-red-700 dark:text-red-300'">
                        <span v-if="flash.success">&#10003;</span>
                        <span v-else>!</span>
                        {{ flash.success || flash.error }}
                    </div>
                </div>
            </transition>

            <!-- Page content -->
            <main class="flex-1 p-4 sm:p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
