<script setup>
import { computed, ref, onMounted } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Select from 'primevue/select'
import InputMask from 'primevue/inputmask';
import QuoteHeaderForm from './QuoteHeaderForm.vue';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import { useQuoteStore } from '@/store/Quote';
import useTranslation from '@/Services/TranslationService.js';

const { t } = useTranslation();
const store = useQuoteStore();

const onCellEditComplete = (event) => {
    let { data, newValue, field } = event;

    switch (field) {
        case 'quantity':
            if (isPositiveInteger(newValue)) data[field] = newValue;
            else event.preventDefault();
            break;
        default:
            if (newValue.length > 0) data[field] = newValue;
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

const addOption = () => {
    store.form.options.items.push({
        name: '',
        quantity: 1,
        unit_price: 0,
    });
};



onMounted(() => {
    if (store.form.options.items.length === 0) {
        addOption();
    }
});

const removeZeroInFront = () => {
    store.form.options.items.forEach((item) => {
        if (/^0\d/.test(item['unit_price'])) {
            item['unit_price'] = item['unit_price'].replace(/^0+/, '');
        }
    });
};

</script>
<template>
    <div class="p-5 flex flex-col h-full justify-between">
        <div>
            <QuoteHeaderForm />
            <DataTable :value="store.form.options.items" :rows="10" :rowsPerPageOptions="[10, 20, 50]"
                class="rounded w-full border-2 text-sm" editMode="cell" @cell-edit-complete="onCellEditComplete">
                <Column header="Options" field="name">
                    <!-- <template #editor="option">
                        <InputText v-model="option.data.name" type="text" class="w-full h-6" />
                    </template> -->
                    <template #body="option">
                        <InputText v-model="option.data.name" placeholder="Option" type="text" class="w-full h-10" />
                    </template>
                </Column>

                <Column :header="t('Quantity')" field="quantity">
                    <!-- <template #editor="option">
                        <InputText v-model="option.data.quantity" type="number" class="w-14 h-6" />
                    </template> -->
                    <template #body="option">
                        <InputText v-model="option.data.quantity" type="number" min="1" class="w-20 h-6" />
                    </template>
                </Column>

                <Column :header="t('Price')" field="unit_price">
                    <!-- <template #body="option">
                        <span>${{ option.data.unit_price }}</span>
                    </template> -->
                    <!-- <template #editor="option">
                        $
                        <InputText v-model="option.data.unit_price" type="number" class="w-20 h-6" />
                    </template> -->
                    <template #body="option">
                        $
                        <InputText v-model="option.data.unit_price" min="0" type="number" class="w-20 h-6" @change="removeZeroInFront()" />
                    </template>
                    <template #footer>
                        <span class="w-full flex justify-end">
                            {{ t('Subtotal') }} :
                        </span>
                    </template>
                </Column>
                <Column header="Total">
                    <template #body="option">
                        <span>${{ (parseFloat(option.data.unit_price || 0) * parseFloat(option.data.quantity ||
                            0)).toFixed(2) }}</span>
                    </template>
                    <template #footer>
                        ${{ store.options_subtotal().toFixed(2) }}
                    </template>
                </Column>
                <Column>
                    <template #body="option">
                        <font-awesome-icon icon="fa-light fa-trash-can"
                            @click="store.deleteItem(option.data, 'option')" />
                    </template>
                </Column>
            </DataTable>
            <div class="mt-6 flex justify-between w-full">
                <Button @click="addOption">
                    <font-awesome-icon icon="fa-regular fa-plus" />
                    {{ t('Add option') }}
                </Button>
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
