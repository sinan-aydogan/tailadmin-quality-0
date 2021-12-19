<template>
    <app-layout :action-buttons="true" :loading="loading">
        <!--Header-->
        <template #header>Create Department</template>
        <template #subHeader>Management of the departments</template>
        <!--Action Buttons-->
        <template #action-buttons>
            <t-action-buttons-create model="department"/>
        </template>
        <template #default>
            <t-form-content @reset="reset" @submitted="save()">
                <t-form-section
                    description="You are going to create new department for your company"
                    title="Department Infos"
                >
                    <grid-section :col-tablet="2">
                        <!--Department Name-->
                        <t-input-group
                            :error="error.name"
                            label="Department Name"
                        >
                            <t-input-text id="name" v-model="form.name"/>
                        </t-input-group>

                        <!--Manager-->
                        <t-input-group
                            :error="error.manager_id"
                            label="Manager"
                        >
                            <t-input-select
                                id="manager_id"
                                v-model="form.manager_id"
                                :clear-button="true"
                                :options="users"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select a manager"
                            >
                                <template #label="{props}">
                                    <div class="flex flex-wrap whitespace-nowrap items-center gap-1">
                                        <t-avatar :radius="8" :size="2"
                                                  :src="props.profile_photo_path !== null ? '/storage/'+props.profile_photo_path : null"/>
                                        {{ props.name }}
                                    </div>
                                </template>
                            </t-input-select>
                        </t-input-group>

                        <!--Department Type-->
                        <t-input-group
                            :error="error.department_type"
                            label="Department Type"
                        >
                            <t-input-select
                                id="department_type"
                                v-model="form.department_type"
                                :options="department_type"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select department type"
                            />
                        </t-input-group>

                        <!--Main Department-->
                        <t-input-group
                            :error="
                    form.department_type === null ? 'Please firstly select department type':
                    form.department_type === 1 ? '<span class=\'text-yellow-500\'>You department type is main department, you can\'t select a sub department</span>': null
                    "
                            label="Main Department"
                        >
                            <t-input-select
                                id="main_department_id"
                                v-model="form.main_department_id"
                                :class="[form.department_type === 1 || form.department_type === null ? 'placeholder-gray-100 text-gray-100':'']"
                                :clear-button="true"
                                :disabled="form.department_type === 1 || form.department_type === null"
                                :options="departments"
                                :search="true"
                                options-label-key="name"
                                options-value-key="id"
                                place-holder="Select a department"
                            />
                        </t-input-group>

                        <!--Customer Complaints-->
                        <t-input-group
                            :error="error.is_complaint"
                            label="Can it get a customer complaint?"
                        >
                            <t-input-select
                                id="is_complaint"
                                v-model="form.is_complaint"
                                :clear-button="true"
                                :options="is_complaint"
                                options-label-key="name"
                                options-value-key="id"
                            >
                                <template #label="{props}">
                                    <div class="flex flex-row items-center gap-1">
                                        <t-check-circle-icon v-if="props.id == 1" :radius="8"
                                                             class="text-green-500 w-5 h-5"/>
                                        <t-x-circle-icon v-if="props.id == 2" :radius="8" class="text-red-500 w-5 h-5"/>
                                        {{ props.name }}
                                    </div>
                                </template>
                            </t-input-select>
                        </t-input-group>

                        <!--Production-->
                        <t-input-group
                            :error="error.is_production"
                            label="Can it make production or has any product?"
                        >
                            <t-input-select
                                id="is_production"
                                v-model="form.is_production"
                                :clear-button="true"
                                :options="is_production"
                                options-label-key="name"
                                options-value-key="id"
                            >
                                <template #label="{props}">
                                    <div class="flex flex-row items-center gap-1">
                                        <t-check-circle-icon v-if="props.id == 1" :radius="8"
                                                             class="text-green-500 w-5 h-5"/>
                                        <t-x-circle-icon v-if="props.id == 2" :radius="8" class="text-red-500 w-5 h-5"/>
                                        {{ props.name }}
                                    </div>
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
/*Main Components*/
import {defineComponent, watch, ref} from "vue";
import AppLayout from "@/Layouts/AppLayout";
import {useForm} from '@inertiajs/inertia-vue3'

/*Sub Components*/
import GridSection from "@/Layouts/GridSection";
import TActionButtonsCreate from "@/Components/Button/ActionButtonsCreate";
import TAvatar from "@/Components/Avatar/TAvatar";
import TBadge from "@/Components/Badge/TBadge";
import TCheckCircleIcon from "@/Components/Icon/TCheckCircleIcon";
import TFormContent from "@/Components/Form/TFormContent";
import TFormSection from "@/Components/Form/TFormSection";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TXCircleIcon from "@/Components/Icon/TXCircleIcon";

/*Consts*/
import DepartmentConsts from "@/Mixins/SectionConsts/DepartmentConsts";

/*Multi-language Support*/
import {useI18n} from "vue-i18n";
import department_module_en from "@/Lang/en/department_module_lang";
import department_module_tr from "@/Lang/tr/department_module_lang";

export default defineComponent({

    name: "Create",

    components: {
        AppLayout,
        GridSection,
        TActionButtonsCreate,
        TAvatar,
        TBadge,
        TCheckCircleIcon,
        TFormContent,
        TFormSection,
        TInputGroup,
        TInputSelect,
        TInputText,
        TXCircleIcon
    },

    props: {
        users: {
            type: Array
        },
        departments: {
            type: Array
        },
    },

    setup() {

        /*Consts*/
        const {is_complaint, is_production, department_type} = DepartmentConsts();

        /*Form Saving*/
        const loading = ref(false);
        const error = ref({});

        const form = useForm({
            name: null,
            manager_id: null,
            department_type: null,
            main_department_id: null,
            is_complaint: null,
            is_production: null,
        })

        const reset = () => {
            form.reset();
        }

        /*Watch Department Type Changes*/
        watch(() => form.department_type,
            () => {
                if (Number(form.department_type) === 1) {
                    form.main_department_id = null
                }
            });

        return {form, error, is_production, is_complaint, department_type, reset}
    },

    methods: {

        save() {
            this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$delete(this.error, 'name');
            this.form.manager_id === null ? this.$set(this.error, 'manager_id', 'You should select a manager') : this.$delete(this.error, 'manager_id');
            this.form.department_type === null ? this.$set(this.error, 'department_type', 'You should select a department type') : this.$delete(this.error, 'department_type');
            this.form.is_complaint === null ? this.$set(this.error, 'is_complaint', 'You should select a complaint status') : this.$delete(this.error, 'is_complaint');
            this.form.is_production === null ? this.$set(this.error, 'is_production', 'You should select a production status') : this.$delete(this.error, 'is_production');

            if (Object.keys(this.error).length === 0) {
                this.form.post(route('department.store'), {
                    errorBag: 'department',
                    preserveScroll: true,
                });
                this.reset();
                this.loading = true;
            }
        },
    }
})
</script>
