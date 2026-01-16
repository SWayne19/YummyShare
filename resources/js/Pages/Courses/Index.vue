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
                    <div class="relative w-full sm:w-40">
                        <select
                            v-model="status"
                            class="peer w-full appearance-none rounded-full border border-white/10 bg-white/5 px-4 py-2.5 pr-10 text-sm text-white shadow-lg shadow-indigo-950/10 ring-1 ring-white/5 backdrop-blur-xl transition focus:border-indigo-400/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
                        >
                            <option value="" class="bg-black text-white">
                                All statuses
                            </option>
                            <option value="active" class="bg-black text-white">
                                Active
                            </option>
                            <option
                                value="inactive"
                                class="bg-black text-white"
                            >
                                Inactive
                            </option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-white"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 opacity-80"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </div>
                    </div>
                    <div class="relative w-full sm:w-56">
                        <select
                            v-model="courseType"
                            class="peer w-full appearance-none rounded-full border border-white/10 bg-white/5 px-4 py-2.5 pr-10 text-sm text-white shadow-lg shadow-indigo-950/10 ring-1 ring-white/5 backdrop-blur-xl transition focus:border-indigo-400/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
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
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-white"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 opacity-80"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </div>
                    </div>
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
                                        <!-- BEGIN: Status toggle button -->
                                        <button
                                            @click="
                                                openStatusModal(
                                                    course.id,
                                                    course.name,
                                                    course.status
                                                )
                                            "
                                            :class="[
                                                'inline-block rounded-full px-3 py-1 text-xs font-semibold transition focus:outline-none cursor-pointer',
                                                course.status
                                                    ? 'bg-green-700/70 text-green-100 hover:bg-green-800'
                                                    : 'bg-gray-600/70 text-gray-100 hover:bg-gray-700',
                                            ]"
                                        >
                                            {{
                                                course.status
                                                    ? "Active"
                                                    : "Inactive"
                                            }}
                                        </button>
                                        <!-- END: Status toggle button -->
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
                                                @click="
                                                    openDeleteModal(
                                                        course.id,
                                                        course.name
                                                    )
                                                "
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

        <!-- Status Confirm Modal -->
        <div
            v-if="statusModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm"
        >
            <div
                class="bg-white rounded-lg shadow-xl p-7 w-[95vw] max-w-sm text-slate-800 relative"
            >
                <button
                    class="absolute right-3 top-2 text-slate-400 hover:text-slate-900 text-xl cursor-pointer"
                    @click="closeStatusModal"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>
                <div class="mb-3">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="mx-auto mb-2 h-10 w-10 text-indigo-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 9V7a5 5 0 00-10 0v2a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2v-7a2 2 0 00-2-2zm-5 5a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                        />
                    </svg>
                    <div class="text-center text-lg font-bold mb-2">
                        Change Status
                    </div>
                    <div class="text-center text-slate-700">
                        Are you sure you want to
                        <span v-if="form.status === 1">activate</span>
                        <span v-else>deactivate</span>
                        the course
                        <span class="font-semibold"
                            >"{{ selectedCourseName }}"</span
                        >?
                    </div>
                </div>
                <div class="flex gap-2 justify-end mt-4">
                    <button
                        @click="closeStatusModal"
                        class="inline-flex items-center rounded-full border border-slate-300 bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-200 cursor-pointer"
                    >
                        Cancel
                    </button>
                    <button
                        @click="confirmStatusChange"
                        :disabled="form.processing"
                        class="inline-flex items-center rounded-full bg-indigo-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-800 disabled:opacity-70 disabled:pointer-events-none cursor-pointer"
                    >
                        Change
                    </button>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div
            v-if="deleteModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm"
        >
            <div
                class="bg-white rounded-lg shadow-xl p-7 w-[95vw] max-w-sm text-slate-800 relative"
            >
                <button
                    class="absolute right-3 top-2 text-slate-400 hover:text-slate-900 text-xl"
                    @click="closeDeleteModal"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>
                <div class="mb-3">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="mx-auto mb-2 h-10 w-10 text-red-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 16h-1v-4h-1m4 0h-1m-3 4v1a4 4 0 108 0v-1m-4 0a4 4 0 01-4-4V7a4 4 0 018 0v5a4 4 0 01-4 4z"
                        />
                    </svg>
                    <div class="text-center text-lg font-bold mb-2">
                        Delete Course
                    </div>
                    <div class="text-center text-slate-700">
                        Are you sure you want to delete
                        <span class="font-semibold"
                            >"{{ deleteCourseName }}"</span
                        >? This action cannot be undone.
                    </div>
                </div>
                <div class="flex gap-2 justify-end mt-4">
                    <button
                        @click="closeDeleteModal"
                        class="inline-flex items-center rounded-full border border-slate-300 bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-200"
                    >
                        Cancel
                    </button>
                    <button
                        @click="confirmDelete"
                        class="inline-flex items-center rounded-full bg-red-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-800"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>
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

const form = useForm({
    status: null,
});

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

// Modal logic for confirming delete
const deleteModalOpen = ref(false);
const deleteCourseId = ref(null);
const deleteCourseName = ref("");

// Status modal logic and support
const statusModalOpen = ref(false);
const selectedCourseId = ref(null);
const selectedCourseName = ref("");
const selectedCourseStatus = ref(false);

function openDeleteModal(id, name) {
    deleteModalOpen.value = true;
    deleteCourseId.value = id;
    deleteCourseName.value = name;
}

function closeDeleteModal() {
    deleteModalOpen.value = false;
    deleteCourseId.value = null;
    deleteCourseName.value = "";
}

function confirmDelete() {
    if (deleteCourseId.value) {
        form.delete(route("courses.destroy", deleteCourseId.value), {
            onFinish: () => {
                closeDeleteModal();
            },
        });
    }
}

function openStatusModal(id, name, status) {
    statusModalOpen.value = true;
    selectedCourseId.value = id;
    selectedCourseName.value = name;
    selectedCourseStatus.value = status;
    form.status = !!status ? 0 : 1;
}

function closeStatusModal() {
    statusModalOpen.value = false;
    selectedCourseId.value = null;
    selectedCourseName.value = "";
    selectedCourseStatus.value = false;
    form.status = null;
}

function confirmStatusChange() {
    // PATCH using the standard resource update route for courses
    form.patch(route("courses.update", selectedCourseId.value), {
        onFinish: () => {
            closeStatusModal();
        },
        preserveScroll: true,
    });
}
</script>
