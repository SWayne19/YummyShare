<template>
    <Layout>
        <section class="relative min-h-screen bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-800 overflow-hidden">
            <div class="mx-auto max-w-4xl flex flex-col gap-12 px-6 py-16 md:py-24">
                <p class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.20em] text-indigo-100 ring-1 ring-white/10 w-fit">
                    Content
                </p>
                <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight text-white">
                    Explore <span class="text-indigo-400">Premium Content</span>
                </h1>
                <p class="text-lg sm:text-xl text-slate-200 max-w-2xl">
                    Discover a curated collection of in-depth articles, guides, and features. Our content page brings together distinct voices and fresh perspectives on design, technology, culture, and more — crafted to spark your curiosity and keep you engaged.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-8">
                    <!-- Example Content Cards -->
                    <div
                        v-for="item in featuredContent"
                        :key="item.id"
                        class="group relative rounded-2xl bg-white/5 border border-white/10 p-6 shadow-lg shadow-indigo-800/20 transition hover:-translate-y-1 hover:border-indigo-400/30 hover:bg-indigo-500/10 backdrop-blur"
                    >
                        <h2 class="text-xl font-semibold text-indigo-100 group-hover:text-indigo-400 transition">
                            {{ item.title }}
                        </h2>
                        <p class="text-slate-300 mt-2 text-sm">
                            {{ item.description }}
                        </p>
                        <a :href="item.link" class="mt-4 inline-flex items-center gap-2 text-indigo-400 hover:text-indigo-300 text-sm font-medium transition">
                            Read More
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                    <!-- End of example cards -->
                </div>
                <div class="flex flex-col md:flex-row mt-16 gap-10 items-center">
                    <img
                        src="/images/article.jpg"
                        alt="Reading content"
                        class="w-full max-w-xs rounded-2xl border border-white/10 shadow-xl shadow-indigo-900/20 object-cover mx-auto md:mx-0"
                        loading="lazy"
                    />
                    <div class="flex-1 flex flex-col justify-center gap-3">
                        <h2 class="text-xl font-semibold text-indigo-200">Why Our Content?</h2>
                        <p class="text-slate-300">
                            We believe in thoughtful storytelling. With every article, we strive to deliver value — not just information but inspiration.
                        </p>
                        <p class="text-slate-300">
                            Each piece is thoroughly researched, beautifully designed, and accessible to everyone who wants to learn, share, or dig deeper.
                        </p>
                        <a
                            href="#"
                            class="inline-flex items-center gap-2 rounded-full bg-indigo-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:-translate-y-0.5 hover:bg-indigo-400 w-fit"
                        >
                            Browse All Content
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
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>
<script setup>
import Layout from "./Components/Layout.vue";

const featuredContent = [
    {
        id: 1,
        title: "The Art of Minimalist Design",
        description: "How less can truly be more: principles and practices from top designers.",
        link: "#"
    },
    {
        id: 2,
        title: "AI & Creativity: Finding the Balance",
        description: "Exploring how AI tools are transforming how we create, collaborate, and imagine.",
        link: "#"
    },
    {
        id: 3,
        title: "Human-Centered Technology",
        description: "Ensuring empathy and ethics remain at the core of tech innovation.",
        link: "#"
    },
    {
        id: 4,
        title: "Storytelling for Impact",
        description: "Techniques to make your story resonate—in writing and visual media.",
        link: "#"
    },
];
</script>
