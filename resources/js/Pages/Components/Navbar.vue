<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import { useTheme } from "../../composables/useTheme.js";

const { isDark, toggle: toggleTheme } = useTheme();

const mobileMenuOpen = ref(false);
const userMenuOpen = ref(false);
const page = usePage();
const currentPath = computed(() => page.url ?? "/");
const isHome = computed(() => currentPath.value === "/");
const user = computed(() => page.props.auth?.user);
const isAdmin = computed(() => user.value?.role === 'admin');

const logout = () => {
    userMenuOpen.value = false;
    router.post('/logout');
};

const isScrolled = ref(false);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 20;
};

onMounted(() => {
    window.addEventListener("scroll", handleScroll, { passive: true });
    handleScroll();
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
});

const navLinks = [
    { name: "Home", href: "/" },
    { name: "Recipes", href: route('recipes.index') },
    { name: "About Us", href: "/aboutus" },
];

function isActive(path) {
    return (
        currentPath.value === path ||
        currentPath.value.startsWith(path + "/") ||
        (typeof path === "string" && path.includes('/recipes') && currentPath.value.startsWith('/recipes'))
    );
}

const navBgClass = computed(() => {
    if (isScrolled.value) {
        return isDark.value
            ? "nav-glass-dark nav-glass-scrolled border-b border-white/10"
            : "nav-glass-light nav-glass-scrolled border-b border-white/40";
    }
    return isDark.value
        ? "nav-glass-dark border-b border-white/5"
        : "nav-glass-light border-b border-transparent";
});

function navLinkClass(linkHref) {
    if (isScrolled.value) {
        return isActive(linkHref)
            ? "bg-black/80 dark:bg-white/20 text-white shadow-md"
            : "text-gray-700 dark:text-gray-200 hover:bg-white/40 dark:hover:bg-white/10 hover:text-orange-600";
    }

    if (isHome.value) {
        return isActive(linkHref)
            ? "bg-white/20 text-white shadow-md font-bold"
            : "text-white hover:bg-white/30 hover:text-orange-500";
    } else {
        return isActive(linkHref)
            ? "bg-gray-900 dark:bg-white/20 text-white shadow-md"
            : "text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-white/10 hover:text-orange-600";
    }
}

const logoTextClass = computed(() => {
    if (isScrolled.value) return "text-gray-900 dark:text-white";
    return isHome.value ? "text-white" : "text-gray-900 dark:text-white";
});

function shareRecipeClass() {
    if (isScrolled.value) {
        return isDark.value
            ? "bg-white/10 text-white hover:bg-white/20 border border-white/20 backdrop-blur-[12px]"
            : "bg-white/60 text-gray-900 hover:bg-white/90 border border-white/40 backdrop-blur-[12px]";
    }
    if (isHome.value) {
        return "bg-white/20 text-white hover:bg-white/30 border border-white/30";
    }
    return "bg-orange-500 text-white hover:bg-orange-600 border border-orange-600";
}

function shareRecipeIconClass() {
    if (isScrolled.value) return isDark.value ? "text-orange-400" : "text-orange-500";
    return isHome.value ? "text-orange-300" : "text-white";
}

function menuButtonClass() {
    if (isScrolled.value) return "text-gray-900 dark:text-white hover:bg-white/65 dark:hover:bg-white/10";
    return isHome.value ? "text-white hover:bg-white/20" : "text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-white/10";
}

function themeButtonClass() {
    if (isScrolled.value) return "text-gray-700 dark:text-gray-200 hover:bg-white/40 dark:hover:bg-white/10";
    if (isHome.value) return "text-white hover:bg-white/20";
    return "text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-white/10";
}

const toggleMenu = () => (mobileMenuOpen.value = !mobileMenuOpen.value);
const closeMenu = () => (mobileMenuOpen.value = false);
</script>

