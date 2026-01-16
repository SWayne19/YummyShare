<template lang="">
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
                            {{ isEdit ? "Edit Center" : "Create Center" }}
                        </p>
                        <h1 class="text-3xl font-bold text-white sm:text-4xl">
                            {{
                                isEdit
                                    ? "Update your center"
                                    : "Share your new center with the world"
                            }}
                        </h1>
                        <p class="text-slate-200">
                            {{
                                isEdit
                                    ? "Make changes to this center for use in your student management system."
                                    : "Create and add a new center to manage in your student management system."
                            }}
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <Link
                            prefetch="mount"
                            :href="route('centers.index')"
                            class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-indigo-950/10 transition hover:border-white/25 hover:bg-white/10 cursor-pointer"
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
                    <!-- Center Name -->
                    <div>
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-indigo-100"
                        >
                            Name
                        </label>
                        <input
                            type="text"
                            id="name"
                            v-model="form.name"
                            class="w-full rounded-lg border border-white/15 bg-slate-800/60 p-3 text-white placeholder-slate-400 transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 outline-none"
                            placeholder="Center name (e.g., Downtown Center)"
                            autocomplete="off"
                            :aria-invalid="form.errors.name ? 'true' : 'false'"
                            :class="
                                form.errors.name
                                    ? 'border-red-500 focus:border-red-400 focus:ring-red-200'
                                    : ''
                            "
                        />
                        <transition name="fade">
                            <div
                                v-if="form.errors.name"
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
                                    form.errors.name
                                }}</span>
                            </div>
                        </transition>
                    </div>

                    <!-- Center Code -->
                    <div>
                        <label
                            for="code"
                            class="block mb-2 text-sm font-medium text-indigo-100"
                        >
                            Code
                        </label>
                        <input
                            type="text"
                            id="code"
                            v-model="form.code"
                            class="w-full rounded-lg border border-white/15 bg-slate-800/60 p-3 text-white placeholder-slate-400 transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 outline-none"
                            placeholder="Center code (e.g., CEN123)"
                            autocomplete="off"
                            :aria-invalid="form.errors.code ? 'true' : 'false'"
                            :class="
                                form.errors.code
                                    ? 'border-red-500 focus:border-red-400 focus:ring-red-200'
                                    : ''
                            "
                        />
                        <transition name="fade">
                            <div
                                v-if="form.errors.code"
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
                                    form.errors.code
                                }}</span>
                            </div>
                        </transition>
                    </div>

                    <!-- Center Address -->
                    <div>
                        <label
                            for="address"
                            class="block mb-2 text-sm font-medium text-indigo-100"
                        >
                            Address
                        </label>
                        <input
                            type="text"
                            id="address"
                            v-model="form.address"
                            class="w-full rounded-lg border border-white/15 bg-slate-800/60 p-3 text-white placeholder-slate-400 transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 outline-none"
                            placeholder="Center address (optional)"
                            autocomplete="off"
                            :aria-invalid="
                                form.errors.address ? 'true' : 'false'
                            "
                            :class="
                                form.errors.address
                                    ? 'border-red-500 focus:border-red-400 focus:ring-red-200'
                                    : ''
                            "
                        />
                        <transition name="fade">
                            <div
                                v-if="form.errors.address"
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
                                    form.errors.address
                                }}</span>
                            </div>
                        </transition>
                    </div>

                    <!-- Center Phone -->
                    <div>
                        <label
                            for="phone"
                            class="block mb-2 text-sm font-medium text-indigo-100"
                        >
                            Phone
                        </label>
                        <input
                            type="number"
                            id="phone"
                            v-model="form.phone"
                            class="w-full rounded-lg border border-white/15 bg-slate-800/60 p-3 text-white placeholder-slate-400 transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 outline-none"
                            placeholder="Contact phone (optional)"
                            autocomplete="off"
                            :aria-invalid="form.errors.phone ? 'true' : 'false'"
                            :class="
                                form.errors.phone
                                    ? 'border-red-500 focus:border-red-400 focus:ring-red-200'
                                    : ''
                            "
                        />
                        <transition name="fade">
                            <div
                                v-if="form.errors.phone"
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
                                    form.errors.phone
                                }}</span>
                            </div>
                        </transition>
                    </div>

                    <div class="flex justify-end">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-60 cursor-pointer"
                        >
                            {{
                                form.processing
                                    ? "Saving…"
                                    : isEdit
                                    ? "Update Center"
                                    : "Create Center"
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
import Layout from "../Components/Layout.vue";
import { useForm, Link } from "@inertiajs/vue3";
import { route } from "ziggy-js";

const props = defineProps({
    center: {
        type: Object,
        default: null,
    },
});

const isEdit = computed(() => Boolean(props.center?.id));

const form = useForm({
    name: props.center?.name ?? "",
    code: props.center?.code ?? "",
    address: props.center?.address ?? "",
    phone: props.center?.phone ?? "",
});

function submit() {
    if (isEdit.value) {
        form.put(route("centers.update", props.center?.id));
        return;
    }

    form.post(route("centers.store"));
}
</script>
<style lang=""></style>
