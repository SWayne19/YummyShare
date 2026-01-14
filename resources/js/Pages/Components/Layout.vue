<script setup>
import { ref, onMounted, onBeforeUnmount, computed, watch } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const mobileMenuOpen = ref(false);

const page = usePage();
const currentPath = computed(() => {
    const url = page.url ?? "/";
    return (url.split("?")[0] || "/").replace(/\/+$/, "") || "/";
});

function isActive(target, { exact = false } = {}) {
    const normalizedTarget = (target || "/").replace(/\/+$/, "") || "/";
    if (exact) return currentPath.value === normalizedTarget;
    if (normalizedTarget === "/") return currentPath.value === "/";
    return (
        currentPath.value === normalizedTarget ||
        currentPath.value.startsWith(normalizedTarget + "/")
    );
}

const navLinkBase =
    "flex items-center gap-3 rounded-2xl px-4 py-3 transition focus-visible:outline focus-visible:ring-2 focus-visible:ring-indigo-400";
const navLinkIdle =
    "text-slate-200 hover:-translate-y-0.5 hover:bg-white/5 hover:text-white";
const navLinkActive =
    "border border-white/5 bg-white/5 text-indigo-50 shadow-lg shadow-indigo-950/30 hover:-translate-y-0.5 hover:border-indigo-400/50 hover:bg-indigo-500/10";

function toggleMobileMenu() {
    mobileMenuOpen.value = !mobileMenuOpen.value;
}

function closeMobileMenu() {
    mobileMenuOpen.value = false;
}

function handleEscape(event) {
    if (event.key === "Escape") {
        mobileMenuOpen.value = false;
    }
}

onMounted(() => {
    window.addEventListener("keydown", handleEscape);
});
onBeforeUnmount(() => {
    window.removeEventListener("keydown", handleEscape);
});

const flash = computed(() => page.props.flash || {});
const showFlash = ref(false);

watch(
    flash,
    (value) => {
        if (value?.success || value?.error) {
            showFlash.value = true;

            window.clearTimeout(showFlash._timeoutId);
            showFlash._timeoutId = window.setTimeout(() => {
                showFlash.value = false;
            }, 4000);
        }
    },
    { immediate: true, deep: true }
);
</script>

