import { ref, readonly } from 'vue';

const isDark = ref(false);

function apply() {
    document.documentElement.classList.toggle('dark', isDark.value);
}

export function useTheme() {
    const init = () => {
        const saved = localStorage.getItem('theme');
        if (saved) {
            isDark.value = saved === 'dark';
        } else {
            isDark.value = window.matchMedia('(prefers-color-scheme: dark)').matches;
        }
        apply();
    };

    const toggle = () => {
        isDark.value = !isDark.value;
        localStorage.setItem('theme', isDark.value ? 'dark' : 'light');
        apply();
    };

    return { isDark: readonly(isDark), toggle, init };
}
