<template>
    <Layout>
        <section class="relative">
            <div class="mx-auto max-w-6xl py-6">
                <!-- Title row -->
                <div class="mb-4 text-center">
                    <p
                        class="text-xs uppercase tracking-[0.3em] text-indigo-100 sm:mr-4"
                    >
                        Courses
                    </p>
                    <p class="text-slate-200">
                        Browse and manage the courses in the system.
                    </p>
                </div>
                <!-- Filters row, centered -->
                <div
                    class="mb-4 flex flex-wrap items-center justify-center gap-3"
                >
                    <div class="relative w-full sm:w-72">
                        <div
                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-300/80"
                            aria-hidden="true"
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
                                    d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 6.3 6.3a7.5 7.5 0 0 0 10.35 10.35Z"
                                />
                            </svg>
                        </div>
                        <input
                            v-model="search"
                            type="search"
                            placeholder="Search by name or code…"
                            class="w-full rounded-full border border-white/10 bg-white/5 py-2.5 pl-11 pr-4 text-sm text-white placeholder:text-slate-400 shadow-lg shadow-indigo-950/10 ring-1 ring-white/5 backdrop-blur-xl transition focus:border-indigo-400/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
                        />
                    </div>
                    <select
                        v-model="status"
                        class="w-full rounded-full border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white shadow-lg shadow-indigo-950/10 ring-1 ring-white/5 backdrop-blur-xl transition focus:border-indigo-400/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 sm:w-40"
                    >
                        <option
                            value=""
                            class="bg-slate-900 text-white"
                            selected
                        >
                            All statuses
                        </option>
                        <option value="active" class="bg-slate-900 text-white">
                            Active
                        </option>
                        <option
                            value="inactive"
                            class="bg-slate-900 text-white"
                        >
                            Inactive
                        </option>
                    </select>
                    <select
                        v-model="courseType"
                        class="w-full rounded-full border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white shadow-lg shadow-indigo-950/10 ring-1 ring-white/5 backdrop-blur-xl transition focus:border-indigo-400/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 sm:w-56"
                    >
                        <option value="" class="bg-black text-white">
                            All Course Types
                        </option>
                        <option
                            v-for="type in courseTypes"
                            :key="type.id"
                            :value="type.id"
                            class="bg-black text-white"
                        >
                            {{ type.name }}
                        </option>
                    </select>
                    <Link
                        prefetch="mount"
                        class="inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-2 text-sm font-semibold text-white transition hover:border-white/40 cursor-pointer"
                        :href="route('courses.create')"
                    >
                        Create
                    </Link>
                </div>

                <div
                    class="rounded-3xl border border-white/10 bg-white/5 shadow-2xl shadow-indigo-950/30 ring-1 ring-white/10 backdrop-blur-2xl"
                >
                    <div
                        class="flex flex-col gap-2 border-b border-white/10 px-5 py-4 sm:flex-row sm:items-center sm:justify-between"
                    >
                        <p class="text-sm font-semibold text-white">
                            Showing
                            <span class="text-indigo-200">
                                {{ courses.length }}
                            </span>
                            of
                            <span class="text-indigo-200">
                                {{ courses.length }}
                            </span>
                        </p>
                        <button
                            v-if="search || status || courseType"
                            @click="resetFilters"
                            type="button"
                            class="inline-flex items-center gap-2 self-start rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-semibold text-slate-200 transition hover:bg-white/10 sm:self-auto"
                        >
                            Clear search
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm">
                            <thead class="text-xs uppercase text-slate-300/80">
                                <tr class="border-b border-white/10">
                                    <th class="px-5 py-4 font-semibold">
                                        Course Type
                                    </th>
                                    <th class="px-5 py-4 font-semibold">
                                        Name
                                    </th>
                                    <th class="px-5 py-4 font-semibold">
                                        Code
                                    </th>
                                    <th class="px-5 py-4 font-semibold">
                                        Duration (months)
                                    </th>
                                    <th class="px-5 py-4 font-semibold">
                                        Status
                                    </th>
                                    <th class="px-5 py-4 font-semibold">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                <tr
                                    v-for="course in courses"
                                    :key="course.id"
                                    class="group hover:bg-white/5"
                                >
                                    <td class="px-5 py-4 align-top">
                                        <div class="font-semibold text-white">
                                            {{
                                                course.course_type?.name ||
                                                (course.courseType &&
                                                    course.courseType.name) ||
                                                "-"
                                            }}
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 align-top">
                                        <div class="font-semibold text-white">
                                            {{ course.name }}
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 align-top">
                                        <div class="text-white">
                                            {{ course.code }}
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 align-top">
                                        <div class="text-white">
                                            {{ course.duration }}
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 align-top">
                                        <span
                                            :class="[
                                                'inline-block rounded-full px-3 py-1 text-xs font-semibold',
                                                course.status
                                                    ? 'bg-green-700/70 text-green-100'
                                                    : 'bg-gray-600/70 text-gray-100',
                                            ]"
                                        >
                                            {{
                                                course.status
                                                    ? "Active"
                                                    : "Inactive"
                                            }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 align-top">
                                        <div class="flex flex-wrap gap-2">
                                            <Link
                                                :href="
                                                    route('courses.edit', {
                                                        course: course.id,
                                                    })
                                                "
                                                prefetch="mount"
                                                class="inline-flex items-center gap-2 rounded-full bg-blue-600/80 px-3 py-1.5 text-xs font-semibold text-white shadow-lg shadow-blue-600/10 transition hover:bg-blue-700"
                                            >
                                                Edit
                                            </Link>
                                            <button
                                                @click="destroy(course.id)"
                                                class="inline-flex items-center gap-2 rounded-full bg-red-700/80 px-3 py-1.5 text-xs font-semibold text-white shadow-lg shadow-red-700/10 transition hover:bg-red-800 cursor-pointer"
                                            >
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr v-if="!courses.length">
                                    <td
                                        colspan="6"
                                        class="px-5 py-10 text-center"
                                    >
                                        <p
                                            class="text-sm font-semibold text-white"
                                        >
                                            No Courses found
                                        </p>
                                        <p class="mt-1 text-sm text-slate-300">
                                            Try a different keyword, or create a
                                            new one.
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import { ref, watch } from "vue";
import { Link, useForm, router } from "@inertiajs/vue3";
import Layout from "../Components/Layout.vue";

const props = defineProps({
    courses: {
        type: Array,
        default: () => [],
    },
    courseTypes: {
        type: Array,
        default: () => [],
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
    totalCourses: {
        type: Number,
        default: 0,
    },
});

const form = useForm({});

const search = ref(props.filters.search || "");
const status = ref(props.filters.status || "");
const courseType = ref(props.filters.course_type_id || "");

let filterTimeout = null;

const applyFilters = () => {
    router.get(
        route("courses.index"),
        {
            search: search.value || undefined,
            status: status.value || undefined,
            course_type_id: courseType.value || undefined,
        },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        }
    );
};

watch(
    [search, status, courseType],
    () => {
        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(applyFilters, 300);
    },
    { deep: true }
);

const resetFilters = () => {
    search.value = "";
    status.value = "";
    courseType.value = "";
    applyFilters();
};

const destroy = (id) => {
    if (confirm("Are you sure you want to delete this course?")) {
        form.delete(route("courses.destroy", id));
    }
};
</script>
