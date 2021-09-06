<template>
  <app-layout :action-buttons="true" :loading="loading">
    <!--Header-->
    <template #header>Create Machine</template>
    <template #subHeader>You can new machine for your company</template>
    <!--Action Buttons-->
    <template #action-buttons>
      <t-action-buttons-create model="machine"/>
    </template>
    <template #default>
      <t-form-content @reset="reset" @submitted="save()">
        <t-form-section
            description="You are going to create new machine for your company"
            title="Machine Infos"
        >
          <grid-section :col-tablet="2">
            <!--Machine Code-->
            <t-input-group
                :error="error.code"
                label="Machine Code"
            >
              <t-input-text id="code" v-model="form.code"/>
            </t-input-group>

            <!--Machine Name-->
            <t-input-group
                :error="error.name"
                label="Machine Name"
            >
              <t-input-text id="name" v-model="form.name"/>
            </t-input-group>

            <!--Machine Model-->
            <t-input-group
                :error="error.model"
                label="Machine Model"
            >
              <t-input-text id="model" v-model="form.model"/>
            </t-input-group>

            <!--Machine Manufacturer-->
            <t-input-group
                :error="error.manufacturer"
                label="Machine Manufacturer"
            >
              <t-input-text id="manufacturer" v-model="form.manufacturer"/>
            </t-input-group>

            <!--Related Machine Type-->
            <t-input-group
                :error="error.machine_type_id"
                label="Related Machine Type"
            >
              <t-input-select
                  id="machine_type_id"
                  v-model="form.machine_type_id"
                  :clear-button="true"
                  :options="machineTypes"
                  :search="true"
                  options-label-key="name"
                  options-value-key="id"
                  place-holder="Select a machine type"
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
                  :clear-button="true"
                  :options="departments"
                  :search="true"
                  options-label-key="name"
                  options-value-key="id"
                  place-holder="Select a department"
              />
            </t-input-group>

            <!--Hierarchy-->
            <t-input-group
                :error="error.machineHierarchy"
                label="Hierarchy;"
            >
              <t-input-select
                  id="hierarchy"
                  v-model="machineHierarchy"
                  :clear-button="true"
                  :options="hierarchy"
                  options-label-key="name"
                  options-value-key="id"
                  place-holder="Select a hierarchy status"
                  @input="form.machine_id = null"
              />

            </t-input-group>

            <!--Main Machine-->
            <t-input-group
                :error="machineHierarchy === null ?
                    '<span class=\'text-yellow-500\'>Please firstly select a hierarchy status</span>' :
                    error.machine_id"
                label="Main Machine"
            >
              <t-input-select
                  id="machine_id"
                  v-model="form.machine_id"
                  :clear-button="true"
                  :disabled="machineHierarchy === 1 || machineHierarchy === null"
                  :options="machines"
                  :search="true"
                  options-label-key="name"
                  options-value-key="id"
                  place-holder="Select a main machine"
              />
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
import TFormContent from "@/Components/Form/TFormContent";
import TFormSection from "@/Components/Form/TFormSection";
import TInputText from "@/Components/Form/Inputs/TInputText";
import {MachineConsts} from "@/Mixins/SectionConsts/MachineConsts";
import TInputGroup from '@/Components/Form/TInputGroup.vue';
import TInputSelect from '@/Components/Form/Inputs/TInputSelect.vue';

export default {
  name: "Create",
  components: {
    AppLayout,
    GridSection,
    TActionButtonsCreate,
    TFormContent,
    TFormSection,
    TInputGroup,
    TInputSelect,
    TInputText
  },
  props: {
    users: {
      type: Array
    },
    machineTypes: {
      type: Array
    },
    departments: {
      type: Array
    },
    machines: {
      type: Array
    },
  },
  mixins: [MachineConsts],
  data() {
    return {
      loading: false,
      error: {},
      machineHierarchy: null,
      form: this.$inertia.form({
        _method: 'POST',
        code: null,
        name: null,
        model: null,
        manufacturer: null,
        machine_type_id: null,
        department_id: null,
        machine_id: null,
      }),
    }
  },
  methods: {
    reset: function () {
      this.form.reset();
    },
    save() {
      this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$delete(this.error, 'name');
      this.form.code === null ? this.$set(this.error, 'code', 'Code is required') : this.$delete(this.error, 'code');
      this.form.model === null ? this.$set(this.error, 'model', 'Model is required') : this.$delete(this.error, 'model');
      this.form.manufacturer === null ? this.$set(this.error, 'manufacturer', 'Manufacturer is required') : this.$delete(this.error, 'manufacturer');
      this.form.machine_type_id === null ? this.$set(this.error, 'machine_type_id', 'You should select a machine type') : this.$delete(this.error, 'machine_type_id');
      this.form.department_id === null ? this.$set(this.error, 'department_id', 'You should select a department') : this.$delete(this.error, 'department_id');
      this.machineHierarchy === null ? this.$set(this.error, 'machineHierarchy', 'You should select a hierarchy status') : this.$delete(this.error, 'machineHierarchy');
      if (this.machineHierarchy === 2) {
        this.form.machine_id === null ? this.$set(this.error, 'machine_id', 'You should select a main machine') : this.$delete(this.error, 'machine_id');
      }

      if (Object.keys(this.error).length === 0) {
        this.form.post(route('machine.store'), {
          errorBag: 'machine',
          preserveScroll: true,
        });
        this.reset();
        this.loading = true;
      }
    },
  },
  updated() {
    console.log(this.$page)
  },
  watch: {
    'form.department_type'() {
      if (this.form.department_type === 1) {
        this.form.main_department_id = null
      }
    }
  }
}
</script>
