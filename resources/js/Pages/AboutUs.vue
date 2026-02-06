<script setup>
import { Head } from "@inertiajs/vue3";
import Layout from "./Components/Layout.vue";

const stats = [
    { label: 'Recipes Shared', value: '15k+' },
    { label: 'Active Cooks', value: '8k+' },
    { label: 'Countries Reached', value: '45+' },
];
</script>

<template>

    <Head title="About Us" />
    <Layout>
        <!-- Adjust padding to match Navbar left/right spaces (px-6 lg:px-12 as an example) -->
        <div class="space-y-24 pb-12 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <section class="relative z-10 max-w-4xl mx-auto text-center pt-8 animate-fade-in-up">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-orange-200 bg-orange-50/50 px-4 py-1.5 backdrop-blur-sm mb-6 shadow-sm cursor-default transition-transform hover:scale-105">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                    </span>
                    <span class="text-xs font-bold uppercase tracking-wider text-orange-700">Our Story</span>
                </div>

                <h1 class="text-4xl font-black tracking-tight text-gray-900 sm:text-6xl leading-tight mb-6">
                    Bringing the World <br />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">Together at
                        the Table.</span>
                </h1>

                <p class="mx-auto max-w-2xl text-lg text-gray-600 leading-relaxed">
                    YummyShare was born from a simple belief: <strong class="text-gray-900">Great food is meant to be
                        shared.</strong> Since 2022, we've been building a community where home cooks can swap secrets,
                    discover new flavors, and preserve family traditions in a digital cookbook open to everyone.
                </p>
            </section>

            <!-- stat -->
            <section class="animate-fade-in-up animation-delay-200">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-3">
                    <div v-for="stat in stats" :key="stat.label"
                        class="relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg shadow-gray-100 ring-1 ring-gray-100 text-center group hover:shadow-xl transition-all">
                        <div
                            class="text-4xl font-black text-gray-900 mb-2 group-hover:text-orange-600 transition-colors">
                            {{ stat.value }}</div>
                        <div class="text-sm font-semibold text-gray-500 uppercase tracking-wide">{{ stat.label }}</div>
                        <div
                            class="absolute -right-6 -bottom-6 h-24 w-24 rounded-full bg-orange-50 opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>
                    </div>
                </div>
            </section>

            <!-- history -->
            <section class="animate-fade-in-up animation-delay-400">
                <div
                    class="relative overflow-hidden rounded-[2.5rem] bg-gray-900 px-6 sm:px-10 lg:px-20 py-16 lg:flex lg:items-center lg:gap-x-16">
                    <div class="absolute top-0 left-0 -mt-10 h-64 w-64 rounded-full bg-orange-500/20 blur-[100px]">
                    </div>
                    <div class="absolute bottom-0 right-0 -mb-10 h-64 w-64 rounded-full bg-red-500/20 blur-[100px]">
                    </div>

                    <div class="relative z-10 lg:w-1/2">
                        <img src="https://static01.nyt.com/images/2021/04/28/dining/26Cookpad-6/26Cookpad-6-articleLarge-v2.jpg?quality=75&auto=webp&disable=upscale"
                            alt="Cooking together"
                            class="rounded-3xl shadow-2xl ring-1 ring-white/10 rotate-2 hover:rotate-0 transition-transform duration-500" />
                    </div>
                    <div class="relative z-10 mt-12 lg:mt-0 lg:w-1/2">
                        <h2 class="text-3xl font-black tracking-tight text-white sm:text-4xl mb-6">
                            Since 2022
                        </h2>
                        <p class="text-lg text-gray-300 mb-6 leading-relaxed">
                            What started as a small WhatsApp group of food enthusiasts in 2022 has grown into a global
                            platform. We realized that while recipe books are great, the real magic happens when people
                            tweak, improve, and personalize dishes.
                        </p>
                        <p class="text-lg text-gray-300 leading-relaxed">
                            Our purpose is to democratize culinary knowledge. Whether you're a Michelin-star aspirant or
                            someone just trying not to burn toast, YummyShare is your kitchen companion.
                        </p>
                    </div>
                </div>
            </section>

            <section class="pb-12 animate-fade-in-up animation-delay-600">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-900">Get in Touch</h2>
                    <p class="text-gray-600 mt-2">Have a suggestion or just want to say hi?</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
                    <div class="bg-orange-50 rounded-3xl p-8 space-y-6">
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">Email Us</h3>
                            <a href="mailto:hello@yummyshare.com"
                                class="text-orange-600 font-medium hover:underline text-xl">hello@yummyshare.com</a>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">Headquarters</h3>
                            <p class="text-gray-600">123 Culinary Ave,<br>Flavor Town, FT 90210</p>
                        </div>
                        <div class="pt-4 flex gap-4">
                            <a href="#"
                                class="h-10 w-10 rounded-full bg-white flex items-center justify-center text-gray-400 hover:text-orange-600 shadow-sm transition-colors">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                            <a href="#"
                                class="h-10 w-10 rounded-full bg-white flex items-center justify-center text-gray-400 hover:text-orange-600 shadow-sm transition-colors">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.468.99c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <form class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-900">Name</label>
                                <input type="text" placeholder="John Cook"
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 placeholder-gray-400 focus:border-orange-500 focus:ring-orange-500 transition-shadow">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-900">Email</label>
                                <input type="email" placeholder="john@example.com"
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 placeholder-gray-400 focus:border-orange-500 focus:ring-orange-500 transition-shadow">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-900">Message</label>
                            <textarea rows="4" placeholder="How can we help?"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 placeholder-gray-400 focus:border-orange-500 focus:ring-orange-500 transition-shadow"></textarea>
                        </div>
                        <button
                            class="w-full rounded-xl bg-gray-900 px-8 py-4 font-bold text-white transition-all hover:bg-gray-800 hover:-translate-y-1 hover:shadow-lg">
                            Send Message
                        </button>
                    </form>
                </div>
            </section>

        </div>
    </Layout>
</template>

<style scoped>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
    opacity: 0;
}

.animation-delay-200 {
    animation-delay: 0.2s;
}

.animation-delay-400 {
    animation-delay: 0.4s;
}

.animation-delay-600 {
    animation-delay: 0.6s;
}
</style>