<template>
    <nav :class="[
        'fixed top-0 left-0 right-0 z-50 h-14 transition-all duration-500 ease-in-out',
        navBgClass
    ]">

        <div class="mx-auto flex h-full max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

            <div class="flex items-center gap-8">
                <Link href="/" class="flex items-center gap-2.5 group">
                    <span :class="[
                        'text-lg font-extrabold tracking-tight glassy-text transition-colors duration-300',
                        logoTextClass
                    ]">
                        Yummy<span class="text-orange-600 dark:text-orange-500">Share</span>
                    </span>
                </Link>

                <div class="hidden md:flex md:gap-1">
                    <Link v-for="link in navLinks" :key="link.href" :href="link.href" :class="[
                        'rounded-full px-3 py-1.5 text-sm font-bold transition-all duration-300',
                        navLinkClass(link.href)
                    ]">
                        {{ link.name }}
                    </Link>
                </div>
            </div>

            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Theme Toggle -->
                <button @click="toggleTheme" :class="[
                    'rounded-full p-2 transition-all duration-300',
                    themeButtonClass()
                ]" :aria-label="isDark ? 'Switch to light mode' : 'Switch to dark mode'">
                    <svg v-if="isDark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z" />
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z" clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Logged in: Share Recipe + User Menu -->
                <template v-if="user">
                    <Link :href="route('recipes.create')" :class="[
                        'hidden sm:flex items-center gap-2 rounded-full px-4 py-2 text-sm font-bold shadow group transition-all hover:-translate-y-0.5',
                        shareRecipeClass()
                    ]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="w-4 h-4 transition-transform duration-300 group-hover:rotate-[360deg]"
                            :class="shareRecipeIconClass()">
                            <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                        </svg>
                        <span class="font-semibold">Share Recipe</span>
                    </Link>

                    <!-- User avatar dropdown -->
                    <div class="relative hidden md:block">
                        <button @click="userMenuOpen = !userMenuOpen" :class="[
                            'flex items-center gap-2 rounded-full p-1 pr-3 transition-all duration-300',
                            isScrolled
                                ? (isDark ? 'hover:bg-white/10' : 'hover:bg-white/40')
                                : (isHome ? 'hover:bg-white/20' : 'hover:bg-gray-100 dark:hover:bg-white/10')
                        ]">
                            <div class="h-7 w-7 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold text-sm">
                                {{ user.name.charAt(0).toUpperCase() }}
                            </div>
                            <span :class="['text-sm font-semibold hidden lg:inline', logoTextClass]">{{ user.name }}</span>
                        </button>

                        <transition enter-active-class="transition duration-100 ease-out"
                            enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                            leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100"
                            leave-to-class="transform scale-95 opacity-0">
                            <div v-if="userMenuOpen" @click="userMenuOpen = false"
                                class="absolute right-0 mt-2 w-44 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-xl p-1.5 z-50">
                                <Link v-if="isAdmin" href="/admin"
                                    class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                                    </svg>
                                    Admin Panel
                                </Link>
                                <button @click="logout"
                                    class="flex w-full items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/30 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                    </svg>
                                    Logout
                                </button>
                            </div>
                        </transition>
                    </div>
                </template>

                <!-- Not logged in: Login/Register -->
                <template v-else>
                    <Link href="/login" :class="[
                        'hidden sm:inline-flex rounded-full px-4 py-2 text-sm font-bold transition-all duration-300',
                        navLinkClass('/login')
                    ]">Sign In</Link>
                    <Link href="/register" :class="[
                        'hidden sm:inline-flex items-center rounded-full px-4 py-2 text-sm font-bold shadow transition-all hover:-translate-y-0.5',
                        shareRecipeClass()
                    ]">Get Started</Link>
                </template>

                <button @click="toggleMenu" :class="[
                    'md:hidden rounded-lg p-2 transition',
                    menuButtonClass()
                ]">
                    <svg v-if="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <transition enter-active-class="transition duration-200 ease-out"
        enter-from-class="transform -translate-y-4 opacity-0" enter-to-class="transform translate-y-0 opacity-100"
        leave-active-class="transition duration-150 ease-in" leave-from-class="transform translate-y-0 opacity-100"
        leave-to-class="transform -translate-y-4 opacity-0">
        <div v-if="mobileMenuOpen"
            class="fixed inset-x-0 top-14 z-40 border-b px-4 pb-6 pt-2 shadow-2xl md:hidden ios-glass-navmenu">
            <nav class="flex flex-col gap-2">
                <Link v-for="link in navLinks" :key="link.href" :href="link.href" @click="closeMenu"
                    class="block rounded-lg px-3 py-2.5 text-sm font-bold text-gray-900 dark:text-gray-100 hover:bg-orange-100 dark:hover:bg-orange-900/30 hover:text-orange-700 dark:hover:text-orange-400 transition-colors duration-200 ios-glass-link">
                    <span>{{ link.name }}</span>
                </Link>
                <hr class="my-2 border-white/20 dark:border-white/10">
                <button @click="toggleTheme"
                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-gray-100 dark:bg-white/10 px-3 py-2.5 text-sm font-bold text-gray-700 dark:text-gray-200 transition-all">
                    <svg v-if="isDark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0Z" />
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z" clip-rule="evenodd" />
                    </svg>
                    {{ isDark ? 'Light Mode' : 'Dark Mode' }}
                </button>

                <template v-if="user">
                    <Link v-if="isAdmin" href="/admin" @click="closeMenu"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-gray-100 dark:bg-white/10 px-3 py-2.5 text-sm font-bold text-gray-700 dark:text-gray-200 transition-all">
                        Admin Panel
                    </Link>
                    <Link :href="route('recipes.create')" @click="closeMenu"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-orange-500 px-3 py-2.5 text-sm font-bold text-white active:bg-orange-700 hover:bg-orange-600 shadow-md transition-all">
                        + Share Recipe
                    </Link>
                    <button @click="logout(); closeMenu()"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-red-50 dark:bg-red-950/30 px-3 py-2.5 text-sm font-bold text-red-600 dark:text-red-400 transition-all">
                        Logout
                    </button>
                </template>
                <template v-else>
                    <Link href="/login" @click="closeMenu"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-gray-100 dark:bg-white/10 px-3 py-2.5 text-sm font-bold text-gray-700 dark:text-gray-200 transition-all">
                        Sign In
                    </Link>
                    <Link href="/register" @click="closeMenu"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-orange-500 px-3 py-2.5 text-sm font-bold text-white active:bg-orange-700 hover:bg-orange-600 shadow-md transition-all">
                        Get Started
                    </Link>
                </template>
            </nav>
        </div>
    </transition>
