<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import InputText from 'primevue/inputtext';
import FloatLabel from 'primevue/floatlabel';
import Button from 'primevue/button';
import useTranslation from '@/Services/TranslationService.js';

const { t } = useTranslation();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password" />
    <div class="flex h-screen w-screen">
        <div class="hidden md:flex justify-center items-center w-[50%] bg-gradient-to-r from-[#387C2B] to-[#0E4B02]">
            <img src="/img/concrete_block.png" alt="Bloc" class="w-auto h-[30rem] aspect-auto" />
        </div>
        <div class="flex w-[50%]  justify-center items-center bg-surface-100">
            <div class="flex flex-col items-center justify-start w-[29rem] h-[42rem]">
                <div class="w-full">
                    <img src="/img/Logo_catch_phrase.png" alt="Bloc" class="w-[14rem] h-auto" />
                </div>
                <div class="flex flex-col items-start mt-5 w-full">
                    <h1 class=" text-4xl font-semibold">{{t("Forgot Password")}}</h1>
                    <h2 class="pt-2 font-normal text-lg">{{t("Forgot_password_string")}}</h2>
                    <form @submit.prevent="submit" class="w-full mt-5">
                        <div class="w-full mt-5">
                            <FloatLabel variant="in">
                                <InputText class="w-full rounded" id="in_label" type="email" v-model="form.email" variant="filled" required autofocus autocomplete="username"></InputText>
                                <label for="in_label">
                                    <font-awesome-icon icon="fa-regular fa-envelope" class="mr-2" />
                                    {{t("Email")}}
                                </label>
                            </FloatLabel>
                        </div>
                        <Button class="w-full mt-5" type="submit" :disabled="form.processing" :label="t('Continue')" />
                    </form>
                </div>
                <Link :href="route('login')" class="mt-5 text-normal font-medium text-[#387C2B]">
                    {{t("Back_to_login")}}
                </Link>
            </div>
        </div>
    </div>
</template>
