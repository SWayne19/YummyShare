<template>
    <Layout>
        <section class="relative overflow-hidden">
            <div
                class="mx-auto flex max-w-6xl flex-col gap-12 px-6 py-16 lg:flex-row lg:items-center"
            >
                <div class="flex-1 space-y-6">
                    <p
                        class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-indigo-100 ring-1 ring-white/10"
                    >
                        New issue · Dec 2025
                    </p>
                    <h1
                        class="text-4xl font-bold leading-tight text-white sm:text-5xl"
                    >
                        Beautifully crafted stories for modern minds.
                    </h1>
                    <p class="text-lg text-slate-200 sm:text-xl">
                        Explore in-depth articles, interviews, and guides that
                        blend design, technology, and culture. Curated weekly to
                        keep you inspired.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a
                            class="inline-flex items-center gap-2 rounded-full bg-indigo-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:-translate-y-0.5 hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-300"
                            href="/articles"
                        >
                            Browse Articles
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="h-4 w-4"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13.5 4.5 21 12l-7.5 7.5M21 12H3"
                                />
                            </svg>
                        </a>
                        <button
                            class="inline-flex items-center gap-2 rounded-full border border-white/30 px-5 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:border-white/60"
                            type="button"
                        >
                            Latest Issue
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-6 text-sm text-slate-300">
                        <div>
                            <p class="text-2xl font-bold text-white">320+</p>
                            <p>Long-form articles</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-white">45</p>
                            <p>Award-winning writers</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-white">120k</p>
                            <p>Monthly readers</p>
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <div
                        class="relative overflow-hidden rounded-3xl border border-white/10 bg-linear-to-br from-slate-900 to-indigo-900 p-6 shadow-2xl shadow-indigo-900/30"
                    >
                        <div class="mb-6 flex items-center justify-between">
                            <p
                                class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-100"
                            >
                                Spotlight
                            </p>
                            <span
                                class="rounded-full bg-emerald-500/20 px-3 py-1 text-xs font-semibold text-emerald-200"
                            >
                                Editor’s pick
                            </span>
                        </div>
                        <div class="space-y-4">
                            <p
                                class="text-xs uppercase tracking-[0.2em] text-slate-300"
                            >
                                Design · Culture · Future
                            </p>
                            <h2 class="text-2xl font-semibold text-white">
                                The quiet renaissance of digital magazines
                            </h2>
                            <p class="text-sm leading-relaxed text-slate-200">
                                Discover how minimalist storytelling, immersive
                                typography, and subtle motion are reshaping the
                                reading experience across the web.
                            </p>
                            <div class="flex items-center gap-4">
                                <img
                                    class="h-10 w-10 rounded-full border border-white/20 object-cover"
                                    src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=200&q=80"
                                    alt="Author avatar"
                                    loading="lazy"
                                />
                                <div class="text-sm text-slate-200">
                                    <p class="font-semibold text-white">
                                        Ava Kim
                                    </p>
                                    <p>Senior Editor · 8 min read</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="mt-6 flex items-center gap-3 rounded-2xl bg-white/5 p-3 text-xs text-slate-200 ring-1 ring-white/10"
                        >
                            <span
                                class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-white/10 text-sm font-bold text-indigo-100"
                            >
                                UX
                            </span>
                            <div>
                                <p class="font-semibold text-white">
                                    Design Systems
                                </p>
                                <p class="text-slate-300">
                                    Crafting cohesive experiences at scale
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import Layout from "./Components/Layout.vue";
</script>
