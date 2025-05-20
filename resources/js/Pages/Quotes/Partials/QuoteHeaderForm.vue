<script setup>
import { computed, ref } from 'vue';
import InputText from 'primevue/inputtext';
import DatePicker from 'primevue/datepicker';
import InputMask from 'primevue/inputmask';
import { useQuoteStore } from '@/store/Quote';
import useTranslation from '@/Services/TranslationService.js';
import { useAppStore } from '@/store/App';

const { t } = useTranslation();
const store = useQuoteStore();
const darkMode = computed(() => useAppStore().darkMode);

</script>
<template>
    <div class="flex justify-between !py-2 mb-2">
        <div class=" w-[19%]" v-if="store.form.type.name == 'rental'">
            <label class="font-medium text-sm text-secondary-text" :class="darkMode ? '!text-white' : ''">{{t('Order date')}}</label>
            <DatePicker showIcon iconDisplay="input" v-model="store.form.quote.order_date" dateFormat="yy/mm/dd" placeholder="yyyy/mm/dd"
                class="w-full h-10" :class="darkMode ? '!text-white' : ''" />
        </div>
        <div class=" w-[28%]" v-else>
            <label class="font-medium text-sm text-secondary-text" :class="darkMode ? '!text-white' : ''">{{t('Order date')}}</label>
            <DatePicker showIcon iconDisplay="input" v-model="store.form.quote.order_date" dateFormat="yy/mm/dd" placeholder="yyyy/mm/dd"
                class="w-full h-10" :class="darkMode ? '!text-white' : ''" />
        </div>
        <div class=" w-[19%]" v-if="store.form.type.name == 'rental'">
            <label class="font-medium text-sm text-secondary-text" :class="darkMode ? '!text-white' : ''">{{t('Start date')}}</label>
            <DatePicker showIcon iconDisplay="input" v-model="store.form.quote.start_date" dateFormat="yy/mm/dd" placeholder="yyyy/mm/dd"
                class="w-full h-10" :class="darkMode ? '!text-white' : ''" />
        </div>
        <div class=" w-[19%]" v-if="store.form.type.name == 'rental'">
            <label class="font-medium text-sm text-secondary-text" :class="darkMode ? '!text-white' : ''">{{t('End date')}}</label>
            <DatePicker showIcon iconDisplay="input" v-model="store.form.quote.end_date" dateFormat="yy/mm/dd" placeholder="yyyy/mm/dd"
                class="w-full h-10" :class="darkMode ? '!text-white' : ''" />
        </div>
        <div class=" w-[28%]" v-else>
            <label class="font-medium text-sm text-secondary-text" :class="darkMode ? '!text-white' : ''">{{t('Delivery date')}}</label>
            <DatePicker showIcon iconDisplay="input" v-model="store.form.quote.delivery_date" dateFormat="yy/mm/dd" placeholder="yyyy/mm/dd"
                class="w-full h-10" :class="darkMode ? '!text-white' : ''" />
        </div>
        <div class=" w-[19%]">
            <label class="font-medium text-sm text-secondary-text" :class="darkMode ? '!text-white' : ''">P.O. Code</label>
            <InputText v-model="store.form.quote.PO_client" placeholder="P.O. Code" class="w-full h-10" :class="darkMode ? '!text-white' : ''" />
        </div>
        <div class=" w-[19%]">
            <label class="font-medium text-sm text-secondary-text" :class="darkMode ? '!text-white' : ''">P.O. GPBloc</label>
            <InputText v-model="store.form.quote.PO_GPBloc" placeholder="P.O. Code" class="w-full h-10" :class="darkMode ? '!text-white' : ''" />
        </div>
    </div>
</template>
