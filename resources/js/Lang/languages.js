/* Flags */
import flagBg from "@/Lang/Flags/flagBg";
import flagDe from "@/Lang/Flags/flagDe";
import flagEn from "@/Lang/Flags/flagEn";
import flagFr from "@/Lang/Flags/flagFr";
import flagRu from "@/Lang/Flags/flagRu";
import flagTr from "@/Lang/Flags/flagTr";
import flagZh from "@/Lang/Flags/flagZh";
const flags = {
    flagBg: flagBg,
    flagDe: flagDe,
    flagEn: flagEn,
    flagFr: flagFr,
    flagRu: flagRu,
    flagTr: flagTr,
    flagZh: flagZh,
};

/* Languages */
const languages = [
    { id: "en", name: "English", flag: "flagEn" },
    { id: "tr", name: "Türkçe", flag: "flagTr" },
    { id: "bg", name: "български", flag: "flagBg" },
    { id: "de", name: "Deutsch", flag: "flagDe" },
    { id: "fr", name: "Français", flag: "flagFr" },
    { id: "ru", name: "Pусский", flag: "flagRu" },
    { id: "zh", name: "自从", flag: "flagZh" },
];

/* Translates */

/* Auth Translates */
import authLangBg from "@/Lang/bg/auth_lang_bg";
import authLangDe from "@/Lang/de/auth_lang_de";
import authLangEn from "@/Lang/en/auth_lang_en";
import authLangFr from "@/Lang/fr/auth_lang_fr";
import authLangRu from "@/Lang/ru/auth_lang_ru";
import authLangTr from "@/Lang/tr/auth_lang_tr";
import authLangZh from "@/Lang/zh/auth_lang_zh";
const authTranslates = {
    bg: authLangBg,
    de: authLangDe,
    en: authLangEn,
    fr: authLangFr,
    ru: authLangRu,
    tr: authLangTr,
    zh: authLangZh,
    bg: authLangBg,
};

export { languages, flags, authTranslates };
