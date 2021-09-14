<template>
    <app-layout>
        <!--Header-->
        <template #header>Raw Material Quality Plans</template>
        <template #subHeader>All of raw material's quality plans in your company</template>
        <!--Content-->
        <template #default>
            <t-table
                :content="tableData.data"
                :header="tableHeaders"
                :pagination="true"
                :searchable-keys="['code']"
                color="solid-blue"
            >
                <!--Search Area-->
                <template #search>
                    <grid-section :col-tablet="3">

                        <!--Raw Material Code-->
                        <t-input-group
                            label="Raw Material Code"
                        >
                            <t-input-text
                                v-model="searchData.code"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Raw Material Type-->
                        <t-input-group
                            label="Raw Material"
                        >
                            <t-input-select
                                v-model="searchData.raw_material_id"
                                :clear-button="true"
                                :options="searchDataRawMaterial"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Department-->
                        <t-input-group
                            label="Department"
                        >
                            <t-input-select
                                v-model="searchData.department_id"
                                :clear-button="true"
                                :options="searchDataDepartment"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                @input="search"
                            />
                        </t-input-group>
                    </grid-section>
                </template>
                <template #right>
                    <t-action-buttons-index model="raw-material-quality-plan"/>
                </template>

                <!--Spects-->
                <template #raw_material_spects="{props}">
                    <div class="flex flex-col cursor-pointer" @click="spectModalController(props)">
                        <t-clipboard-icon class="w-6 h-6 text-blue-400 hover:text-gray-700"/>
                    </div>
                </template>
            </t-table>

            <!--Quality Spects List Modal-->
            <t-modal :show="showSpectModal" @close="showSpectModal = $event ">
                <template #header>
                    {{ selectedRawMaterial.raw_material_name + ' (' + selectedRawMaterial.code + ') '}}
                    <br>
                    <span class="text-base">Quality Spects</span>
                </template>
                <template #content>
                    <t-table
                        :content="selectedRawMaterial.raw_material_spects"
                        :header="[
                            {key:'quality_spect', label: 'Spect'},
                            {key:'rule_id', label: 'Rule',align: 'center'},
                            {key:'limit_type_id', label: 'Limit Type',align: 'center'},
                            {key:'value', label: 'Value',align: 'center'}
                            ]"
                        :searchable-keys="[['quality_spect','name']]"
                        :shadow="true"
                        :zebra="true"
                        class="-mt-4"
                        color="solid-blue"
                    >
                        <!--Spect Name-->
                        <template #quality_spect="{props}">
                            {{ props.quality_spect.name }}
                        </template>

                        <!--Rule-->
                        <template #rule_id="{props}">
                            {{ rule[rule.findIndex(s => s.id === props.rule_id)].name }}
                        </template>

                        <!--Limit Type-->
                        <template #limit_type_id="{props}">
                            {{ limit_type[limit_type.findIndex(s => s.id === props.limit_type_id)].name }}
                        </template>
                    </t-table>
                </template>
            </t-modal>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import GridSection from "@/Layouts/GridSection";
import TActionButtonsIndex from "@/Components/Button/ActionButtonsIndex";
import TBadge from "@/Components/Badge/TBadge";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TTable from "@/Components/Table/TTable";
import TTooltip from "@/Components/Tooltip/TTooltip";
import TModal from "@/Components/Modal/TModal";
import TInformationIcon from "@/Components/Icon/TInformationIcon";
import {QualitySpectConsts} from "@/Mixins/SectionConsts/QualitySpectConsts";
import TClipboardIcon from "@/Components/Icon/TClipboardIcon";

export default {
    name: "Index",
    components: {
        TClipboardIcon,
        TInformationIcon,
        TModal,
        TTooltip,
        AppLayout,
        GridSection,
        TActionButtonsIndex,
        TBadge,
        TInputGroup,
        TInputSelect,
        TInputText,
        TTable
    },
    props: {
        tableData: {
            type: Object
        },
        searchDataDepartment: {
            type: Array
        },
        searchDataRawMaterial: {
            type: Array
        }
    },
    mixins: [QualitySpectConsts],
    data() {
        return {
            showSpectModal: false,
            selectedRawMaterial: {},
            tableHeaders: [
                {label: 'Plan Code', key: 'code', align: 'left'},
                {label: 'Raw Material', key: 'raw_material_name', align: 'left'},
                {label: 'Department', key: 'department_name', align: 'left'},
                {label: 'Spects', key: 'raw_material_spects', align: 'center'},
            ],
            searchData: {
                code: '',
                department_id: null,
                raw_material_id: null,
            }
        }
    },
    methods: {
        search() {
            this.$inertia.reload({
                data: {
                    code: this.searchData.code,
                    department_id: this.searchData.department_id,
                    raw_material_id: this.searchData.raw_material_id,
                },
                only: ['tableData'],
            })
        },
        spectModalController(rawMaterial) {
            this.selectedRawMaterial = rawMaterial;
            this.showSpectModal = !this.showSpectModal;
        }
    }
}
</script>
