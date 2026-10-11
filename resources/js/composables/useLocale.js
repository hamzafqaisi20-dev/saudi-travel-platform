import { ref, computed, watch } from 'vue';

const currentLocale = ref(localStorage.getItem('saudiwings_locale') || 'ar');

export function useLocale() {
    const isAr = computed(() => currentLocale.value === 'ar');
    const isEn = computed(() => currentLocale.value === 'en');
    const dir = computed(() => (isAr.value ? 'rtl' : 'ltr'));

    const setLocale = (locale) => {
        if (locale === 'ar' || locale === 'en') {
            currentLocale.value = locale;
            localStorage.setItem('saudiwings_locale', locale);
            document.documentElement.setAttribute('dir', locale === 'ar' ? 'rtl' : 'ltr');
            document.documentElement.setAttribute('lang', locale);
        }
    };

    const toggleLocale = () => {
        setLocale(currentLocale.value === 'ar' ? 'en' : 'ar');
    };

    // Initialize document direction immediately
    if (typeof document !== 'undefined') {
        document.documentElement.setAttribute('dir', currentLocale.value === 'ar' ? 'rtl' : 'ltr');
        document.documentElement.setAttribute('lang', currentLocale.value);
    }

    return {
        locale: currentLocale,
        isAr,
        isEn,
        dir,
        setLocale,
        toggleLocale,
    };
}
