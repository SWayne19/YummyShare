<template>
    <footer class="w-full border-t border-orange-900 bg-gradient-to-tr from-black via-black to-orange-900">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-7 lg:px-9 py-10 sm:py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-6">
                <!-- Brand and Mission -->
                <div class="flex flex-col gap-4 sm:col-span-2 lg:col-span-1">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-base font-bold text-orange-50 glass-text-bright">YummyShare</span>
                    </div>
                    <p class="text-sm text-orange-200 leading-relaxed">
                        Connecting passionate cooks worldwide. YummyShare is built for sharing global food traditions, creative recipes, and delicious discoveries.
                    </p>
                </div>
                <!-- Discover YummyShare -->
                <div class="flex flex-col gap-3">
                    <h3 class="text-base font-semibold text-orange-300 mb-1">About</h3>
                    <p class="text-sm text-orange-200 leading-relaxed mb-1">
                        <span class="font-semibold text-orange-100">15k+ Recipes Shared</span><br>
                        <span class="font-semibold text-orange-100">8k+ Active Cooks</span><br>
                        <span class="font-semibold text-orange-100">45+ Countries Reached</span>
                    </p>
                    <p class="text-sm text-orange-200">
                        Since 2022, YummyShare makes it easy to collect favorite recipes, connect with other home chefs, and preserve your culinary heritage.
                    </p>
                </div>
                <!-- Contact & Social -->
                <div class="flex flex-col gap-4">
                    <h3 class="text-base font-semibold text-orange-300 mb-1">Contact & Social</h3>
                    <div class="flex flex-col gap-2">
                        <a href="mailto:hello@yummyshare.com"
                            class="flex items-center gap-2 rounded-full bg-white/10 px-2.5 py-1 shadow text-orange-300 font-semibold text-sm hover:bg-orange-600/30 hover:text-orange-200 transition-all border border-orange-700 glass-ui-bright w-max">
                            <svg class="h-4 w-4 text-orange-300" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2.94 5.06a1.5 1.5 0 0 1 .95-.34h12.12a1.5 1.5 0 0 1 .95.34l-6.01 4.72a.75.75 0 0 1-.95 0L2.94 5.06zm-1.01 8.07A1.5 1.5 0 0 0 4.5 16h11a1.5 1.5 0 0 0 1.5-2.87l-5.77-4.53c-.74-.58-1.8-.58-2.54 0L1.93 13.13z" />
                            </svg>
                            hello@yummyshare.com
                        </a>
                        <div class="flex gap-3 mt-1">
                            <a href="https://twitter.com" target="_blank" rel="noopener" aria-label="Twitter"
                                class="h-8 w-8 rounded-full bg-white/10 flex items-center justify-center text-orange-300 hover:text-orange-100 shadow glass-ui-bright transition-colors border border-orange-800">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                            <a href="https://instagram.com" target="_blank" rel="noopener" aria-label="Instagram"
                                class="h-8 w-8 rounded-full bg-white/10 flex items-center justify-center text-orange-300 hover:text-orange-100 shadow glass-ui-bright transition-colors border border-orange-800">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.468.99c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="text-sm text-orange-200 mt-2">
                        123 Culinary Ave, Flavor Town, FT 90210
                    </div>
                </div>
                <!-- Useful Links -->
                <div class="flex flex-col gap-3">
                    <h3 class="text-base font-semibold text-orange-300 mb-1">Quick Links</h3>
                    <ul class="flex flex-col gap-1 text-sm text-orange-200">
                        <li>
                            <a href="#" class="hover:text-orange-100 transition-colors">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-orange-100 transition-colors">Terms of Service</a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-orange-100 transition-colors">About Us</a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-orange-100 transition-colors">Help Center</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="w-full mt-6 mb-3 text-center text-sm text-orange-400 font-medium">
            &copy; 2026 YummyShare. All rights reserved.
        </div>
    </footer>
</template>

<style scoped>
.glass-ui-bright {
    box-shadow: 0 4px 48px 0 rgba(255, 191, 71, 0.09), 0 1.5px 5px 0 rgba(255, 255, 255, 0.12) inset;
    background: rgba(255, 255, 255, 0.08);
    border: 1.5px solid rgba(252, 146, 43, 0.18);
    backdrop-filter: blur(12px) saturate(140%);
    -webkit-backdrop-filter: blur(12px) saturate(140%);
}

.glass-text-bright {
    color: #fff6e1;
    text-shadow: 0 1px 10px rgba(248, 191, 81, 0.28), 0 2px 8px rgba(255, 143, 44, 0.19);
}
</style>
