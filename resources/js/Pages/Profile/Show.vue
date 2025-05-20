<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import { ref } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';
import useTranslation from '@/Services/TranslationService.js';

const { t } = useTranslation();

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});

const initialState = ref({
    fullName: '',
    email: '',
    phone: '',
    bio: '',
    department_id: null,
    designation_id: null,
    language_id: null,
});

const form = ref({ ...initialState.value });

const form_settings = ref({
    departments: [],
    designations: [],
    languages: [],
});

const feedFormSettings = () => {

}
const $page = usePage()

const user = $page.props.auth.user


const formTemp = useForm({
    _method: 'PUT',
    name: user.name,
    email: user.email,
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        formTemp.photo = photoInput.value.files[0];
    }

    formTemp.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        // onSuccess: () => clearPhotoFileInput(),
    });
};

</script>

<template>
    <AppLayout title="Profile">
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template> -->

        <div>
            <div class="max-w-7xl py-10 sm:px-6 lg:px-8">
                <div class="flex justify-around w-full h-full">
                    <div class="flex w-[31rem] mr-5 h-[40rem] rounded-2xl bg-white ">

                        <div class="w-full rounded-xl overflow-hidden shadow-lg bg-white">
                            <!-- Header -->
                            <div class="bg-gray-400 h-36 relative">
                            <div class="absolute inset-x-0 -bottom-14 flex justify-center">
                                <div class="w-28 h-28 rounded-full bg-gray-300 border-4 border-white" :style="'background-image: url('+$page.props.auth.user.profile_photo_url+');background-position: center;background-size: 6rem 6rem;'"></div>
                            </div>
                            </div>

                            <!-- Body -->
                            <div class="pt-14 px-4 pb-6 text-center">
                                <h2 class="text-xl font-semibold text-gray-800">{{ user.name }}</h2>
                                <p class="text-sm text-gray-500">{{ form.designation }}</p>

                                <hr class="my-4">
                                <div class="flex justify-start">
                                    <h2 class="align-left font-bold mb-3">{{t("Personal information")}}</h2>
                                </div>
                                <div class="text-left space-y-2">
                                    <div class="flex">
                                        <span class="w-28 font-medium text-gray-700">{{ t("Full name") }}</span>
                                        <span>: {{ user.name }}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-28 font-medium text-gray-700">{{t("Email")}}</span>
                                        <span>: {{ user.email }}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-28 font-medium text-gray-700">{{t("Phone")}}</span>
                                        <span>: {{ }}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-28 font-medium text-gray-700">{{t("Department")}}</span>
                                        <span>: {{ }}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-28 font-medium text-gray-700">{{t("Designation")}}</span>
                                        <span>: {{  }}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-28 font-medium text-gray-700">{{t("Language")}}</span>
                                        <span>: {{ }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="w-28 font-medium text-gray-700">{{t("Biography")}}</span>
                                        <span>: </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="p-5 flex-col flex w-[64rem] h-[40rem] rounded-2xl bg-white">
                        <h2 class="text-lg font-semibold">{{t("Profile picture")}}</h2>
                        <div class="mt-2">
                            <img :src="$page.props.auth.user.profile_photo_url" alt="Profile Image" class="w-[7rem] h-[7rem] rounded-full border-2 border-gray-300" />
                        </div>
                        <!-- Conteneur des champs -->
                        <div class="flex justify-between w-full flex-wrap">
                            <!-- Champ : Nom complet -->
                            <div class="flex flex-col w-[49%] mt-5">
                                <label for="fullName" class="text-sm font-medium text-gray-700 mb-1">{{t("Full name")}}</label>
                                <InputText
                                    id="fullName"
                                    v-model="formTemp.name"
                                    :placeholder="t('fullname_placeholder')"
                                    class="w-full"
                                />
                            </div>

                            <!-- Champ : Email -->
                            <div class="flex flex-col w-[49%] mt-5">
                                <label for="email" class="text-sm font-medium text-gray-700 mb-1">{{t("Email")}}</label>
                                <InputText
                                    id="email"
                                    v-model="formTemp.email"
                                    :placeholder="t('email_placeholder')"
                                    class="w-full"
                                />
                            </div>

                            <!-- Champ : Téléphone -->
                            <div class="flex flex-col w-[49%] mt-5">
                                <label for="phone" class="text-sm font-medium text-gray-700 mb-1">{{t("Phone")}}</label>
                                <InputText
                                    id="phone"
                                    v-model="form.phone"
                                    :placeholder="t('phone_placeholder')"
                                    class="w-full"
                                />
                            </div>

                            <!-- Dropdown : Département -->
                            <div class="flex flex-col w-[49%] mt-5">
                                <label for="department" class="text-sm font-medium text-gray-700 mb-1">{{t("Department")}}</label>
                                <Dropdown
                                    id="department"
                                    v-model="form.department"
                                    :options="form_settings.departments"
                                    :placeholder="t('department_placeholder')"
                                    class="w-full"
                                />
                            </div>

                            <!-- Dropdown : Désignation -->
                            <div class="flex flex-col w-[49%] mt-5">
                                <label for="designation" class="text-sm font-medium text-gray-700 mb-1">{{t("Designation")}}</label>
                                <Dropdown
                                    id="designation"
                                    v-model="form.designation"
                                    :options="form_settings.designations"
                                    :placeholder="t('designation_placeholder')"
                                    class="w-full"
                                />
                            </div>

                            <!-- Dropdown : Langue -->
                            <div class="flex flex-col w-[49%] mt-5">
                                <label for="language" class="text-sm font-medium text-gray-700 mb-1">{{t("Language")}}</label>
                                <Dropdown
                                    id="language"
                                    v-model="form.language"
                                    :options="form_settings.languages"
                                    :placeholder="t('language_placeholder')"
                                    class="w-full"
                                />
                            </div>

                            <!-- Champ : Bio -->
                            <div class="flex flex-col w-full mt-5">
                                <label for="bio" class="text-sm font-medium text-gray-700 mb-1">{{t("Biography")}}</label>
                                <Textarea
                                    id="bio"
                                    v-model="form.bio"
                                    :placeholder="t('description_placeholder')"
                                    rows="3"
                                    class="w-full"
                                />
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="flex justify-center w-full space-x-2 mt-6">
                        <Button :label="t('Cancel')" severity="danger" variant="outlined" class="p-button-secondary w-32" />
                        <Button @click="updateProfileInformation" :label="t('Save')" class="p-button-primary w-32" />
                        </div>

                    </div>
                </div>
                <!-- <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <UpdateProfileInformationForm :user="$page.props.auth.user" />

                    <SectionBorder />
                </div> -->

                <!-- <div v-if="$page.props.jetstream.canUpdatePassword">
                    <UpdatePasswordForm class="mt-10 sm:mt-0" />

                    <SectionBorder />
                </div>

                <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                    <TwoFactorAuthenticationForm
                        :requires-confirmation="confirmsTwoFactorAuthentication"
                        class="mt-10 sm:mt-0"
                    />

                    <SectionBorder />
                </div>

                <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0" />

                <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                    <SectionBorder />

                    <DeleteUserForm class="mt-10 sm:mt-0" />
                </template> -->
            </div>
        </div>
    </AppLayout>
</template>
