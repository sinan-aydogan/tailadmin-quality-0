<template>
    <app-layout :action-buttons="true">
        <!--Header-->
        <template #header>Create New Measurement Tool</template>
        <template #subHeader>You can new measurement tool for your company</template>
        <!--Action Buttons-->
        <template #action-buttons>
            <t-action-buttons-create model="measurement-tool"/>
        </template>
        <template #default>
            <t-form-content @reset="reset" @submitted="save()">
                <!--Tool Info-->
                <t-form-section
                    description="You are going to create new measurement tool for your company"
                    title="Tool Infos"
                >
                    <grid-section :col-tablet="2">

                        <!--Tool Code-->
                        <t-input-group
                            :error="error.code"
                            label="Tool Code"
                        >
                            <t-input-text id="code" v-model="form.code">
                                <t-finger-print-icon slot="icon" class="w-6 h-6"/>
                            </t-input-text>
                        </t-input-group>

                        <!--Tool Serial Number-->
                        <t-input-group
                            :error="error.serial_no"
                            label="Tool Serial Number"
                        >
                            <t-input-text id="serial_no" v-model="form.serial_no"/>
                        </t-input-group>

                        <!--Tool Type-->
                        <t-input-group
                            :error="error.measurement_tool_type_id"
                            label="Tool Type"
                            class="col-span-full"
                        >
                            <t-input-select
                                id="measurement_tool_type_id"
                                v-model="form.measurement_tool_type_id"
                                :clear-button="true"
                                :options="types"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select a type"
                            />
                        </t-input-group>

                        <!--Description-->
                        <t-input-group
                            :error="error.description"
                            label="Description"
                            class="col-span-full"
                        >
                            <t-input-text-area
                                id="description"
                                v-model="form.description"
                                :clear-button="true"
                            />
                        </t-input-group>

                    </grid-section>
                </t-form-section>

                <t-form-section
                    title="Purchase Infos"
                    description="The info of the tool's financial infos"
                >
                    <grid-section :col-tablet="3">
                        <!--Manufacturer-->
                        <t-input-group
                            :error="error.manufacturer"
                            label="Manufacturer"
                        >
                            <t-input-text id="manufacturer" v-model="form.manufacturer"/>
                        </t-input-group>

                        <!--Model-->
                        <t-input-group
                            :error="error.model"
                            label="Model"
                        >
                            <t-input-text id="model" v-model="form.model"/>
                        </t-input-group>

                        <!--Manufactured Date-->
                        <t-input-group
                            :error="error.manufactured_date"
                            label="Manufactured Date"
                        >
                            <t-input-date id="manufactured_date" v-model="form.manufactured_date"/>
                        </t-input-group>


                        <!--Supplier-->
                        <t-input-group
                            :error="error.supplier_id"
                            label="Supplier"
                        >
                            <t-input-select
                                id="supplier_id"
                                v-model="form.supplier_id"
                                :clear-button="true"
                                :options="suppliers"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select a supplier"
                            />
                        </t-input-group>

                        <!--Purchase Date-->
                        <t-input-group
                            :error="error.purchase_date"
                            label="Purchase Date"
                        >
                            <t-input-date id="purchase_date" v-model="form.purchase_date"/>
                        </t-input-group>

                        <!--Purchase Price-->
                        <t-input-group
                            :error="error.purchase_price"
                            label="Purchase Price"
                        >
                            <t-input-text id="purchase_price" v-model="form.purchase_price"/>
                        </t-input-group>
                    </grid-section>
                </t-form-section>

                <t-form-section
                    title="Tools related infos"
                    description="Tool location, responsible staff and status"
                >
                    <grid-section :col-tablet="2">
                        <!--Related Department-->
                        <t-input-group
                            :error="error.department_id"
                            label="Related Department"
                            class="col-span-full"
                        >
                            <t-input-select
                                id="department_id"
                                v-model="form.department_id"
                                :clear-button="true"
                                :options="departments"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select a department"
                            />
                        </t-input-group>

                        <!--Operator-->
                        <t-input-group
                            :error="error.operator_id"
                            label="Operator"
                        >
                            <t-input-select
                                id="operator_id"
                                v-model="form.operator_id"
                                :clear-button="true"
                                :options="users"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select a staff"
                            />
                        </t-input-group>

                        <!--Action Manager-->
                        <t-input-group
                            :error="error.action_manager_id"
                            label="Action Manager"
                        >
                            <t-input-select
                                id="action_manager_id"
                                v-model="form.action_manager_id"
                                :clear-button="true"
                                :options="users"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select a action manager"
                            />
                        </t-input-group>

                        <!--Status-->
                        <t-input-group
                            :error="error.status"
                            label="Status"
                            class="col-span-full"
                        >
                            <t-input-select
                                id="status"
                                v-model="form.status"
                                :clear-button="true"
                                :options="status"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select a status"
                            >
                                <template #label="{props}">
                                    <t-badge :color="props.color">
                                        {{ props.name }}
                                    </t-badge>
                                </template>
                            </t-input-select>
                        </t-input-group>
                    </grid-section>
                </t-form-section>
            </t-form-content>
            <t-loading-screen v-if="loading"/>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import GridSection from "@/Layouts/GridSection";
