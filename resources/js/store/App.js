import { defineStore } from 'pinia';
import { ref, watch } from 'vue';

export const useAppStore = defineStore('App', () => {
    const darkMode = ref(localStorage.getItem('darkMode') === 'true');
    if (darkMode.value) {
        document.documentElement.classList.add('my-app-dark');
    }

    watch(darkMode, (newValue) => {
        localStorage.setItem('darkMode', newValue);
        if (newValue) {
            document.documentElement.classList.add('my-app-dark');
        } else {
            document.documentElement.classList.remove('my-app-dark');
        }
    });

    const setDarkMode = (value) => {
        darkMode.value = value;
    };

    const toggleDarkMode = () => {
        darkMode.value = !darkMode.value;
    };

    return {
        darkMode,
        setDarkMode,
        toggleDarkMode,
    };
});
