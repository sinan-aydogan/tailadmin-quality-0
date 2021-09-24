<template>
    <app-layout :action-buttons="true">
        <!--Header-->
        <template #header>Create New Audit Type Type</template>
        <template #subHeader>You can new audit type type for your audits</template>
        <!--Action Buttons-->
        <template #action-buttons>
            <t-action-buttons-create model="audit-type"/>
        </template>
        <template #default>
            <t-form-content @reset="reset" @submitted="save()">
                <!--Product Info-->
                <t-form-section
                    description="You are going to create new audit type for audits"
                    title="Audit Type Infos"
                >
                    <grid-section :col-tablet="1">
                        <!--Type Name-->
                        <t-input-group :error="error.name" label="Type Name">
                            <t-input-text id="name" v-model="form.name"/>
                        </t-input-group>

                        <!--Related Audit Firms-->
                        <t-input-group
                            :error="error.audit_firms"
                            label="Related Audit Firms"
                        >
                            <t-input-multi-select
                                id="department_id"
                                v-model="form.audit_firms"
                                :clear-button="true"
                                :options="firms"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select a firm"
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
            </t-form-content>
            <t-loading-screen v-if="loading"/>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import GridSection from "@/Layouts/GridSection";
import TActionButtonsCreate from "@/Components/Button/ActionButtonsCreate";
import TFormContent from "@/Components/Form/TFormContent";
import TFormSection from "@/Components/Form/TFormSection";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TInputTextArea from "@/Components/Form/Inputs/TInputTextArea";
import TLoadingScreen from "@/Components/Misc/TLoadingScreen";
import TInputMultiSelect from "@/Components/Form/Inputs/TInputMultiSelect";

export default {
    name: "Create",
    components: {
        TInputMultiSelect,
        AppLayout,
        GridSection,
        TActionButtonsCreate,
        TFormContent,
        TFormSection,
        TInputGroup,
        TInputText,
        TInputTextArea,
        TLoadingScreen,
    },
    props: {
        firms: {
            type: Array,
        },
    },
    data() {
        return {
            loading: false,
            error: {},
            form: this.$inertia.form({
                _method: "POST",
                name: null,
                audit_firms: [],
                description: null,
            }),
        };
    },
    methods: {
        reset: function () {
            this.form.reset()
        },
        save() {
            this.form.name === null
                ? this.$set(this.error, "name", "Name is required")
                : this.$delete(this.error, "name");

            if (Object.keys(this.error).length === 0) {
                this.form.post(route("audit-type.store"), {
                    errorBag: "audit-type",
                    preserveScroll: true,
                });
                this.reset();
                this.loading = true;
            }
        }
    },
};
</script>
