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
        <!--Product Info-->
        <t-form-section
            description="You are going to create new product for your company"
            title="Product Infos"
        >
          <grid-section :col-tablet="2">
            <!--Code-->
            <t-input-group
                :error="error.code"
                label="Raw Material Code"
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
                label="Raw Material Name"
            >
              <t-input-text
                  id="name"
                  v-model="form.name"
              />
            </t-input-group>

            <!--Supplier-->
            <t-input-group
              :error="error.supplier_id"
              label="Supplier"
              >
              <t-input-select
                v-model="form.supplier_id"
                id="supplier_id"
                :options="suppliers"
                options-value-key="id"
                options-label-key="name"
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
    suppliers: {
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
        supplier_id: null,
        department_id: null,
        raw_material_type_id: null,
        package_type: null,
        stock_rules: null,
      }),
    }
  },
  methods: {
    reset(){
      this.form.reset()
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