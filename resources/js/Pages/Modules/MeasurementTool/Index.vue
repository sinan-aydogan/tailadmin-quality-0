<template>
    <app-layout>
        <!--Header-->
        <template #header>Measurement Tools</template>
        <template #subHeader>All of measurement tools in your company</template>
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

                        <!--Tool Code-->
                        <t-input-group
                            label="Tool Code"
                        >
                            <t-input-text
                                v-model="searchData.code"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Tool Type-->
                        <t-input-group
                            label="Tool Type"
                        >
                            <t-input-select
                                v-model="searchData.measurement_tool_type_id"
                                :clear-button="true"
                                :options="searchDataType"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Tool Serial No-->
                        <t-input-group
                            label="Tool Serial No"
                        >
                            <t-input-text
                                v-model="searchData.serial_no"
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

                        <!--Model-->
                        <t-input-group
                            label="Model"
                        >
                            <t-input-text
                                v-model="searchData.model"
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

                        <!--Operator-->
                        <t-input-group
                            label="Operator"
                        >
                            <t-input-select
                                v-model="searchData.operator_id"
                                :clear-button="true"
                                :options="searchDataOperator"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Action Manager-->
                        <t-input-group
                            label="Action Manager"
                        >
                            <t-input-select
                                v-model="searchData.action_manager_id"
                                :clear-button="true"
                                :options="searchDataActionManager"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Certification-->
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
                    <t-action-buttons-index model="measurement-tool"/>
                </template>

                <!--Code-->
                <template #code="{props}">
                    <div class="inline-flex whitespace-nowrap items-center gap-1">
                        {{ props.code }}
                    </div>
                </template>

                <!--Status-->
                <template #status="{props}">
                    <t-badge :color="status.find(s=>s.id === props.status).color">
                        {{ status.find(s=>s.id === props.status).name }}
                    </t-badge>
                </template>
            </t-table>
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
import {MeasurementToolConsts} from "@/Mixins/SectionConsts/MeasurementToolConsts";
import TTooltip from "@/Components/Tooltip/TTooltip";

export default {
    name: "Index",
    components: {
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
    mixins: [MeasurementToolConsts],
    props: {
        tableData: {
            type: Object
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
        searchDataOperator: {
            type: Array
        },
        searchDataActionManager: {
            type: Array
        }
    },
    data() {
        return {
            tableHeaders: [
                {label: 'Code', key: 'code', align: 'left'},
                {label: 'Type', key: 'measurement_tool_type_name', align: 'left'},
                {label: 'Serial No', key: 'serial_no', align: 'left'},
                {label: 'Manufacturer', key: 'manufacturer', align: 'left'},
                {label: 'Model', key: 'model', align: 'left'},
                {label: 'Department', key: 'department_name', align: 'left'},
                {label: 'Operator', key: 'operator_name', align: 'left'},
                {label: 'Action Manager', key: 'action_manager_name', align: 'left'},
                {label: 'Status', key: 'status', align: 'center'},
            ],
            searchData: {
                code: '',
                measurement_tool_type_id: null,
                serial_no: '',
                manufacturer: '',
                model: '',
                department_id: null,
                supplier_id: null,
                operator_id: null,
                action_manager_id: null,
                status: null,
            }
        }
    },
    methods: {
        search() {
            this.$inertia.reload({
                data: {
                    code: this.searchData.code,
                    measurement_tool_type_id: this.searchData.measurement_tool_type_id,
                    serial_no: this.searchData.serial_no,
                    manufacturer: this.searchData.manufacturer,
                    model: this.searchData.model,
                    department_id: this.searchData.department_id,
                    supplier_id: this.searchData.supplier_id,
                    operator_id: this.searchData.operator_id,
                    action_manager_id: this.searchData.action_manager_id,
                    status: this.searchData.status
                },
                only: ['tableData'],
            })
        }
    }
}
</script>
