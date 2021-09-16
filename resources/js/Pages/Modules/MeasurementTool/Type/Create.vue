<template>
  <app-layout :action-buttons="true">
    <!--Header-->
    <template #header>Create New Measurement Tool Type</template>
    <template #subHeader>You can new measurement tool type for your products</template>
    <!--Action Buttons-->
    <template #action-buttons>
      <t-action-buttons-create model="measurement-tool-type" />
    </template>
    <template #default>
      <t-form-content @reset="reset" @submitted="save()">
        <!--Tool Type Info-->
        <t-form-section
          description="You are going to create new measurement tool type for your company"
          title="Measurement Tool Type Infos"
        >
          <grid-section :col-tablet="1">
            <!--Type Name-->
            <t-input-group :error="error.name" label="Type Name">
              <t-input-text id="name" v-model="form.name" />
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
import TFormContent from "@/Components/Form/TFormContent";
import TFormSection from "@/Components/Form/TFormSection";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TInputTextArea from "@/Components/Form/Inputs/TInputTextArea";
import TLoadingScreen from "@/Components/Misc/TLoadingScreen";

export default {
  name: "Create",
  components: {
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
  data() {
    return {
      loading: false,
      error: {},
      form: this.$inertia.form({
        _method: "POST",
        name: null,
        description: null,
      }),
    };
  },
  methods: {
    reset: function () {
      this.form.reset();
    },
    save() {
      this.form.name === null ? this.$set(this.error, "name", "Name is required") : this.$delete(this.error, "name");

      if (Object.keys(this.error).length === 0) {
        this.form.post(route("measurement-tool-type.store"), {
          errorBag: "measurement-tool-type",
          preserveScroll: true,
        });
        this.reset();
        this.loading = true;
      }
    }
  },
};
</script>
