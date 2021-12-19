/*Multi-language Support*/
import {ref} from "vue";
import {useI18n} from "vue-i18n";
import department_module_en from "@/Lang/en/department_module_lang";
import department_module_tr from "@/Lang/tr/department_module_lang";

export default function () {
    /*Multi-language Support*/
    const {t} = useI18n({
        messages: {
            en: department_module_en,
            tr: department_module_tr
        }
    });

    /*Complaint Admissibility*/
    const is_complaint = ref([
        {id: 1, name: t('yes'), color: 'green'},
        {id: 2, name: t('no'), color: 'red'}
    ])

    /*Manufacturability*/
    const is_production = ref([
        {id: 1, name: t('yes'), color: 'green'},
        {id: 2, name: t('no'), color: 'red'}
    ])

    /*Department Type*/
    const department_type = ref([
        {id: 1, name: t('mainDepartment')},
        {id: 2, name: t('subDepartment')}
    ])

    return {is_complaint, is_production, department_type}
}
