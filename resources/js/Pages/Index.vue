<template>
    <Layout>
        <section class="space-y-8" id="dashboard">
            <div class="space-y-2 text-center">
                <p class="text-xs uppercase tracking-[0.2em] text-indigo-100">
                    Overview
                </p>
                <h1 class="text-3xl font-bold text-white sm:text-4xl">
                    Dashboard
                </h1>
                <p class="text-sm text-slate-300">
                    Simple overview of your data. Below is the total number of
                    course types you have configured.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 justify-center">
                <Link
                    :href="route('courseTypes.index')"
                    class="rounded-2xl border border-white/10 bg-white/5 p-5 ring-1 ring-white/10"
                >
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p
                                class="text-xs font-semibold uppercase tracking-[0.18em] text-indigo-100"
                            >
                                Course Types
                            </p>
                            <p class="mt-2 text-3xl font-bold text-white">
                                {{ totalCourseTypes }}
                            </p>
                            <p class="mt-1 text-xs text-slate-300">
                                Total course type records in the system.
                            </p>
                        </div>
                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-500/20 text-indigo-200 ring-1 ring-indigo-400/40"
                        >
                            <!-- Matching sidebar icon for Course Types (list icon) -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="h-6 w-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 6h16M4 12h16M4 18h7"
                                />
                            </svg>
                        </div>
                    </div>
                </Link>
                <Link
                    :href="route('courses.index')"
                    class="rounded-2xl border border-white/10 bg-white/5 p-5 ring-1 ring-white/10"
                >
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p
                                class="text-xs font-semibold uppercase tracking-[0.18em] text-indigo-100"
                            >
                                Courses
                            </p>
                            <p class="mt-2 text-3xl font-bold text-white">
                                {{ courses }}
                            </p>
                            <p class="mt-1 text-xs text-slate-300">
                                Total course records in the system.
                            </p>
                        </div>
                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-500/20 text-indigo-200 ring-1 ring-indigo-400/40"
                        >
                            <!-- Matching sidebar icon for Courses (academic cap icon) -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="h-6 w-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 14.25L19.5 9.75L12 5.25L4.5 9.75L12 14.25ZM12 14.25V19.5M18 10.5V16.5C18 16.9142 17.8788 17.2652 17.6778 17.5071C17.4767 17.749 17.2167 17.875 16.9433 17.8953C14.8635 18.0554 13.1365 18.0554 11.0567 17.8953C10.7833 17.875 10.5233 17.749 10.3222 17.5071C10.1212 17.2652 10 16.9142 10 16.5V10.5"
                                />
                            </svg>
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
    courses: {
        type: Number,
        default: 0,
    },
});
</script>
