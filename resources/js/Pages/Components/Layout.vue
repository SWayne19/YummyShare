<script setup>
import { ref, computed, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import Navbar from "./Navbar.vue";
import Footer from "./Footer.vue";

const page = usePage();

// Flash Messages Logic
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
        class="relative flex min-h-screen flex-col bg-gradient-to-tr from-white/70 to-zinc-100/80 font-sans text-gray-900 selection:bg-orange-100 selection:text-orange-900 overflow-x-hidden backdrop-blur-2xl">

        <!-- Modern Glassy Blobs Background -->
        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none bg-white/20 backdrop-blur-xl">
            <div
                class="absolute top-0 left-1/4 h-[550px] w-[550px] -translate-y-1/2 -translate-x-1/2 rounded-full bg-gradient-to-tr from-orange-200/60 to-orange-400/30 shadow-xl shadow-orange-100/30 blur-[120px] animate-blob saturate-150">
            </div>
            <div
                class="absolute top-1/2 right-1/4 h-[440px] w-[440px] -translate-y-1/2 translate-x-1/2 rounded-full bg-gradient-to-tr from-red-200/60 to-red-400/20 shadow-xl shadow-red-100/20 blur-[100px] animate-blob animation-delay-2000 saturate-150">
            </div>
            <div
                class="absolute bottom-0 left-1/3 h-[620px] w-[620px] translate-y-1/2 -translate-x-1/2 rounded-full bg-gradient-to-t from-yellow-100/60 to-yellow-300/20 shadow-xl shadow-yellow-100/30 blur-[130px] animate-blob animation-delay-4000 saturate-150">
            </div>
        </div>

        <Navbar />

        <transition name="slide-fade">
            <div v-if="showFlash && (flash.success || flash.error)"
                class="fixed left-1/2 top-28 z-50 flex -translate-x-1/2 justify-center px-4 w-full max-w-md pointer-events-none">
                <div
                    class="flex w-full items-center gap-3 rounded-xl px-6 py-4 shadow-2xl pointer-events-auto border border-white/40 bg-white/50 backdrop-blur-2xl saturate-180 transition-all duration-300 glass-ui"
                    :class="flash.success ? 'ring-2 ring-emerald-200/60 text-emerald-900' : 'ring-2 ring-red-200/60 text-red-900'">
                    <div class="flex-shrink-0">
                        <div v-if="flash.success"
                            class="flex h-7 w-7 items-center justify-center rounded-full bg-gradient-to-br from-emerald-300/80 to-emerald-500/90 text-white shadow-lg">
                            ✓</div>
                        <div v-else
                            class="flex h-7 w-7 items-center justify-center rounded-full bg-gradient-to-br from-red-300/80 to-red-500/90 text-white shadow-lg">!
                        </div>
                    </div>
                    <p class="text-base font-semibold tracking-tight drop-shadow-lg glass-text">{{ flash.success || flash.error }}</p>
                </div>
            </div>
        </transition>

        <main class="flex-1 pt-20 relative z-0">
            <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                <slot />
            </div>
        </main>

        <Footer />

    </div>
</template>

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateY(-20px) translateX(-50%);
    opacity: 0;
}

@keyframes blob {
    0% {
        transform: translate(0px, 0px) scale(1);
    }

    33% {
        transform: translate(30px, -50px) scale(1.12);
    }

    66% {
        transform: translate(-20px, 20px) scale(0.94);
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

/* Glass UI add: */
.glass-ui {
    box-shadow: 0 4px 48px 0 rgba(30, 41, 59, 0.12), 0 1.5px 5px 0 rgba(255,255,255,0.04) inset;
    background: rgba(255,255,255,0.40);
    border: 1.5px solid rgba(255,255,255,0.25);
    backdrop-filter: blur(18px) saturate(175%);
    -webkit-backdrop-filter: blur(18px) saturate(175%);
}

.glass-text {
    color: #171717;
    text-shadow: 0 1px 10px rgba(255,255,255,0.45), 0 2px 8px rgba(255,169,55,0.13);
}

</style>
