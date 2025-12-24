<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { Link } from "@inertiajs/vue3";

const mobileMenuOpen = ref(false);
const showNavbar = ref(true);
let lastScroll = window.scrollY;

function openMenu() {
    mobileMenuOpen.value = true;
}

function closeMenu() {
    mobileMenuOpen.value = false;
}

// Show/hide navbar on scroll
function handleScroll() {
    const currentScroll = window.scrollY;
    if (currentScroll <= 10) {
        showNavbar.value = true; // always show at top
    } else if (currentScroll > lastScroll + 7) {
        showNavbar.value = false; // scrolling down, hide
    } else if (currentScroll < lastScroll - 7) {
        showNavbar.value = true; // scrolling up, show
    }
    lastScroll = currentScroll;
}

onMounted(() => {
    window.addEventListener("scroll", handleScroll, { passive: true });
});
onBeforeUnmount(() => {
    window.removeEventListener("scroll", handleScroll);
});
</script>

<template>
    <div
        class="relative min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 text-slate-100"
    >
        <!-- Animated, modern background gradient blobs -->
        <div
            class="pointer-events-none fixed inset-0 opacity-60"
            aria-hidden="true"
        >
            <div
                class="absolute -left-44 top-[-12%] h-96 w-96 animate-pulse-slow bg-indigo-500 blur-[130px] rounded-full opacity-70"
            ></div>
            <div
                class="absolute right-0 top-24 h-80 w-80 animate-pulse-slow bg-emerald-400 blur-[120px] rounded-full opacity-60"
            ></div>
            <div
                class="absolute bottom-0 right-32 h-40 w-40 animate-pulse bg-indigo-400/40 blur-2xl rounded-full"
            ></div>
        </div>

        <!-- Highlight ring for entered page -->
        <div class="pointer-events-none fixed left-0 top-0 z-30 h-full w-full">
            <div
                class="absolute inset-5 md:inset-12 rounded-[2.5rem] border-4 border-indigo-500/10 shadow-[0_0_120px_60px_rgba(99,102,241,0.08)]"
            ></div>
        </div>

        <transition name="navbar-fade-slide">
            <header
                v-show="showNavbar"
                class="fixed top-0 inset-x-0 z-40 border-b border-white/10 bg-slate-950/80 backdrop-blur transition-transform duration-300"
                style="will-change: transform"
            >
                <div
                    class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5"
                >
                    <Link href="/">
                        <div class="flex items-center gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-tr from-indigo-600 via-indigo-400 to-indigo-700 text-xl font-extrabold text-white shadow-xl shadow-indigo-600/30 ring-4 ring-indigo-500/10 animate-in fade-in"
                            >
                                S
                            </div>
                            <div>
                                <p
                                    class="text-xs md:text-sm uppercase tracking-[0.3em] font-medium text-indigo-200/90 drop-shadow-sm select-none"
                                >
                                    swamArticle
                                </p>
                                <p
                                    class="text-base font-bold text-white drop-shadow"
                                >
                                    Stories that stay
                                </p>
                            </div>
                        </div>
                    </Link>
                    <nav
                        class="hidden items-center gap-7 text-base font-medium md:flex"
                    >
                        <Link
                            class="relative text-slate-200/90 transition hover:text-indigo-200 hover:underline hover:underline-offset-4 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 rounded px-2 py-1"
                            href="/"
                        >
                            Home
                        </Link>
                        <Link
                            class="relative text-slate-200/90 transition hover:text-indigo-200 hover:underline hover:underline-offset-4 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 rounded px-2 py-1"
                            href="/articles"
                        >
                            Articles
                        </Link>
                        <Link
                            class="relative text-slate-200/90 transition hover:text-indigo-200 hover:underline hover:underline-offset-4 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 rounded px-2 py-1"
                            href="/about"
                        >
                            About
                        </Link>
                        <Link
                            class="relative text-slate-200/90 transition hover:text-indigo-200 hover:underline hover:underline-offset-4 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 rounded px-2 py-1"
                            href="/content"
                        >
                            Contact
                        </Link>
                    </nav>
                    <button
                        @click="openMenu"
                        class="md:hidden rounded-full border border-white/20 bg-slate-800/60 p-2 text-white hover:border-indigo-400/60 hover:bg-slate-700/80 transition"
                        type="button"
                        aria-label="Open menu"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-6 w-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"
                            />
                        </svg>
                    </button>
                </div>
                <!-- Mobile menu (Drawer) -->
                <transition name="fade">
                    <div
                        v-if="mobileMenuOpen"
                        class="fixed inset-0 z-50 flex"
                        aria-modal="true"
                        role="dialog"
                    >
                        <!-- Overlay with less transparency -->
                        <div
                            class="fixed inset-0 z-40 bg-[#181F3A]/90 backdrop-blur transition-opacity"
                            @click="closeMenu"
                            aria-hidden="true"
                        ></div>
                        <!-- Drawer content -->
                        <div
                            class="relative z-50 ml-auto w-4/5 max-w-xs h-full bg-gradient-to-br from-slate-800 via-slate-900 to-indigo-950 bg-opacity-100 shadow-2xl ring-1 ring-indigo-900/30 flex flex-col py-8 px-6 animate-in fade-in-right rounded-l-2xl"
                        >
                            <div
                                class="flex items-center justify-between mb-10"
                            >
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-10 w-10 flex items-center justify-center rounded-xl bg-gradient-to-tr from-indigo-600 via-indigo-400 to-indigo-700 text-lg font-extrabold text-white shadow-md shadow-indigo-600/20 ring-2 ring-indigo-400/20"
                                    >
                                        S
                                    </div>
                                    <div>
                                        <p
                                            class="text-xs uppercase tracking-[0.25em] text-indigo-100 font-semibold select-none"
                                        >
                                            swamArticle
                                        </p>
                                    </div>
                                </div>
                                <button
                                    @click="closeMenu"
                                    class="hover:bg-white/10 rounded-full p-2 transition"
                                    type="button"
                                    aria-label="Close menu"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="h-6 w-6 text-indigo-100"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 18 18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                            <nav
                                class="flex flex-col gap-4 text-base font-medium"
                            >
                                <Link
                                    @click="closeMenu"
                                    class="rounded-lg px-3 py-2 text-slate-100 hover:bg-indigo-500/90 focus-visible:outline focus-visible:ring-2 focus-visible:ring-indigo-400 transition"
                                    href="/"
                                >
                                    Home
                                </Link>
                                <Link
                                    @click="closeMenu"
                                    class="rounded-lg px-3 py-2 text-slate-100 hover:bg-indigo-500/90 focus-visible:outline focus-visible:ring-2 focus-visible:ring-indigo-400 transition"
                                    href="/articles"
                                >
                                    Articles
                                </Link>
                                <Link
                                    @click="closeMenu"
                                    class="rounded-lg px-3 py-2 text-slate-100 hover:bg-indigo-500/90 focus-visible:outline focus-visible:ring-2 focus-visible:ring-indigo-400 transition"
                                    href="/about"
                                >
                                    About
                                </Link>
                                <a
                                    @click="closeMenu"
                                    class="rounded-lg px-3 py-2 text-slate-100 hover:bg-indigo-500/90 focus-visible:outline focus-visible:ring-2 focus-visible:ring-indigo-400 transition"
                                    href="#"
                                >
                                    Contact
                                </a>
                            </nav>
                            <div
                                class="mt-10 border-t border-white/10 pt-6 flex flex-col gap-2 text-xs text-slate-400"
                            >
                                <a
                                    href="#"
                                    class="transition hover:text-white hover:underline underline-offset-4"
                                    >Privacy Policy</a
                                >
                                <a
                                    href="#"
                                    class="transition hover:text-white hover:underline underline-offset-4"
                                    >Terms of Service</a
                                >
                                <a
                                    href="#"
                                    class="transition hover:text-white hover:underline underline-offset-4"
                                    >Support</a
                                >
                            </div>
                            <div class="mt-auto pt-8">
                                <p class="text-xs text-slate-500">
                                    &copy;
                                    {{ new Date().getFullYear() }} swamArticle
                                </p>
                            </div>
                        </div>
                    </div>
                </transition>
                <!-- Animated accent underline -->
                <div class="mx-auto max-w-7xl px-6">
                    <div
                        class="h-1 w-full rounded-b-2xl bg-gradient-to-r from-indigo-700/30 via-emerald-500/10 to-transparent blur-[2px] opacity-75"
                    ></div>
                </div>
            </header>
        </transition>

        <!-- Fixed height for header and footer: add spacing using pt and pb on main -->
        <main class="relative z-10 pt-[81px] pb-[75px]">
            <div class="mx-auto max-w-3xl px-4 lg:px-0 py-10">
                <div
                    class="rounded-3xl bg-white/5 shadow-2xl ring-1 ring-white/10 ring-inset backdrop-blur-lg transition-all duration-500 hover:shadow-indigo-700/25 hover:ring-indigo-500/30"
                >
                    <slot />
                </div>
            </div>
        </main>

        <footer
            class="fixed bottom-0 inset-x-0 z-40 border-t border-white/10 bg-slate-950/90 backdrop-blur transition"
        >
            <div
                class="mx-auto flex max-w-7xl flex-col gap-4 px-6 py-6 text-sm text-slate-300 md:flex-row md:items-center md:justify-between"
            >
                <p
                    class="font-semibold text-white tracking-tight flex items-center gap-2"
                >
                    <svg
                        class="inline h-5 w-5 text-indigo-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        viewBox="0 0 22 22"
                    >
                        <circle
                            cx="11"
                            cy="11"
                            r="10"
                            stroke="currentColor"
                            fill="none"
                        />
                        <path
                            d="M7 11l3 3 5-5"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                    swamArticle — Crafted for curious readers.
                </p>
                <div class="flex items-center gap-4">
                    <a
                        class="transition hover:text-white hover:underline underline-offset-4"
                        href="#"
                        >Privacy</a
                    >
                    <a
                        class="transition hover:text-white hover:underline underline-offset-4"
                        href="#"
                        >Terms</a
                    >
                    <a
                        class="transition hover:text-white hover:underline underline-offset-4"
                        href="#"
                        >Support</a
                    >
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>
@keyframes pulse-slow {
    0%,
    100% {
        opacity: 0.6;
        filter: blur(120px);
    }
    50% {
        opacity: 0.93;
        filter: blur(140px);
    }
}
.animate-pulse-slow {
    animation: pulse-slow 9s cubic-bezier(0.4, 0, 0.2, 1) infinite;
}

/* Modern mobile menu transitions */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.18s cubic-bezier(0.4, 0, 0.2, 1),
        transform 0.23s cubic-bezier(0.4, 0, 0.2, 1);
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
.fade-enter-to,
.fade-leave-from {
    opacity: 1;
}
.fade-in-right-enter-active {
    transition: all 0.28s cubic-bezier(0.53, 0.18, 0.19, 1.09);
}
.fade-in-right-enter-from {
    opacity: 0;
    transform: translateX(100%);
}
.fade-in-right-enter-to {
    opacity: 1;
    transform: translateX(0%);
}

/* Show/hide navbar animation */
.navbar-fade-slide-enter-active,
.navbar-fade-slide-leave-active {
    transition: opacity 0.23s cubic-bezier(0.4, 0, 0.2, 1),
        transform 0.31s cubic-bezier(0.53, 0.18, 0.19, 1.09);
}
.navbar-fade-slide-enter-from,
.navbar-fade-slide-leave-to {
    opacity: 0;
    transform: translateY(-70%);
}
.navbar-fade-slide-enter-to,
.navbar-fade-slide-leave-from {
    opacity: 1;
    transform: translateY(0%);
}
</style>
