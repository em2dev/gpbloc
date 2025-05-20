<script setup>
import { computed, onMounted, ref } from 'vue';
import { usePage, useForm, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Select from 'primevue/select';
import { FilterMatchMode } from '@primevue/core/api';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import axios from 'axios';
import { useConfirm } from "primevue/useconfirm";
import useTranslation from '@/Services/TranslationService.js';
import { useAppStore } from '@/store/App';

const { t } = useTranslation();
const confirm = useConfirm();
const appStore = useAppStore();
const darkMode = computed(() => appStore.darkMode);

const quotes = ref([]);
const selectedQuotes = ref([]);

onMounted(() => {
    axios.get(route('quote.get'))
        .then((response) => {
            quotes.value = response.data;
            console.log(quotes.value);
        })
        .catch((error) => {
            console.error('Error fetching quotes:', error);
        });
});

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    status: { value: null, matchMode: FilterMatchMode.EQUALS },
});

const deleteQuote = (id) => {
    confirm.require({
        message: 'Are you sure you want to delete this quote?',
        header: 'Delete Quote',
        icon: 'pi pi-exclamation-triangle',
        acceptLabel: 'Yes',
        rejectLabel: 'No',
        accept: () => {
            axios.delete(route('quote.delete', id))
                .then((response) => {
                    console.log('Quote deleted:', response.data);
                    axios.get(route('quote.get'))
                        .then((response) => {
                            quotes.value = response.data;
                            console.log(quotes.value);
                        })
                        .catch((error) => {
                            console.error('Error fetching quotes:', error);
                        });
                })
                .catch((error) => {
                    console.error('Error deleting quote:', error);
                });
        },
    });
}

</script>
<template>
    <AppLayout title="Quotes">
        <div class="w-full h-screen p-6" :class="darkMode ? 'bg-primary-dark !text-white' : 'bg-primary-gray !text-black' ">
            <h1 :class="darkMode ? '!text-white' : '!text-black'" class="font-semibold text-2xl text-primary-text">{{ t("Quotes") }}</h1>
            <div :class="darkMode ? '!bg-[#18181b]' : '!bg-white'" class="rounded-xl shadow-md p-5 mt-5">
                <DataTable :value="quotes" :paginator="true" :rows="10" :rowsPerPageOptions="[10, 20, 50]"
                    v-model:selection="selectedQuotes" v-model:filters="filters" dataKey="name">
                    <template #header #paginatorcontainer="{ rows, rowsPerPageOptions }">
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                <IconField>
                                    <InputIcon class="pi pi-search" />
                                    <InputText v-model="filters['global'].value" :placeholder="t('Search')" />
                                </IconField>
                            </div>
                            <div class="flex gap-2">
                                <Select :placeholder="t('Action Status')" showClear v-model="filters['status'].value"
                                    :options="[(t('pending').charAt(0).toUpperCase() + t('pending').slice(1)), 'Approved']" :class="darkMode ? '!text-white' : '!text-black'">
                                </Select>
                                <Link href="/quotes/create">
                                <Button :label="t('New quote')" icon="pi pi-plus" class="!text-white h-10" />
                                </Link>
                            </div>
                        </div>
                    </template>
                    <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                    <Column field="code" :header="t('Code')" :class="darkMode ? '!text-white' : '!text-black'">
                        <template #body="quote">
                            <a :href="route('quote.edit', quote.data.id)">
                                <span>{{ quote.data.code }}</span>
                            </a>
                        </template>
                    </Column>
                    <Column field="quote_type.name" :header="t('Type')" :class="darkMode ? '!text-white' : '!text-black'">
                        <template #body="quote">
                            <div class="flex items-center gap-2" v-if="quote.data.quote_type?.icon">
                                <font-awesome-icon :icon="quote.data.quote_type?.icon" class="text-xl" />
                                <span>{{ t(quote.data.quote_type?.name).charAt(0).toUpperCase() +
                                    t(quote.data.quote_type?.name).slice(1) }}</span>
                            </div>
                        </template>
                    </Column>
                    <Column field="client.name" header="Client" :class="darkMode ? '!text-white' : '!text-black'" />
                    <Column field="created_at" :header="t('Creation date')" :class="darkMode ? '!text-white' : '!text-black'">
                        <template #body="quote">
                            <span>{{ quote.data.created_at }}</span>
                        </template>
                    </Column>
                    <Column field="total" header="Total" :class="darkMode ? '!text-white' : '!text-black'">
                        <template #body="quote">
                            <span>${{ quote.data.total }}</span>
                        </template>
                    </Column>
                    <Column field="status" :header="t('Action Status')" :class="darkMode ? '!text-white' : '!text-black'">
                        <template #body="quote">
                            <Tag class="w-22 !font-light" v-if="quote.data.status"
                                :severity="quote.data.status == 'pending' ? 'danger' : 'success'">
                                {{ t(quote.data.status).charAt(0).toUpperCase() + t(quote.data.status).slice(1) }}
                            </Tag>
                        </template>
                    </Column>
                    <Column>
                        <template #body="quote">
                            <div class="flex gap-2 items-center justify-end mr-5">
                                <Button rounded class="!w-7 !h-7 !bg-opacity-20 !bg-button-blue !border-none">
                                    <template #icon>
                                        <font-awesome-icon icon="fa-light fa-eye" class="text-xs text-button-blue" />
                                    </template>
                                </Button>
                                <a :href="route('quote.edit', quote.data.id)">
                                    <Button rounded class="!w-7 !h-7 !bg-opacity-20 !bg-button-green !border-none">
                                        <template #icon>
                                            <font-awesome-icon icon="fa-light fa-pen-to-square"
                                                class="text-xs text-button-green" />
                                        </template>
                                    </Button>
                                </a>
                                <Button @click="deleteQuote(quote.data.id)" rounded
                                    class="!w-7 !h-7 !bg-opacity-20 !bg-button-red !border-none">
                                    <template #icon>
                                        <font-awesome-icon icon="fa-light fa-trash-can"
                                            class="text-xs text-button-red" />
                                    </template>
                                </Button>
                            </div>
                        </template>
                    </Column>
                </DataTable>
            </div>
        </div>
    </AppLayout>
    <ConfirmDialog />
</template>
<style>
.p-datatable-header-cell {
    background-color: #F5F6FA !important;
}
.my-app-dark .p-datatable-header-cell {
    background-color: #0a0a0c !important;
}
.my-app-dark .p-select-option {
    color: #fff !important;
}
.my-app-dark .p-select-label {
    color: #fff !important;
}
</style>
