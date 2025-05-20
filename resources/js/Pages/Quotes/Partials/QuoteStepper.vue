<script setup>
import { computed, ref } from 'vue';
import { useQuoteStore } from '@/store/Quote';
import useTranslation from '@/Services/TranslationService.js';

const { t } = useTranslation();
const store = useQuoteStore();

const numberWithCommas = (x) => {
    return x?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

</script>

<template>
    <div class="w-72 h-[87vh] bg-white rounded-xl shadow-md p-7">
        <div class="flex flex-col w-full h-1/2">
            <div v-for="step in store.steps" :key="step.label" @click="store.selectStep(step)"
                :class="['mt-2 py-1 rounded-xl w-full', step.selected ? 'bg-[#E5FFE4]' : 'border-primary-gray']">
                <li class="text-primary-color text-2xl ml-8" :class="step.disabled ? '!text-gray-400' : ''">
                    <span class="text-base font-medium text-secondary-text"
                        :class="step.disabled ? '!text-gray-400' : ''">{{ t(step.label) }}</span>
                </li>
            </div>
        </div>
        <div class="flex flex-col w-full h-1/2 justify-between">
            <div>
                <div class="flex justify-between">
                    <span class="text-sm text-secondary-text">
                        {{t('Subtotal')}}:
                    </span>
                    <span class="font-bold text-right text-primary-text text-sm">
                        ${{ numberWithCommas(store.subtotal()?.toFixed(2)) }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-secondary-text">
                        {{t('Discount')}}:
                    </span>
                    <span class="font-bold text-right text-primary-text text-sm">
                        <!-- ${{ numberWithCommas(store.discount?.toFixed(2)) }} -->
                         $<InputText
                            v-model="store.form.discount"
                            type="number"
                            :formatter="(value) => numberWithCommas(value)"
                            :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
                            :placeholder="t('Discount')"
                            class="w-20 h-6 text-right"
                            min="0"
                            :step="5" />
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-secondary-text">
                        Taxes:
                    </span>
                    <span class="font-bold text-right text-primary-text text-sm">
                        ${{ numberWithCommas(store.taxes().toFixed(2)) }}
                    </span>
                </div>
                <div class="flex justify-between border-t-2 mt-2 border-gray-200">
                    <span class="font-bold mt-2">
                        Total:
                    </span>
                    <span class="font-bold text-right mt-2 text-primary-text text-sm">
                        ${{ numberWithCommas(store.total?.toFixed(2)) }}
                    </span>
                </div>
            </div>
            <div>
                <Button v-for="button in store.buttons"
                        v-bind:key="button.label"
                        class="w-full h-12 mt-3 !justify-start !border-none !rounded-lg font-medium"
                        :class="button.disabled ? '!bg-[#979797] !opacity-100' : 'bg-primary-color'"
                        @click=""
                        :disabled="button.disabled">
                    {{ t(button.label) }}
                    <font-awesome-icon icon="fa-light fa-square-arrow-right" size="lg" class="ml-1" />
                </Button>
            </div>
        </div>
    </div>
</template>
