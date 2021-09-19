<template>
    <app-layout>
        <!--Header-->
        <template #header>Raw Materials</template>
        <template #subHeader>All of raw materials in your company</template>
        <!--Content-->
        <template #default>
            <t-table
                :content="tableData.data"
                :header="tableHeaders"
                :pagination="true"
                :searchable-keys="['name']"
                color="solid-blue"
            >
                <!--Search Area-->
                <template #search>
                    <grid-section :col-tablet="3">

                        <!--Product Code-->
                        <t-input-group
                            label="Raw Material Code"
                        >
                            <t-input-text
                                v-model="searchData.code"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Product Name-->
                        <t-input-group
                            label="Raw Material Name"
                        >
                            <t-input-text
                                v-model="searchData.name"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Product Type-->
                        <t-input-group
                            label="Raw Material Type"
                        >
                            <t-input-select
                                v-model="searchData.raw_material_type_id"
                                :clear-button="true"
                                :options="searchDataType"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Model-->
                        <t-input-group
                            label="Model"
                        >
                            <t-input-text
                                v-model="searchData.model"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Manufacturer-->
                        <t-input-group
                            label="Manufacturer"
                        >
                            <t-input-text
                                v-model="searchData.manufacturer"
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

                        <!--Supplier-->
                        <t-input-group
                            label="Supplier"
                        >
                            <t-input-select
                                v-model="searchData.supplier_id"
                                :clear-button="true"
                                :options="searchDataSupplier"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Standard-->
                        <t-input-group
                            label="Standard"
                        >
                            <t-input-select
                                v-model="searchData.standard_id"
                                :clear-button="true"
                                :options="searchDataStandard"
                                options-label-key="name"
                                options-value-key="id"
                                @input="search"
                            />
                        </t-input-group>
                    </grid-section>
                </template>
                <template #right>
                    <t-action-buttons-index model="raw-material"/>
                </template>

                <template #details="{props}">
                    <div class="flex flex-col cursor-pointer" @click="detailsModalController(props)">
                        <t-clipboard-icon class="w-6 h-6 text-blue-400 hover:text-gray-700"/>
                    </div>
                </template>
            </t-table>
            <!--Details Modal-->
            <t-modal :show="showDetailsModal" @close="showDetailsModal=false">
                <template #header>
                    Raw Material Details
                </template>
                <template #content>
                    <div v-if="selectedRawMaterial" class="flex flex-col -mt-6 gap-2">
                        <!--Supplier-->
                        <div v-if="selectedRawMaterial.suppliers.length>0" class="border p-2 rounded bg-gray-50">
                            <span class="font-bold text-xl">Supplier</span>
                            <div class="flex flex-wrap gap-2 mt-2">
                            <span
                                v-for="item in selectedRawMaterial.suppliers"
                            >
                                <t-badge>
                                    {{ item.name }}
                                </t-badge>
                            </span>
                            </div>
                        </div>
                        <!--Standards-->
                        <div v-if="selectedRawMaterial.standards.length>0" class="border p-2 rounded bg-gray-50">
                            <span class="font-bold text-xl">Related Standards</span>
                            <div class="flex flex-wrap gap-2 mt-2">
                            <span
                                v-for="item in selectedRawMaterial.standards"
                            >
                                <t-badge>
                                    {{ item.code }} - {{ item.name }}
                                </t-badge>
                            </span>
                            </div>
                        </div>
                        <!--Properties-->
                        <div v-for="propertyType in propertyTypes">
                            <div v-if="selectedRawMaterial.properties.find(item=>item.property_type_id === propertyType.id)" class="border p-2 rounded bg-gray-50">
                            <span class="font-bold text-xl">
                                {{ propertyType.name }}
                            </span>
                                <div class="flex flex-wrap gap-2 mt-2">
                            <span
                                v-for="property in selectedRawMaterial.properties"
                                v-if="propertyType.id === property.property_type_id"
                            >
                                <t-badge>
                                    {{ property.name }}
                                </t-badge>
                            </span>
                                </div>
                            </div>
                        </div>
                        <!--Files-->
                        <div v-if="selectedRawMaterial.files.length!==0" class="border p-2 rounded bg-gray-50">
                            <span class="font-bold text-xl">
                                Files
                            </span>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <t-list class="w-full" :radius="3">
                                    <t-list-item v-for="(file,index) in selectedRawMaterial.files" :key="index">
                                        <template #default>
                                            <a :href="file.original_url" target="_blank" class="flex justify-between w-full overflow-hidden">
                                                <span>
                                                    {{ file.name }}
                                                </span>

                                                <div>
                                                    <t-badge>
                                                        {{ file.size | sizeCalculator }} - {{ file.extension }}
                                                    </t-badge>
                                                </div>
                                            </a>
                                        </template>
                                    </t-list-item>
                                </t-list>
                            </div>
                        </div>
                    </div>
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
import {ProductConsts} from "@/Mixins/SectionConsts/ProductConsts";
import TTooltip from "@/Components/Tooltip/TTooltip";
import TClipboardIcon from "@/Components/Icon/TClipboardIcon";
import TModal from "@/Components/Modal/TModal";
import TList from "@/Components/List/TList";
import TListItem from "@/Components/List/TListItem";

export default {
    name: "Index",
    components: {
        TListItem,
        TList,
        TModal,
        TClipboardIcon,
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
    mixins: [ProductConsts],
    props: {
        tableData: {
            type: Object
        },
        propertyTypes: {
            type: Array
        },
        searchDataDepartment: {
            type: Array
        },
        searchDataType: {
            type: Array
        },
        searchDataSupplier: {
            type: Array
        },
        searchDataStandard: {
            type: Array
        }
    },
    data() {
        return {
            selectedRawMaterial: null,
            showDetailsModal: false,
            tableHeaders: [
                {label: 'Code', key: 'code', align: 'left'},
                {label: 'Name', key: 'name', align: 'left'},
                {label: 'Type', key: 'raw_material_type_name', align: 'left'},
                {label: 'Model', key: 'model', align: 'left'},
                {label: 'Manufacturer', key: 'manufacturer', align: 'left'},
                {label: 'Department', key: 'department_name', align: 'left'},
                {label: 'Details', key: 'details', align: 'center'},
            ],
            searchData: {
                code: '',
                name: '',
                raw_material_type_id: null,
                model: '',
                manufacturer: '',
                supplier_id: null,
                department_id: null,
                stock_rules: null,
                package_type: null,
                standard_id: null,
            }
        }
    },
    methods: {
        search() {
            this.$inertia.reload({
                data: {
                    code: this.searchData.code,
                    name: this.searchData.name,
                    department_id: this.searchData.department_id,
                    raw_material_type_id: this.searchData.raw_material_type_id,
                    model: this.searchData.model,
                    manufacturer: this.searchData.manufacturer,
                    supplier_id: this.searchData.supplier_id,
                    standard_id: this.searchData.standard_id
                },
                only: ['tableData'],
            })
        },
        detailsModalController(rawMaterial) {
            this.selectedRawMaterial = rawMaterial;
            this.showDetailsModal = !this.showDetailsModal;
        }
    },
    filters: {
        sizeCalculator(value) {
            let sizes = ["Bytes", "KB", "MB", "GB", "TB"];
            if (value === 0) return "0 Byte";
            let i = parseInt(Math.floor(Math.log(value) / Math.log(1024)));
            return Math.round(value / Math.pow(1024, i), 2) + " " + sizes[i];
        },
    }
}
</script>
