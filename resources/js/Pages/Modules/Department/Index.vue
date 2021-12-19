<template>
    <app-layout>
        <!--Header-->
        <template #header>{{ t('indexTitle') }}</template>
        <template #subHeader>{{ t('indexSubTitle') }}</template>
        <template #action-buttons>
            <t-action-buttons-index model="department"/>
        </template>
        <!--Content-->
        <template #default>
            <t-back-end-table
                :content="tableData"
                :features="features"
                :header="header"
                content-key="tableData"
            >
                <!--Manager-->
                <template #manager_name="{props}">
                    <div class="inline-flex whitespace-nowrap items-center gap-1">
                        <t-avatar
                            :radius="8"
                            :size="2"
                            :src="props.manager_photo"
                        />
                        {{ props.manager_name }}
                    </div>
                </template>
                <!--Customer Complaints-->
                <template #is_complaint="{props}">
                    <t-badge :color="is_complaint[is_complaint.findIndex( s => s.id === props.is_complaint )].color"
                             :radius="8">
                        <template #icon>
                            <t-x-circle-icon v-if="props.is_complaint === 0" :radius="8"/>
                            <t-check-circle-icon v-else :radius="8"/>
                        </template>
                        {{ is_complaint[is_complaint.findIndex(s => s.id === props.is_complaint)].name }}
                    </t-badge>
                </template>
                <!--Production-->
                <template #is_production="{props}">
                    <t-badge :color="is_production[is_production.findIndex( s => s.id === props.is_production )].color"
                             :radius="8">
                        <template #icon>
                            <t-x-circle-icon v-if="props.is_production === 0" :radius="8"/>
                            <t-check-circle-icon v-else :radius="8"/>
                        </template>
                        {{ is_production[is_production.findIndex(s => s.id === props.is_production)].name }}
                    </t-badge>
                </template>
            </t-back-end-table>
        </template>
    </app-layout>
</template>

<script>
/*Main Components*/
import { defineComponent, reactive } from "vue";
import AppLayout from "@/Layouts/AppLayout";

/*Sub Components*/

import TBackEndTable from "@/Components/Table/TBackEndTable";
import GridSection from "@/Layouts/GridSection";
import TBadge from "@/Components/Badge/TBadge";
import TXCircleIcon from "@/Components/Icon/TXCircleIcon";
import TCheckCircleIcon from "@/Components/Icon/TCheckCircleIcon";
import TAvatar from "@/Components/Avatar/TAvatar";
import TActionButtonsIndex from "@/Components/Button/ActionButtonsIndex";

/*Consts*/
import DepartmentConsts from "@/Mixins/SectionConsts/DepartmentConsts";

/*Multi-language Support*/
import {useI18n} from "vue-i18n";
import department_module_en from "@/Lang/en/department_module_lang";
import department_module_tr from "@/Lang/tr/department_module_lang";

export default defineComponent({
    name: "DepartmentIndex",

    components: {
        TBackEndTable,
        TActionButtonsIndex,
        TAvatar,
        TCheckCircleIcon,
        TXCircleIcon,
        TBadge,
        GridSection,
        AppLayout
    },

    props: {
        tableData: {
            type: Object
        },
        searchDataManager: {
            type: Array
        }
    },

    setup() {

        /*Consts*/
        const {is_complaint, is_production, department_type} = DepartmentConsts();

        /*Multi-language Support*/
        const {t} = useI18n({
            messages: {
                en: department_module_en,
                tr: department_module_tr
            }
        })

        /*Table Definitions*/

        const header = reactive([
            {
                label: t('department'),
                key: "name",
                align: "left",
                status: true,
                sortable: true,
                simpleSearchable: true,
            },
            {
                label: t('manager'),
                key: "manager_name",
                align: "left",
                status: true,
                simpleSearchable: true,
            },
            {
                label: t('complaintAdmissibility'),
                key: "is_complaint",
                align: "center",
                status: true,
                sortable: true,
                simpleSearchable: true,
            },
            {
                label: t('manufacturability'),
                key: "is_production",
                align: "center",
                status: true,
                sortable: true,
                simpleSearchable: true,
            }
        ]);

        const features = reactive({
            table: {
                design: "elegant",
                radius: 3,
                borderRow: true,
                zebraRow: false,
                hoverRow: true,
            },
            pagination: {
                status: true,
                range: 5,
                jump: true,
            },
            actions: {
                status: true,
            },
            deleteModal: {
                headerText: "Item's deleting",
                contentText: "You are going to delete <br><b>{$name}</b><br>Are you sure ?",
                icon: "warning"
            }
        })


        return {
            t,
            header,
            features,
            is_complaint,
            is_production,
            department_type
        }
    }
})
</script>
