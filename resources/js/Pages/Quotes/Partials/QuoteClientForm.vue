<script setup>
import { computed, onMounted, ref } from 'vue';
import InputText from 'primevue/inputtext';
import InputMask from 'primevue/inputmask';
import Textarea from 'primevue/textarea';
import Button from 'primevue/button';
import DatePicker from 'primevue/datepicker';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import Select from 'primevue/select';
import QuoteHeaderForm from './QuoteHeaderForm.vue';
import { useQuoteStore } from '@/store/Quote';
import axios from 'axios';
import useTranslation from '@/Services/TranslationService.js';
import { useAppStore } from '@/store/App';

const { t } = useTranslation();
const store = useQuoteStore();

const teamClients = ref([]);
const darkMode = computed(() => (useAppStore().darkMode));

function copyAddress() {
    store.form.client.delivery_address = store.form.client.address;
    store.form.client.delivery_city = store.form.client.city;
    store.form.client.delivery_province = store.form.client.province;
    store.form.client.delivery_zip = store.form.client.zip;
}

onMounted(() => {
    axios.get(route('teamClients.get')).then((response) => {
        teamClients.value = response.data;
    }).catch((error) => {
        console.error(error);
    });
});

const autoCompleteClient = () => {
    let client = teamClients.value.find(client => client.name === store.form.client.name);
    if (client) {
        store.form.client = {
            ...client,
            id: store.form.client.id,
        };
    }
}

</script>

