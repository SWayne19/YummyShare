<template>
    <article
        class="group relative overflow-hidden rounded-3xl border border-white/10 bg-slate-900/60 p-6 shadow-xl shadow-slate-900/30 transition hover:-translate-y-1 hover:border-white/20 hover:bg-slate-900/80"
    >
        <!-- Edit / Delete -->
        <div
            class="absolute top-4 right-4 z-10 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
        >
            <!-- Edit -->
            <Link
                :href="`/articles/${article.id}/edit`"
                class="rounded-full bg-blue-600/90 px-3 py-1 text-xs font-semibold text-white shadow-lg hover:bg-blue-700 transition flex items-center gap-1"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 21h4.586a1 1 0 0 0 .707-.293l9.414-9.414a2 2 0 0 0 0-2.828l-2.172-2.172a2 2 0 0 0-2.828 0l-9.414 9.414A1 1 0 0 0 3 19.586V21z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 6l3 3" />
                </svg>
                Edit
            </Link> 

            <!-- Delete -->
            <Link
                :href="`/articles/${article.id}`"
                method="delete"
                as="button"
                class="rounded-full bg-red-600/80 px-3 py-1 text-xs font-semibold text-white shadow-lg hover:bg-red-700 transition flex items-center gap-1"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
                Delete
            </Link>
        </div>

        <!-- Content -->
        <h2 class="mt-4 text-2xl font-semibold text-white">
            {{ article.title }}
        </h2>

        <p class="mt-3 text-sm leading-relaxed text-slate-200">
            {{ article.content }}
        </p>

        <!-- Hover Glow -->
        <div
            class="pointer-events-none absolute inset-0 opacity-0 transition group-hover:opacity-100"
            aria-hidden="true"
        >
            <div
                class="absolute right-[-20%] top-[-20%] h-40 w-40 rounded-full bg-indigo-500/20 blur-3xl"
            ></div>
        </div>
    </article>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps(['article'])
</script>

