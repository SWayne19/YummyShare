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
                class="hidden w-[290px] shrink-0 flex-col border-r border-white/5 bg-slate-950/70 p-0 backdrop-blur-2xl lg:fixed lg:inset-y-0 lg:left-0 lg:flex lg:overflow-hidden"
            >
                <div
                    class="logo-bar-sidebar flex flex-col p-6 border-b border-white/10 h-[72px] justify-center"
                >
                    <Link href="/" class="flex items-center gap-3">
                        <div>
                            <p
                                class="text-lg uppercase tracking-[0.28em] text-indigo-100/90 font-bold"
                            >
                                StudyFlow
                            </p>
                            <p class="text-sm font-semibold text-white">
                                Student Hub
                            </p>
                        </div>
                    </Link>
                </div>
                <div class="mt-8 space-y-6 px-6">
                    <nav class="space-y-2 text-sm font-semibold">
                        <div
                            class="space-y-4.5 text-sm uppercase text-slate-400 font-bold"
                        >
                            Overview
                        </div>
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
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-purple-500/20 text-purple-100 ring-1 ring-white/10 mr-2"
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
                                v-if="isActive('/', { exact: true })"
                                class="ml-auto rounded-full bg-emerald-500/20 px-2.5 py-1 text-[11px] font-semibold text-emerald-100"
                            >
                                Live
                            </span>
                        </Link>
                        <div
                            class="space-y-4.5 text-sm uppercase text-slate-400 font-bold"
                        >
                            Masters
                        </div>
                        <Link
                            @click="closeMobileMenu"
                            :href="route('centers.index')"
                            :class="[
                                'flex items-center gap-3 rounded-xl px-4 py-2 transition focus-visible:outline focus-visible:ring-2 focus-visible:ring-indigo-400',
                                isActive('/centers')
                                    ? 'bg-white/5 text-white ring-1 ring-white/10'
                                    : 'text-slate-100 hover:bg-white/5',
                            ]"
                        >
                            <span
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-green-500/20 text-green-100 ring-1 ring-white/10 mr-2"
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
                                        d="M3 21V7a2 2 0 0 1 2-2h3V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v1h3a2 2 0 0 1 2 2v14M3 21h18M6 21V9m4 12V13m4 8V9"
                                    />
                                </svg>
                            </span>
                            Centers
                            <span
                                v-if="isActive('/centers')"
                                class="ml-auto rounded-full bg-emerald-500/20 px-2.5 py-1 text-[11px] font-semibold text-emerald-100"
                            >
                                Live
                            </span>
                        </Link>
                        <Link
                            :href="route('courseTypes.index')"
                            :class="[
                                navLinkBase + ' text-sm rounded-xl px-3 py-2',
                                isActive('/courseTypes')
                                    ? navLinkActive
                                    : navLinkIdle,
                            ]"
                            prefetch="mount"
                        >
                            <span
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-purple-500/20 text-purple-100 ring-1 ring-white/10 mr-2"
                            >
                                <!-- Course Types icon (list icon) -->
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
                                        d="M4 6h16M4 12h16M4 18h7"
                                    />
                                </svg>
                            </span>
                            Course Types
                            <span
                                v-if="isActive('/courseTypes')"
                                class="ml-auto rounded-full bg-emerald-500/20 px-2.5 py-1 text-[11px] font-semibold text-emerald-100"
                            >
                                Live
                            </span>
                        </Link>
                        <Link
                            :href="route('courses.index')"
                            :class="[
                                navLinkBase + ' text-sm rounded-xl px-3 py-2',
                                isActive('/courses')
                                    ? navLinkActive
                                    : navLinkIdle,
                            ]"
                            prefetch="mount"
                        >
                            <span
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-sky-500/20 text-sky-100 ring-1 ring-white/10 mr-2"
                            >
                                <!-- Course icon (academic cap icon) -->
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
                                        d="M12 14.25L19.5 9.75L12 5.25L4.5 9.75L12 14.25ZM12 14.25V19.5M18 10.5V16.5C18 16.9142 17.8788 17.2652 17.6778 17.5071C17.4767 17.749 17.2167 17.875 16.9433 17.8953C14.8635 18.0554 13.1365 18.0554 11.0567 17.8953C10.7833 17.875 10.5233 17.749 10.3222 17.5071C10.1212 17.2652 10 16.9142 10 16.5V10.5"
                                    />
                                </svg>
                            </span>
                            Courses
                            <span
                                v-if="isActive('/courses')"
                                class="ml-auto rounded-full bg-emerald-500/20 px-2.5 py-1 text-[11px] font-semibold text-emerald-100"
                            >
                                Live
                            </span>
                        </Link>
                    </nav>
                </div>
            </aside>

            <!-- Mobile sidebar -->
            <transition name="fade">
                <div
                    v-if="mobileMenuOpen"
                    class="fixed inset-0 z-50 lg:hidden flex"
                    aria-modal="true"
                    role="dialog"
                >
                    <div
                        class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm"
                        @click="closeMobileMenu"
                        aria-hidden="true"
                    ></div>
                    <div
                        class="mobile-sidebar relative flex h-full w-[290px] flex-col bg-slate-950/95 border-r border-white/5 shadow-2xl ring-1 ring-white/10 p-0"
                    >
                        <div
                            class="logo-bar-sidebar flex flex-col p-6 border-b border-white/10 h-[72px] justify-center"
                        >
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div>
                                        <p
                                            class="text-lg uppercase tracking-[0.22em] text-indigo-100/90 font-bold"
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
                        </div>

                        <div class="flex-1 flex flex-col pt-8 px-6 space-y-6">
                            <nav class="space-y-2 text-sm font-semibold">
                                <div
                                    class="space-y-4.5 text-sm uppercase text-slate-400 font-bold"
                                >
                                    Overview
                                </div>
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
                                    <span
                                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-purple-500/20 text-purple-100 ring-1 ring-white/10 mr-2"
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
                                        v-if="isActive('/', { exact: true })"
                                        class="ml-auto rounded-full bg-emerald-500/20 px-2.5 py-1 text-[11px] font-semibold text-emerald-100"
                                    >
                                        Live
                                    </span>
                                </Link>
                                <div
                                    class="space-y-4.5 text-sm uppercase text-slate-400 font-bold"
                                >
                                    Masters
                                </div>
                                <Link
                                    @click="closeMobileMenu"
                                    :href="route('centers.index')"
                                    :class="[
                                        'flex items-center gap-3 rounded-xl px-4 py-2 transition focus-visible:outline focus-visible:ring-2 focus-visible:ring-indigo-400',
                                        isActive('/centers')
                                            ? 'bg-white/5 text-white ring-1 ring-white/10'
                                            : 'text-slate-100 hover:bg-white/5',
                                    ]"
                                >
                                    <span
                                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-green-500/20 text-green-100 ring-1 ring-white/10 mr-2"
                                    >
                                        <!-- Centers icon (building) -->
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
                                                d="M3 21V7a2 2 0 0 1 2-2h3V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v1h3a2 2 0 0 1 2 2v14M3 21h18M6 21V9m4 12V13m4 8V9"
                                            />
                                        </svg>
                                    </span>
                                    Centers
                                    <span
                                        v-if="isActive('/centers')"
                                        class="ml-auto rounded-full bg-emerald-500/20 px-2.5 py-1 text-[11px] font-semibold text-emerald-100"
                                    >
                                        Live
                                    </span>
                                </Link>
                                <Link
                                    @click="closeMobileMenu"
                                    :href="route('courseTypes.index')"
                                    :class="[
                                        'flex items-center gap-3 rounded-xl px-4 py-2 transition focus-visible:outline focus-visible:ring-2 focus-visible:ring-indigo-400',
                                        isActive('/courseTypes')
                                            ? 'bg-white/5 text-white ring-1 ring-white/10'
                                            : 'text-slate-100 hover:bg-white/5',
                                    ]"
                                >
                                    <span
                                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-purple-500/20 text-purple-100 ring-1 ring-white/10 mr-2"
                                    >
                                        <!-- Course Types icon (list icon) -->
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
                                                d="M4 6h16M4 12h16M4 18h7"
                                            />
                                        </svg>
                                    </span>
                                    Course Types
                                    <span
                                        v-if="isActive('/courseTypes')"
                                        class="ml-auto rounded-full bg-emerald-500/20 px-2.5 py-1 text-[11px] font-semibold text-emerald-100"
                                    >
                                        Live
                                    </span>
                                </Link>
                                <Link
                                    @click="closeMobileMenu"
                                    :href="route('courses.index')"
                                    :class="[
                                        'flex items-center gap-3 rounded-xl px-4 py-2 transition focus-visible:outline focus-visible:ring-2 focus-visible:ring-indigo-400',
                                        isActive('/courses')
                                            ? 'bg-white/5 text-white ring-1 ring-white/10'
                                            : 'text-slate-100 hover:bg-white/5',
                                    ]"
                                >
                                    <span
                                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-sky-500/20 text-sky-100 ring-1 ring-white/10 mr-2"
                                    >
                                        <!-- Course icon (academic cap icon) -->
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
                                                d="M12 14.25L19.5 9.75L12 5.25L4.5 9.75L12 14.25ZM12 14.25V19.5M18 10.5V16.5C18 16.9142 17.8788 17.2652 17.6778 17.5071C17.4767 17.749 17.2167 17.875 16.9433 17.8953C14.8635 18.0554 13.1365 18.0554 11.0567 17.8953C10.7833 17.875 10.5233 17.749 10.3222 17.5071C10.1212 17.2652 10 16.9142 10 16.5V10.5"
                                            />
                                        </svg>
                                    </span>
                                    Courses
                                    <span
                                        v-if="isActive('/courses')"
                                        class="ml-auto rounded-full bg-emerald-500/20 px-2.5 py-1 text-[11px] font-semibold text-emerald-100"
                                    >
                                        Live
                                    </span>
                                </Link>
                            </nav>
                            <div class="mt-auto space-y-3">
                                <p class="text-xs text-slate-400">
                                    &copy;
                                    {{ new Date().getFullYear() }} StudyFlow.
                                    Organized learning for everyone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            <div class="flex h-full flex-1 flex-col min-w-0 lg:ml-[290px]">
                <header
                    class="sticky top-0 z-30 bg-slate-950/80 px-4 py-0 backdrop-blur-2xl sm:px-6 lg:px-10 border-b border-white/10 h-[72px] flex items-center"
                >
                    <div class="flex items-center gap-3 lg:hidden h-full">
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

                <!-- Global flash messages - compact, modernized style -->
                <transition name="fade">
                    <div
                        v-if="showFlash && (flash.success || flash.error)"
                        class="pointer-events-none fixed inset-x-0 top-6 z-50 flex justify-center px-2 sm:justify-end sm:px-6"
                    >
                        <div
                            class="pointer-events-auto flex w-full max-w-sm items-start gap-4 rounded-xl border px-4 py-3 text-sm font-semibold shadow-xl backdrop-blur-lg"
                            :class="
                                flash.success
                                    ? 'border-emerald-400/70 bg-emerald-600/90 text-white shadow-emerald-700/30'
                                    : 'border-rose-400/70 bg-rose-600/90 text-white shadow-rose-700/25'
                            "
                            style="box-shadow: 0 8px 28px 0 rgba(23,41,85,0.15), 0 2px 8px 0 #0001;"
                        >
                            <div class="mt-0.5 flex-shrink-0">
                                <svg
                                    v-if="flash.success"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <circle cx="12" cy="12" r="10" class="text-emerald-200/60" fill="currentColor" fill-opacity="0.12"/>
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12.75 11.25 15 15 9.75"
                                        class="text-emerald-100"
                                        stroke="currentColor"
                                    />
                                </svg>
                                <svg
                                    v-else
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <circle cx="12" cy="12" r="10" class="text-rose-200/60" fill="currentColor" fill-opacity="0.12"/>
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4m0 4h.01"
                                        class="text-rose-100"
                                        stroke="currentColor"
                                    />
                                </svg>
                            </div>
                            <div class="flex-1 ml-1">
                                <p class="font-semibold text-base tracking-wide mb-0.5">
                                    {{ flash.success ? "Success" : "Error" }}
                                </p>
                                <p class="text-[15px] text-white/95 leading-snug">
                                    {{ flash.success || flash.error }}
                                </p>
                            </div>
                            <button
                                type="button"
                                class="ml-2 rounded-full p-1.5 text-lg text-white/80 transition hover:bg-white/10 hover:text-white/95 focus:outline-none"
                                @click="showFlash = false"
                                title="Close notification"
                            >
                                <span aria-hidden="true">✕</span>
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
                <footer class="px-4 pb-4 pt-2 sm:px-6 lg:px-10">
                    <div class="flex justify-center">
                        <p class="text-xs text-slate-400">
                            &copy;
                            {{ new Date().getFullYear() }} StudyFlow. Organized
                            learning for everyone.
                        </p>
                    </div>
                </footer>
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