<template>
    <div class="flex flex-col justify-between h-full">
        <div class="px-5 space-y-6">
            <div>
                <QuoteHeaderForm />
                <h3 class="font-bold text-2xl text-primary-text mb-3" :class="darkMode ? '!text-white' : ''">Client</h3>
                <div class="flex">
                    <div class="flex flex-wrap gap-4 w-3/5 h-full">
                        <div class="w-[48%]">
                            <label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text">{{t('Company')}}</label>
                            <!-- <IconField> -->
                                <!-- <InputIcon>
                                    <font-awesome-icon icon="fa-regular fa-user" />
                                </InputIcon> -->
                                <Select v-model="store.form.client.name" filter @change="autoCompleteClient()" editable :options="teamClients" optionLabel="name" optionValue="name" :placeholder="t('Company name')" class="w-full h-10" :class="darkMode ? '!text-white' : ''" />
                            <!-- </IconField> -->
                        </div>
                        <div class="w-[48%]">
                            <label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text mb-4">{{t('Phone')}}</label>
                            <IconField>
                                <InputIcon>
                                    <font-awesome-icon icon="fa-regular fa-phone-volume" />
                                </InputIcon>
                                <InputMask v-model="store.form.client.phone" mask="(999) 999-9999" class="w-full h-10"
                                    placeholder="(555) 000-0000" :class="darkMode ? '!text-white' : ''" />
                            </IconField>
                        </div>
                        <div class="w-[48%]">
                            <label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text mt-4">{{t('Email')}}</label>
                            <IconField>
                                <InputIcon>
                                    <font-awesome-icon icon="fa-light fa-envelope" />
                                </InputIcon>
                                <InputText v-model="store.form.client.email" class="w-full h-10" :placeholder="t('main_email_placeholder')" :class="darkMode ? '!text-white' : ''" />
                            </IconField>
                        </div>
                        <div class="w-[48%]">
                            <label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text mt-4">{{t('Website')}}</label>
                            <InputText v-model="store.form.client.website" class="w-full h-10" :class="darkMode ? '!text-white' : ''" />
                        </div>
                    </div>
                    <div class="w-2/5 ml-10 h-full">
                        <label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text">Description</label>
                        <Textarea v-model="store.form.client.description" rows="4" class="w-full h-[7.5rem]"
                            :placeholder="t('description_placeholder')" :class="darkMode ? '!text-white' : ''" />
                    </div>
                </div>
            </div>

            <div class="flex">
                <div class="flex w-3/5 justify-between">
                    <div class="w-[49%]">
                        <h3 class="font-bold text-2xl text-primary-text mb-4" :class="darkMode ? '!text-white' : ''">{{t('Address')}}</h3>
                        <div>
                            <label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text">{{t('Address')}}</label>
                            <InputText v-model="store.form.client.address" class="w-full mb-2 h-10" :class="darkMode ? '!text-white' : ''" />
                        </div>
                        <div>
                            <label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text">{{t('City')}}</label>
                            <InputText v-model="store.form.client.city" class="w-full mb-2 h-10" :class="darkMode ? '!text-white' : ''" />
                        </div>
                        <div>
                            <label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text">Province</label>
                            <InputText v-model="store.form.client.province" class="w-full mb-2 h-10" :class="darkMode ? '!text-white' : ''" />
                        </div>
                        <div>
                            <label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text">{{t('Postal code')}}</label>
                            <InputText v-model="store.form.client.zip" class="w-full h-10" :class="darkMode ? '!text-white' : ''" />
                        </div>
                    </div>

                    <div class="w-[49%]">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-bold text-2xl text-primary-text" :class="darkMode ? '!text-white' : ''">{{t('Delivery')}}</h3>
                            <Button :label="t('Copy')" outlined
                                class="w-30 !rounded-none mr-1 !rounded-e-md h-10 hover:!bg-transparent !text-secondary-text !border-[#D1D5DB]"
                                @click="copyAddress" :class="darkMode ? '!text-white' : ''">
                                <template #icon>
                                    <font-awesome-icon icon="fa-regular fa-clone" />
                                </template>
                            </Button>
                        </div>
                        <div><label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text">{{t('Address')}}</label>
                            <InputText v-model="store.form.client.delivery_address" class="w-full mb-2 h-10" :class="darkMode ? '!text-white' : ''" />
                        </div>
                        <div><label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text">{{t('City')}}</label>
                            <InputText v-model="store.form.client.delivery_city" class="w-full mb-2 h-10" :class="darkMode ? '!text-white' : ''" />
                        </div>
                        <div><label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text">Province</label>
                            <InputText v-model="store.form.client.delivery_province" class="w-full mb-2 h-10" :class="darkMode ? '!text-white' : ''" />
                        </div>
                        <div><label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text">{{t('Postal code')}}</label>
                            <InputText v-model="store.form.client.delivery_zip" class="w-full h-10" :class="darkMode ? '!text-white' : ''" />
                        </div>
                    </div>
                </div>
                <div class="w-2/5 ml-10">
                    <h3 class="font-bold text-2xl text-primary-text mb-4" :class="darkMode ? '!text-white' : ''">Contact</h3>

                    <div>
                        <label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text">{{t('First name')}}</label>
                        <IconField class="mb-2">
                            <InputIcon>
                                <font-awesome-icon icon="fa-regular fa-user" />
                            </InputIcon>
                            <InputText v-model="store.form.client.contact_first_name" class="w-full h-10" :placeholder="t('first_name_placeholder')" :class="darkMode ? '!text-white' : ''" />
                        </IconField>
                    </div>
                    <div><label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text">{{t('Last name')}}</label>
                        <IconField class="mb-2">
                            <InputIcon>
                                <font-awesome-icon icon="fa-regular fa-user" />
                            </InputIcon>
                            <InputText v-model="store.form.client.contact_last_name" class="w-full h-10" :placeholder="t('last_name_placeholder')" :class="darkMode ? '!text-white' : ''" />
                        </IconField>
                    </div>
                    <div><label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text">{{t('Email')}}</label>
                        <IconField class="mb-2">
                            <InputIcon>
                                <font-awesome-icon icon="fa-light fa-envelope" />
                            </InputIcon>
                            <InputText v-model="store.form.client.contact_email" class="w-full h-10"
                                :placeholder="t('contact_email_placeholder')" :class="darkMode ? '!text-white' : ''" />
                        </IconField>
                    </div>
                    <div><label :class="darkMode ? '!text-white' : ''" class="font-medium text-sm text-secondary-text">{{t('Phone')}}</label>
                        <IconField class="mb-2">
                            <InputIcon>
                                <font-awesome-icon icon="fa-regular fa-phone-volume" />
                            </InputIcon>
                            <InputMask v-model="store.form.client.contact_phone" mask="(999) 999-9999" class="w-full h-10"
                                placeholder="(555) 000-0000" :class="darkMode ? '!text-white' : ''" />
                        </IconField>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between items-center p-5">
            <span class="text-base font-medium text-gray-600" :class="darkMode ? '!text-white' : ''">{{store.form.quote.code}} - {{ store.form.client.name }}</span>
            <div class="flex gap-2">
                <Button @click="store.previousStep" variant="outlined" severity="secondary">{{t('Previous step')}}</Button>
                <Button @click="store.nextStep" class="!text-white">{{t('Next step')}}</Button>
            </div>
        </div>
    </div>
</template>
<style>
.p-select-label {
    --tw-ring-shadow: 0 0 #0000 !important;
}
</style>
