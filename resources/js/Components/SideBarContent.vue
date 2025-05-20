<script setup>
import Accordion from 'primevue/accordion';
import AccordionPanel from 'primevue/accordionpanel';
import AccordionHeader from 'primevue/accordionheader';
import AccordionContent from 'primevue/accordioncontent';
import { Link } from '@inertiajs/vue3';
import useTranslation from '@/Services/TranslationService.js';
import { useAppStore } from '@/store/App';
import { computed, ref } from 'vue';

const { t } = useTranslation();
const appStore = useAppStore();
const darkMode = computed(() => appStore.darkMode);

</script>
<template>
    <Link href="/dashboard">
    <img src="/img/Logo.png" alt="Logo" class="cursor-pointer" />
    </Link>
    <div class="mt-11">
        <Accordion value="0" expandIcon="pi pi-angle-right" collapseIcon="pi pi-angle-down">
            <AccordionPanel class="!border-none">
                <AccordionHeader class="!font-medium text-secondary-text !rounded-xl !h-3 flex !hover:color-white">
                    <div :class="darkMode ? 'text-white' : 'text-secondary-text'">
                        <font-awesome-icon icon="fa-regular fa-house" class="mr-3 text-lg" />
                        {{ t("Dashboard") }}
                    </div>
                </AccordionHeader>
                <AccordionContent class="mt-3">
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#ef4a00] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{ t("Administration")
                                }}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#487fff] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{ t("Support") }}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#f8b757] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{
                                    t("Sales and earning") }}
                            </span>
                        </li>
                        </Link>
                    </div>
                </AccordionContent>
            </AccordionPanel>
        </Accordion>
        <div class=" font-semibold text-gray-600 mt-4" :class="darkMode ? 'text-white' : 'text-secondary-text'">My tools
        </div>
        <div class="mt-3 mr-1">
            <div class="pl-4 rounded-xl w-full h-11 flex items-center font-medium hover:bg-primary-color hover:!text-white"
                :class="darkMode ? 'text-white' : 'text-secondary-text'">
                <font-awesome-icon icon="fa-light fa-envelope" class="mr-3 text-lg" />
                {{ t("Email") }}
            </div>
            <div class="pl-4 rounded-xl w-full h-11 flex items-center font-medium hover:bg-primary-color hover:!text-white"
                :class="darkMode ? 'text-white' : 'text-secondary-text'">
                <font-awesome-icon icon="fa-light fa-comment-dots" class="mr-3 text-lg" />
                {{ t("Chat") }}
            </div>
            <div class="pl-4 rounded-xl w-full h-11 flex items-center  font-medium hover:bg-primary-color hover:!text-white"
                :class="darkMode ? 'text-white' : 'text-secondary-text'">
                <font-awesome-icon icon="fa-light fa-calendar" class="mr-3 text-lg" />
                {{ t("Calendar") }}
            </div>
            <div class="pl-4 rounded-xl w-full h-11 flex items-center  font-medium hover:bg-primary-color hover:!text-white"
                :class="darkMode ? 'text-white' : 'text-secondary-text'">
                <font-awesome-icon icon="fa-light fa-map" class="mr-3 text-lg" />
                {{ t("Trello") }}
            </div>
        </div>
        <Accordion value="0" expandIcon="pi pi-angle-right" collapseIcon="pi pi-angle-down">
            <AccordionPanel class="!border-none">
                <AccordionHeader class="!font-medium text-secondary-text !rounded-xl !h-3 flex">
                    <div :class="darkMode ? 'text-white' : 'text-secondary-text'">
                        <font-awesome-icon icon="fa-light fa-file-invoice-dollar" class="mr-3 text-lg" />
                        {{ t("Sales") }}
                    </div>
                </AccordionHeader>
                <AccordionContent class="mt-3">
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#487fff] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{ t("Opportunities") }}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="/quotes/show">
                        <li class="text-[#f8b757] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{ t("Quotes") }}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#75b643] text-xl ml-8">
                            <span class="text-sm font-medium" :class="darkMode ? 'text-white' : 'text-secondary-text'">
                                {{t("Invoices")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#ef4a00] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Expenses")}}</span>
                        </li>
                        </Link>
                    </div>
                </AccordionContent>
            </AccordionPanel>
        </Accordion>
        <Accordion value="0" expandIcon="pi pi-angle-right" collapseIcon="pi pi-angle-down">
            <AccordionPanel class="!border-none">
                <AccordionHeader class="!font-medium text-secondary-text !rounded-xl !h-3 flex">
                    <div :class="darkMode ? 'text-white' : 'text-secondary-text'">
                        <font-awesome-icon icon="fa-light fa-microchip-ai" class="mr-3 text-lg" />
                        {{t("Account")}}s
                    </div>
                </AccordionHeader>
                <AccordionContent class="mt-3">
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#ef4a00] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#487fff] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#f8b757] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                </AccordionContent>
            </AccordionPanel>
        </Accordion>
        <Accordion value="0" expandIcon="pi pi-angle-right" collapseIcon="pi pi-angle-down">
            <AccordionPanel class="!border-none">
                <AccordionHeader class="!font-medium text-secondary-text !rounded-xl !h-3 flex">
                    <div :class="darkMode ? 'text-white' : 'text-secondary-text'">
                        <font-awesome-icon icon="fa-light fa-desktop" class="mr-3 text-lg" />
                        {{t("Product")}}s
                    </div>
                </AccordionHeader>
                <AccordionContent class="mt-3">
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#ef4a00] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#487fff] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#f8b757] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                </AccordionContent>
            </AccordionPanel>
        </Accordion>
        <Accordion value="0" expandIcon="pi pi-angle-right" collapseIcon="pi pi-angle-down">
            <AccordionPanel class="!border-none">
                <AccordionHeader class="!font-medium text-secondary-text !rounded-xl !h-3 flex">
                    <div :class="darkMode ? 'text-white' : 'text-secondary-text'">
                        <font-awesome-icon icon="fa-light fa-cart-shopping" class="mr-3 text-lg" />
                        {{t("Support")}}
                    </div>
                </AccordionHeader>
                <AccordionContent class="mt-3">
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#ef4a00] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#487fff] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#f8b757] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                </AccordionContent>
            </AccordionPanel>
        </Accordion>
        <div :class="darkMode ? 'text-white' : 'text-secondary-text'" class="font-semibold text-gray-600 mt-4 mb-3">{{t("Administration")}}</div>
        <Accordion value="0" expandIcon="pi pi-angle-right" collapseIcon="pi pi-angle-down">
            <AccordionPanel class="!border-none">
                <AccordionHeader class="!font-medium text-secondary-text !rounded-xl !h-3 flex">
                    <div :class="darkMode ? 'text-white' : 'text-secondary-text'">
                        <font-awesome-icon icon="fa-light fa-hexagon-nodes" class="mr-3 text-lg" />
                        {{t("User")}}s
                    </div>
                </AccordionHeader>
                <AccordionContent class="mt-3">
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#ef4a00] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#487fff] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#f8b757] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                </AccordionContent>
            </AccordionPanel>
        </Accordion>
        <Accordion value="0" expandIcon="pi pi-angle-right" collapseIcon="pi pi-angle-down">
            <AccordionPanel class="!border-none">
                <AccordionHeader class="!font-medium text-secondary-text !rounded-xl !h-3 flex">
                    <div :class="darkMode ? 'text-white' : 'text-secondary-text'">
                        <font-awesome-icon icon="fa-light fa-square-question" class="mr-3 text-lg" />
                        {{t("GP Academy")}}
                    </div>
                </AccordionHeader>
                <AccordionContent class="mt-3">
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#ef4a00] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#487fff] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#f8b757] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                </AccordionContent>
            </AccordionPanel>
        </Accordion>
        <Accordion value="0" expandIcon="pi pi-angle-right" collapseIcon="pi pi-angle-down">
            <AccordionPanel class="!border-none">
                <AccordionHeader class="!font-medium text-secondary-text !rounded-xl !h-3 flex">
                    <div :class="darkMode ? 'text-white' : 'text-secondary-text'">
                        <font-awesome-icon icon="fa-light fa-circle-exclamation" class="mr-3 text-lg" />
                        {{t("Communications")}}
                    </div>
                </AccordionHeader>
                <AccordionContent class="mt-3">
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#ef4a00] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#487fff] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#f8b757] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                </AccordionContent>
            </AccordionPanel>
        </Accordion>
        <Accordion value="0" expandIcon="pi pi-angle-right" collapseIcon="pi pi-angle-down">
            <AccordionPanel class="!border-none">
                <AccordionHeader class="!font-medium text-secondary-text !rounded-xl !h-3 flex">
                    <div :class="darkMode ? 'text-white' : 'text-secondary-text'">
                        <font-awesome-icon icon="fa-light fa-gear" class="mr-3 text-lg" />
                        {{t("Options")}}
                    </div>
                </AccordionHeader>
                <AccordionContent class="mt-3">
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#ef4a00] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#487fff] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                    <div class="mt-2 rounded-xl w-full"
                        :class="darkMode ? 'hover:bg-zinc-800' : 'hover:bg-sky-100'">
                        <Link href="">
                        <li class="text-[#f8b757] text-xl ml-8">
                            <span class="text-sm font-medium"
                                :class="darkMode ? 'text-white' : 'text-secondary-text'">{{t("Link")}}</span>
                        </li>
                        </Link>
                    </div>
                </AccordionContent>
            </AccordionPanel>
        </Accordion>
    </div>
</template>
<style>
li {
    cursor: pointer;
}

.p-accordionpanel:not(.p-disabled).p-accordionpanel-active>.p-accordionheader {
    background-color: #387C2B !important;
    color: white !important;
}

.p-accordionpanel:not(.p-disabled).p-accordionpanel-active>.p-accordionheader>div, .p-accordionpanel:not(.p-disabled).p-accordionpanel-active>.p-accordionheader>div {
    color: white !important;
}

.p-accordionpanel:not(.p-disabled):hover>.p-accordionheader {
    background-color: #387C2B !important;
    color: white !important;
}

.p-accordionpanel:not(.p-disabled):hover>.p-accordionheader>div, .p-accordionpanel:not(.p-disabled):hover>.p-accordionheader>span {
    color: white !important;
}

.p-accordionheader,
.p-accordioncontent-content {
    background-color: transparent !important;
}
</style>
