<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputText from 'primevue/inputtext';
import FloatLabel from 'primevue/floatlabel';
import Password from 'primevue/password';
import Checkbox from 'primevue/checkbox';
import Button from 'primevue/button';
import useTranslation from '@/Services/TranslationService.js';

import { vue3dLoader } from "vue-3d-loader";

const { t } = useTranslation();

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />


    <div class="flex h-screen w-screen">
        <div class="hidden md:flex justify-center items-center w-[50%] bg-gradient-to-r from-[#387C2B] to-[#0E4B02]">
            <img src="/img/concrete_block.png" alt="Bloc" class="w-auto h-[30rem] aspect-auto" />
            <!-- <vue3dLoader
                filePath="/img/bloc_3d.glb"
                :cameraPosition="{ x: 0, y: 10, z: 13 }"
                :height="350"
                backgroundColor="#F2F2F2"
                /> -->
        </div>
        <div class="flex w-[50%]  justify-center items-center bg-surface-100">
            <div class="flex flex-col items-center justify-start w-[29rem] h-[42rem]">
                <div class="w-full">
                    <img src="/img/Logo_catch_phrase.png" alt="Bloc" class="w-[14rem] h-auto" />
                </div>

                <div class="flex flex-col items-start mt-5 w-full">
                    <h1 class=" text-4xl font-semibold">{{t('Login')}}</h1>
                    <h2 class="pt-2 font-normal text-lg">{{t('Welcome_string_login')}}</h2>
                    <form @submit.prevent="submit" class="w-full mt-5">
                        <div class="w-full mt-5">
                            <FloatLabel variant="in">
                                <InputText class="w-full rounded" id="in_label" type="email" v-model="form.email" variant="filled" required autofocus autocomplete="username"></InputText>
                                <label for="in_label">
                                    <font-awesome-icon icon="fa-light fa-envelope" class="mr-2" />
                                    {{t('Email')}}
                                </label>
                            </FloatLabel>
                        </div>
                        <div class="w-full mt-5">
                            <FloatLabel variant="in">
                                <Password class="w-full rounded" :feedback="false" toggleMask id="password" v-model="form.password" variant="filled" required autofocus autocomplete="current-password" />
                                <label for="password">
                                    <font-awesome-icon icon="fa-regular fa-lock-keyhole" class="mr-2" />
                                    {{t('Password')}}
                                </label>
                            </FloatLabel>
                        </div>
                        <div class="mt-5">
                            <label class="flex items-center justify-between">
                                <div>
                                    <Checkbox :binary="true" v-model="form.remember" name="remember" size="large" />
                                    <span class="ms-2 text-base">{{t("Remember me")}}</span>
                                </div>
                                <Link v-if="canResetPassword" :href="route('password.request')" class="text-normal font-medium text-[#387C2B]">
                                    {{t("Forgot Password")}}?
                                </Link>
                            </label>
                        </div>
                        <Button class="w-full mt-5" type="submit" :disabled="form.processing" :label="t('Login')" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>-->

        <!-- <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Forgot your password?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form> -->
    <!-- </AuthenticationCard>  -->
</template>
<style>
.p-password-input {
    width: 100%;
}
</style>
