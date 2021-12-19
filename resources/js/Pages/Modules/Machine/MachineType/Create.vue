<template>
  <app-layout :action-buttons="true" :loading="loading">
    <!--Header-->
    <template #header>Create Machine Type</template>
    <template #subHeader>Management of the machine type</template>
    <!--Action Buttons-->
    <template #action-buttons>
      <t-action-buttons-create model="machine-type"/>
    </template>
    <template #default>
      <t-form-content @reset="reset" @submitted="save()">
        <t-form-section
          description="You are going to create new machine type for your company"
          title="Machine Type Infos"
        >
          <grid-section :col-tablet="2">
            <!--Machine Type Name-->
            <t-input-group
              :error="error.name"
              label="Machine Type Name"
            >
              <t-input-text id="name" v-model="form.name"/>
            </t-input-group>

            <!--Machine Type Description-->
            <t-input-group
              :error="error.description"
              label="Machine Type Description"
            >
              <t-input-text id="description" v-model="form.description"/>
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
import TAvatar from "@/Components/Avatar/TAvatar";
import TBadge from "@/Components/Badge/TBadge";
import TCheckCircleIcon from "@/Components/Icon/TCheckCircleIcon";
import TFormContent from "@/Components/Form/TFormContent";
import TFormSection from "@/Components/Form/TFormSection";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TXCircleIcon from "@/Components/Icon/TXCircleIcon";

export default {
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
  data() {
    return {
      loading: false,
      error: {},
      form: this.$inertia.form({
        _method: 'POST',
        name: null,
        description: null,
      }),
    }
  },
  methods: {
    reset: function () {
      this.form.reset();
    },
    save() {
      this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$delete(this.error, 'name');

      if (Object.keys(this.error).length === 0) {
        this.form.post(route('machine-type.store'), {
          errorBag: 'machine-type',
          preserveScroll: true,
        });
        this.reset();
        this.loading = true;
      }
    },
  }
}
</script>
