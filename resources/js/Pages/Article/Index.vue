<template>
    <Layout>
        <section class="relative">
            <div class="mx-auto max-w-6xl px-6 py-14">
                <div
                    class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
                >
                    <div>
                        <p
                            class="text-xs uppercase tracking-[0.3em] text-indigo-100"
                        >
                            Articles
                        </p>
                        <h1 class="text-3xl font-bold text-white sm:text-4xl">
                            Latest insights from our contributors
                        </h1>
                        <p class="text-slate-200">
                            Curated pieces on design, technology, and the craft
                            of writing.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <Link
                            class="inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-2 text-sm font-semibold text-white transition hover:border-white/40"
                            href="/articles/create"
                        >
                            Create
                        </Link>
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <ArticleCard
                        v-for="article in articles"
                        :key="article.id"
                        :article="article"
                    />
                </div>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";
import ArticleCard from "../Components/ArticleCard.vue";

defineProps(["articles"]);
</script>
