<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const mobileMenuOpen = ref(false);
const page = usePage();
const currentPath = computed(() => page.url ?? "/");

// --- Scroll Logic ---
const isScrolled = ref(false);

const handleScroll = () => {
    // Check if scrolled more than 20px
    isScrolled.value = window.scrollY > 20;
};

onMounted(() => {
    window.addEventListener("scroll", handleScroll);
    handleScroll(); // Check initial position
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
});
// --------------------

const navLinks = [
    { name: "Home", href: "/" },
    { name: "Categories", href: "/categories" },
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

const toggleMenu = () => (mobileMenuOpen.value = !mobileMenuOpen.value);
const closeMenu = () => (mobileMenuOpen.value = false);
</script>

<template>
    <nav :class="[
        'fixed top-0 left-0 right-0 z-50 h-20 transition-all duration-500 ease-in-out',
        isScrolled ? 'ios-glass-scrolled border-b border-white/40' : 'bg-transparent border-b border-transparent shadow-none'
    ]">

        <div class="mx-auto flex h-full max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

            <div class="flex items-center gap-8">
                <Link href="/" class="flex items-center gap-2.5 group">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-tr from-orange-500 to-red-500 text-white shadow-lg shadow-orange-200 transition-transform group-hover:scale-105 group-hover:rotate-3 ios-glass-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                            <path fill-rule="evenodd"
                                d="M12.963 2.286a.75.75 0 0 0-1.071-.136 9.742 9.742 0 0 0-3.539 6.177 7.547 7.547 0 0 1-1.705-1.715.75.75 0 0 0-1.152-.082A9 9 0 1 0 15.68 4.534a7.46 7.46 0 0 1-2.717-2.248ZM15.75 14.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm-2.125.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-gray-900 glassy-text">
                        Yummy<span class="text-orange-600">Share</span>
                    </span>
                </Link>

                <div class="hidden md:flex md:gap-1">
                    <Link v-for="link in navLinks" :key="link.href" :href="link.href" :class="[
                        'rounded-full px-4 py-2 text-sm font-bold transition-all duration-300',
                        (isActive(link.href)
                            ? 'bg-black/80 text-white ios-glass-active shadow-md'
                            : 'text-gray-700 hover:bg-white/40 hover:text-orange-600')
                    ]" prefetch="mount">
                        {{ link.name }}
                    </Link>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <Link :href="route('recipes.create')"
                    class="hidden sm:flex items-center gap-2 rounded-full bg-white/60 px-5 py-2.5 text-sm font-bold text-gray-900 shadow group ios-glass-action hover:bg-white/90 transition-all hover:-translate-y-0.5 border border-white/40 backdrop-blur-[12px]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-4 h-4 transition-transform duration-300 group-hover:rotate-[360deg] text-orange-500">
                        <path
                            d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                    </svg>
                    <span class="font-semibold">Share Recipe</span>
                </Link>

                <button @click="toggleMenu"
                    class="md:hidden rounded-lg p-2 text-gray-900 hover:bg-white/65 transition ios-glass-action">
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
                    class="block rounded-lg px-4 py-3 text-base font-bold text-gray-900 hover:bg-orange-100 hover:text-orange-700 transition-colors duration-200 ios-glass-link">
                    <span class="text-gray-900">{{ link.name }}</span>
                </Link>
                <hr class="my-2 border-white/20">
                <Link :href="route('recipes.create')" @click="closeMenu"
                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-orange-500 px-4 py-3 text-base font-bold text-white active:bg-orange-700 hover:bg-orange-600 shadow-md ios-glass-action transition-all">
                    <span class="text-orange-500">+ Share Recipe</span>
                </Link>
            </nav>
        </div>
    </transition>
</template>

<style scoped>
/* Only apply glass effect when scrolled */
.ios-glass-scrolled {
    background: rgba(255, 255, 255, 0.65);
    /* Semi-transparent white */
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
    /* Soft shadow */
    backdrop-filter: blur(30px) saturate(180%);
    /* Strong blur */
    -webkit-backdrop-filter: blur(20px) saturate(180%);
}

.ios-glass-navmenu {
    background: rgba(255, 255, 255, 0.85);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    border-radius: 0 0 1.5rem 1.5rem;
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

.ios-glass-icon {
    background: linear-gradient(135deg, #f97316 0%, #ef4444 100%);
    box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
}

.glassy-text {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    color: #1a1a1a;
}
</style>
