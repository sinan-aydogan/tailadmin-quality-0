<template>
    <app-layout :action-buttons="true" :loading="loading">
        <!--Header-->
        <template #header>Create New Audit Firm</template>
        <template #subHeader>You can new audir firm</template>
        <!--Action Buttons-->
        <template #action-buttons>
            <t-action-buttons-create model="audit-firm"/>
        </template>
        <template #default>
            <t-form-content @reset="reset" @submitted="save()">
                <t-form-section
                    description="You are going to create new audit firm"
                    title="Firm Infos"
                >
                    <grid-section :col-tablet="2">
                        <!--Firm Name-->
                        <t-input-group
                            :error="error.name"
                            label="Firm Name"
                        >
                            <t-input-text id="name" v-model="form.name">
                                <t-office-icon slot="icon" class="w-6 h-6"/>
                            </t-input-text>
                        </t-input-group>

                        <!--Firm Type-->
                        <t-input-group
                            :error="error.audit_firm_type_id"
                            label="Firm Type"
                        >
                            <t-input-multi-select
                                id="audit_firm_type_id"
                                v-model="form.audit_firm_type_id"
                                :clear-button="true"
                                :options="firm_type"
                                options-label-key="name"
                                options-value-key="id"
                            />
                        </t-input-group>

                        <!--Notified Body Number (NANDO)-->
                        <t-input-group
                            :error="error.notified_body_number"
                            label="Notified Body Number (NANDO)"
                        >
                            <t-input-text id="notified_body_number" v-model="form.notified_body_number">
                                <t-finger-print-icon slot="icon" class="w-6 h-6"/>
                            </t-input-text>
                        </t-input-group>

                        <!--Local Accreditation Numbers-->
                        <t-input-group
                            :error="error.local_accreditation_numbers"
                            label="Local Accreditation Numbers"
                        >
                            <t-input-repeatable
                                id="local_accreditation_numbers"
                                v-model="form.local_accreditation_numbers"
                                value1name="Subject"
                                value2name="Number"
                            />
                        </t-input-group>

                        <!--Phone-->
                        <t-input-group
                            :error="error.phone"
                            label="Phone"
                        >
                            <t-input-text id="phone" v-model="form.phone" type="tel">
                                <t-phone-icon slot="icon" class="w-6 h-6"/>
                            </t-input-text>
                        </t-input-group>

                        <!--Email-->
                        <t-input-group
                            :error="error.email"
                            label="Email"
                        >
                            <t-input-text id="email" v-model="form.email" type="email" placeholder=". . . @ . . . .">
                                <t-email-at-icon slot="icon" class="w-6 h-6"/>
                            </t-input-text>
                        </t-input-group>

                        <!--Address-->
                        <t-input-group
                            :error="error.address"
                            label="Address"
                        >
                            <t-input-text-area
                                id="address"
                                v-model="form.address"
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
import TEmailAtIcon from "@/Components/Icon/TEmailAtIcon";
import TFingerPrintIcon from "@/Components/Icon/TFingerPrintIcon";
import TFormContent from "@/Components/Form/TFormContent";
import TFormSection from "@/Components/Form/TFormSection";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TInputTextArea from "@/Components/Form/Inputs/TInputTextArea";
import TOfficeIcon from "@/Components/Icon/TOfficeIcon";
import TPhoneIcon from "@/Components/Icon/TPhoneIcon";
import TInputRepeatable from "@/Components/Form/Inputs/TInputRepeatable";
import {AuditFirmConsts} from "@/Mixins/SectionConsts/AuditFirmConsts";
import TInputMultiSelect from "@/Components/Form/Inputs/TInputMultiSelect";

export default {
    name: "Create",
    components: {
        TInputMultiSelect,
        TInputRepeatable,
        AppLayout,
        GridSection,
        TActionButtonsCreate,
        TBadge,
        TEmailAtIcon,
        TFingerPrintIcon,
        TFormContent,
        TFormSection,
        TInputGroup,
        TInputSelect,
        TInputText,
        TOfficeIcon,
        TPhoneIcon,
        TInputTextArea,
    },
    mixins: [AuditFirmConsts],
    data() {
        return {
            loading: false,
            error: {},
            form: this.$inertia.form({
                _method: 'POST',
                name: null,
                notified_body_number: null,
                local_accreditation_numbers: [],
                audit_firm_type_id: [],
                phone: null,
                email: null,
                address: null,
                status: 1,
            }),
        }
    },
    methods: {
        reset: function () {
            this.form.reset();
        },
        save() {
            this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$delete(this.error, 'name');
            this.form.audit_firm_type_id.length === 0 ? this.$set(this.error, 'audit_firm_type_id', 'You should select a firm type') : this.$delete(this.error, 'audit_firm_type_id');
            this.form.phone === null ? this.$set(this.error, 'phone', 'Phone is required') : this.$delete(this.error, 'phone');
            this.form.email === null ? this.$set(this.error, 'email', 'Email is required') : this.$delete(this.error, 'email');
            this.form.status === null ? this.$set(this.error, 'status', 'You should select a status') : this.$delete(this.error, 'status');

            if (Object.keys(this.error).length === 0) {
                this.form.post(route('audit-firm.store'), {
                    errorBag: 'audit-firm',
                    preserveScroll: true,
                });
                this.reset();
                this.loading = true;
            }
        },
    }
}
</script>
