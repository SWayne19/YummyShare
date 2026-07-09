<script setup>
import { ref, computed, watch, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import { useTheme } from "../../composables/useTheme.js";
import Navbar from "./Navbar.vue";
import Footer from "./Footer.vue";

const { init } = useTheme();
onMounted(() => init());

const page = usePage();
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
    <div class="relative flex min-h-screen flex-col bg-gray-50 dark:bg-gray-950 font-sans text-gray-900 dark:text-gray-100 overflow-x-hidden transition-colors duration-300">

        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none bg-white/30 dark:bg-gray-950/50 backdrop-blur-3xl transition-colors duration-300">
            <div class="absolute top-0 left-1/4 h-[500px] w-[500px] -translate-y-1/2 -translate-x-1/2 rounded-full bg-orange-200/40 dark:bg-orange-900/20 blur-[100px] animate-blob"></div>
            <div class="absolute top-1/2 right-1/4 h-[400px] w-[400px] -translate-y-1/2 translate-x-1/2 rounded-full bg-red-200/40 dark:bg-red-900/20 blur-[100px] animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-0 left-1/3 h-[600px] w-[600px] translate-y-1/2 -translate-x-1/2 rounded-full bg-yellow-100/40 dark:bg-yellow-900/15 blur-[100px] animate-blob animation-delay-4000"></div>
        </div>

        <Navbar />

        <transition name="slide-fade">
            <div v-if="showFlash && (flash.success || flash.error)" class="fixed left-1/2 top-24 z-[60] flex -translate-x-1/2 justify-center px-4 w-full max-w-md pointer-events-none">
                <div class="flex w-full items-center gap-3 rounded-2xl border px-4 py-3 shadow-2xl backdrop-blur-xl pointer-events-auto"
                    :class="flash.success
                        ? 'border-emerald-200 dark:border-emerald-800 bg-emerald-50/90 dark:bg-emerald-950/90 text-emerald-900 dark:text-emerald-100'
                        : 'border-red-200 dark:border-red-800 bg-red-50/90 dark:bg-red-950/90 text-red-900 dark:text-red-100'">
                    <div class="flex-shrink-0">
                        <div v-if="flash.success" class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-200 dark:bg-emerald-800 text-emerald-700 dark:text-emerald-300">&#10003;</div>
                        <div v-else class="flex h-6 w-6 items-center justify-center rounded-full bg-red-200 dark:bg-red-800 text-red-700 dark:text-red-300">!</div>
                    </div>
                    <p class="text-sm font-bold">{{ flash.success || flash.error }}</p>
                </div>
            </div>
        </transition>

        <main class="flex-1 relative z-0 pt-24">
            <div class="mx-auto">
                <slot />
            </div>
        </main>

        <Footer />
    </div>
</template>

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.3s ease;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateY(-20px) translateX(-50%);
    opacity: 0;
}

@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 { animation-delay: 2s; }
.animation-delay-4000 { animation-delay: 4s; }
</style>
