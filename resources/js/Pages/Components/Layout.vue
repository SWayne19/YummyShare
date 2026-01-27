<script setup>
import { ref, computed, watch } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const mobileMenuOpen = ref(false);
const page = usePage();
const currentPath = computed(() => page.url ?? "/");

const navLinks = [
    { name: "Fresh Recipes", href: "/" },
    { name: "Categories", href: "/categories" },
    { name: "Popular", href: "/popular" },
];

function isActive(path) {
    return currentPath.value === path || currentPath.value.startsWith(path + "/");
}

const toggleMenu = () => (mobileMenuOpen.value = !mobileMenuOpen.value);
const closeMenu = () => (mobileMenuOpen.value = false);

const flash = computed(() => page.props.flash || {});
const showFlash = ref(false);

watch(flash, (val) => {
    if (val?.success || val?.error) {
        showFlash.value = true;
        setTimeout(() => (showFlash.value = false), 4000);
    }
}, { deep: true, immediate: true });
</script>

<template>
    <div
        class="min-h-screen bg-white font-sans text-gray-900 selection:bg-orange-100 selection:text-orange-900 overflow-x-hidden">

        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
            <div
                class="absolute top-0 left-1/4 h-[500px] w-[500px] -translate-y-1/2 -translate-x-1/2 rounded-full bg-orange-200/30 blur-[100px] animate-blob">
            </div>
            <div
                class="absolute top-1/2 right-1/4 h-[400px] w-[400px] -translate-y-1/2 translate-x-1/2 rounded-full bg-red-200/30 blur-[100px] animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute bottom-0 left-1/3 h-[600px] w-[600px] translate-y-1/2 -translate-x-1/2 rounded-full bg-yellow-100/40 blur-[100px] animate-blob animation-delay-4000">
            </div>
        </div>

        <nav class="fixed top-0 z-40 w-full border-b border-gray-100 bg-white/80 backdrop-blur-xl transition-all">
            <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

                <div class="flex items-center gap-8">
                    <Link href="/" class="flex items-center gap-2.5 group">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-tr from-orange-500 to-red-500 text-white shadow-lg shadow-orange-200 transition-transform group-hover:scale-105 group-hover:rotate-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="h-6 w-6">
                                <path fill-rule="evenodd"
                                    d="M12.963 2.286a.75.75 0 0 0-1.071-.136 9.742 9.742 0 0 0-3.539 6.177 7.547 7.547 0 0 1-1.705-1.715.75.75 0 0 0-1.152-.082A9 9 0 1 0 15.68 4.534a7.46 7.46 0 0 1-2.717-2.248ZM15.75 14.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm-2.125.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-xl font-extrabold tracking-tight text-gray-900">
                            Yummy<span class="text-orange-600">Share</span>
                        </span>
                    </Link>

                    <div class="hidden md:flex md:gap-1">
                        <Link v-for="link in navLinks" :key="link.href" :href="link.href" :class="[
                            'rounded-full px-4 py-2 text-sm font-bold transition-colors',
                            isActive(link.href) ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600'
                        ]">
                            {{ link.name }}
                        </Link>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <Link href="/recipes/create"
                        class="hidden sm:flex items-center gap-2 rounded-full bg-gray-900 px-5 py-2.5 text-sm font-bold text-white transition-transform hover:-translate-y-0.5 hover:bg-gray-800 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path
                                d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                        </svg>
                        Share Recipe
                    </Link>

                    <button @click="toggleMenu" class="md:hidden rounded-lg p-2 text-gray-900 hover:bg-gray-100">
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
                class="fixed inset-x-0 top-20 z-30 border-b border-gray-100 bg-white px-4 pb-6 pt-2 shadow-xl md:hidden">
                <nav class="flex flex-col gap-2">
                    <Link v-for="link in navLinks" :key="link.href" :href="link.href" @click="closeMenu"
                        class="block rounded-lg px-4 py-3 text-base font-bold text-gray-900 hover:bg-gray-50">
                        {{ link.name }}
                    </Link>
                    <hr class="my-2 border-gray-100">
                    <Link href="/recipes/create" @click="closeMenu"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-orange-600 px-4 py-3 text-base font-bold text-white active:bg-orange-700">
                        + Submit Recipe
                    </Link>
                </nav>
            </div>
        </transition>

        <transition name="slide-fade">
            <div v-if="showFlash && (flash.success || flash.error)"
                class="fixed left-1/2 top-24 z-50 flex -translate-x-1/2 justify-center px-4 w-full max-w-md">
                <div class="flex w-full items-center gap-3 rounded-2xl border px-4 py-3 shadow-2xl backdrop-blur-xl"
                    :class="flash.success ? 'border-emerald-200 bg-emerald-50/95 text-emerald-900' : 'border-red-200 bg-red-50/95 text-red-900'">
                    <div class="flex-shrink-0">
                        <div v-if="flash.success"
                            class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-200 text-emerald-700">
                            ✓</div>
                        <div v-else
                            class="flex h-6 w-6 items-center justify-center rounded-full bg-red-200 text-red-700">!
                        </div>
                    </div>
                    <p class="text-sm font-bold">{{ flash.success || flash.error }}</p>
                </div>
            </div>
        </transition>

        <main class="relative pt-20 pb-12">
            <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                <slot />
            </div>
        </main>

        <footer class="border-t border-gray-100 bg-white/50 backdrop-blur-sm py-12">
            <div
                class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col items-center justify-between gap-6 sm:flex-row">
                <div class="flex items-center gap-2">
                    <div class="h-6 w-6 rounded-full bg-gray-200"></div>
                    <span class="text-sm font-bold text-gray-900">YummyShare</span>
                </div>
                <p class="text-sm font-medium text-gray-500">
                    &copy; {{ new Date().getFullYear() }} All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</template>

<style scoped>
/* Flash Message Animation */
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.3s ease;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateY(-20px) translateX(-50%);
    opacity: 0;
}

/* Background Blob Animation */
@keyframes blob {
    0% {
        transform: translate(0px, 0px) scale(1);
    }

    33% {
        transform: translate(30px, -50px) scale(1.1);
    }

    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }

    100% {
        transform: translate(0px, 0px) scale(1);
    }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}
</style>
