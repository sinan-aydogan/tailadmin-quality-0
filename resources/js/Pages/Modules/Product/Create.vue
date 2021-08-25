<template>
  <app-layout :action-buttons="true">
    <!--Header-->
    <template #header>Create New Product</template>
    <template #subHeader>You can new product for your company</template>
    <!--Action Buttons-->
    <template #action-buttons>
      <t-action-buttons-create model="product"/>
    </template>
    <template #default>
      <t-form-content @reset="reset" @submitted="save()">
        <!--Product Info-->
        <t-form-section
            description="You are going to create new product for your company"
            title="Product Infos"
        >
          <grid-section :col-tablet="2">

            <!--Product Name-->
            <t-input-group
                :error="error.name"
                label="Product Name"
            >
              <t-input-text id="name" v-model="form.name"/>
            </t-input-group>

            <!--Product Code-->
            <t-input-group
                :error="error.code"
                label="Product Code"
            >
              <t-input-text id="code" v-model="form.code">
                <t-finger-print-icon slot="icon" class="w-6 h-6"/>
              </t-input-text>
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
                  @input="departmentChange"
              />
            </t-input-group>

            <!--Product Type-->
            <t-input-group
                :error="
                form.department_id === null ?
                    '<span class=\'text-yellow-500\'>Please firstly select a department</span>' :
                    error.product_type_id
                "
                label="Product Type"
            >
              <t-input-select
                  id="product_type_id"
                  v-model="form.product_type_id"
                  :clear-button="true"
                  :disabled="form.department_id === null"
                  :options="productTypes"
                  :search="true"
                  options-label-key="name"
                  options-value-key="id"
                  place-holder="Select a type"

              />
            </t-input-group>

            <!--Related Standard-->
            <t-input-group
                :error="
                    form.department_id === null ?
                    '<span class=\'text-yellow-500\'>Please firstly select a department</span>' :
                    error.standard_id"
                label="Related Standard"
            >
              <t-input-select
                  id="standard_id"
                  v-model="form.standard_id"
                  :clear-button="true"
                  :disabled="form.department_id === null"
                  :options="standards"
                  :search="true"
                  options-label-key="code"
                  options-value-key="id"
                  place-holder="Select a standard"
              />
            </t-input-group>

            <!--Certification Status-->
            <t-input-group
                :error="error.is_certified"
                label="Certification Status"
            >
              <t-input-select
                  id="is_certified"
                  v-model="form.is_certified"
                  :clear-button="true"
                  :options="is_certified"
                  :search="true"
                  options-label-key="name"
                  options-value-key="id"
                  place-holder="Select a certification status"
              >
                <template #label="{props}">
                  <t-badge :color="props.color">
                    {{ props.name }}
                  </t-badge>
                </template>
              </t-input-select>
            </t-input-group>

            <!--Photo-->
            <t-input-group
                :error="error.photo"
                label="Product Photo"
            >
              <t-input-file
                  v-model="form.photo"
                  placeholder="Select a photo"
                  :preview="true"
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
import TBadge from "@/Components/Badge/TBadge";
import TFingerPrintIcon from "@/Components/Icon/TFingerPrintIcon";
import TFormContent from "@/Components/Form/TFormContent";
import TFormSection from "@/Components/Form/TFormSection";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TInputTextArea from "@/Components/Form/Inputs/TInputTextArea";
import TLoadingScreen from "@/Components/Misc/TLoadingScreen";
import {ProductConsts} from "@/Mixins/SectionConsts/ProductConsts";
import TInputFile from "@/Components/Form/Inputs/TInputFile";


export default {
  name: "Create",
  components: {
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
  mixins: [ProductConsts],
  props: {
    managers: {
      type: Array
    },
    departments: {
      type: Array
    },
    productTypes: {
      type: Array
    },
    standards: {
      type: Array
    },
  },
  data() {
    return {
      loading: false,
      error: {},
      form: this.$inertia.form({
        _method: 'POST',
        name: null,
        code: null,
        department_id: null,
        product_type_id: null,
        standard_id: null,
        is_certified: 4,
        description: null,
        photo: null,
      }),
    }
  },
  methods: {
    reset: function () {
      this.form.name = null;
      this.form.code = null;
      this.form.department_id = null;
      this.form.product_type_id = null;
      this.form.standard_id = null;
      this.form.is_certified = null;
      this.form.description = null;
      this.form.photo= null;
    },
    save() {
      this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$delete(this.error, 'name');
      this.form.code === null ? this.$set(this.error, 'code', 'Code is required') : this.$delete(this.error, 'code');
      this.form.department_id === null ? this.$set(this.error, 'department_id', 'Department is required') : this.$delete(this.error, 'department_id');
      this.form.product_type_id === null ? this.$set(this.error, 'product_type_id', 'Type is required') : this.$delete(this.error, 'product_type_id');
      this.form.is_certified === null ? this.$set(this.error, 'is_certified', 'Certification status is required') : this.$delete(this.error, 'is_certified');

      console.log(Object.keys(this.error).length)
      console.log(this.error)
      if (Object.keys(this.error).length === 0) {
        this.form.post(route('product.store'), {
          errorBag: 'product',
          preserveScroll: true,
        });
        this.reset();
        this.loading = true;
      }
    },
    departmentChange() {
      this.$inertia.reload({
        method: 'get',
        data: {
          department_id: this.form.department_id,
        },
        replace: true,
        preserveState: true,
        preserveScroll: true,
        only: ['productTypes', 'standards'],
      })
    }
  }
}
</script>