<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Select from 'primevue/select'
import InputMask from 'primevue/inputmask';
import QuoteHeaderForm from './QuoteHeaderForm.vue';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import { Textarea } from 'primevue';
import { ref } from 'vue';
import { useQuoteStore } from '@/store/Quote';
import useTranslation from '@/Services/TranslationService.js';

const { t } = useTranslation();
const store = useQuoteStore();

</script>
<template>
    <div class="flex flex-col h-full justify-between p-5">
        <div class="flex gap-10">
            <div>
                <label class="font-medium text-sm text-secondary-text">{{t('Quote is valid for how many days?')}}</label>
                <IconField>
                    <InputIcon>
                        <font-awesome-icon icon="fa-light fa-calendar" />
                    </InputIcon>
                    <InputText type="number" min="0" v-model="store.form.notes.quote_valid_days" class="w-full h-10 !bg-primary-gray" />
                </IconField>
            </div>
            <div v-if="store.form.type.name == 'rental'">
                <label class="font-medium text-sm text-secondary-text">{{t('Thaw period')}}</label>
                <IconField>
                    <InputIcon>
                        <font-awesome-icon icon="fa-light fa-calendar" />
                    </InputIcon>
                    <InputText type="number" min="0" v-model="store.form.notes.thawing_days" class="w-full h-10 !bg-primary-gray" />
                </IconField>
            </div>
        </div>
        <div>
            <label>{{t('General rental conditions')}}</label>
            <Textarea rows="8" cols="30" class="w-full !bg-primary-gray" v-model="store.form.notes.general_rental_terms" :placeholder="t('general_rental_conditions_placeholder')" />
        </div>
        <div>
            <label>{{t('Payment method')}}</label>
            <Textarea rows="5" cols="30" class="w-full !bg-primary-gray" v-model="store.form.notes.payement_method" :placeholder="t('payment_method_placeholder')" />
        </div>
        <div>
            <label>{{t('Bank transfer')}}</label>
            <Textarea rows="3" cols="30" class="w-full !bg-primary-gray" v-model="store.form.notes.bank_transfer" :placeholder="t('bank_transfer_placeholder')" />
        </div>
        <div class="flex justify-between items-center">
            <span class="text-base font-medium text-gray-600">{{store.form.quote.code}} - {{ store.form.client.name }}</span>
            <div class="flex gap-2">
                <Button @click="store.previousStep" variant="outlined" severity="secondary">{{t('Previous step')}}</Button>
                <Button @click="store.nextStep">{{t('Next step')}}</Button>
            </div>
        </div>
    </div>
</template>
