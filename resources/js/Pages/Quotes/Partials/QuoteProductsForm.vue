<script setup>
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Select from 'primevue/select'
import QuoteHeaderForm from './QuoteHeaderForm.vue';
import { useQuoteStore } from '@/store/Quote';
import useTranslation from '@/Services/TranslationService.js';

const { t } = useTranslation();
const store = useQuoteStore();

const productCodes = ref([
    { code: 'BR222', description: 'Bloc Ruff grade 1 2x2x2', width: 2, height: 2, length: 2, rental_price_per_day: 3, weight: 1100 },
    { code: 'BR224', description: 'Bloc Ruff grade 2 2x2x4', width: 2, height: 2, length: 4, rental_price_per_day: 3, weight: 2200 },
    { code: 'BR232', description: 'Bloc Ruff grade 1 2x3x2', width: 2, height: 3, length: 2, rental_price_per_day: 3, weight: 1350 },
    { code: 'BR234', description: 'Bloc Ruff grade 1 2x3x4', width: 2, height: 3, length: 4, rental_price_per_day: 3, weight: 3700 },
]);

const numberWithCommas = (x) => {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

const onCellEditComplete = (event) => {
    let { data, newValue, field } = event;

    switch (field) {
        case 'quantity':
        case 'rental_days':
            if (isPositiveInteger(newValue)) data[field] = newValue;
            else event.preventDefault();
            break;
        case 'code':
            console.log('code', newValue);
            let product = productCodes.value.find(product => product.code === newValue);
            console.log('product', product);
            if (product) {
                data.code = product.code;
                Object.entries(product).forEach(([key, value]) => {
                    if (key !== 'code') {
                        data[key] = value;
                    }
                });
            } else {
                event.preventDefault();
            }
            break;
        case 'rental_price_per_day':
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

const addProduct = () => {
    store.form.products.items.push({
        code: 'Product code',
        description: '',
        width: 0,
        height: 0,
        length: 0,
        quantity: 1,
        rental_days: 1,
        weight: 0,
        rental_price_per_day: 0
    });
};

const productTotal = (product) => {
    let price = product.data.rental_price_per_day * product.data.rental_days * product.data.quantity;
    store.form.products.items.find(item => item.code === product.data.code && item.quantity == product.data.quantity && item.rental_days == product.data.rental_days).total = price;
    return price;
}

if (store.form.products.items.length === 0) {
    addProduct();
}

const autofillPorduct = (product) => {
    let productData = productCodes.value.find(p => p.code === product.data.code);
    if (productData) {
        Object.entries(productData).forEach(([key, value]) => {
            if (key !== 'code') {
                product.data[key] = value;
            }
        });
    }
}

</script>
<template>
    <div class="p-5 flex flex-col h-full justify-between">
        <div>
            <QuoteHeaderForm />
            <DataTable :value="store.form.products.items" :rows="10" :rowsPerPageOptions="[10, 20, 50]"
                class="rounded w-full border-2 text-sm" editMode="cell" @cell-edit-complete="onCellEditComplete">
                <Column header="Code" field="code">
                    <!-- <template #editor="product">
                        <Select v-model="product.data.code" optionValue="code" optionLabel="code"
                            :options="productCodes" filter class="w-full h-10" />
                    </template> -->
                    <template #body="product">
                        <Select v-model="product.data.code" optionValue="code" optionLabel="code"
                            :options="productCodes" filter class="w-full h-10" @change="autofillPorduct(product)" />
                    </template>
                </Column>
                <Column header="Description" field="description" />
                <Column :header="t('Width')" field="width">
                    <template #body="product">
                        <span>{{ product.data.width }}’</span>
                    </template>
                </Column>
                <Column :header="t('Height')" field="height">
                    <template #body="product">
                        <span>{{ product.data.height }}’</span>
                    </template>
                </Column>
                <Column :header="t('Length')" field="length">
                    <template #body="product">
                        <span>{{ product.data.length }}’</span>
                    </template>
                </Column>
                <Column :header="t('Quantity')" field="quantity">
                    <!-- <template #editor="product">
                        <InputText v-model="product.data.quantity" type="number" class="w-14 h-6" />
                    </template> -->
                    <template #body="product">
                        <InputText v-model="product.data.quantity" type="number" class="w-16 h-6" min="1" />
                    </template>
                    <template #footer>
                        {{store.form.products?.items.reduce((acc, product) => acc + parseInt(product.quantity), 0)}}
                    </template>
                </Column>
                <Column :header="t('Days')" field="rental_days">
                    <!-- <template #editor="product">
                        <InputText v-model="product.data.rental_days" type="number" class="w-14 h-6" />
                    </template> -->
                    <template #body="product">
                        <InputText v-model="product.data.rental_days" type="number" class="w-16 h-6" min="1" />
                    </template>
                </Column>
                <Column :header="t('Weight') + '(Lbs)'" field="weight">
                    <template #body="product">
                        <span>{{ numberWithCommas(product.data.weight) }}</span>
                    </template>
                </Column>
                <Column header="Total (lbs)">
                    <template #body="product">
                        <span>{{ numberWithCommas(product.data.weight * product.data.quantity) }}</span>
                    </template>
                    <template #footer>
                        {{numberWithCommas(store.form.products.items.reduce((acc, product) => acc + (product.weight * product.quantity), 0))}}
                    </template>
                </Column>
                <Column class="!max-w-32" :header="t('Price per day')" field="rental_price_per_day">
                    <!-- <template #editor="product">
                        <InputNumber showButtons v-model="product.data.rental_price_per_day" fluid :minFractionDigits="2" :maxFractionDigits="2" :min="0" class="h-10" />
                    </template>
                    <template #body="product">
                        <span>${{ product.data.rental_price_per_day }}</span>
                    </template> -->
                    <template #body="product">
                        <InputNumber showButtons v-model="product.data.rental_price_per_day" fluid :minFractionDigits="2" :maxFractionDigits="2" :min="0" class="h-10" />
                    </template>
                    <template #footer>
                        {{t('Subtotal')}} :
                    </template>
                </Column>
                <Column header="Total" field="total">
                    <template #body="product">
                        <span>${{ productTotal(product).toFixed(2) }}
                        </span>
                    </template>
                    <template #footer>
                        ${{store.products_subtotal().toFixed(2)}}
                    </template>
                </Column>
                <Column>
                    <template #body="product">
                        <font-awesome-icon icon="fa-light fa-trash-can" @click="store.deleteItem(product.data, 'product')" />
                    </template>
                </Column>
            </DataTable>
            <div class="mt-6 flex justify-between w-full">
                <Button @click="addProduct">
                    <font-awesome-icon icon="fa-regular fa-plus" />
                    {{t('Add product')}}
                </Button>
            </div>
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
