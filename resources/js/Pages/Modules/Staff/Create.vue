<template>
  <app-layout :action-buttons="true">
    <!--Header-->
    <template #header>Create Department</template>
    <template #subHeader>Management of the departments</template>
    <!--Action Buttons-->
    <template #action-buttons>
      <t-action-buttons-create model="department"/>
    </template>
    <template #default>
      <t-form-content @submitted="save()"  @reset="reset">
        <t-form-section
            description="You are going to create new department for your company"
            title="Department Infos"
        >
          <grid-section :col-tablet="2">
            <!--Department Name-->
            <t-input-group
                label="Department Name"
                :error="error.name"
            >
              <t-input-text id="name" v-model="form.name"/>
            </t-input-group>

            <!--Manager-->
            <t-input-group
                label="Manager"
                :error="error.manager_id"
            >
              <t-input-select
                  id="manager_id"
                  v-model="form.manager_id"
                  :search="true"
                  place-holder="Select a manager"
                  :clear-button="true"
                  :options="users"
                  options-value-key="id"
                  options-label-key="name"
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
                label="Department Type"
                :error="error.department_type"
            >
              <t-input-select
                  id="department_type"
                  v-model="form.department_type"
                  place-holder="Select department type"
                  :options="department_type"
                  options-label-key="name"
                  options-value-key="id"
              />
            </t-input-group>

            <!--Main Department-->
            <t-input-group
                label="Main Department"
                :error="
                    form.department_type === null ? 'Please firstly select department type':
                    form.department_type === 1 ? '<span class=\'text-yellow-500\'>You department type is main department, you can\'t select a sub department</span>': null
                    "
            >
              <t-input-select
                  id="main_department_id"
                  v-model="form.main_department_id"
                  :search="true"
                  place-holder="Select a department"
                  :clear-button="true"
                  :options="departments"
                  options-label-key="name"
                  options-value-key="id"
                  :disabled="form.department_type === 1 || form.department_type === null"
                  :class="[form.department_type === 1 || form.department_type === null ? 'placeholder-gray-100 text-gray-100':'']"
              />
            </t-input-group>

            <!--Customer Complaints-->
            <t-input-group
                label="Can it get a customer complaint?"
                :error="error.is_complaint"
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
                    <t-check-circle-icon v-if="props.id == 1" :radius="8" class="text-green-500 w-5 h-5"/>
                    <t-x-circle-icon v-if="props.id == 2" :radius="8" class="text-red-500 w-5 h-5"/>
                    {{ props.name }}
                  </div>
                </template>
              </t-input-select>
            </t-input-group>

            <!--Production-->
            <t-input-group
                label="Can it make production or has any product?"
                :error="error.is_production"
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
                    <t-check-circle-icon v-if="props.id == 1" :radius="8" class="text-green-500 w-5 h-5"/>
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
import AppLayout from "@/Layouts/AppLayout";
import TActionButtonsCreate from "@/Components/Button/ActionButtonsCreate";
import TFormContent from "@/Components/Form/TFormContent";
import TFormSection from "@/Components/Form/TFormSection";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputSelectItem from "@/Components/Form/Inputs/TInputSelectItem";
import GridSection from "@/Layouts/GridSection";
import TBadge from "@/Components/Badge/TBadge";
import TCheckCircleIcon from "@/Components/Icon/TCheckCircleIcon";
import TXCircleIcon from "@/Components/Icon/TXCircleIcon";
import TAvatar from "@/Components/Avatar/TAvatar";
import {DepartmentConsts} from "@/Mixins/SectionConsts/DepartmentConsts";

export default {
  name: "Create",
  components: {
    TAvatar,
    TXCircleIcon,
    TCheckCircleIcon,
    TBadge,
    GridSection,
    TInputSelectItem,
    TInputSelect, TInputText, TInputGroup, TFormSection, TFormContent, TActionButtonsCreate, AppLayout
  },
  mixins: [DepartmentConsts],
  props: {
    users: {
      type: Array
    },
    departments: {
      type: Array
    },
  },
  data() {
    return {
      loading: false,
      error:{},
      form: this.$inertia.form({
        _method: 'POST',
        name: null,
        manager_id: null,
        department_type: null,
        main_department_id: null,
        is_complaint: null,
        is_production: null,
      }),
    }
  },
  methods: {
    reset: function () {
      this.form.name = null;
      this.form.manager_id = null;
      this.form.department_type = null;
      this.form.department_id = '';
      this.form.is_complaint = null;
      this.form.is_production = null;
    },
    save() {
      this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$set(this.error, 'name', '');
      this.form.manager_id === null ? this.$set(this.error, 'manager_id', 'You should select a manager') : this.$set(this.error, 'manager_id', '');
      this.form.department_type === null ? this.$set(this.error, 'department_type', 'You should select a department type') : this.$set(this.error, 'department_type', '');
      this.form.is_complaint === null ? this.$set(this.error, 'is_complaint', 'You should select a complaint status') : this.$set(this.error, 'is_complaint', '');
      this.form.is_production === null ? this.$set(this.error, 'is_production', 'You should select a production status') : this.$set(this.error, 'is_production', '');
      if(this.form.name !== null && this.form.manager_id !== null && this.form.department_type !== null && this.form.is_complaint !== null && this.form.is_production !== null) {
        this.form.post(route('department.store'), {
          errorBag: 'department',
          preserveScroll: true,
        });
        this.reset();
        this.loading = true;
      }
    },
  },
  watch: {
    'form.department_type'(){
      if(this.form.department_type === 1){
        this.form.main_department_id = null
      }
    }
  }
}
</script>