<template>
    <app-layout :action-buttons="true">
        <!--Header-->
        <template #header>Create New Raw Material</template>
        <template #subHeader>You can new raw material for your company</template>
        <!--Action Buttons-->
        <template #action-buttons>
            <t-action-buttons-create model="raw-material"/>
        </template>
        <template #default>
            <t-form-content @reset="reset" @submitted="save()">
                <!--Raw Material Info-->
                <t-form-section
                    description="Unique identity infos about raw material"
                    title="Identity Infos"
                >
                    <grid-section :col-tablet="2">
                        <!--Code-->
                        <t-input-group
                            :error="error.code"
                            label="Code"
                        >
                            <t-input-text
                                id="code"
                                v-model="form.code"
                            >
                                <t-finger-print-icon slot="icon" class="w-5 h-5"/>
                            </t-input-text>
                        </t-input-group>

                        <!--Name-->
                        <t-input-group
                            :error="error.name"
                            label="Name"
                        >
                            <t-input-text
                                id="name"
                                v-model="form.name"
                            />
                        </t-input-group>

                        <!--Model-->
                        <t-input-group
                            :error="error.name"
                            label="Model"
                        >
                            <t-input-text
                                id="model"
                                v-model="form.model"
                            />
                        </t-input-group>

                        <!--Manufacturer-->
                        <t-input-group
                            :error="error.manufacturer"
                            label="Manufacturer"
                        >
                            <t-input-text
                                id="manufacturer"
                                v-model="form.manufacturer"
                            />
                        </t-input-group>

                        <!--Description-->
                        <t-input-group
                            :error="error.description"
                            label="Raw Material Description"
                            class="col-span-full"
                        >
                            <t-input-text-area
                                id="description"
                                v-model="form.description"
                            />
                        </t-input-group>

                    </grid-section>
                </t-form-section>

                <!--Related Items-->
                <t-form-section
                    description="Linked other infos for raw material"
                    title="Releated Definitions"
                >
                    <grid-section :col-tablet="3">
                        <!--Raw Material Type-->
                        <t-input-group
                            :error="error.raw_material_type_id"
                            label="Raw Material Type"
                        >
                            <t-input-select
                                id="raw_material_type_id"
                                v-model="form.raw_material_type_id"
                                :options="types"
                                options-value-key="id"
                                options-label-key="name"
                                place-holder="Select a type"
                                :clear-button="true"
                                :search="true"
                            />
                        </t-input-group>

                        <!--Related Department-->
                        <t-input-group
                            :error="error.department_id"
                            label="Related Department"
                        >
                            <t-input-select
                                id="department_id"
                                v-model="form.department_id"
                                :options="departments"
                                options-value-key="id"
                                options-label-key="name"
                                place-holder="Select a department"
                                :clear-button="true"
                                :search="true"
                            />
                        </t-input-group>

                        <!--Suppliers-->
                        <t-input-group
                            :error="error.suppliers"
                            label="Supplier"
                        >
                            <t-input-multi-select
                                id="suppliers"
                                v-model="form.suppliers"
                                :options="suppliers"
                                options-value-key="id"
                                options-label-key="name"
                                place-holder="Select a supplier"
                                :clear-button="true"
                                :search="true"
                            />
                        </t-input-group>
                    </grid-section>

                    <grid-section :col-tablet="2">
                        <!--Raw Material Properties-->
                        <t-input-group
                            :error="error['propertyType'+propertyType.id]"
                            :label="propertyType.name"
                            v-for="(propertyType,index) in propertyTypes"
                            :key="index"
                        >
                            <t-input-multi-select
                                :id="'property_'+propertyType.id"
                                v-model="form['propertyType'+propertyType.id]"
                                :options="propertyType.properties"
                                options-value-key="id"
                                options-label-key="name"
                                place-holder="Select"
                                :clear-button="true"
                                :search="true"
                            />
                        </t-input-group>
                    </grid-section>
                </t-form-section>
                <!--Raw Material Files-->
                <t-form-section>
                    <grid-section :col="1">
                        <t-input-group
                            label="Files"
                            :error="error.file"
                        >
                            <t-input-file
                                id="file"
                                v-model="form.files"
                                :multiple="true"
                                :preview="true"
                            />
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
import TFingerPrintIcon from "@/Components/Icon/TFingerPrintIcon";
import TFormContent from "@/Components/Form/TFormContent";
import TFormSection from "@/Components/Form/TFormSection";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TInputTextArea from "@/Components/Form/Inputs/TInputTextArea";
import TLoadingScreen from "@/Components/Misc/TLoadingScreen";
import TButton from "@/Components/Button/TButton";
import TCollectionIcon from "@/Components/Icon/TCollectionIcon";
import TModal from "@/Components/Modal/TModal";
import TTable from "@/Components/Table/TTable";
import {RawMaterialConsts} from "@/Mixins/SectionConsts/RawMaterialConsts";
import TPlusIcon from "@/Components/Icon/TPlusIcon";
import TInputMultiSelect from "@/Components/Form/Inputs/TInputMultiSelect";
import TInputFile from "@/Components/Form/Inputs/TInputFile";


export default {
    name: "Create",
    components: {
        TInputFile,
        TInputMultiSelect,
        TPlusIcon,
        TTable,
        TModal,
        TCollectionIcon,
        TButton,
        AppLayout,
        GridSection,
        TActionButtonsCreate,
        TFormContent,
        TFormSection,
        TInputGroup,
        TInputSelect,
        TInputText,
        TInputTextArea,
        TLoadingScreen,
        TFingerPrintIcon
    },
    mixins: [RawMaterialConsts],
    props: {
        managers: {
            type: Array
        },
        departments: {
            type: Array
        },
        types: {
            type: Array
        },
        suppliers: {
            type: Array
        },
        propertyTypes: {
            type: Array
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
                model: null,
                manufacturer: null,
                description: null,
                suppliers: [],
                department_id: null,
                raw_material_type_id: null,
                properties: [],
                files: []
            }),
        }
    },
    created() {
        this.propertyTypes.forEach((propertyType) => {
            this.$set(this.form, 'propertyType' + propertyType.id, []);
        })
    },
    methods: {
        reset() {
            this.form.reset()
        },
        save() {
            this.form.code === null ? this.$set(this.error, 'code', 'Code is required') : this.$delete(this.error, 'code');
            this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$delete(this.error, 'name');
            this.form.raw_material_type_id === null ? this.$set(this.error, 'raw_material_type_id', 'Type is required') : this.$delete(this.error, 'raw_material_type_id');
            this.form.department_id === null ? this.$set(this.error, 'department_id', 'Department is required') : this.$delete(this.error, 'department_id');
            this.form.suppliers.length === 0 ? this.$set(this.error, 'suppliers', 'Supplier is required') : this.$delete(this.error, 'suppliers');

            if (Object.keys(this.error).length === 0) {
                let x = [];
                /*Merge different properties*/
                this.propertyTypes.forEach((propertyType) => {
                        this.form.properties.push([].concat(this.form['propertyType' + propertyType.id]))
                })

                this.form.post(route('raw-material.store'), {
                    errorBag: 'raw-material',
                    preserveScroll: true,
                });
                this.reset();
                this.loading = true;
            }
        },
    },
}
</script>