<template>
    <div
        class="relative h-screen overflow-hidden bg-slate-950 text-slate-800 selection:bg-indigo-200 selection:text-slate-900"
    >
        <!-- Ambient gradient mesh -->
        <div class="pointer-events-none fixed inset-0 overflow-hidden">
            <div
                class="absolute -left-32 top-0 h-80 w-80 rounded-full bg-indigo-600/35 blur-[120px] animate-pulse-slow"
                aria-hidden="true"
            ></div>
            <div
                class="absolute bottom-16 right-0 h-96 w-96 rounded-full bg-sky-400/30 blur-[140px] animate-pulse-slow"
                aria-hidden="true"
            ></div>
            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(99,102,241,0.08),transparent_35%),radial-gradient(circle_at_80%_0%,rgba(45,212,191,0.05),transparent_30%),radial-gradient(circle_at_50%_80%,rgba(56,189,248,0.08),transparent_25%)] opacity-70"
                aria-hidden="true"
            ></div>
        </div>

        <div class="relative z-10 flex h-full">
            <!-- Desktop sidebar -->
            <aside
                class="hidden w-[290px] shrink-0 flex-col border-r border-white/5 bg-slate-950/70 p-6 backdrop-blur-2xl lg:fixed lg:inset-y-0 lg:left-0 lg:flex lg:overflow-hidden"
            >
                <Link href="/" class="flex items-center gap-3">
                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-2xl bg-linear-to-br from-indigo-500 via-sky-400 to-indigo-700 text-lg font-black text-white shadow-xl shadow-indigo-500/30 ring-4 ring-white/10"
                    >
                        SF
                    </div>
                    <div>
                        <p
                            class="text-xs uppercase tracking-[0.28em] text-indigo-100/90 font-semibold"
                        >
                            StudyFlow
                        </p>
                        <p class="text-base font-semibold text-white">
                            Student Hub
                        </p>
                    </div>
                </Link>

                <div class="mt-8 space-y-6">
                    <div class="space-y-1.5 text-xs uppercase text-slate-400">
                        Overview
                    </div>
                    <nav class="space-y-2 text-sm font-semibold">
                        <Link
                            :class="[
                                navLinkBase,
                                isActive('/', { exact: true })
                                    ? navLinkActive
                                    : navLinkIdle,
                            ]"
                            href="/"
                            prefetch="mount"
                        >
                            <span
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-500/20 text-indigo-100 ring-1 ring-white/10"
                            >
                                <!-- dashboard icon -->
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5"
                                    />
                                </svg>
                            </span>
                            Dashboard
                            <span
                                class="ml-auto rounded-full bg-emerald-500/20 px-2.5 py-1 text-[11px] font-semibold text-emerald-100"
                            >
                                Live
                            </span>
                        </Link>
                        <Link
                            :href="route('articles.index')"
                            :class="[
                                navLinkBase,
                                isActive('/articles')
                                    ? navLinkActive
                                    : navLinkIdle,
                            ]"
                            prefetch="mount"
                        >
                            <span
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5 text-slate-200 ring-1 ring-white/5"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 19.128a9.004 9.004 0 0 0 6-8.508m-6 8.508a9.003 9.003 0 0 1-6 0m6 0a5.25 5.25 0 1 0-6 0m0 0a9.004 9.004 0 0 1-6-8.508m12 0a9.004 9.004 0 0 0-6-8.508m0 0a9.004 9.004 0 0 0-6 8.508"
                                    />
                                </svg>
                            </span>
                            Articles
                        </Link>
                        <Link
                            :href="route('courseTypes.index')"
                            :class="[
                                navLinkBase,
                                isActive('/courseTypes')
                                    ? navLinkActive
                                    : navLinkIdle,
                            ]"
                            prefetch="mount"
                        >
                            <span
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5 text-slate-200 ring-1 ring-white/5"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4.5 6.75h15m-15 0a1.5 1.5 0 0 0-1.5 1.5v9a1.5 1.5 0 0 0 1.5 1.5h15a1.5 1.5 0 0 0 1.5-1.5v-9a1.5 1.5 0 0 0-1.5-1.5m-15 0V5.25A2.25 2.25 0 0 1 6.75 3h10.5A2.25 2.25 0 0 1 19.5 5.25V6.75m-12 6h9"
                                    />
                                </svg>
                            </span>
                            Course Types
                        </Link>
                        <Link
                            :class="[navLinkBase, navLinkIdle]"
                            href="#reports"
                        >
                            <span
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5 text-slate-200 ring-1 ring-white/5"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875zm6-9.75C9 2.754 9.504 2.25 10.125 2.25h2.25c.621 0 1.125.504 1.125 1.125v16.5c0 .621-.504 1.125-1.125 1.125h-2.25A1.125 1.125 0 0 1 9 19.875zm6 6.75c0-.621.504-1.125 1.125-1.125h2.25C18.996 9 19.5 9.504 19.5 10.125v9.75A1.125 1.125 0 0 1 18.375 21h-2.25A1.125 1.125 0 0 1 15 19.875z"
                                    />
                                </svg>
                            </span>
                            Reports
                        </Link>
                        <Link
                            :class="[navLinkBase, navLinkIdle]"
                            href="#support"
                        >
                            <span
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5 text-slate-200 ring-1 ring-white/5"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 18.75a.75.75 0 0 1-.75-.75v-2.25a.75.75 0 0 1 .428-.677 3.75 3.75 0 1 0-4.928-3.536.75.75 0 0 1-1.496 0 5.25 5.25 0 1 1 7.178 4.859v1.604a.75.75 0 0 1-.432.685l-3 1.5a.75.75 0 1 1-.684-1.342l2.684-1.342V18a.75.75 0 0 1-.75.75z"
                                    />
                                </svg>
                            </span>
                            Help center
                        </Link>
                    </nav>
                </div>
            </aside>

            <!-- Mobile sidebar -->
            <transition name="fade">
                <div
                    v-if="mobileMenuOpen"
                    class="fixed inset-0 z-50 flex lg:hidden"
                    aria-modal="true"
                    role="dialog"
                >
                    <div
                        class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm"
                        @click="closeMobileMenu"
                        aria-hidden="true"
                    ></div>
                    <div
                        class="relative ml-auto flex h-full w-4/5 max-w-sm flex-col gap-6 border-l border-white/10 bg-slate-950/95 p-6 shadow-2xl ring-1 ring-white/10"
                    >
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-linear-to-br from-indigo-500 via-sky-400 to-indigo-700 text-sm font-black text-white shadow-lg shadow-indigo-500/30 ring-2 ring-white/10"
                                >
                                    SF
                                </div>
                                <div>
                                    <p
                                        class="text-xs uppercase tracking-[0.22em] text-indigo-100/90 font-semibold"
                                    >
                                        StudyFlow
                                    </p>
                                    <p class="text-sm text-white/90">
                                        Student dashboard
                                    </p>
                                </div>
                            </div>
                            <button
                                @click="closeMobileMenu"
                                class="rounded-full p-2 text-slate-200 transition hover:bg-white/10"
                                type="button"
                                aria-label="Close menu"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="h-6 w-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 18 18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>

                        <nav class="space-y-2 text-sm font-semibold">
                            <Link
                                @click="closeMobileMenu"
                                :class="[
                                    'flex items-center gap-3 rounded-xl px-4 py-3 transition ring-1 ring-white/10',
                                    isActive('/', { exact: true })
                                        ? 'bg-white/5 text-white'
                                        : 'text-slate-100 hover:bg-white/5',
                                ]"
                                href="/"
                            >
                                Dashboard
                            </Link>
                            <Link
                                @click="closeMobileMenu"
                                :class="[
                                    'flex items-center gap-3 rounded-xl px-4 py-3 transition focus-visible:outline focus-visible:ring-2 focus-visible:ring-indigo-400',
                                    isActive('/articles')
                                        ? 'bg-white/5 text-white ring-1 ring-white/10'
                                        : 'text-slate-100 hover:bg-white/5',
                                ]"
                                href="/articles"
                            >
                                Articles
                            </Link>
                            <Link
                                @click="closeMobileMenu"
                                class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-100 transition hover:bg-white/5 focus-visible:outline focus-visible:ring-2 focus-visible:ring-indigo-400"
                                href="#courses"
                            >
                                Courses
                            </Link>
                            <Link
                                @click="closeMobileMenu"
                                class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-100 transition hover:bg-white/5 focus-visible:outline focus-visible:ring-2 focus-visible:ring-indigo-400"
                                href="#reports"
                            >
                                Reports
                            </Link>
                            <a
                                @click="closeMobileMenu"
                                class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-100 transition hover:bg-white/5 focus-visible:outline focus-visible:ring-2 focus-visible:ring-indigo-400"
                                href="#support"
                            >
                                Support
                            </a>
                        </nav>

                        <div class="mt-auto space-y-3">
                            <button
                                class="flex w-full items-center justify-center rounded-xl bg-linear-to-r from-indigo-500 to-sky-400 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:-translate-y-0.5"
                                type="button"
                            >
                                Add new student
                            </button>
                            <p class="text-xs text-slate-400">
                                &copy; {{ new Date().getFullYear() }} StudyFlow.
                                Organized learning for everyone.
                            </p>
                        </div>
                    </div>
                </div>
            </transition>

            <div class="flex h-full flex-1 flex-col min-w-0 lg:ml-[290px]">
                <header
                    class="sticky top-0 z-30 border-b border-white/5 bg-slate-950/80 px-4 py-4 backdrop-blur-2xl sm:px-6 lg:px-10"
                >
                    <div class="flex items-center gap-3 lg:hidden">
                        <button
                            @click="toggleMobileMenu"
                            class="rounded-2xl border border-white/15 bg-white/5 p-2 text-white shadow-md shadow-indigo-500/20 transition hover:border-indigo-400/40 hover:bg-indigo-500/10"
                            type="button"
                            aria-label="Open menu"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.6"
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
                        <div class="text-sm font-semibold text-white">
                            StudyFlow Dashboard
                        </div>
                    </div>
                    <div
                        class="hidden items-center justify-between gap-6 lg:flex"
                    >
                        <div>
                            <p class="text-sm text-slate-300">
                                Monitor attendance, performance, and course
                                health in one calm view.
                            </p>
                        </div>
                    </div>
                </header>

                <!-- Global flash messages -->
                <transition name="fade">
                    <div
                        v-if="showFlash && (flash.success || flash.error)"
                        class="pointer-events-none fixed inset-x-0 top-4 z-40 flex justify-center px-4 sm:justify-end sm:px-8"
                    >
                        <div
                            class="pointer-events-auto flex max-w-sm items-start gap-3 rounded-2xl border px-4 py-3 text-sm shadow-lg backdrop-blur-xl"
                            :class="
                                flash.success
                                    ? 'border-emerald-400/40 bg-emerald-500/15 text-emerald-100 shadow-emerald-500/30'
                                    : 'border-red-400/40 bg-red-500/15 text-red-100 shadow-red-500/30'
                            "
                        >
                            <div class="mt-0.5">
                                <svg
                                    v-if="flash.success"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12.75 11.25 15 15 9.75M21 12A9 9 0 1 1 3 12a9 9 0 0 1 18 0Z"
                                    />
                                </svg>
                                <svg
                                    v-else
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
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
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold">
                                    {{ flash.success ? "Success" : "Error" }}
                                </p>
                                <p class="mt-0.5 text-xs text-white/90">
                                    {{ flash.success || flash.error }}
                                </p>
                            </div>
                            <button
                                type="button"
                                class="ml-1 rounded-full p-1 text-xs text-white/70 transition hover:bg-white/10"
                                @click="showFlash = false"
                            >
                                ✕
                            </button>
                        </div>
                    </div>
                </transition>

                <main
                    class="min-h-0 flex-1 overflow-y-auto px-4 pb-16 pt-6 sm:px-6 lg:px-10"
                >
                    <div
                        class="rounded-3xl border border-white/5 bg-white/5 bg-linear-to-br from-white/5 via-white/5 to-white/0 p-4 shadow-2xl shadow-indigo-950/40 ring-1 ring-white/10 backdrop-blur-2xl lg:p-6"
                    >
                        <slot />
                    </div>
                </main>
            </div>
        </div>
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
