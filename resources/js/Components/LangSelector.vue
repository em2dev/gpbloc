<script setup>
import Dropdown from './Dropdown.vue';
import Button from 'primevue/button';
import { ref } from 'vue';

const options = ref([
    { label: 'Français', value: 'fr', img: '/img/lang/qc-flag.jpg' },
    { label: 'English', value: 'en', img: '/img/lang/us-flag.png' },
])

const selectedOption = ref(
    options.value.find(option => option.value === localStorage.getItem('lang')) || options.value[0]
);

const changeLanguage = (option) => {
    console.log(localStorage.getItem('lang'));
    console.log(option);
    selectedOption.value = option;
    localStorage.setItem('lang', option.value);
    location.reload();
};

</script>
<template>
    <Dropdown width="48">
        <template #trigger>
            <Button rounded class="w-10 h-10 mr-4" severity="secondary">
                <img :src="selectedOption.img" alt="" class="!max-w-6 rounded-full" />
            </Button>
        </template>
        <template #content>
            <div v-for="lang in options" :key="lang.value" class="flex items-center gap-2 p-2 cursor-pointer hover:bg-gray-100" @click="changeLanguage(lang)">
                <div class="flex items-center gap-2 p-2 cursor-pointer hover:bg-gray-100">
                    <img :src="lang.img" alt="" class="w-6 h-6 rounded-full" />
                    <span>{{ lang.label }}</span>
                </div>
            </div>
        </template>
    </Dropdown>
</template>
