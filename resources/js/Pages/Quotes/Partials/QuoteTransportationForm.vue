<script setup>
import { ref, computed } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Select from 'primevue/select'
import InputMask from 'primevue/inputmask';
import QuoteHeaderForm from './QuoteHeaderForm.vue';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import { useQuoteStore } from '@/store/Quote';
import useTranslation from '@/Services/TranslationService.js';
import Textarea from 'primevue/textarea';

const { t } = useTranslation();
const store = useQuoteStore();

const carriersOptions = ref([
    { carrier: 'Bi-Train', capacity_without_lift: 88000, capacity_with_lift: 82500, price_per_trip: 65 },
    { carrier: 'Boom', capacity_without_lift: 60786, capacity_with_lift: 54886, price_per_trip: 50 },
]);

const numberWithCommas = (x) => {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

const onCellEditComplete = (event) => {
    let { data, newValue, field } = event;

    switch (field) {
        case 'number_of_trips':
        case 'number_of_goings':
        case 'number_of_comings':
            if (isPositiveInteger(newValue)) data[field] = newValue;
            else event.preventDefault();
            break;
        case 'carrier':
            let carrier = carriersOptions.value.find(carrier => carrier.carrier === newValue);
            if (carrier) {
                Object.entries(carrier).forEach(([key, value]) => {
                    data[key] = value;
                });
            } else {
                event.preventDefault();
            }
            break;
        case 'price_per_trip':
            if (newValue >= 0) data[field] = newValue;
            else event.preventDefault();
            break;
        default:
            if (newValue.trim().length > 0) data[field] = newValue;
            else event.preventDefault();
            break;
    }
};

const isPositiveInteger = (val) => {
    let str = String(val);

    str = str.trim();

    if (!str) {
        return false;
    }

    str = str.replace(/^0+/, '') || '0';
    var n = Math.floor(Number(str));

    return n !== Infinity && String(n) === str && n > 0;
};


const TransportationTotal = (transportation) => {
    let price = 0;
    if (store.form.type.name == 'rental') {
        price = (parseInt(transportation.data.number_of_goings) + parseInt(transportation.data.number_of_comings)) * transportation.data.price_per_trip;
    } else {
        price = transportation.data.price_per_trip * transportation.data.number_of_trips;
    }
    store.form.transportation.items.find(i => i === transportation.data).total = price;
    return price;
}

const addLine = () => {
    try {

        store.form.transportation.items.push({
            carrier: 'Carrier',
            capacity_without_lift: 0,
            capacity_with_lift: 0,
            number_of_trips: 1,
            price_per_trip: 0,
            number_of_goings: 1,
            number_of_comings: 1,
        });
    } catch (error) {
        console.error('Error adding line:', error);

    }
};

if (store.form.transportation.items.length === 0) {
    addLine();
}

const autoFillTransportation = (transport) => {
    let carrier = carriersOptions.value.find(carrier => carrier.carrier === transport.data.carrier);
    if (carrier) {
        Object.entries(carrier).forEach(([key, value]) => {
            transport.data[key] = value;
        });
    }
}

</script>
<template>
    <div class="p-5 flex flex-col h-full justify-between">
        <div>
            <QuoteHeaderForm />
            <DataTable :value="store.form.transportation.items" :rows="10" :rowsPerPageOptions="[10, 20, 50]"
                class="rounded w-full border-2 text-sm" editMode="cell" @cell-edit-complete="onCellEditComplete">
                <Column :header="t('Carrier')" field="carrier">
                    <!-- <template #editor="transport">
                        <Select v-model="transport.data.carrier" optionValue="carrier" optionLabel="carrier"
                            :options="carriersOptions" filter class="w-full h-10" />
                    </template> -->
                    <template #body="transport">
                        <Select v-model="transport.data.carrier" optionValue="carrier" optionLabel="carrier"
                            :options="carriersOptions" filter class="w-40 h-10"
                            @change="autoFillTransportation(transport)" :placeholder="t('Carrier')" />
                    </template>
                </Column>

                <Column :header="t('Charge capcity without lift')" field="capacity_with_lift">
                    <template #body="transport">
                        <span>{{ numberWithCommas(transport.data.capacity_without_lift) }} Lbs</span>
                    </template>
                </Column>
                <Column :header="t('Charge capacity with lift')" field="capacity_with_lift">
                    <template #body="transport">
                        <span>{{ numberWithCommas(transport.data.capacity_with_lift) }} Lbs</span>
                    </template>
                </Column>
                <Column v-if="store.form.type.name == 'rental'" :header="t('Number of goings')"
                    field="number_of_goings">
                    <!-- <template #editor="transport">
                        <InputText v-model="transport.data.number_of_goings" type="number" class="w-14 h-6" :min="0" />
                    </template> -->
                    <template #body="transport">
                        <InputText v-model="transport.data.number_of_goings" type="number" class="w-16 h-6" :min="0" />
                    </template>
                </Column>
                <Column v-if="store.form.type.name == 'rental'" :header="t('Number of comings')"
                    field="number_of_comings">
                    <!-- <template #editor="transport">
                        <InputText v-model="transport.data.number_of_comings" type="number" class="w-14 h-6" :min="0" />
                    </template> -->
                    <template #body="transport">
                        <InputText v-model="transport.data.number_of_comings" type="number" class="w-16 h-6" :min="0" />
                    </template>
                </Column>
                <Column v-if="store.form.type.name == 'sale'" :header="t('Number of trips')" field="number_of_trips">
                    <!-- <template #editor="transport">
                        <InputText v-model="transport.data.number_of_trips" type="number" class="w-14 h-6" />
                    </template> -->
                    <template #body="transport">
                        <InputText v-model="transport.data.number_of_trips" type="number" class="w-16 h-6" />
                    </template>
                </Column>

                <Column :header="t('Price per trip')" field="price_per_trip" class="max-w-32">
                    <!-- <template #editor="transport">
                        <InputNumber showButtons v-model="transport.data.price_per_trip" fluid :minFractionDigits="2" :maxFractionDigits="2" :min="0" class="h-10" />
                    </template> -->
                    <template #body="transport">
                        <span>
                            <InputNumber showButtons v-model="transport.data.price_per_trip" fluid
                                :minFractionDigits="2" :maxFractionDigits="2" :min="0" class="h-10" />
                        </span>
                    </template>
                    <template #footer>
                        {{ t('Subtotal') }} :
                    </template>
                </Column>
                <Column header="Total" field="total">
                    <template #body="transport">
                        <span>${{ TransportationTotal(transport).toFixed(2) }}</span>
                    </template>
                    <template #footer>
                        ${{ store.transportation_subtotal() }}
                    </template>
                </Column>
                <Column>
                    <template #body="transportation">
                        <font-awesome-icon icon="fa-light fa-trash-can"
                            @click="store.deleteItem(transportation.data, 'transportation')" />
                    </template>
                </Column>
            </DataTable>
            <div class="mt-6 flex justify-between w-full">
                <Button @click="addLine">
                    <font-awesome-icon icon="fa-regular fa-plus" />
                    {{ t('Add Line') }}
                </Button>
            </div>
        </div>
        <div>
            <h3 class="font-bold text-2xl text-primary-text mb-4">{{ t('Shipping contact') }}</h3>
            <div class="grid grid-cols-2 w-10/12 gap-4 gap-x-2 ml-5">
                <div class="grid grid-cols-2 gap-y-4 gap-x-4">
                    <div>
                        <label class="font-medium text-sm text-secondary-text">{{ t('First name') }}</label>
                        <IconField>
                            <InputIcon>
                                <font-awesome-icon icon="fa-regular fa-user" />
                            </InputIcon>
                            <InputText v-model="store.form.transportation.shipping_contact_first_name"
                                class=" w-full h-10" :placeholder="t('first_name_placeholder')" />
                        </IconField>
                    </div>
                    <div>
                        <label class="font-medium text-sm text-secondary-text">{{ t('Last name') }}</label>
                        <IconField>
                            <InputIcon>
                                <font-awesome-icon icon="fa-regular fa-user" />
                            </InputIcon>
                            <InputText v-model="store.form.transportation.shipping_contact_last_name"
                                class="w-full h-10" :placeholder="t('last_name_placeholder')" />
                        </IconField>
                    </div>
                    <div>
                        <label class="font-medium text-sm text-secondary-text">{{ t('Email') }}</label>
                        <IconField>
                            <InputIcon>
                                <font-awesome-icon icon="fa-light fa-envelope" />
                            </InputIcon>
                            <InputText v-model="store.form.transportation.shipping_contact_email" class="w-full h-10"
                                :placeholder="t('contact_email_placeholder')" />
                        </IconField>
                    </div>
                    <div>
                        <label class="font-medium text-sm text-secondary-text">{{ t('Phone') }}</label>
                        <IconField>
                            <InputIcon>
                                <font-awesome-icon icon="fa-regular fa-phone-volume" />
                            </InputIcon>
                            <InputMask v-model="store.form.transportation.shipping_contact_phone" mask="(999) 999-9999"
                                class=" w-full h-10" placeholder="(555) 000-0000" />
                        </IconField>
                    </div>
                </div>
                <div class="ml-5 w-full">
                    <label class="font-medium text-sm text-secondary-text">{{ t('Client notes') }}</label>
                    <Textarea rows="3" cols="30" class="w-full h-32"
                        v-model="store.form.transportation.client_notes" :placeholder="t('client_notes_placeholder')" />
                </div>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <span class="text-base font-medium text-gray-600">{{ store.form.quote.code }} - {{ store.form.client.name
                }}</span>
            <div class="flex gap-2">
                <Button @click="store.previousStep" variant="outlined" severity="secondary">{{ t('Previous step')}}</Button>
                <Button @click="store.nextStep">{{ t('Next step') }}</Button>
            </div>
        </div>
    </div>
</template>
