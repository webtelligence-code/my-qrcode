import i18n from 'i18next';
import { initReactI18next } from 'react-i18next';

import enTranslation from './translations/en-US.json';
import frTranslation from './translations/fr-FR.json';
import ptTranslation from './translations/pt-PT.json';


const userLanguage = navigator.language.split('-')[0]

i18n.use(initReactI18next).init({
  resources: {
    en: {
      translation: enTranslation
    },
    fr: {
      translation: frTranslation
    },
    pt: {
      translation: ptTranslation
    }
  },
  lng: userLanguage, // Set the default language
  fallbackLng: 'en', // Set the fallback language
  interpolation: {
    escapeValue: false // Disable escaping HTML characters
  }
});

export default i18n;
