import axios from 'axios';
import { defineStore } from 'pinia'
import { computed, ref, watch } from 'vue';

export const useQuoteStore = defineStore('quote', () => {

    // Faire une fonction permettant de selectionner la tax provinciale en fonction de l'adresse du client ?
    const TVQ = 0.09975;
    const TPS = 0.05;
    const localTax = TPS;

    const form = ref({
        quote: {
            id: null,
            code: '',
            order_date: '',
            delivery_date: '',
            start_date: '',
            end_date: '',
            PO_client: '',
            PO_GPBloc: '',
        },
        type: {
            name: '',
            id: null,
        },
        client: {
            id: null,
            name: '',
            phone: '',
            email: '',
            website: '',
            description: '',
            address: '',
            city: '',
            province: '',
            zip: '',
            delivery_address: '',
            delivery_city: '',
            delivery_province: '',
            delivery_zip: '',
            contact_first_name: '',
            contact_last_name: '',
            contact_email: '',
            contact_phone: '',
        },
        products: {
            id: null,
            items: [],
        },
        transportation: {
            id: null,
            items: [],
            shipping_contact_first_name: '',
            shipping_contact_last_name: '',
            shipping_contact_phone: '',
            shipping_contact_email: '',
            client_notes: '',
        },
        options: {
            id: null,
            items: [],
        },
        notes: {
            id: null,
            quote_valid_days: '',
            thawing_days: '',
            general_rental_terms: '',
            payement_method: '',
            bank_transfer: '',
        },
        discount: 0,
    });

    function transportation_subtotal() {
        if (form.value.transportation.items.length == 0) {
            return 0;
        }
        // if (form.value.type.name == 'rental') {
        //     return form.value.transportation.items.reduce((acc, item) => acc + (item.price_per_trip * (item.number_of_goings + item.number_of_comings), 0));
        // }
        return form.value.transportation.items.reduce((acc, item) => acc + item.total, 0)
    }

    function products_subtotal() {
        if (form.value.products.items.length == 0) {
            return 0;
        }
        return form.value.products.items.reduce((acc, product) => acc + (product.rental_price_per_day * product.rental_days *
            product.quantity),
            0)
    }

    function options_subtotal() {
        if (form.value.options.items.length == 0) {
            return 0;
        }
        return form.value.options.items.reduce((acc, item) => acc + item.unit_price * item.quantity, 0)
    }

    function subtotal() {
        return parseFloat(products_subtotal() + transportation_subtotal() + options_subtotal());
    }

    function taxes() {
        let taxes = ((subtotal() - discount.value) * (TVQ + localTax));
        if (taxes == undefined || taxes == null || isNaN(taxes)) {
            return 1;
        }
        return taxes;
    }

    const discount = computed(() => {
        let e = form.value.discount;
        if (e == undefined || e == null || isNaN(e)) {
            return 0;
        }
        return e;
    });

    const total = computed(() => {
        let total = (subtotal() - discount.value + taxes());
        if (total == undefined || total == null) {
            return 0;
        }
        return parseFloat(total);
    });

    const steps = ref([
        { label: 'Quote type', selected: true, disabled: false, component: 'QuoteTypeForm', index: 'quote' },
        { label: 'Client informations', selected: false, disabled: true, component: 'QuoteClientForm', index: 'quote_client' },
        { label: 'Products', selected: false, disabled: true, component: 'QuoteProductsForm', index: 'quote_product' },
        { label: 'Transportation', selected: false, disabled: true, component: 'QuoteTransportationForm', index: 'quote_transportation' },
        { label: 'Options', selected: false, disabled: true, component: 'QuoteOptionsForm', index: 'quote_option' },
        { label: 'Notes', selected: false, disabled: true, component: 'QuoteNotesForm', index: 'quote_note' },
        { label: 'Summary', selected: false, disabled: true, component: '', index: 'quote_summary' },
    ]);

    const buttons = ref([
        { label: 'Preview', disabled: true, function: '' },
        { label: 'Download PDF', disabled: true, function: () => { console.log('Télécharger le PDF') } },
        { label: 'Print', disabled: true, function: () => { console.log('Imprimer') } },
        { label: 'Send to client', disabled: false, function: () => { console.log('Envoyer au client') } },
        // Possible aussi de juste mettre le nom de la fonction et de l'appeler comme ceci:

        // buttons[0].function()

        // function saveType() {
        //     console.log('saveType');
        // }

        // À vérifier
    ]);

    const selectedStep = computed(() => {
        return steps.value.find(step => step.selected);
    });

    watch(() => form.value.type, (newValue, oldValue) => {
        console.log('Type changed from', oldValue, 'to', newValue);
        if (newValue.name == 'transportation') {
            steps.value = [
                { label: 'Quote type', selected: true, disabled: false, component: 'QuoteTypeForm', index: 'quote' },
                { label: 'Client informations', selected: false, disabled: true, component: 'QuoteClientForm', index: 'quote_client' },
                { label: 'Options', selected: false, disabled: true, component: 'QuoteOptionsForm', index: 'quote_option' },
                { label: 'Notes', selected: false, disabled: true, component: 'QuoteNotesForm', index: 'quote_note' },
                { label: 'Summary', selected: false, disabled: true, component: '', index: 'quote_summary' },
            ];
        } else {
            steps.value = [
                { label: 'Quote type', selected: true, disabled: false, component: 'QuoteTypeForm', index: 'quote' },
                { label: 'Client informations', selected: false, disabled: true, component: 'QuoteClientForm', index: 'quote_client' },
                { label: 'Products', selected: false, disabled: true, component: 'QuoteProductsForm', index: 'quote_product' },
                { label: 'Transportation', selected: false, disabled: true, component: 'QuoteTransportationForm', index: 'quote_transportation' },
                { label: 'Options', selected: false, disabled: true, component: 'QuoteOptionsForm', index: 'quote_option' },
                { label: 'Notes', selected: false, disabled: true, component: 'QuoteNotesForm', index: 'quote_note' },
                { label: 'Summary', selected: false, disabled: true, component: '', index: 'quote_summary' },
            ];
        }
    }, { deep: true });

    function enableUpdateMode() {
        steps.value.splice(0, 1);
        steps.value[0].selected = true;
        steps.value.forEach((step, i) => {
            step.disabled = false;
        });
    }

    function selectStep(selectedstep) {
        if (selectedstep.disabled) return;
        var index = steps.value.findIndex(step => step === selectedstep);
        if (index !== -1) {
            steps.value = steps.value.map((step, i) => ({
                ...step,
                selected: i == index,
            }));
        }
    };

    function nextStep() {
        var index = steps.value.findIndex(step => step.selected);
        if (index === steps.value.length - 1) return;

        if (index === 0 && form.value.type.id !== null) {
            steps.value.forEach((step, i) => {
                step.disabled = false;
            });
        }

        submitForm().then(() => {
            selectStep(steps.value[index + 1]);
        }).catch((error) => {
            console.error('Error submitting form:', error);
        });
    }

    function previousStep() {
        var index = steps.value.findIndex(step => step.selected);
        if (index === 0) return;
        // validations on forms
        selectStep(steps.value[index - 1]);
    }

    function deleteItem(item, type) {
        console.log('deleteItem', item, type);
        if (type === 'product') {
            form.value.products.items = form.value.products.items.filter(i => i !== item);
        } else if (type === 'transportation') {
            form.value.transportation.items = form.value.transportation.items.filter(i => i !== item);
        }
        else if (type === 'option') {
            form.value.options.items = form.value.options.items.filter(i => i !== item);
        }
        if (item.id) {
            axios.delete(route('quote_' + type + '_item.delete', item.id))
                .then(response => {
                    console.log('Item deleted successfully:', response.data);
                })
                .catch(error => {
                    console.error('Error deleting item:', error);
                });
        }
    }

    async function submitForm() {
        let payload = {};
        let route_name = '';

        switch (selectedStep.value.index) {
            case 'quote':
                payload = {
                    ...form.value.quote,
                    quote_type_id: form.value.type.id,
                };
                route_name = 'quote.updateOrCreate';
                break;
            case 'quote_client':
                payload = {
                    ...form.value.client,
                    quote_id: form.value.quote.id,
                }
                route_name = 'quote_client.updateOrCreate';
                break;
            case 'quote_product':
                payload = {
                    ...form.value.products,
                    quote_id: form.value.quote.id,
                }
                route_name = 'quote_product.updateOrCreate';
                break;
            case 'quote_transportation':
                payload = {
                    ...form.value.transportation,
                    quote_id: form.value.quote.id,
                }
                route_name = 'quote_transportation.updateOrCreate';
                break;
            case 'quote_option':
                payload = {
                    ...form.value.options,
                    quote_id: form.value.quote.id,
                }
                route_name = 'quote_option.updateOrCreate';
                break;
            case 'quote_note':
                payload = {
                    ...form.value.notes,
                    quote_id: form.value.quote.id,
                }
                route_name = 'quote_note.updateOrCreate';
                break;
            default:
                throw new Error('Invalid step index');
        }

        axios.post(route(route_name), payload)
            .then(response => {
                switch (route_name) {
                    case 'quote.updateOrCreate':
                        form.value.quote = response.data;
                        break;
                    case 'quote_client.updateOrCreate':
                        form.value.client = response.data;
                        break;
                    case 'quote_product.updateOrCreate':
                        form.value.products = response.data;
                        break;
                    case 'quote_transportation.updateOrCreate':
                        form.value.transportation = response.data;
                        break;
                    case 'quote_option.updateOrCreate':
                        form.value.options = response.data;
                        break;
                    case 'quote_note.updateOrCreate':
                        form.value.notes = response.data;
                        break;
                }
                payload = {
                    ...form.value.quote,
                    total: total.value.toFixed(2),
                    subtotal: subtotal().toFixed(2),
                    discount: discount.value,
                }
                route_name = 'quote.updateOrCreate';
                axios.post(route(route_name), payload)
                    .then(response => {
                        return;
                    })
                    .catch(error => {
                        console.log('Error updating quote:', error);
                        throw new Error('Error updating quote:', error);
                    });
                return response.data;
            })
            .catch(error => {
                console.log('Error submitting form:', error);
                throw new Error('Error submitting form:', error);
            });
    }

    function $reset() {
        form.value = {
            quote: {
                id: null,
                code: '',
                order_date: '',
                delivery_date: '',
                start_date: '',
                end_date: '',
                PO_client: '',
                PO_GPBloc: '',
            },
            type: {
                name: '',
                id: null,
            },
            client: {
                id: null,
                name: '',
                phone: '',
                email: '',
                website: '',
                description: '',
                address: '',
                city: '',
                province: '',
                zip: '',
                delivery_address: '',
                delivery_city: '',
                delivery_province: '',
                delivery_zip: '',
                contact_first_name: '',
                contact_last_name: '',
                contact_email: '',
                contact_phone: '',
            },
            products: {
                id: null,
                items: [],

            },
            transportation: {
                id: null,
                items: [],
                shipping_contact_first_name: '',
                shipping_contact_last_name: '',
                shipping_contact_phone: '',
                shipping_contact_email: '',
            },
            options: {
                id: null,
                items: [],
            },
            notes: {
                id: null,
                quote_valid_days: '',
                thawing_days: '',
                general_rental_terms: '',
                payement_method: '',
                bank_transfer: '',
            },
            discount: 0,
        };

        steps.value = [
            { label: 'Quote type', selected: true, disabled: false, component: 'QuoteTypeForm', index: 'quote' },
            { label: 'Client informations', selected: false, disabled: true, component: 'QuoteClientForm', index: 'quote_client' },
            { label: 'Products', selected: false, disabled: true, component: 'QuoteProductsForm', index: 'quote_product' },
            { label: 'Transportation', selected: false, disabled: true, component: 'QuoteTransportationForm', index: 'quote_transportation' },
            { label: 'Options', selected: false, disabled: true, component: 'QuoteOptionsForm', index: 'quote_option' },
            { label: 'Notes', selected: false, disabled: true, component: 'QuoteNotesForm', index: 'quote_note' },
            { label: 'Summary', selected: false, disabled: true, component: '', index: 'quote_summary' },
        ];
    }

    return {
        form,
        steps,
        buttons,
        selectedStep,
        total,
        discount,
        selectStep,
        nextStep,
        previousStep,
        $reset,
        transportation_subtotal,
        products_subtotal,
        options_subtotal,
        subtotal,
        taxes,
        deleteItem,
        enableUpdateMode
    }
});
