<template>
    <Layout>
        <section class="relative">
            <div class="mx-auto max-w-3xl px-6 py-14">
                <div
                    class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
                >
                    <div class="min-w-0">
                        <p
                            class="text-xs uppercase tracking-[0.3em] text-indigo-100"
                        >
                            {{ isEdit ? "Edit Article" : "Create Article" }}
                        </p>
                        <h1 class="text-3xl font-bold text-white sm:text-4xl">
                            {{
                                isEdit
                                    ? "Update your article"
                                    : "Share your insights with the world"
                            }}
                        </h1>
                        <p class="text-slate-200">
                            {{
                                isEdit
                                    ? "Make changes to your published insights on design, technology, or storytelling."
                                    : "Write and publish your own article on design, technology, or storytelling."
                            }}
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <Link
                            prefetch="mount"
                            :href="route('articles.index')"
                            class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-indigo-950/10 transition hover:border-white/25 hover:bg-white/10"
                        >
                            <span aria-hidden="true">←</span>
                            Back
                        </Link>
                    </div>
                </div>

                <form
                    @submit.prevent="submit"
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
                            type="text"
                            id="title"
                            v-model="form.title"
                            class="w-full rounded-lg border border-white/15 bg-slate-800/60 p-3 text-white placeholder-slate-400 transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 outline-none"
                            placeholder="Enter your article title"
                            autocomplete="off"
                            :aria-invalid="form.errors.title ? 'true' : 'false'"
                            :class="
                                form.errors.title
                                    ? 'border-red-500 focus:border-red-400 focus:ring-red-200'
                                    : ''
                            "
                        />
                        <transition name="fade">
                            <div
                                v-if="form.errors.title"
                                class="mt-2 flex items-center gap-2 rounded-lg bg-red-500/15 px-3 py-2 text-sm text-red-400 border border-red-400/40 animate-shake"
                                style="backdrop-filter: blur(2px)"
                            >
                                <svg
                                    class="w-4 h-4 text-red-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12A9 9 0 1 1 3 12a9 9 0 0 1 18 0z"
                                    />
                                </svg>
                                <span class="font-medium">{{
                                    form.errors.title
                                }}</span>
                            </div>
                        </transition>
                    </div>

                    <div>
                        <label
                            for="content"
                            class="block mb-2 text-sm font-medium text-indigo-100"
                        >
                            Content
                        </label>
                        <textarea
                            id="content"
                            v-model="form.content"
                            rows="8"
                            class="w-full rounded-lg border border-white/15 bg-slate-800/60 p-3 text-white placeholder-slate-400 transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 outline-none resize-vertical"
                            placeholder="Write your article content here..."
                            :aria-invalid="
                                form.errors.content ? 'true' : 'false'
                            "
                            :class="
                                form.errors.content
                                    ? 'border-red-500 focus:border-red-400 focus:ring-red-200'
                                    : ''
                            "
                        ></textarea>
                        <transition name="fade">
                            <div
                                v-if="form.errors.content"
                                class="mt-2 flex items-center gap-2 rounded-lg bg-red-500/15 px-3 py-2 text-sm text-red-400 border border-red-400/40 animate-shake"
                                style="backdrop-filter: blur(2px)"
                            >
                                <svg
                                    class="w-4 h-4 text-red-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12A9 9 0 1 1 3 12a9 9 0 0 1 18 0z"
                                    />
                                </svg>
                                <span class="font-medium">{{
                                    form.errors.content
                                }}</span>
                            </div>
                        </transition>
                    </div>

                    <div class="flex justify-end">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-60"
                        >
                            {{
                                form.processing
                                    ? "Saving…"
                                    : isEdit
                                    ? "Update Article"
                                    : "Publish Article"
                            }}
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import { computed } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";

const props = defineProps({
    article: {
        type: Object,
        default: null,
    },
});

const isEdit = computed(() => Boolean(props.article?.id));

const form = useForm({
    title: props.article?.title ?? "",
    content: props.article?.content ?? "",
});

function submit() {
    if (isEdit.value) {
        form.put(route("articles.update", props.article?.id));
        return;
    }

    form.post(route("articles.store"));
}
</script>
