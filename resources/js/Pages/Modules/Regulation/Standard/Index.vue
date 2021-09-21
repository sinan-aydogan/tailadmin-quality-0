<template>
    <app-layout>
        <!--Header-->
        <template #header>Standards</template>
        <template #subHeader>Management of the standards</template>
        <!--Content-->
        <template #default>
            <t-table
                :content="tableData.data"
                :header="tableHeaders"
                :pagination="true"
                :searchable-keys="['code','name']"
                color="solid-blue"
            >
                <!--Search Area-->
                <template #search>
                    <grid-section :col-tablet="4">
                        <!--Standard Code-->
                        <t-input-group
                            label="Standard Code"
                        >
                            <t-input-text
                                v-model="searchData.code"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Standard Name-->
                        <t-input-group
                            label="Standard Name"
                        >
                            <t-input-text
                                v-model="searchData.name"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Standard Type-->
                        <t-input-group
                            label="Standard Type"
                        >
                            <t-input-select
                                v-model="searchData.standard_type"
                                :clear-button="true"
                                :options="standardTypes"
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
                                options-label-key="name"
                                options-value-key="id"
                                @input="search"
                                />
                        </t-input-group>

                        <!--Product-->
                        <t-input-group
                            label="Product"
                        >
                            <t-input-select
                                v-model="searchData.product_id"
                                :clear-button="true"
                                :options="searchDataProduct"
                                options-label-key="name"
                                options-value-key="id"
                                @input="search"
                                />
                        </t-input-group>

                        <!--Raw Material-->
                        <t-input-group
                            label="Raw Material"
                        >
                            <t-input-select
                                v-model="searchData.raw_material_id"
                                :clear-button="true"
                                :options="searchDataRawMaterial"
                                options-label-key="name"
                                options-value-key="id"
                                @input="search"
                                />
                        </t-input-group>

                        <!--Machine-->
                        <t-input-group
                            label="Machine"
                        >
                            <t-input-select
                                v-model="searchData.machine_id"
                                :clear-button="true"
                                :options="searchDataMachine"
                                options-label-key="name"
                                options-value-key="id"
                                @input="search"
                                />
                        </t-input-group>

                        <!--Measurement Tool-->
                        <t-input-group
                            label="Measurement Tool"
                        >
                            <t-input-select
                                v-model="searchData.measurement_tool_id"
                                :clear-button="true"
                                :options="searchDataMeasurementTool"
                                options-label-key="code"
                                options-value-key="id"
                                @input="search">
                                <template #label="{props}">
                                    {{props.code}} / SN: {{ props.serial_no }} / {{ props.measurement_tool_type_name }}
                                </template>
                            </t-input-select>
                        </t-input-group>

                        <!--Status-->
                        <t-input-group
                            label="Status"
                        >
                            <t-input-select
                                v-model="searchData.status"
                                :clear-button="true"
                                :options="status"
                                options-label-key="name"
                                options-value-key="id"
                                @input="search"
                            >
                                <template #label="{props}">
                                    <t-badge :color="props.color">
                                        {{ props.name }}
                                    </t-badge>
                                </template>
                            </t-input-select>
                        </t-input-group>
                    </grid-section>
                </template>
                <template #right>
                    <t-action-buttons-index model="standard"/>
                </template>

                <!--Type-->
                <template #standard_type="{props}">
                    {{ standardTypes.find(st=>st.id === props.standard_type).name}}
                </template>

                <!--Related Items-->
                <template #related_items="{props}">
                    <div class="flex flex-col cursor-pointer" @click="relatedItemsModalController(props)">
                        <t-clipboard-icon class="w-6 h-6 text-blue-400 hover:text-gray-700"/>
                    </div>
                </template>

                <!--Status-->
                <template #status="{props}">
                    <t-badge :color="status.find(s=>s.id === props.status).color">
                        {{ status.find(s=>s.id === props.status).name }}
                    </t-badge>
                </template>
            </t-table>
            <!--Details Modal-->
            <t-modal :show="showRelatedItemsModal" @close="showRelatedItemsModal=false">
                <template #header>
                    Related Items
                </template>
                <template #content>
                    <div v-if="selectedItem" class="flex flex-col -mt-6 gap-2">
                        <!--Departments-->
                        <div v-if="selectedItem.departments.length>0" class="border p-2 rounded bg-gray-50">
                            <span class="font-bold text-xl">Departments</span>
                            <div class="flex flex-wrap gap-2 mt-2">
                            <span
                                v-for="item in selectedItem.departments"
                            >
                                <t-badge>
                                   {{ item.name }}
                                </t-badge>
                            </span>
                            </div>
                        </div>

                        <!--Product-->
                        <div v-if="selectedItem.products.length>0" class="border p-2 rounded bg-gray-50">
                            <span class="font-bold text-xl">Products</span>
                            <div class="flex flex-wrap gap-2 mt-2">
                            <span
                                v-for="item in selectedItem.products"
                            >
                                <t-badge>
                                   {{ item.code }} - {{ item.name }}
                                </t-badge>
                            </span>
                            </div>
                        </div>

                        <!--Raw Materials-->
                        <div v-if="selectedItem.rawMaterials.length>0" class="border p-2 rounded bg-gray-50">
                            <span class="font-bold text-xl">Raw Materials</span>
                            <div class="flex flex-wrap gap-2 mt-2">
                            <span
                                v-for="item in selectedItem.rawMaterials"
                            >
                                <t-badge>
                                    {{ item.code }} - {{ item.name }}
                                </t-badge>
                            </span>
                            </div>
                        </div>

                        <!--Machines-->
                        <div v-if="selectedItem.machines.length>0" class="border p-2 rounded bg-gray-50">
                            <span class="font-bold text-xl">Machines</span>
                            <div class="flex flex-wrap gap-2 mt-2">
                            <span
                                v-for="item in selectedItem.machines"
                            >
                                <t-badge>
                                    {{ item.code }} - {{ item.name }}
                                </t-badge>
                            </span>
                            </div>
                        </div>

                        <!--Measurement Tools-->
                        <div v-if="selectedItem.measurementTools.length>0" class="border p-2 rounded bg-gray-50">
                            <span class="font-bold text-xl">Measurement Tools</span>
                            <div class="flex flex-wrap gap-2 mt-2">
                            <span
                                v-for="item in selectedItem.measurementTools"
                            >
                                <t-badge>
                                    {{ item.code }} / SN: {{ item.serial_no }} / {{ item.type.name }}
                                </t-badge>
                            </span>
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
import TTable from "@/Components/Table/TTable";
import TActionButtonsIndex from "@/Components/Button/ActionButtonsIndex";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputSelectItem from "@/Components/Form/Inputs/TInputSelectItem";
import GridSection from "@/Layouts/GridSection";
import TBadge from "@/Components/Badge/TBadge";
import TXCircleIcon from "@/Components/Icon/TXCircleIcon";
import TCheckCircleIcon from "@/Components/Icon/TCheckCircleIcon";
import TAvatar from "@/Components/Avatar/TAvatar";
import {StandardConsts} from "@/Mixins/SectionConsts/StandardConsts";
import TClipboardIcon from "@/Components/Icon/TClipboardIcon";
import TModal from "@/Components/Modal/TModal";

