<template>
  <app-layout :action-buttons="true">
    <!--Header-->
    <template #header>Create New Product Type</template>
    <template #subHeader>You can new product type for your products</template>
    <!--Action Buttons-->
    <template #action-buttons>
      <t-action-buttons-create model="product-type" />
    </template>
    <template #default>
      <t-form-content @reset="reset" @submitted="save()">
        <!--Product Info-->
        <t-form-section
          description="You are going to create new product for your company"
          title="Product Infos"
        >
          <grid-section :col-tablet="1">
            <!--Type Name-->
            <t-input-group :error="error.name" label="Type Name">
              <t-input-text id="name" v-model="form.name" />
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
      <t-loading-screen v-if="loading" />
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
    TFingerPrintIcon,
  },
  props: {
    departments: {
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
        department_id: null,
        description: null,
      }),
    };
  },
  methods: {
    reset: function () {
      this.form.name = null;
      this.form.department_id = null;
      this.form.description = null;
    },
    save() {
      this.form.name === null
        ? this.$set(this.error, "name", "Name is required")
        : this.$delete(this.error, "name");
      this.form.department_id === null
        ? this.$set(this.error, "department_id", "Department is required")
        : this.$delete(this.error, "department_id");

      console.log(Object.keys(this.error).length);
      console.log(this.error);
      if (Object.keys(this.error).length === 0) {
        this.form.post(route("product-type.store"), {
          errorBag: "product-type",
          preserveScroll: true,
        });
        this.reset();
        this.loading = true;
      }
    }
  },
};
</script>
