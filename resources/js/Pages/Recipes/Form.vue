<script setup>
import { useForm, Head } from "@inertiajs/vue3";
import { ref } from "vue";
import Layout from "../Components/Layout.vue";
import GlassCombobox from "../Components/GlassCombobox.vue";

defineProps({
    categories: {
        type: Array,
        default: () => [],
    }
});

const difficultyOptions = [
    { id: 'easy', name: 'Easy' },
    { id: 'medium', name: 'Medium' },
    { id: 'hard', name: 'Hard' }
];

const form = useForm({
    title: '',
    author_name: '',
    category_id: '',
    cook_time: '',
    servings: '',
    difficulty: 'easy',
    instructions: '',
    ingredients: [{ name: '', quantity: '', unit: '' }],
    images: []
});

const currentStep = ref(1);
const totalSteps = 4;

const steps = [
    { id: 1, title: "The Basics", desc: "Name & Category", fields: ['title', 'author_name', 'category_id'] },
    { id: 2, title: "Details", desc: "Time & Difficulty", fields: ['cook_time', 'servings', 'difficulty'] },
    { id: 3, title: "Ingredients", desc: "What goes in?", fields: ['ingredients'] },
    { id: 4, title: "Finish", desc: "Instructions & Photos", fields: ['instructions', 'images'] }
];

const stepHasError = (stepId) => {
    const step = steps.find(s => s.id === stepId);
    if (!step) return false;

    return step.fields.some(field => {
        if (form.errors[field]) return true;
        return Object.keys(form.errors).some(key => key.startsWith(`${field}.`));
    });
};

const nextStep = () => {
    if (currentStep.value < totalSteps) currentStep.value++;
};

const prevStep = () => {
    if (currentStep.value > 1) currentStep.value--;
};

const addIngredient = () => form.ingredients.push({ name: '', quantity: '', unit: '' });
const removeIngredient = (index) => form.ingredients.length > 1 && form.ingredients.splice(index, 1);
const handleImageUpload = (e) => form.images = Array.from(e.target.files);

const submit = () => {
    form.post('/recipes', {
        forceFormData: true,
        onError: (errors) => {
            const firstErrorStep = steps.find(step => stepHasError(step.id));
            if (firstErrorStep) {
                currentStep.value = firstErrorStep.id;
            }
        }
    });
};
</script>

