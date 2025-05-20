<script setup>
import { ref, onMounted, watch, computed } from 'vue';
import { useQuoteStore } from '@/store/Quote';
import axios from 'axios';
import useTranslation from '@/Services/TranslationService.js';
import { useAppStore } from '@/store/App';

const { t } = useTranslation();
const store = useQuoteStore();
const appStore = useAppStore();
const darkMode = ref(appStore.darkMode);

const selectedOption = ref(null);
const options = ref([]);

onMounted(() => {
    axios.get(route('quote_type.get'))
        .then(response => {
            options.value = response.data.map(type => ({
                id: type.id,
                name: type.name,
                icon: type.icon,
                selected: store.form.type.id === type.id
            }));
        })
        .catch(error => {
            console.error('Error fetching quote types:', error);
        });

});

const selectOption = (selectedOption) => {
    options.value = options.value.map(option => ({
        ...option,
        selected: option === selectedOption
    }));
    store.form.type = selectedOption;
};

</script>

<template>
    <div class="flex flex-col align-content-between justify-between h-full">
        <div class="flex gap-10 justify-center">
            <div
                v-for="option in options"
                :key="option.name"
                @click="selectOption(option)"
                :class="['flex flex-col items-center justify-center w-80 h-64 border-2 rounded-bl-[40px] rounded-tr-[40px] cursor-pointer text-[#6B7280]', option.selected ? darkMode ? 'bg-primary-color !text-white border-primary-color' : 'bg-primary-color !text-white border-primary-color' : 'border-primary-gray']"
            >
                <font-awesome-icon :icon="option.icon" class="w-36 h-36" />
                <h1 class="mt-4 text-2xl font-extrabold">{{ t(option.name).charAt(0).toUpperCase() + t(option.name).slice(1) }}</h1>
            </div>
        </div>
        <div class="flex justify-between p-5">
            <span class="text-base font-medium text-gray-600"></span>
            <Button class="!text-white" @click="store.nextStep">{{t('Next step')}}</Button>
        </div>
    </div>
</template>
