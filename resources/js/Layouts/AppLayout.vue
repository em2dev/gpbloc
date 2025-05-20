<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import SideBarContent from '@/Components/SideBarContent.vue';
import useTranslation from '@/Services/TranslationService.js';
import LangSelector from '@/Components/LangSelector.vue';
import { useAppStore } from '@/store/App';

const { t } = useTranslation();

const appStore = useAppStore();

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);
const darkMode = ref(appStore.darkMode);
const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};

const toggleDarkMode = () => {
    appStore.toggleDarkMode();
}

const navBarState = ref(true);
const toggleNav = () => {
    navBarState.value = !navBarState.value;
    const sideBar = document.getElementById('sideBar');
    if (navBarState.value) {
        sideBar.style.minWidth = '19.5rem';
        sideBar.style.padding = '1rem';
    } else {
        sideBar.style.minWidth = '0';
        sideBar.style.width = '0';
        sideBar.style.padding = '0';
    }
}
</script>
<template>
    <div class="flex">

        <Head :title="title" />

        <Banner />
        <div id="sideBar" class="h-screen min-w-[19.5rem] p-4 sticky top-0">
            <SideBarContent />
        </div>

        <div class="w-screen h-[4.5rem] bg-surface-100">
            <div class="flex justify-between h-full ml-4">
                <div class="flex items-center">
                    <font-awesome-icon icon="fa-regular fa-align-justify" class="ml-2 cursor-pointer"
                        @click="toggleNav()" />
                    <IconField class="ml-5 w-96">
                        <InputIcon class="pi pi-search" />
                        <InputText class="w-96" :placeholder="t('Search')" filled />
                    </IconField>
                </div>
                <div class="flex items-center justify-end mr-5">
                    <Dropdown width="48">
                        <template #trigger>
                            <Button rounded class="w-10 h-10 mr-4">
                                <font-awesome-icon icon="fa-light fa-octagon-plus" class=" text-2xl text-white" />
                            </Button>
                        </template>

                        <template #content>
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ t("Shortcut") }}s
                            </div>
                            <DropdownLink href="/quotes/create">
                                <font-awesome-icon icon="fa-regular fa-plus" class="mr-1" />
                                {{ t("New quote") }}
                            </DropdownLink>
                        </template>
                    </Dropdown>

                    <Button rounded class="w-10 h-10 mr-4" severity="secondary" @click="toggleDarkMode()">
                        <font-awesome-icon :icon="darkMode ? 'fa-light fa-moon-stars' : 'fa-light fa-sun-bright'"
                            class="text-2xl" />
                    </Button>
                    <LangSelector />
                    <Button rounded class="w-10 h-10 mr-4" severity="secondary">
                        <font-awesome-icon icon="fa-light fa-envelope" class="text-2xl" />
                    </Button>
                    <Button rounded class="w-10 h-10 mr-4" severity="secondary">
                        <font-awesome-icon icon="fa-light fa-bell" class="text-2xl" />
                    </Button>
                    <Dropdown width="48">
                        <template #trigger>
                            <Button rounded class="w-10 h-10 mr-4"
                                :style="'background-image: url(' + $page.props.auth.user.profile_photo_url + ');background-position: center;background-size: 3rem 3rem;'"
                                severity="secondary" />
                        </template>

                        <template #content>
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ t("Manage Team") }}
                            </div>

                            <DropdownLink :href="route('teams.show', $page.props.auth.user.current_team)">
                                {{ t("Team Settings") }}
                            </DropdownLink>

                            <DropdownLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')">
                                {{ t("Create New Team") }}
                            </DropdownLink>

                            <template v-if="$page.props.auth.user.all_teams.length > 1">
                                <div class="border-t border-gray-200" />

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ t("Switch Teams") }}
                                </div>

                                <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                    <form @submit.prevent="switchToTeam(team)">
                                        <DropdownLink as="button">
                                            <div class="flex items-center">
                                                <svg v-if="team.id == $page.props.auth.user.current_team_id"
                                                    class="me-2 size-5 text-green-400"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>

                                                <div>{{ team.name }}</div>
                                            </div>
                                        </DropdownLink>
                                    </form>
                                </template>
                            </template>
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ t("Manage Account") }}
                            </div>

                            <DropdownLink :href="route('profile.show')">
                                {{ t("Profile") }}
                            </DropdownLink>

                            <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                {{ t("API Tokens") }}
                            </DropdownLink>
                            <div class="border-t border-gray-200" />

                            <form @submit.prevent="logout">
                                <DropdownLink as="button">
                                    {{ t("Log Out") }}
                                </DropdownLink>
                            </form>
                        </template>
                    </Dropdown>
                </div>
            </div>

            <main>
                <div id="main" class="w-[100%]" :class="darkMode ? ' bg-zinc-800' : 'bg-zinc-100'">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
<style>
#main {
    transition: margin-left .5s ease;
}

#sideBar {
    transition: 0.5s ease;
    overflow-x: hidden;
}
</style>
