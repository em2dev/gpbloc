import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createPinia } from 'pinia'

import PrimeVue from 'primevue/config';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import ConfirmDialog from 'primevue/confirmdialog';
import Dialog from 'primevue/dialog';
import Password from 'primevue/password';
import Dropdown from 'primevue/dropdown';
import Textarea from 'primevue/textarea';
import MultiSelect from 'primevue/multiselect';
import Divider from 'primevue/divider';
import Checkbox from 'primevue/checkbox';
import InputNumber from 'primevue/inputnumber';
import Card from 'primevue/card';
import ColorPicker from 'primevue/colorpicker';
import Tag from 'primevue/tag';
import DynamicDialog from 'primevue/dynamicdialog';
import DialogService from 'primevue/dialogservice';
import ToastService from 'primevue/toastservice';
import Toast from 'primevue/toast';
import Message from 'primevue/message';
import ConfirmationService from 'primevue/confirmationservice';
import Tooltip from 'primevue/tooltip';



//import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";

// Theme :
// To override : comment and place new theme in resources/css/theme.css
//import 'primevue/resources/themes/aura-light-noir/theme.css';

/*store vuex*/
import store from '@/store/index';

/* import the fontawesome core */
import { config, library } from "@fortawesome/fontawesome-svg-core";
/* import font awesome icon component */
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
/* import specific icons */
import {
    faBallotCheck,
    //faUsers,
    faPlus,
    faClock,
    faTents,
    faUsersGear,
    faTrash,
    faArrowLeft,
    faFileArrowDown,
    faCheck,
    faAngleLeft,
    faMagnifyingGlass,
    faFileExport,
    faUpRightFromSquare,
    faCirclePlus,
    faAlignJustify,
    faLockKeyhole,
    faHouse,
    faTruck,
    faSquareDollar,
    faClockFive,
    faClone,
    faUser,
    faPhoneVolume,
} from "@fortawesome/pro-regular-svg-icons";

import {
    faUsers,
    faMoneyBillTransfer,
    faCreditCard,
    faGlobe,
    faFileInvoiceDollar,
    faOctagonPlus,
    faEnvelope,
    faBell,
    faSunBright,
    faMoonStars,
    faCommentDots,
    faCalendar,
    faMap,
    faMicrochipAi,
    faDesktop,
    faCartShopping,
    faHexagonNodes,
    faSquareQuestion,
    faCircleExclamation,
    faGear,
    faEye,
    faTrashCan,
    faPenToSquare,
    faSquareArrowRight,
} from "@fortawesome/pro-light-svg-icons";

import {
    faXTwitter,
    faFacebookF,
    faLinkedinIn,
    faInstagram,
    faCcVisa,
    faCcMastercard,
    faCcAmex,

} from "@fortawesome/free-brands-svg-icons";

import {
    faShareNodes,
    faText,
    faLink,
    faPencil,

} from "@fortawesome/pro-solid-svg-icons";

import { definePreset } from '@primeuix/themes';

library.add(
    faBallotCheck,
    faUsers,
    faPlus,
    faClock,
    faTents,
    faUsersGear,
    faTrash,
    faArrowLeft,
    faFileArrowDown,
    faCheck,
    faAngleLeft,
    faMagnifyingGlass,
    faFileExport,
    faMoneyBillTransfer,
    faCreditCard,
    faXTwitter,
    faFacebookF,
    faLinkedinIn,
    faInstagram,
    faGlobe,
    faUpRightFromSquare,
    faFileInvoiceDollar,
    faCcVisa,
    faCcMastercard,
    faCcAmex,
    faCirclePlus,
    faAlignJustify,
    faShareNodes,
    faText,
    faLink,
    faCartShopping,
    faPencil,
    faEnvelope,
    faLockKeyhole,
    faOctagonPlus,
    faBell,
    faSunBright,
    faMoonStars,
    faHouse,
    faCommentDots,
    faCalendar,
    faMap,
    faMicrochipAi,
    faDesktop,
    faCartShopping,
    faHexagonNodes,
    faSquareQuestion,
    faCircleExclamation,
    faGear,
    faEye,
    faTrashCan,
    faPenToSquare,
    faTruck,
    faSquareDollar,
    faClockFive,
    faClone,
    faUser,
    faPhoneVolume,
    faSquareArrowRight,
);

