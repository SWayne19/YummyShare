<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Layout  from "./Components/Layout.vue";
import { onMounted } from "vue";

const milestones = [
    {
        year: '2022',
        title: "YummyShare Founded",
        description: "Started as a small group of passionate food lovers on WhatsApp, sharing family recipes and tips beyond borders."
    },
    {
        year: '2023',
        title: "Our First 10,000 Recipes",
        description: "The platform hit a major milestone as our community uploaded over 10,000 homemade recipes from cooks all over the globe."
    },
    {
        year: '2023',
        title: "Reaching 8,000 Active Cooks",
        description: "Over 8,000 cooks signed up, swapping stories, secrets, and flavors, creating a buzzing kitchen community online."
    },
    {
        year: '2024',
        title: "45+ Countries Connected",
        description: "Home-cooked inspiration now reaches kitchens in more than 45 countries, making every table a little more connected."
    },
];

onMounted(() => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: "0px 0px -50px 0px" });

    document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
        observer.observe(el);
    });
});
</script>

<template>

    <Head title="About Us" />
    <Layout>
        <div class="space-y-16 pb-8">

            <section class="relative z-10 text-center pt-12 px-4 reveal-on-scroll">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight text-gray-900 dark:text-white leading-tight mb-4">
                    Bringing the World <br />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">Together at
                        the Table.</span>
                </h1>

                <p class="mx-auto max-w-2xl text-base sm:text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                    YummyShare was born from a simple belief: <strong class="text-gray-900 dark:text-white">Great food is meant to be
                        shared.</strong> Since 2022, we've been building a community where home cooks can swap secrets,
                    discover new flavors, and preserve family traditions.
                </p>
            </section>

            <section class="relative w-full bg-gray-900 py-16 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                    <div class="absolute top-1/4 left-0 h-96 w-96 rounded-full bg-orange-500/10 blur-[100px]"></div>
                    <div class="absolute bottom-1/4 right-0 h-96 w-96 rounded-full bg-red-500/10 blur-[100px]"></div>
                </div>

                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-10 reveal-on-scroll">
                        <h2 class="text-2xl font-black text-white sm:text-3xl">Our Journey</h2>
                        <p class="mt-4 text-base sm:text-lg text-gray-400">From a WhatsApp group to a global kitchen.</p>
                    </div>

                    <div class="relative">
                        <div
                            class="absolute left-8 md:left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-orange-500 via-red-500 to-gray-800 md:-ml-0.5 rounded-full">
                        </div>

                        <div class="space-y-8">
                            <div v-for="(milestone, index) in milestones" :key="index"
                                class="relative flex flex-col md:flex-row items-center reveal-on-scroll"
                                :class="{ 'md:flex-row-reverse': index % 2 !== 0 }">
                                <div class="w-full md:w-1/2 pl-20 md:pl-0 md:pr-16"
                                    :class="{ 'md:!pl-16 md:!pr-0': index % 2 !== 0 }">
                                    <div
                                        class="bg-white/5 border border-white/10 backdrop-blur-md rounded-2xl p-4 sm:p-6 hover:bg-white/10 transition-all duration-300 hover:-translate-y-1 shadow-xl">
                                        <span
                                            class="inline-block px-3 py-1 mb-3 text-xs font-bold tracking-wider text-orange-400 uppercase bg-orange-500/10 rounded-lg border border-orange-500/20">
                                            {{ milestone.year }}
                                        </span>
                                        <h3 class="text-lg sm:text-xl font-bold text-white mb-3">{{ milestone.title }}</h3>
                                        <p class="text-gray-400 leading-relaxed text-sm sm:text-base">{{ milestone.description }}</p>
                                    </div>
                                </div>

                                <div
                                    class="absolute left-8 md:left-1/2 -translate-x-1/2 flex items-center justify-center w-8 h-8 rounded-full bg-gray-900 border-4 border-orange-500 shadow-[0_0_20px_rgba(249,115,22,0.5)] z-10">
                                    <div class="w-2.5 h-2.5 bg-white rounded-full"></div>
                                </div>

                                <div class="hidden md:block md:w-1/2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 reveal-on-scroll">
                <div
                    class="relative overflow-hidden rounded-2xl sm:rounded-[2rem] bg-orange-50 dark:bg-gray-900 px-5 sm:px-8 lg:px-14 py-8 sm:py-12 lg:flex lg:items-center lg:gap-x-16 border border-orange-100 dark:border-gray-800">

                    <div class="relative z-10 lg:w-1/2">
                        <img src="https://news.miami.edu/_assets/images-stories/2015/09/_NN27598-15-940x529.jpg"
                            alt="Cooking together" loading="lazy"
                            class="rounded-[2rem] shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-500 border-4 border-white dark:border-gray-700" />
                    </div>

                    <div class="relative z-10 mt-12 lg:mt-0 lg:w-1/2">
                        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black tracking-tight text-gray-900 dark:text-white mb-4">
                            More Than Just Recipes
                        </h2>
                        <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                            What started as a small WhatsApp group of food enthusiasts in 2022 has grown into a global
                            platform. We realized that while recipe books are great, the real magic happens when people
                            tweak, improve, and personalize dishes.
                        </p>
                        <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                            Our purpose is to democratize culinary knowledge. Whether you're a Michelin-star aspirant or
                            someone just trying not to burn toast, YummyShare is your kitchen companion.
                        </p>
                    </div>
                </div>
            </section>

            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 reveal-on-scroll">
                <div class="text-center mb-6">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">Get in Touch</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Have a suggestion or just want to say hi?</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                    <div
                        class="bg-gray-900 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white shadow-2xl relative overflow-hidden h-full">
                        <div
                            class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-orange-500 rounded-full blur-[60px] opacity-20">
                        </div>

                        <div class="space-y-8 relative z-10">
                            <div>
                                <h3 class="font-bold text-gray-400 text-sm uppercase tracking-widest mb-1">Email Us</h3>
                                <a href="mailto:hello@yummyshare.com"
                                    class="text-xl sm:text-2xl font-bold text-white hover:text-orange-400 transition-colors break-all">hello@yummyshare.com</a>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-400 text-sm uppercase tracking-widest mb-1">Visit Us</h3>
                                <p class="text-base sm:text-lg font-medium">123 Culinary Ave,<br>Flavor Town, FT 90210</p>
                            </div>
                            <div class="pt-4 flex gap-4">
                                <a href="#"
                                    class="h-10 w-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-orange-500 transition-all">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                    </svg>
                                </a>
                                <a href="#"
                                    class="h-10 w-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-orange-500 transition-all">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.468.99c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <form class="space-y-4 bg-white dark:bg-gray-900/80 p-5 sm:p-6 rounded-xl sm:rounded-2xl shadow-xl border border-gray-100 dark:border-gray-800">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-900 dark:text-gray-200 ml-1">Name</label>
                                <input type="text" placeholder="John Cook"
                                    class="w-full rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-white/5 px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:border-orange-500 focus:ring-orange-500 transition-shadow">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-900 dark:text-gray-200 ml-1">Email</label>
                                <input type="email" placeholder="john@example.com"
                                    class="w-full rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-white/5 px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:border-orange-500 focus:ring-orange-500 transition-shadow">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-900 dark:text-gray-200 ml-1">Message</label>
                            <textarea rows="4" placeholder="How can we help?"
                                class="w-full rounded-xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-white/5 px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:border-orange-500 focus:ring-orange-500 transition-shadow resize-none"></textarea>
                        </div>
                        <button
                            class="w-full rounded-xl bg-gradient-to-r from-orange-500 to-red-600 px-6 py-3 font-bold text-white transition-all hover:shadow-lg hover:scale-[1.02] active:scale-[0.98]">
                            Send Message
                        </button>
                    </form>
                </div>
            </section>

        </div>
    </Layout>
</template>

<style scoped>
.reveal-on-scroll {
    opacity: 0;
    transform: translateY(40px);
    transition: all 1s cubic-bezier(0.2, 0.8, 0.2, 1);
}

.reveal-on-scroll.is-visible {
    opacity: 1;
    transform: translateY(0);
}
</style>
