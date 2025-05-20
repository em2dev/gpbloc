import en from '../../lang/en.json';
import fr from '../../lang/fr.json';

const languages = {
    en,
    fr,
    // Add more languages as needed
};

export function translate(key) {
    const language = languages[localStorage.getItem('lang')] || languages['fr'];
    if (!language || !language[key]) {
        return key; // Fallback to the key if translation is not found
    }
    return language[key];
}

export default function useTranslation() {

    function t(key) {
        return translate(key);
    }

    return { t };
}