import Aura from '@primeuix/themes/aura';

const MyPreset = definePreset(Aura, {
    semantic: {
        primary: {
            200: '#54bb40',
            300: '#49a238',
            400: '#387C2B',
            500: '#387C2B',
            600: '#306f26',
        },
        colorScheme: {
            light: {
                surface: {
                    0: '#ffffff',
                    50: '{zinc.50}',
                    100: '{zinc.100}',
                    200: '{zinc.200}',
                    300: '{zinc.300}',
                    400: '{zinc.400}',
                    500: '{zinc.500}',
                    600: '{zinc.600}',
                    700: '{zinc.700}',
                    800: '{zinc.800}',
                    900: '{zinc.900}',
                    950: '{zinc.950}'
                },

            },
            dark: {
                surface: {
                    0: '#000000',
                    50: '{slate.50}',
                    100: '{zinc.100}',
                    200: '{zinc.200}',
                    300: '{zinc.300}',
                    400: '{zinc.400}',
                    500: '{zinc.500}',
                    600: '{zinc.600}',
                    700: '{zinc.700}',
                    800: '{zinc.800}',
                    900: '{zinc.900}',
                    950: '{zinc.950}'
                },
            }
        }
    }
});

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const pinia = createPinia();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(store)
            .use(pinia)
            .use(PrimeVue, {
                theme: {
                    preset: MyPreset,
                    options: {
                        prefix: 'p',
                        darkModeSelector: '.my-app-dark',
                        cssLayer: false
                    }
                },
                locale: {
                    accept: 'Oui',
                    reject: 'Non',
                    closeText: 'Fermer',
                    prevText: 'Précédent',
                    nextText: 'Suivant',
                    monthNames: [
                        'Janvier',
                        'Février',
                        'Mars',
                        'Avril',
                        'Mai',
                        'Juin',
                        'Juillet',
                        'Août',
                        'Septembre',
                        'Octobre',
                        'Novembre',
                        'Décembre'
                    ],
                    monthNamesShort: [
                        'Jan',
                        'Fév',
                        'Mar',
                        'Avr',
                        'Mai',
                        'Jun',
                        'Jul',
                        'Aoû',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Déc'
                    ], dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'], dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'], dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'], weekHeader: 'Semaine', firstDay: 1, isRTL: false, showMonthAfterYear: false, yearSuffix: '', timeOnlyTitle: 'Choisir l\'heure', timeText: 'Heure', hourText: 'Heures', minuteText: 'Minutes', secondText: 'Secondes', currentText: 'Maintenant', ampm: false, month: 'Mois', week: 'Semaine', day: 'Jour', allDayText: 'Toute la journée',
                    dateFormat: 'dd-mm-yy'
                }
            })
            .use(DialogService)
            .use(ToastService)
            .use(ConfirmationService)
            .directive('tooltip', Tooltip)
            .component("DataTable", DataTable)
            .component("Column", Column)
            .component("Button", Button)
            .component("InputText", InputText)
            .component("ConfirmDialog", ConfirmDialog)
            .component("Dialog", Dialog)
            .component("Password", Password)
            .component("Dropdown", Dropdown)
            .component("Textarea", Textarea)
            .component("MultiSelect", MultiSelect)
            .component("font-awesome-icon", FontAwesomeIcon)
            .component('Divider', Divider)
            .component("Checkbox", Checkbox)
            .component("InputNumber", InputNumber)
            .component("Card", Card)
            .component("ColorPicker", ColorPicker)
            .component("Tag", Tag)
            .component("DynamicDialog", DynamicDialog)
            .component("Toast", Toast)
            .component("Message", Message)
            .mount(el);
    }
});