import TActionButtonsCreate from "@/Components/Button/ActionButtonsCreate";
import TBadge from "@/Components/Badge/TBadge";
import TFingerPrintIcon from "@/Components/Icon/TFingerPrintIcon";
import TFormContent from "@/Components/Form/TFormContent";
import TFormSection from "@/Components/Form/TFormSection";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TInputTextArea from "@/Components/Form/Inputs/TInputTextArea";
import TLoadingScreen from "@/Components/Misc/TLoadingScreen";
import {MeasurementToolConsts} from "@/Mixins/SectionConsts/MeasurementToolConsts";
import TInputFile from "@/Components/Form/Inputs/TInputFile";
import TInputDate from "@/Components/Form/Inputs/TInputDate";


export default {
    name: "Create",
    components: {
        TInputDate,
        TInputFile,
        AppLayout,
        GridSection,
        TActionButtonsCreate,
        TBadge,
        TFormContent,
        TFormSection,
        TInputGroup,
        TInputSelect,
        TInputText,
        TInputTextArea,
        TLoadingScreen,
        TFingerPrintIcon
    },
    mixins: [MeasurementToolConsts],
    props: {
        departments: {
            type: Array
        },
        types: {
            type: Array
        },
        suppliers: {
            type: Array
        },
        users: {
            type: Array
        }
    },
    data() {
        return {
            loading: false,
            error: {},
            form: this.$inertia.form({
                _method: 'POST',
                code: null,
                serial_no: null,
                measurement_tool_type_id: null,
                model: null,
                manufacturer: null,
                manufactured_date: null,
                purchase_price: null,
                purchase_date: null,
                supplier_id: null,
                department_id: null,
                operator_id: null,
                action_manager_id: null,
                status: 1,
                description: null,
            }),
        }
    },
    methods: {
        reset() {
            this.form.reset();
        },
        save() {
            this.form.code === null ? this.$set(this.error, 'code', 'Code is required') : this.$delete(this.error, 'code');
            this.form.serial_no === null ? this.$set(this.error, 'serial_no', 'Serial number is required') : this.$delete(this.error, 'serial_no');
            this.form.measurement_tool_type_id === null ? this.$set(this.error, 'measurement_tool_type_id', 'Type is required') : this.$delete(this.error, 'measurement_tool_type_id');
            this.form.action_manager_id === null ? this.$set(this.error, 'action_manager_id', 'Action manager is required') : this.$delete(this.error, 'action_manager_id');
            this.form.department_id === null ? this.$set(this.error, 'department_id', 'Department is required') : this.$delete(this.error, 'department_id');
            this.form.status === null ? this.$set(this.error, 'status', 'Status is required') : this.$delete(this.error, 'status');

            if (Object.keys(this.error).length === 0) {
                this.form.post(route('measurement-tool.store'), {
                    errorBag: 'measurement-tool',
                    preserveScroll: true,
                });
                this.reset();
                this.loading = true;
            }
        },
    }
}
</script>
