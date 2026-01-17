<template>
    <Layout>
        <section class="max-w-7xl mx-auto px-4 py-10 space-y-12" id="dashboard">
            <div class="relative">
                <div class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-500/10 blur-[100px] rounded-full"></div>
                <div class="relative space-y-3">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-500/10 text-indigo-300 ring-1 ring-inset ring-indigo-500/20">
                        Platform Overview
                    </span>
                    <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">
                        System <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Insights</span>
                    </h1>
                    <p class="max-w-2xl text-base text-slate-400 leading-relaxed">
                        Monitor your educational ecosystem performance. Manage centers, track course availability, and
                        analyze content distribution at a glance.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                <Link :href="route('centers.index')"
                    class="group relative overflow-hidden rounded-3xl border border-white/10 bg-slate-900/50 p-8 transition-all duration-300 hover:border-green-500/30 hover:bg-slate-800/50 hover:shadow-2xl hover:shadow-green-500/10">
                    <div
                        class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-green-500/5 blur-2xl group-hover:bg-green-500/10">
                    </div>

                    <div class="flex flex-col gap-6">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-green-500/10 text-green-400 ring-1 ring-green-500/20 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-7 w-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-400">Global Centers</p>
                            <div class="flex items-baseline gap-2">
                                <span class="text-4xl font-bold tracking-tight text-white">{{ totalCenters }}</span>
                                <span
                                    class="text-xs font-medium text-green-400 bg-green-400/10 px-2 py-0.5 rounded-md">Live</span>
                            </div>
                            <p class="mt-2 text-sm text-slate-500">Active operational hubs</p>
                        </div>
                    </div>
                </Link>

                <Link :href="route('courseTypes.index')"
                    class="group relative overflow-hidden rounded-3xl border border-white/10 bg-slate-900/50 p-8 transition-all duration-300 hover:border-indigo-500/30 hover:bg-slate-800/50 hover:shadow-2xl hover:shadow-indigo-500/10">
                    <div
                        class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-indigo-500/5 blur-2xl group-hover:bg-indigo-500/10">
                    </div>

                    <div class="flex flex-col gap-6">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-500/10 text-indigo-400 ring-1 ring-indigo-500/20 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-7 w-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 0 0 3.182 0l4.318-4.318a2.25 2.25 0 0 0 0-3.182L10.58 3.659A2.25 2.25 0 0 0 9.568 3Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-400">Categories</p>
                            <div class="flex items-baseline gap-2">
                                <span class="text-4xl font-bold tracking-tight text-white">{{ totalCourseTypes }}</span>
                            </div>
                            <p class="mt-2 text-sm text-slate-500">Unique training classifications</p>
                        </div>
                    </div>
                </Link>

                <Link :href="route('courses.index')"
                    class="group relative overflow-hidden rounded-3xl border border-white/10 bg-slate-900/50 p-8 transition-all duration-300 hover:border-cyan-500/30 hover:bg-slate-800/50 hover:shadow-2xl hover:shadow-cyan-500/10">
                    <div
                        class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-cyan-500/5 blur-2xl group-hover:bg-cyan-500/10">
                    </div>

                    <div class="flex flex-col gap-6">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-500/10 text-cyan-400 ring-1 ring-cyan-500/20 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-7 w-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.425-4.741c.844-.406 1.664-.78 2.425-1.122m0 5.863L12 5.426m0 0L21.75 9.13m-9.75-3.704v5.863m5.104-1.582a48.594 48.594 0 0 1 3.09 3.456" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-400">Total Courses</p>
                            <div class="flex items-baseline gap-2">
                                <span class="text-4xl font-bold tracking-tight text-white">{{ totalCourses }}</span>
                            </div>
                            <p class="mt-2 text-sm text-slate-500">Published learning modules</p>
                        </div>
                    </div>
                </Link>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Layout from "./Components/Layout.vue";

const props = defineProps({
    totalCourseTypes: {
        type: Number,
        default: 0,
    },
    totalCourses: {
        type: Number,
        default: 0,
    },
    totalCenters: {
        type: Number,
        default: 0
    }
});
</script>
