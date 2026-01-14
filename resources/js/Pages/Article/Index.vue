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
                    <div class="flex flex-wrap items-center gap-3">
                        <Link
                            class="inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-2 text-sm font-semibold text-white transition hover:border-white/40"
                            :href="route('articles.create')"
                            prefetch="mount"
                        >
                            Create
                        </Link>
                    </div>
                </div>

                <div
                    class="rounded-3xl border border-white/10 bg-white/5 shadow-2xl shadow-indigo-950/30 ring-1 ring-white/10 backdrop-blur-2xl"
                >
                    <div
                        class="flex flex-col gap-2 border-b border-white/10 px-5 py-4 sm:flex-row sm:items-center sm:justify-between"
                    >
                        <p class="text-sm font-semibold text-white">
                            Showing
                            <span class="text-indigo-200">{{
                                articles.length
                            }}</span>
                            of
                            <span class="text-indigo-200">{{
                                articles.length
                            }}</span>
                        </p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm">
                            <thead class="text-xs uppercase text-slate-300/80">
                                <tr class="border-b border-white/10">
                                    <th class="px-5 py-4 font-semibold">
                                        Title
                                    </th>
                                    <th
                                        class="hidden px-5 py-4 font-semibold md:table-cell"
                                    >
                                        Content
                                    </th>
                                    <th class="px-5 py-4 font-semibold">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                <tr
                                    v-for="article in articles"
                                    :key="article.id"
                                    class="group hover:bg-white/5"
                                >
                                    <td class="px-5 py-4 align-top">
                                        <div class="font-semibold text-white">
                                            {{ article.title }}
                                        </div>
                                        <div
                                            class="mt-1 text-xs text-slate-400 md:hidden"
                                        >
                                            {{ article.content }}
                                        </div>
                                    </td>
                                    <td
                                        class="hidden px-5 py-4 align-top text-slate-200 md:table-cell"
                                    >
                                        {{ article.content }}
                                    </td>
                                    <td class="px-5 py-4 align-top">
                                        <div class="flex flex-wrap gap-2">
                                            <Link
                                                :href="
                                                    route('articles.edit', {
                                                        article: article.id,
                                                    })
                                                "
                                                prefetch="mount"
                                                class="inline-flex items-center gap-2 rounded-full bg-blue-600/80 px-3 py-1.5 text-xs font-semibold text-white shadow-lg shadow-blue-600/10 transition hover:bg-blue-700"
                                            >
                                                Edit
                                            </Link>
                                            <button
                                                @click="destroy(article.id)"
                                                class="inline-flex items-center gap-2 rounded-full bg-red-700/80 px-3 py-1.5 text-xs font-semibold text-white shadow-lg shadow-red-700/10 transition hover:bg-red-800 cursor-pointer"
                                            >
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr v-if="articles.length === 0">
                                    <td
                                        colspan="3"
                                        class="px-5 py-10 text-center"
                                    >
                                        <p
                                            class="text-sm font-semibold text-white"
                                        >
                                            No articles found
                                        </p>
                                        <p class="mt-1 text-sm text-slate-300">
                                            Try a different keyword, or create a
                                            new article.
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";

const props = defineProps({
    articles: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({});

const destroy = (id) => {
    if (confirm("Are you sure you want to delete this article?")) {
        form.delete(route("articles.destroy", id));
    }
};
</script>