<template>

    <Head title="Add Recipe" />
    <Layout>
        <div class="py-6 min-h-screen relative mx-auto max-w-5xl px-4 pb-12 sm:px-6 lg:px-8">

            <div class="mx-auto mb-6 text-center">
                <h1 class="text-2xl sm:text-3xl font-black text-gray-900 dark:text-white tracking-tight drop-shadow-sm">
                    Share Your <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">Masterpiece</span>
                </h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm sm:text-base">Step {{ currentStep }} of {{ totalSteps }}: {{
                    steps[currentStep-1].title }}</p>
            </div>

            <div class="mb-5 mx-auto max-w-3xl">
                <div class="relative h-2 bg-gray-200 dark:bg-gray-800 rounded-full overflow-hidden">
                    <div class="absolute top-0 left-0 h-full transition-all duration-500 ease-out"
                        :class="stepHasError(currentStep) ? 'bg-red-500' : 'bg-gradient-to-r from-orange-500 to-red-600'"
                        :style="{ width: `${(currentStep / totalSteps) * 100}%` }"></div>
                </div>

                <div class="flex justify-between mt-4 text-[10px] sm:text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest px-1">
                    <span v-for="step in steps" :key="step.id"
                        class="cursor-pointer transition-colors flex items-center gap-1" :class="{
                            'text-orange-600 dark:text-orange-400': currentStep === step.id && !stepHasError(step.id),
                            'text-red-600 dark:text-red-400': stepHasError(step.id),
                            'text-gray-800 dark:text-gray-300': currentStep > step.id && !stepHasError(step.id)
                        }" @click="currentStep = step.id">
                        {{ step.title }}
                        <span v-if="stepHasError(step.id)"
                            class="block h-2 w-2 rounded-full bg-red-500 animate-pulse"></span>
                    </span>
                </div>
            </div>

            <div v-if="Object.keys(form.errors).length > 0"
                class="mx-auto max-w-3xl mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-950/50 border border-red-100 dark:border-red-900 text-red-600 dark:text-red-400 text-sm font-bold text-center animate-pulse">
                Please correct the errors in the highlighted steps.
            </div>

            <form @submit.prevent="submit" class="relative mx-auto max-w-3xl">
                <transition name="slide-fade" mode="out-in">

                    <div v-if="currentStep === 1" key="step1"
                        class="space-y-5 p-4 sm:p-6 md:p-8 rounded-2xl sm:rounded-[2rem] bg-white/70 dark:bg-gray-900/70 border border-white/60 dark:border-gray-800 shadow-xl backdrop-blur-2xl">
                        <div class="space-y-2">
                            <label class="font-bold text-gray-700 dark:text-gray-200 ml-1">Recipe Title</label>
                            <input v-model="form.title" type="text" placeholder="e.g. Grandma's Apple Pie"
                                class="glass-input w-full text-xl font-bold"
                                :class="{ 'ring-2 ring-red-500 bg-red-50 dark:bg-red-950/30': form.errors.title }">
                            <div v-if="form.errors.title" class="text-red-500 dark:text-red-400 text-sm ml-1 mt-1">{{ form.errors.title }}
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="font-bold text-gray-700 dark:text-gray-200 ml-1">Chef Name</label>
                            <input v-model="form.author_name" type="text" placeholder="Your Name"
                                class="glass-input w-full"
                                :class="{ 'ring-2 ring-red-500 bg-red-50 dark:bg-red-950/30': form.errors.author_name }">
                            <div v-if="form.errors.author_name" class="text-red-500 dark:text-red-400 text-sm ml-1 mt-1">{{
                                form.errors.author_name }}</div>
                        </div>

                        <div class="space-y-2">
                            <GlassCombobox
                                label="Category"
                                :options="categories"
                                v-model="form.category_id"
                                placeholder="Search category..."
                                v-if="categories && categories.length > 0"
                            />
                            <select
                                v-else
                                v-model="form.category_id"
                                class="glass-input w-full"
                            >
                                <option disabled value="">Select category</option>
                                <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                                    {{ cat.name }}
                                </option>
                            </select>
                            <div v-if="form.errors.category_id" class="text-red-500 dark:text-red-400 text-sm ml-1 mt-1">
                                {{ form.errors.category_id }}
                            </div>
                        </div>
                    </div>

                    <div v-else-if="currentStep === 2" key="step2"
                        class="space-y-5 p-4 sm:p-6 md:p-8 rounded-2xl sm:rounded-[2rem] bg-white/70 dark:bg-gray-900/70 border border-white/60 dark:border-gray-800 shadow-xl backdrop-blur-2xl">
                        <div class="grid grid-cols-2 gap-4 sm:gap-6">
                            <div class="space-y-2">
                                <label class="font-bold text-gray-700 dark:text-gray-200 ml-1 text-sm uppercase tracking-wide">Cook Time
                                    (min)</label>
                                <input v-model="form.cook_time" type="number"
                                    class="glass-input w-full text-center font-black text-xl sm:text-2xl h-16 sm:h-20"
                                    :class="{ 'ring-2 ring-red-500 bg-red-50 dark:bg-red-950/30': form.errors.cook_time }">
                                <div v-if="form.errors.cook_time" class="text-red-500 dark:text-red-400 text-sm ml-1 mt-1">{{
                                    form.errors.cook_time }}</div>
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="font-bold text-gray-700 dark:text-gray-200 ml-1 text-sm uppercase tracking-wide">Servings</label>
                                <input v-model="form.servings" type="number"
                                    class="glass-input w-full text-center font-black text-xl sm:text-2xl h-16 sm:h-20"
                                    :class="{ 'ring-2 ring-red-500 bg-red-50 dark:bg-red-950/30': form.errors.servings }">
                                <div v-if="form.errors.servings" class="text-red-500 dark:text-red-400 text-sm ml-1 mt-1">{{
                                    form.errors.servings }}</div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <GlassCombobox
                                label="Difficulty"
                                :options="difficultyOptions"
                                v-model="form.difficulty"
                                placeholder="Select difficulty..."
                            />
                            <div v-if="form.errors.difficulty" class="text-red-500 dark:text-red-400 text-sm ml-1 mt-1">{{
                                form.errors.difficulty }}</div>
                        </div>
                    </div>

                    <div v-else-if="currentStep === 3" key="step3"
                        class="space-y-5 p-4 sm:p-6 md:p-8 rounded-2xl sm:rounded-[2rem] bg-white/70 dark:bg-gray-900/70 border border-white/60 dark:border-gray-800 shadow-xl backdrop-blur-2xl min-h-[320px]">
                        <div class="flex items-center justify-between px-1 mb-4">
                            <label class="font-bold text-lg sm:text-xl text-gray-800 dark:text-white">Ingredients</label>
                            <button type="button" @click="addIngredient"
                                class="group flex items-center gap-2 rounded-full bg-orange-50 dark:bg-orange-950/50 px-3 sm:px-4 py-2 text-sm font-bold text-orange-600 dark:text-orange-400 transition-all hover:bg-orange-100 dark:hover:bg-orange-900/50 hover:scale-105 active:scale-95 shadow-sm">
                                <span>+ Add Item</span>
                            </button>
                        </div>

                        <div class="space-y-3 max-h-[320px] overflow-y-auto pr-2 custom-scrollbar">
                            <transition-group name="list">
                                <div v-for="(ingredient, index) in form.ingredients" :key="index"
                                    class="flex gap-2 sm:gap-3 items-center group mb-3">
                                    <div class="grid grid-cols-12 gap-2 sm:gap-3 flex-1">
                                        <div class="col-span-3">
                                            <input v-model="ingredient.quantity" placeholder="Qty"
                                                class="glass-input w-full text-center bg-white/80 dark:bg-white/5"
                                                :class="{ 'ring-2 ring-red-500': form.errors[`ingredients.${index}.quantity`] }">
                                        </div>
                                        <div class="col-span-3">
                                            <input v-model="ingredient.unit" placeholder="Unit"
                                                class="glass-input w-full text-center bg-white/80 dark:bg-white/5"
                                                :class="{ 'ring-2 ring-red-500': form.errors[`ingredients.${index}.unit`] }">
                                        </div>
                                        <div class="col-span-6">
                                            <input v-model="ingredient.name" placeholder="Item Name"
                                                class="glass-input w-full bg-white/80 dark:bg-white/5"
                                                :class="{ 'ring-2 ring-red-500': form.errors[`ingredients.${index}.name`] }">
                                        </div>
                                    </div>
                                    <button type="button" @click="removeIngredient(index)"
                                        class="h-8 w-8 flex-shrink-0 flex items-center justify-center rounded-full bg-red-50 dark:bg-red-950/50 text-red-400 opacity-50 hover:opacity-100 hover:bg-red-100 dark:hover:bg-red-900/50 hover:text-red-600 transition-all active:scale-90">
                                        &times;
                                    </button>
                                </div>
                            </transition-group>
                        </div>
                        <div v-if="form.errors.ingredients" class="text-red-500 dark:text-red-400 text-sm ml-1">{{ form.errors.ingredients
                            }}</div>
                    </div>

                    <div v-else key="step4"
                        class="space-y-5 p-4 sm:p-6 md:p-8 rounded-2xl sm:rounded-[2rem] bg-white/70 dark:bg-gray-900/70 border border-white/60 dark:border-gray-800 shadow-xl backdrop-blur-2xl">
                        <div class="space-y-2">
                            <label class="font-bold text-gray-700 dark:text-gray-200 ml-1">Instructions</label>
                            <textarea v-model="form.instructions" rows="6"
                                class="glass-input w-full resize-none leading-relaxed text-base sm:text-lg"
                                placeholder="Step 1: Preheat the oven..."
                                :class="{ 'ring-2 ring-red-500 bg-red-50 dark:bg-red-950/30': form.errors.instructions }"></textarea>
                            <div v-if="form.errors.instructions" class="text-red-500 dark:text-red-400 text-sm ml-1 mt-1">{{
                                form.errors.instructions }}</div>
                        </div>

                        <div class="space-y-2">
                            <label class="font-bold text-gray-700 dark:text-gray-200 ml-1">Photos</label>
                            <div class="relative group cursor-pointer">
                                <input type="file" multiple @change="handleImageUpload"
                                    class="absolute inset-0 w-full h-full opacity-0 z-20 cursor-pointer">
                                <div class="border-3 border-dashed border-gray-300/60 dark:border-gray-600/60 rounded-3xl p-5 sm:p-7 text-center bg-white/40 dark:bg-white/5 transition-all group-hover:bg-orange-50/50 dark:group-hover:bg-orange-950/20 group-hover:border-orange-300 dark:group-hover:border-orange-700 group-hover:scale-[1.01]"
                                    :class="{ 'border-red-400 bg-red-50 dark:bg-red-950/20': form.errors.images }">
                                    <div class="flex flex-col items-center gap-3">
                                        <div
                                            class="h-12 w-12 rounded-full bg-orange-100 dark:bg-orange-950/50 text-orange-600 dark:text-orange-400 flex items-center justify-center mb-2 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-8 h-8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400 font-medium text-base sm:text-lg" v-if="form.images.length === 0">
                                            Drop photos here</p>
                                        <p class="text-orange-600 dark:text-orange-400 font-bold text-lg sm:text-xl" v-else>{{ form.images.length }}
                                            files selected</p>
                                    </div>
                                </div>
                            </div>
                            <div v-if="form.errors.images" class="text-red-500 dark:text-red-400 text-sm ml-1">{{ form.errors.images }}
                            </div>
                        </div>
                    </div>

                </transition>

                <div class="mt-6 flex items-center justify-between">
                    <button type="button" @click="prevStep"
                        class="px-4 sm:px-5 py-2.5 rounded-xl font-bold text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white transition-colors"
                        :class="{ 'invisible': currentStep === 1 }">
                        &larr; Back
                    </button>

                    <button v-if="currentStep < totalSteps" type="button" @click="nextStep"
                        class="px-4 sm:px-6 py-2.5 rounded-xl bg-gray-900 dark:bg-white/10 font-bold text-white shadow-lg hover:bg-black dark:hover:bg-white/20 hover:shadow-xl hover:-translate-y-1 transition-all">
                        Next Step &rarr;
                    </button>

                    <button v-else :disabled="form.processing"
                        class="px-6 sm:px-8 py-2.5 rounded-xl bg-gradient-to-r from-orange-500 to-red-600 font-bold text-white shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:scale-105 transition-all disabled:opacity-70 disabled:scale-100">
                        {{ form.processing ? 'Publishing...' : 'Publish Recipe' }}
                    </button>
                </div>

            </form>
        </div>
    </Layout>
</template>

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.slide-fade-enter-from {
    opacity: 0;
    transform: translateX(30px);
}

.slide-fade-leave-to {
    opacity: 0;
    transform: translateX(-30px);
}

.list-enter-active,
.list-leave-active {
    transition: all 0.3s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(-10px);
}

.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.1);
    border-radius: 20px;
}
</style>