</template>

<style scoped>
/* Base glass layers — always visible, GPU-composited */
.nav-glass-light {
    will-change: backdrop-filter, background-color, box-shadow;
    background: rgba(255, 255, 255, 0.45);
    backdrop-filter: blur(12px) saturate(140%);
    -webkit-backdrop-filter: blur(12px) saturate(140%);
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
}

.nav-glass-dark {
    will-change: backdrop-filter, background-color, box-shadow;
    background: rgba(10, 10, 20, 0.5);
    backdrop-filter: blur(12px) saturate(140%);
    -webkit-backdrop-filter: blur(12px) saturate(140%);
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.15);
}

/* Scrolled — intensify glass effect */
.nav-glass-light.nav-glass-scrolled {
    background: rgba(255, 255, 255, 0.72);
    backdrop-filter: blur(28px) saturate(180%);
    -webkit-backdrop-filter: blur(28px) saturate(180%);
    box-shadow:
        0 2px 8px rgba(0, 0, 0, 0.07),
        0 4px 24px rgba(0, 0, 0, 0.1),
        0 1px 6px rgba(249, 115, 22, 0.06);
}

.nav-glass-dark.nav-glass-scrolled {
    background: rgba(10, 10, 20, 0.78);
    backdrop-filter: blur(28px) saturate(180%);
    -webkit-backdrop-filter: blur(28px) saturate(180%);
    box-shadow:
        0 2px 8px rgba(0, 0, 0, 0.25),
        0 4px 24px rgba(0, 0, 0, 0.35),
        0 1px 6px rgba(249, 115, 22, 0.08);
}

.ios-glass-navmenu {
    background: rgba(255, 255, 255, 0.88);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    border-radius: 0 0 1.5rem 1.5rem;
    backdrop-filter: blur(24px) saturate(160%);
    -webkit-backdrop-filter: blur(24px) saturate(160%);
}

:where(.dark) .ios-glass-navmenu {
    background: rgba(10, 10, 20, 0.92);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
}

.ios-glass-link {
    background: rgba(255, 255, 255, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

:where(.dark) .ios-glass-link {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.glassy-text {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.07);
}
</style>