export default {
    name: "Index",
    components: {
        TModal,
        TClipboardIcon,
        TAvatar,
        TCheckCircleIcon,
        TXCircleIcon,
        TBadge,
        GridSection,
        TInputSelectItem,
        TInputSelect,
        TInputText,
        TInputGroup,
        TActionButtonsIndex,
        TTable,
        AppLayout
    },
    mixins: [StandardConsts],
    props: {
        tableData: {
            type: Object
        },
        searchDataDepartment: {
            type: Array
        },
        searchDataProduct: {
            type: Array
        },
        searchDataRawMaterial: {
            type: Array
        },
        searchDataMachine: {
            type: Array
        },
        searchDataMeasurementTool: {
            type: Array
        }
    },
    data() {
        return {
            selectedItem: null,
            showRelatedItemsModal: false,
            tableHeaders: [
                {label: 'Code', key: 'code', align: 'left'},
                {label: 'Name', key: 'name', align: 'left'},
                {label: 'Type', key: 'standard_type', align: 'left'},
                {label: 'Related Items', key: 'related_items', align: 'center'},
                {label: 'Status', key: 'status', align: 'center'},
            ],
            searchData: {
                code: '',
                name: '',
                standard_type: null,
                department_id: null,
                product_id: null,
                raw_material_id: null,
                machine_id: null,
                measurement_tool_id: null,
                status: null,
            }
        }
    },
    methods: {
        search() {
            this.$inertia.reload({
                data: {
                    code: this.searchData.code,
                    name: this.searchData.name,
                    standard_type: this.searchData.standard_type,
                    department_id: this.searchData.department_id,
                    product_id: this.searchData.product_id,
                    raw_material_id: this.searchData.raw_material_id,
                    machine_id: this.searchData.machine_id,
                    measurement_tool_id: this.searchData.measurement_tool_id,
                    status: this.searchData.status,
                },
                only: ['tableData'],
            })
        },
        relatedItemsModalController(item) {
            this.selectedItem = item;
            this.showRelatedItemsModal = !this.showRelatedItemsModal;
        }
    }
}
</script>
