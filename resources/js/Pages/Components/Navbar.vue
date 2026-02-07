<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const mobileMenuOpen = ref(false);
const page = usePage();
const currentPath = computed(() => page.url ?? "/");
const isHome = computed(() => currentPath.value === "/");

// --- Scroll Logic ---
const isScrolled = ref(false);

const handleScroll = () => {
    // Enable scroll detection for ALL pages
    isScrolled.value = window.scrollY > 20;
};

onMounted(() => {
    window.addEventListener("scroll", handleScroll);
    handleScroll(); // Check initial state
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

// --- DYNAMIC CLASSES ---

// 1. Navbar Background
// NOW: Transparent at top for ALL pages. Glass when scrolled for ALL pages.
const navBgClass = computed(() => {
    return isScrolled.value
        ? "ios-glass-scrolled border-b border-white/40"
        : "bg-transparent border-b border-transparent shadow-none";
});

// 2. Nav Link Colors
function navLinkClass(linkHref) {
    // If Scrolled: Always dark text (because glass background is white-ish)
    if (isScrolled.value) {
        return isActive(linkHref)
            ? "bg-black/80 text-white ios-glass-active shadow-md"
            : "text-gray-700 hover:bg-white/40 hover:text-orange-600";
    }

    // If NOT Scrolled (Top of page):
    if (isHome.value) {
        // Home Page = White Text (Overlaying video/hero)
        return isActive(linkHref)
            ? "bg-white/20 text-white shadow-md font-bold"
            : "text-white hover:bg-white/30 hover:text-orange-500";
    } else {
        // Other Pages = Dark Text (Overlaying white page background)
        return isActive(linkHref)
            ? "bg-gray-900 text-white ios-glass-active shadow-md"
            : "text-gray-900 hover:bg-gray-100 hover:text-orange-600";
    }
}

// 3. Logo Text Color
const logoTextClass = computed(() => {
    if (isScrolled.value) return "text-gray-900"; // Scrolled = Dark
    return isHome.value ? "text-white" : "text-gray-900"; // Top: Home=White, Others=Dark
});

// 4. Share Recipe Button
function shareRecipeClass() {
    if (isScrolled.value) {
        return "bg-white/60 text-gray-900 ios-glass-action hover:bg-white/90 border border-white/40 backdrop-blur-[12px]";
    }

    if (isHome.value) {
        return "bg-white/20 text-white hover:bg-white/30 border border-white/30";
    } else {
        return "bg-orange-500 text-white hover:bg-orange-600 border border-orange-600";
    }
}

function shareRecipeIconClass() {
    if (isScrolled.value) return "text-orange-500"; // Scrolled

    // Top of page
    return isHome.value ? "text-orange-300" : "text-white";
}

// 5. Mobile Menu Button
function menuButtonClass() {
    if (isScrolled.value) return "text-gray-900 hover:bg-white/65";
    return isHome.value ? "text-white hover:bg-white/20" : "text-gray-900 hover:bg-gray-100";
}

// Mobile helpers
function mobileNavLinkClass() {
    return "block rounded-lg px-4 py-3 text-base font-bold text-gray-900 hover:bg-orange-100 hover:text-orange-700 transition-colors duration-200 ios-glass-link";
}
function mobileShareRecipeClass() {
    return "flex w-full items-center justify-center gap-2 rounded-xl bg-orange-500 px-4 py-3 text-base font-bold text-white active:bg-orange-700 hover:bg-orange-600 shadow-md ios-glass-action transition-all";
}

const toggleMenu = () => (mobileMenuOpen.value = !mobileMenuOpen.value);
const closeMenu = () => (mobileMenuOpen.value = false);
</script>

<template>
    <nav :class="[
        'fixed top-0 left-0 right-0 z-50 h-20 transition-all duration-500 ease-in-out',
        navBgClass
    ]">

        <div class="mx-auto flex h-full max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

            <div class="flex items-center gap-8">
                <Link href="/" class="flex items-center gap-2.5 group">
                    <span :class="[
                        'text-xl font-extrabold tracking-tight glassy-text transition-colors',
                        logoTextClass
                    ]">
                        Yummy<span class="text-orange-600">Share</span>
                    </span>
                </Link>

                <div class="hidden md:flex md:gap-1">
                    <Link v-for="link in navLinks" :key="link.href" :href="link.href" :class="[
                        'rounded-full px-4 py-2 text-sm font-bold transition-all duration-300',
                        navLinkClass(link.href)
                    ]">
                        {{ link.name }}
                    </Link>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <Link :href="route('recipes.create')" :class="[
                    'hidden sm:flex items-center gap-2 rounded-full px-5 py-2.5 text-sm font-bold shadow group transition-all hover:-translate-y-0.5',
                    shareRecipeClass()
                ]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-4 h-4 transition-transform duration-300 group-hover:rotate-[360deg]"
                        :class="shareRecipeIconClass()">
                        <path
                            d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                    </svg>
                    <span class="font-semibold">Share Recipe</span>
                </Link>

                <button @click="toggleMenu" :class="[
                    'md:hidden rounded-lg p-2 transition ios-glass-action',
                    menuButtonClass()
                ]">
                    <svg v-if="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" class="h-7 w-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="h-7 w-7">
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
            class="fixed inset-x-0 top-20 z-40 border-b px-4 pb-6 pt-2 shadow-2xl md:hidden ios-glass-navmenu">
            <nav class="flex flex-col gap-2">
                <Link v-for="link in navLinks" :key="link.href" :href="link.href" @click="closeMenu"
                    :class="mobileNavLinkClass()">
                    <span class="text-gray-900">{{ link.name }}</span>
                </Link>
                <hr class="my-2 border-white/20">
                <Link :href="route('recipes.create')" @click="closeMenu" :class="mobileShareRecipeClass()">
                    <span class="text-white">+ Share Recipe</span>
                </Link>
            </nav>
        </div>
    </transition>
</template>

<style scoped>
/* Glass Effect (Applied when scrolled) */
.ios-glass-scrolled {
    background: rgba(255, 255, 255, 0.65);
    box-shadow:
        0 2px 10px rgba(0, 0, 0, 0.08),
        0 6px 36px 4px rgba(0, 0, 0, 0.14),
        0 1.5px 8px 1.5px rgba(249, 115, 22, 0.08);
    backdrop-filter: blur(30px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
}

.ios-glass-navmenu {
    background: rgba(255, 255, 255, 0.85);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    border-radius: 0 0 1.5rem 1.5rem;
    backdrop-filter: blur(20px);
}

.ios-glass-link {
    background: rgba(255, 255, 255, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.ios-glass-active {
    background: #111 !important;
    color: white !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.ios-glass-action {
    background: rgba(255, 255, 255, 0.5);
    border: 1px solid rgba(255, 255, 255, 0.6);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.glassy-text {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.07);
}
</style>
