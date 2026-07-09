<script setup>
import { Link } from "@inertiajs/vue3";
import Layout from "./Components/Layout.vue";

defineProps({
    categories: Array
});
</script>

<template>
    <Layout>
        <div class="space-y-14 pb-8">

            <section
                class="relative h-screen min-h-[480px] w-full -mt-16 flex items-center justify-center overflow-hidden">

                <div class="absolute inset-0 z-0">
                    <video autoplay loop muted playsinline preload="metadata" class="h-full w-full object-cover"
                        poster="/videos/poster.jpg">
                        <source src="/videos/home.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                    <div class="absolute inset-0 bg-black/40"></div>
                </div>

                <div class="relative z-10 mx-auto max-w-4xl text-center px-4 pt-14 animate-fade-in-up">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight text-white leading-tight drop-shadow-lg">
                        Cook Like a Pro,<br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-300 to-red-600">Share
                            with the World.</span>
                    </h1>

                    <p class="mx-auto mt-4 max-w-2xl text-sm sm:text-base text-gray-200 leading-relaxed drop-shadow-md">
                        Discover thousands of tested recipes from home cooks. Join the community, save your favorites,
                        and start your culinary journey today.
                    </p>

                    <div
                        class="mx-auto mt-6 flex max-w-lg items-center gap-2 rounded-xl bg-white/90 dark:bg-white/10 p-1.5 shadow-2xl backdrop-blur-sm transition-all focus-within:ring-4 focus-within:ring-orange-500/30">
                        <div class="pl-4 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" placeholder="What do you want to cook?"
                            class="w-full border-none bg-transparent text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-0 text-base outline-none h-10">
                        <button
                            class="rounded-xl bg-gray-900 dark:bg-orange-600 px-5 sm:px-6 py-2.5 font-bold text-white transition-all hover:bg-orange-600 dark:hover:bg-orange-500 hover:shadow-lg whitespace-nowrap">
                            Search
                        </button>
                    </div>
                </div>

                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 animate-bounce">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="white" class="w-6 h-6 opacity-75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
            </section>

            <section class="space-y-14 pb-14 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="relative z-10 mx-auto max-w-4xl text-center pt-8 reveal-card">
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-orange-200 dark:border-orange-800 bg-orange-50/50 dark:bg-orange-950/50 px-3 py-1 backdrop-blur-sm mb-4 shadow-sm cursor-default transition-transform hover:scale-105">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                        </span>
                        <span class="text-xs font-bold uppercase tracking-wider text-orange-700 dark:text-orange-400">Curated
                            Collections</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight text-gray-900 dark:text-white mb-4">
                        Find Your <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">Flavor</span>
                    </h1>

                    <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                        Journey through our culinary collections. From quick bites to gourmet feasts, discover the
                        perfect dish for every palate.
                    </p>
                </div>

                <div class="space-y-8 sm:space-y-12">

                    <div v-for="(category, index) in categories" :key="category.id"
                        class="group relative block h-[300px] sm:h-[380px] md:h-[450px] w-full overflow-hidden rounded-2xl sm:rounded-[2rem] shadow-xl transition-all duration-700 hover:shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] hover:-translate-y-1 reveal-card"
                        :class="{ 'md:w-[95%] md:ml-auto': index % 2 !== 0, 'md:w-[95%] md:mr-auto': index % 2 === 0 }">
                        <div class="absolute inset-0 h-full w-full overflow-hidden bg-gray-200 dark:bg-gray-800">
                            <img :src="category.image" :alt="category.name" loading="lazy"
                                class="h-full w-full object-cover transition-transform duration-[1.5s] ease-out" />
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-60 transition-opacity duration-500 group-hover:opacity-75">
                        </div>

                        <div class="absolute inset-0 flex flex-col justify-end p-5 sm:p-6 md:p-10">

                            <div class="transform transition-all duration-500 translate-y-4 group-hover:translate-y-0">

                                <div
                                    class="mb-4 opacity-0 transform -translate-y-4 transition-all duration-500 delay-100 group-hover:opacity-100 group-hover:translate-y-0">
                                    <span
                                        class="inline-block px-3 py-1 rounded-lg bg-white/20 backdrop-blur-md text-white text-xs font-bold uppercase tracking-widest border border-white/20">
                                        Collection #{{ index + 1 }}
                                    </span>
                                </div>

                                <h2
                                    class="text-2xl sm:text-3xl md:text-5xl font-black text-white mb-4 tracking-tighter drop-shadow-lg">
                                    {{ category.name }}
                                </h2>

                                <div class="max-w-2xl">
                                    <p
                                        class="text-sm sm:text-base md:text-lg font-medium text-gray-200 line-clamp-2 leading-relaxed mb-4 sm:mb-5 opacity-90 group-hover:text-white transition-colors">
                                        {{ category.description }}
                                    </p>
                                </div>

                                <div class="flex items-center gap-4">
                                    <span
                                        class="group-hover:pl-2 transition-all duration-300 flex items-center gap-2 text-white font-bold text-base sm:text-lg tracking-wide">
                                        Explore Recipes
                                        <div
                                            class="h-8 w-8 rounded-full bg-orange-600 flex items-center justify-center transform transition-transform duration-300 group-hover:rotate-45 group-hover:bg-white group-hover:text-orange-600 shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                            </svg>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="text-center pt-10 reveal-card">
                    <div class="relative inline-block">
                        <span class="spotlight z-0"></span>
                        <p class="relative z-10 text-gray-400 dark:text-gray-500 font-medium font-semibold text-base sm:text-lg px-7 py-4"
                            style="text-shadow: 0 4px 32px rgba(255,255,255,0.20);">
                            More categories coming soon...
                        </p>
                    </div>
                </div>

            </section>

            <section class="animate-fade-in-up animation-delay-600 mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
                <div
                    class="relative overflow-hidden rounded-2xl sm:rounded-[2rem] bg-gray-900 px-6 py-8 sm:py-12 text-center shadow-2xl sm:px-12">
                    <div class="absolute top-0 left-0 -mt-10 h-64 w-64 rounded-full bg-orange-500/20 blur-[100px]">
                    </div>
                    <div class="absolute bottom-0 right-0 -mb-10 h-64 w-64 rounded-full bg-red-500/20 blur-[100px]">
                    </div>

                    <div class="relative z-10">
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-black tracking-tight text-white">
                            Got a Secret Recipe?
                        </h2>
                        <p class="mx-auto mt-4 sm:mt-6 max-w-xl text-base sm:text-lg text-gray-300 leading-relaxed">
                            Share your culinary masterpiece with thousands of foodies. Build your profile and inspire
                            others to cook.
                        </p>
                        <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row justify-center gap-4">
                            <Link href="/recipes/create"
                                class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-orange-500 to-red-600 px-6 py-3 text-base font-bold text-white shadow-lg shadow-orange-500/30 transition-transform hover:scale-105">
                                Start Sharing
                            </Link>
                            <Link href="/aboutus"
                                class="inline-flex items-center justify-center rounded-xl bg-white/10 px-6 py-3 text-base font-bold text-white backdrop-blur-sm transition-colors hover:bg-white/20">
                                Learn More
                            </Link>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </Layout>
</template>

<style scoped>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes spotlightMove {
    0% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.72;
    }

    50% {
        transform: translate(-50%, -60%) scale(1.08);
        opacity: 1;
    }

    100% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.7;
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
    opacity: 0;
}

.animation-delay-200 {
    animation-delay: 0.2s;
}

.animation-delay-400 {
    animation-delay: 0.4s;
}

.animation-delay-600 {
    animation-delay: 0.6s;
}

.spotlight {
    position: absolute;
    left: 50%;
    top: 50%;
    pointer-events: none;
    z-index: 1;
    width: 240px;
    height: 66px;
    transform: translate(-50%, -50%);
    border-radius: 60px;
    background: radial-gradient(ellipse at center, rgba(255, 180, 80, 0.22) 0%, rgba(255, 140, 55, 0.15) 60%, rgba(255, 255, 255, 0) 100%);
    filter: blur(9px);
    animation: spotlightMove 2.2s ease-in-out infinite alternate;
    opacity: 0.7;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
