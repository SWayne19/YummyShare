<template>
    <Layout>
        <section class="relative overflow-hidden">
            <div
                class="mx-auto flex max-w-4xl flex-col gap-10 px-6 py-16 md:py-24"
            >
                <p
                    class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-indigo-100 ring-1 ring-white/10 w-fit"
                >
                    About Us
                </p>
                <h1
                    class="text-3xl font-bold leading-tight text-white sm:text-4xl"
                >
                    Get to Know <span class="text-indigo-400">swamArticle</span>
                </h1>
                <p class="text-lg text-slate-200 sm:text-xl">
                    swamArticle is where artful storytelling meets modern web technology. Our mission? To inspire, inform, and connect curious minds with beautifully crafted long-form articles. Each piece is thoughtfully curated, blending design, technology, and culture to keep you engaged week after week.
                </p>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-3 mt-6">
                    <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10 flex flex-col items-start gap-3">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600/80 text-lg font-bold text-white shadow-lg shadow-indigo-600/30">320+</span>
                        <p class="text-slate-100 font-semibold">Long-form Articles</p>
                        <p class="text-slate-300 text-sm">Deep dives, guides, and interviews delivering quality content every issue.</p>
                    </div>
                    <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10 flex flex-col items-start gap-3">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-500/80 text-lg font-bold text-white shadow-lg shadow-emerald-500/30">45</span>
                        <p class="text-slate-100 font-semibold">Award-winning Writers</p>
                        <p class="text-slate-300 text-sm">Our team of experts crafts every article with care and precision.</p>
                    </div>
                    <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10 flex flex-col items-start gap-3">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-400/80 text-lg font-bold text-white shadow-lg shadow-indigo-400/30">120k</span>
                        <p class="text-slate-100 font-semibold">Monthly Readers</p>
                        <p class="text-slate-300 text-sm">A growing global community passionate about insightful content.</p>
                    </div>
                </div>

                <div class="mt-12 flex flex-col md:flex-row gap-8">
                    <img
                        src="https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80"
                        alt="Team collaborating"
                        class="w-full max-w-xs rounded-2xl border border-white/10 shadow-xl shadow-indigo-900/20 object-cover mx-auto md:mx-0"
                        loading="lazy"
                    />
                    <div class="flex-1 flex flex-col justify-center gap-4">
                        <h2 class="text-xl font-semibold text-indigo-200">What Drives Us</h2>
                        <p class="text-slate-300">
                            We believe stories should do more than inform—they should move you. That’s why swamArticle blends high-quality journalism with beautiful design, making the reading experience as inspiring as the ideas themselves.
                        </p>
                        <p class="text-slate-300">
                            Whether you’re a lifelong learner, designer, or simply curious, we’re here to fuel your curiosity and creativity—one story at a time.
                        </p>
                        <a
                            href="#"
                            class="inline-flex items-center gap-2 rounded-full bg-indigo-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:-translate-y-0.5 hover:bg-indigo-400 w-fit"
                        >
                            Meet the Team
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
</script>
