<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";

defineProps({
    categories: Array
});
</script>

<template>

    <Head title="Categories" />

    <Layout>
        <div class="space-y-16 pb-12">

            <section class="relative z-10 mx-auto max-w-4xl text-center pt-8">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-orange-200 bg-orange-50/50 px-4 py-1.5 backdrop-blur-sm mb-6 shadow-sm cursor-default transition-transform hover:scale-105">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                    </span>
                    <span class="text-xs font-bold uppercase tracking-wider text-orange-700">Curated Collections</span>
                </div>

                <h1 class="text-4xl font-black tracking-tight text-gray-900 sm:text-6xl mb-6">
                    Find Your <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">Flavor</span>
                </h1>

                <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Explore our diverse collection of recipes organized by category. From quick bites to gourmet feasts,
                    we have something for every palate.
                </p>
            </section>

            <section class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    <Link v-for="category in categories" :key="category.id" :href="`/?category=${category.slug}`"
                        class="group relative h-[28rem] w-full overflow-hidden rounded-[2.5rem] bg-gray-100 shadow-md transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-orange-900/20">
                        <div class="absolute inset-0 h-full w-full overflow-hidden">
                            <img :src="category.image" :alt="category.name"
                                class="h-full w-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-110" />
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-60 transition-opacity duration-500 group-hover:opacity-80">
                        </div>

                        <div class="absolute inset-0 flex flex-col justify-end p-8">

                            <div class="transform transition-transform duration-500 group-hover:-translate-y-2">
                                <h2 class="text-4xl font-black text-white mb-2 tracking-tight drop-shadow-md">
                                    {{ category?.name }}
                                </h2>

                                <div
                                    class="grid grid-rows-[0fr] transition-all duration-500 group-hover:grid-rows-[1fr]">
                                    <div class="overflow-hidden">
                                        <p
                                            class="text-sm font-medium text-gray-200 line-clamp-2 leading-relaxed mb-4 opacity-0 transition-opacity duration-500 delay-100 group-hover:opacity-100">
                                            {{ category?.description }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <span
                                        class="h-[3px] w-8 bg-orange-500 rounded-full transition-all duration-500 group-hover:w-16 group-hover:bg-orange-400"></span>
                                    <span
                                        class="text-xs font-bold text-orange-400 uppercase tracking-widest opacity-90"></span>
                                </div>
                            </div>
                        </div>
                    </Link>

                </div>
            </section>

        </div>
    </Layout>
</template>

<style scoped>
/* Staggered Animation for Grid Items */
.grid>a {
    animation: fadeUp 0.6s ease-out forwards;
    opacity: 0;
}

.grid>a:nth-child(1) {
    animation-delay: 0.1s;
}

.grid>a:nth-child(2) {
    animation-delay: 0.2s;
}

.grid>a:nth-child(3) {
    animation-delay: 0.3s;
}

.grid>a:nth-child(4) {
    animation-delay: 0.4s;
}

.grid>a:nth-child(5) {
    animation-delay: 0.5s;
}

.grid>a:nth-child(6) {
    animation-delay: 0.6s;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
