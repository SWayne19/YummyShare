<template>
    <Layout>
        <section class="relative">
            <div class="mx-auto max-w-3xl px-6 py-14">
                <div
                    class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
                >
                    <div>
                        <p
                            class="text-xs uppercase tracking-[0.3em] text-indigo-100"
                        >
                            Edit Article
                        </p>
                        <h1 class="text-3xl font-bold text-white sm:text-4xl">
                            Update your article
                        </h1>
                        <p class="text-slate-200">
                            Make changes to your published insights on design, technology, or storytelling.
                        </p>
                    </div>
                </div>

                <form
                    @submit.prevent="updateArticle"
                    class="rounded-3xl bg-white/5 shadow-2xl ring-1 ring-white/10 ring-inset backdrop-blur-lg transition-all duration-500 hover:shadow-indigo-700/25 hover:ring-indigo-500/30 p-8 flex flex-col gap-6"
                >
                    <div>
                        <label
                            for="title"
                            class="block mb-2 text-sm font-medium text-indigo-100"
                        >
                            Title
                        </label>
                        <input
                            v-model="form.title"
                            type="text"
                            id="title"
                            class="w-full rounded-lg border border-white/15 bg-slate-800/60 p-3 text-white placeholder-slate-400 transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 outline-none"
                            placeholder="Enter your article title"
                            autocomplete="off"
                        />
                    </div>
                    <div>
                        <label
                            for="content"
                            class="block mb-2 text-sm font-medium text-indigo-100"
                        >
                            Content
                        </label>
                        <textarea
                            v-model="form.content"
                            id="content"
                            rows="8"
                            class="w-full rounded-lg border border-white/15 bg-slate-800/60 p-3 text-white placeholder-slate-400 transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 outline-none resize-vertical"
                            placeholder="Write your article content here..."
                        ></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-indigo-700"
                        >
                            Update Article
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";

const props = defineProps(['article']);

const form = useForm({
    title : props.article.title,
    content : props.article.content
})

const updateArticle = () => {
    form.put(`/articles/${props.article.id}`)
}
</script>
