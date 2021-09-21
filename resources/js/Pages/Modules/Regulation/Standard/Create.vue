<template>
    <app-layout :action-buttons="true" :loading="loading">
        <!--Header-->
        <template #header>Create Standard</template>
        <template #subHeader>Management of the standards</template>
        <!--Action Buttons-->
        <template #action-buttons>
            <t-action-buttons-create model="standard"/>
        </template>
        <template #default>
            <t-form-content @reset="reset" @submitted="save()">
                <t-form-section
                    description="You are going to create new standard for your company"
                    title="Standard Infos"
                >
                    <grid-section :col-tablet="2">
                        <!--Standard Code-->
                        <t-input-group
                            :error="error.code"
                            label="Standard Code"
                        >
                            <t-input-text id="code" v-model="form.code" placeholder="EN XXX"/>
                        </t-input-group>

                        <!--Standard Name-->
                        <t-input-group
                            :error="error.name"
                            label="Standard Name"
                        >
                            <t-input-text id="name" v-model="form.name"/>
                        </t-input-group>

                        <!--Standard Type-->
                        <t-input-group
                            :error="error.standard_type"
                            label="Standard Type"
                        >
                            <t-input-select
                                id="standard_type"
                                v-model="form.standard_type"
                                :options="standardTypes"
                                :clear-button="true"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select standard type"
                            />
                        </t-input-group>

                        <!--Status-->
                        <t-input-group
                            :error="error.status"
                            label="Status"
                        >
                            <t-input-select
                                id="status"
                                v-model="form.status"
                                :clear-button="true"
                                :options="status"
                                options-label-key="name"
                                options-value-key="id"
                            >
                                <template #label="{props}">
                                    <t-badge :color="props.color">
                                        {{ props.name }}
                                    </t-badge>
                                </template>
                            </t-input-select>
                        </t-input-group>

                        <!--Scope-->
                        <t-input-group
                            :error="error.scope"
                            label="Scope"
                            class="col-span-full"
                        >
                            <t-input-text-area
                                id="scope"
                                v-model="form.scope"
                                :clear-button="true"
                            />
                        </t-input-group>


                    </grid-section>


                </t-form-section>
                <!--Related Definitions-->
                <t-form-section
                    title="Related Definitions"
                    description="Linked other infos for standard"
                >
                    <grid-section :col-tablet="2">
                        <!--Related Departments-->
                        <t-input-group
                            :error="error.departments"
                            label="Departments"
                            key="departments"
                        >
                            <t-input-multi-select
                                id="departments"
                                v-model="form.departments"
                                :options="departments"
                                :clear-button="true"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select department"
                            />
                        </t-input-group>

                        <!--Related Products-->
                        <t-input-group
                            :error="error.products"
                            label="Products"
                            v-if="form.standard_type === 1 || form.standard_type === 3 || form.standard_type === 5"
                            key="products"
                        >
                            <t-input-multi-select
                                id="products"
                                v-model="form.products"
                                :options="products"
                                :clear-button="true"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select product"
                            />
                        </t-input-group>

                        <!--Related Raw Materials-->
                        <t-input-group
                            :error="error.raw_materials"
                            label="Raw Materials"
                            v-if="form.standard_type === 2 || form.standard_type === 3 || form.standard_type === 5"
                            key="raw_materials"
                        >
                            <t-input-multi-select
                                id="raw_materials"
                                v-model="form.raw_materials"
                                :options="rawMaterials"
                                :clear-button="true"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select raw material"
                            />
                        </t-input-group>

                        <!--Related Machines-->
                        <t-input-group
                            :error="error.machines"
                            label="Machines"
                            v-if="form.standard_type === 4 || form.standard_type === 8"
                            key="machines"
                        >
                            <t-input-multi-select
                                id="machines"
                                v-model="form.machines"
                                :options="machines"
                                :clear-button="true"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select machine"
                            />
                        </t-input-group>

                        <!--Related Measurement Tools-->
                        <t-input-group
                            :error="error.measurement_tools"
                            label="Measurement Tools"
                            v-if="form.standard_type === 4 || form.standard_type === 8"
                            key="measurement_tools"
                        >
                            <t-input-multi-select
                                id="measurement_tools"
                                v-model="form.measurement_tools"
                                :options="measurementTools.data"
                                :clear-button="true"
                                :search="true"
                                options-label-key="code"
                                options-value-key="id"
                                place-holder="Select tools"
                            >
                                <template #label="{props}">
                                    {{props.code}} / SN: {{ props.serial_no }} / {{ props.measurement_tool_type_name }}
                                </template>
                            </t-input-multi-select>
                        </t-input-group>
                        <!--TODO: Related Process will add, when Process Module create-->
                    </grid-section>
                </t-form-section>
            </t-form-content>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import GridSection from "@/Layouts/GridSection";
import TActionButtonsCreate from "@/Components/Button/ActionButtonsCreate";
import TBadge from "@/Components/Badge/TBadge";
import TFormContent from "@/Components/Form/TFormContent";
import TFormSection from "@/Components/Form/TFormSection";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputText from "@/Components/Form/Inputs/TInputText";
import {StandardConsts} from "@/Mixins/SectionConsts/StandardConsts";
import TInputTextArea from "@/Components/Form/Inputs/TInputTextArea";
import TInputMultiSelect from "@/Components/Form/Inputs/TInputMultiSelect";

export default {
    name: "Create",
    components: {
        TInputMultiSelect,
        TInputTextArea,
        AppLayout,
        GridSection,
        TActionButtonsCreate,
        TBadge,
        TFormContent,
        TFormSection,
        TInputGroup,
        TInputSelect,
        TInputText,
    },
    mixins: [StandardConsts],
    props: {
        standards: {
            type: Array
        },
        departments: {
            type: Array
        },
        products: {
            type: Array
        },
        rawMaterials: {
            type: Array
        },
        machines: {
            type: Array
        },
        measurementTools: {
            type: Object
        },
    },
    data() {
        return {
            loading: false,
            error: {},
            form: this.$inertia.form({
                _method: 'POST',
                code: null,
                name: null,
                standard_type: null,
                scope: null,
                departments: [],
                products: [],
                raw_materials: [],
                machines: [],
                measurement_tools: [],
                status: null,
            }),
        }
    },
    methods: {
        reset: function () {
            this.form.reset()
        },
        save() {
            this.form.code === null ? this.$set(this.error, 'code', 'Code is required') : this.$delete(this.error, 'code');
            this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$delete(this.error, 'name');
            this.form.standard_type === null ? this.$set(this.error, 'standard_type', 'You should select a standard type') : this.$delete(this.error, 'standard_type');
            this.form.status === null ? this.$set(this.error, 'status', 'You should select a status') : this.$delete(this.error, 'status');

            if (Object.keys(this.error).length === 0) {
                this.form.post(route('standard.store'), {
                    errorBag: 'standard',
                    preserveScroll: true,
                });
                this.reset();
                this.loading = true;
            }
        },
    }
}
</script>
