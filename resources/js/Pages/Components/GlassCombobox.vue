GlassCombobox
<script setup>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    modelValue: [String, Number],
    options: { type: Array, required: true }, // Expects [{ id: 1, name: '...' }]
    label: String,
    placeholder: String
});

const emit = defineEmits(['update:modelValue']);

const isOpen = ref(false);
const search = ref('');
const containerRef = ref(null);

// Find the name of the currently selected ID
const selectedName = computed(() => {
    const found = props.options.find(opt => opt.id == props.modelValue);
    return found ? found.name : '';
});

// Filter options based on search input
const filteredOptions = computed(() => {
    if (search.value === '') return props.options;
    return props.options.filter(opt =>
        opt.name.toLowerCase().includes(search.value.toLowerCase())
    );
});

// Handle clicking outside to close
const handleClickOutside = (e) => {
    if (containerRef.value && !containerRef.value.contains(e.target)) {
        isOpen.value = false;
        // Reset search to match selection if closed
        if (selectedName.value) search.value = selectedName.value;
    }
};

onMounted(() => document.addEventListener('click', handleClickOutside));
onUnmounted(() => document.removeEventListener('click', handleClickOutside));

// Initialize search with selected value
watch(() => props.modelValue, (newVal) => {
    if (newVal) search.value = selectedName.value;
}, { immediate: true });

const selectOption = (option) => {
    emit('update:modelValue', option.id);
    search.value = option.name;
    isOpen.value = false;
};

const openDropdown = () => {
    isOpen.value = true;
    search.value = ''; // Clear search to show all options
};
</script>

<template>
    <div class="relative space-y-2" ref="containerRef">
        <label v-if="label" class="font-bold text-gray-700 ml-1">{{ label }}</label>

        <div class="relative">
            <input type="text" v-model="search" @focus="openDropdown" :placeholder="placeholder"
                class="w-full rounded-2xl border border-white/40 bg-white/50 p-4 pl-5 text-gray-900 placeholder-gray-400 shadow-sm backdrop-blur-xl transition-all focus:bg-white/80 focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 outline-none" />

            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-5 h-5 transition-transform" :class="{ 'rotate-180': isOpen }">
                    <path fill-rule="evenodd"
                        d="M10 3a.75.75 0 0 1 .55.24l3.25 3.5a.75.75 0 1 1-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 0 1-1.1-1.02l3.25-3.5A.75.75 0 0 1 10 3Zm-3.76 9.2a.75.75 0 0 1 1.06.04l2.7 2.908 2.7-2.908a.75.75 0 1 1 1.1 1.02l-3.25 3.5a.75.75 0 0 1-1.1 0l-3.25-3.5a.75.75 0 0 1 .04-1.06Z"
                        clip-rule="evenodd" />
                </svg>
            </div>

            <transition enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0">
                <ul v-if="isOpen"
                    class="absolute z-50 mt-2 max-h-60 w-full overflow-auto rounded-2xl bg-white/80 backdrop-blur-xl border border-white/50 p-1 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none scrollbar-thin">
                    <li v-if="filteredOptions.length === 0"
                        class="relative cursor-default select-none py-3 px-4 text-gray-500 italic">
                        Nothing found.
                    </li>
                    <li v-for="option in filteredOptions" :key="option.id" @click="selectOption(option)"
                        class="relative cursor-pointer select-none rounded-xl py-3 pl-4 pr-9 hover:bg-orange-50 text-gray-900 transition-colors"
                        :class="{ 'bg-orange-100 text-orange-900 font-bold': modelValue === option.id }">
                        <span class="block truncate">{{ option.name }}</span>
                        <span v-if="modelValue === option.id"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-orange-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </li>
                </ul>
            </transition>
        </div>
    </div>
</template>
