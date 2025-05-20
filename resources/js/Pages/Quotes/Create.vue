<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import QuoteTypeForm from './Partials/QuoteTypeForm.vue';
import QuoteClientForm from './Partials/QuoteClientForm.vue';
import QuoteHeaderForm from './Partials/QuoteHeaderForm.vue';
import QuoteProductsForm from './Partials/QuoteProductsForm.vue';
import QuoteTransportationForm from './Partials/QuoteTransportationForm.vue';
import QuoteOptionsForm from './Partials/QuoteOptionsForm.vue';
import QuoteNotesForm from './Partials/QuoteNotesForm.vue';
import QuoteStepper from './Partials/QuoteStepper.vue';
import { useQuoteStore } from '@/store/Quote';
import { defineProps, ref, onMounted, computed } from 'vue';
import { useAppStore } from '@/store/App';
import { nextTick } from 'vue';

const props = defineProps({
    quote: {
        type: Object,
        default: () => (undefined),
    },
});

const store = useQuoteStore();
const darkMode = computed(() => (useAppStore().darkMode));



onMounted(() => {
    store.$reset();
    if (props.quote && props.quote !== undefined) {
        console.log(props.quote)
        store.form.quote = {
            ...props.quote.quote,
        };

        nextTick(() => {
            store.enableUpdateMode();
        });

        if (props.quote.client && props.quote.client !== undefined) {
            store.form.client = {
                ...props.quote.client,
            };
        }
        if (props.quote.products && props.quote.products !== undefined) {
            store.form.products = {
                ...props.quote.products,
            };
        }
        if (props.quote.transportation && props.quote.transportation !== undefined) {
            store.form.transportation = {
                ...props.quote.transportation,
            };
        }
        if (props.quote.options && props.quote.options !== undefined) {
            store.form.options = {
                ...props.quote.options,
            };
        }
        if (props.quote.notes && props.quote.notes !== undefined) {
            store.form.notes = {
                ...props.quote.notes,
            };
        }
        if (props.quote.type && props.quote.type !== undefined) {
            store.form.type = {
                ...props.quote.type,
            };
        }
        store.steps.forEach((step) => {
            step.disabled = false;
        });
    }
});

const getComponent = (step) => {
    switch (step.component) {
        case 'QuoteTypeForm':
            return QuoteTypeForm;
        case 'QuoteClientForm':
            return QuoteClientForm;
        case 'QuoteHeaderForm':
            return QuoteHeaderForm;
        case 'QuoteProductsForm':
            return QuoteProductsForm;
        case 'QuoteTransportationForm':
            return QuoteTransportationForm;
        case 'QuoteOptionsForm':
            return QuoteOptionsForm;
        case 'QuoteNotesForm':
            return QuoteNotesForm;
        default:
            return null;
    }
}

</script>

<template>
    <AppLayout title="Create Quote">
        <div class="p-5 flex gap-5" :class="darkMode ? '!bg-primary-dark' : '!bg-primary-gray'">
            <div class="rounded-xl shadow-md flex-1 p-5 h-[87vh]" :class="darkMode ? '!bg-[#18181b]' : '!bg-white'">
                <component :is="getComponent(store.selectedStep)" />
            </div>
            <QuoteStepper />
        </div>
    </AppLayout>
</template>
<style>
.p-datatable-header-cell {
    background-color: #F5F6FA !important;
}
</style>
