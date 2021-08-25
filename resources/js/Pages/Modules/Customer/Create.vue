<template>
  <app-layout :action-buttons="true" :loading="loading">
    <!--Header-->
    <template #header>Create New Customer</template>
    <template #subHeader>You can new customer</template>
    <!--Action Buttons-->
    <template #action-buttons>
      <t-action-buttons-create model="customer"/>
    </template>
    <template #default>
      <t-form-content @reset="reset" @submitted="save()">
        <t-form-section
            description="You are going to create new customer"
            title="Customer Infos"
        >
          <grid-section :col-tablet="2">
            <!--Customer Name-->
            <t-input-group
                :error="error.name"
                label="Department Name"
            >
              <t-input-text id="name" v-model="form.name">
                <t-office-icon slot="icon" class="w-6 h-6"/>
              </t-input-text>
            </t-input-group>

            <!--Tax ID-->
            <t-input-group
                :error="error.tax_id"
                label="Tax ID"
            >
              <t-input-text id="tax_id" v-model="form.tax_id">
                <t-finger-print-icon slot="icon" class="w-6 h-6"/>
              </t-input-text>
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
import {CustomerConsts} from "@/Mixins/SectionConsts/CustomerConsts";

export default {
  name: "Create",
  components: {
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
  mixins: [CustomerConsts],
  data() {
    return {
      loading: false,
      error: {},
      form: this.$inertia.form({
        _method: 'POST',
        name: null,
        tax_id: null,
        phone: null,
        email: null,
        address: null,
        status: 1,
      }),
    }
  },
  methods: {
    reset: function () {
      this.form.name = null;
      this.form.tax_id = null;
      this.form.phone = null;
      this.form.email = '';
      this.form.address = null;
      this.form.status = null;
    },
    save() {
      this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$delete(this.error, 'name');
      this.form.tax_id === null ? this.$set(this.error, 'tax_id', 'Tax ID is required') : this.$delete(this.error, 'tax_id');
      this.form.phone === null ? this.$set(this.error, 'phone', 'Phone is required') : this.$delete(this.error, 'phone');
      this.form.email === null ? this.$set(this.error, 'email', 'Email is required') : this.$delete(this.error, 'email');
      this.form.status === null ? this.$set(this.error, 'status', 'You should select a status') : this.$delete(this.error, 'status');

      if (Object.keys(this.error).length === 0) {
        this.form.post(route('customer.store'), {
          errorBag: 'customer',
          preserveScroll: true,
        });
        this.reset();
        this.loading = true;
      }
    },
  }
}
</script>