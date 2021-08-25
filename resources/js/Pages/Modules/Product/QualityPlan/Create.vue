<template>
  <app-layout :action-buttons="true">
    <!--Header-->
    <template #header>Create New Job Description</template>
    <template #subHeader>You can new job description for your HR management</template>
    <!--Action Buttons-->
    <template #action-buttons>
      <t-action-buttons-create model="job-description"/>
    </template>
    <template #default>
      <t-form-content @reset="reset" @submitted="save()">
        <!--Job Description Infos-->
        <t-form-section
            description="You are going to create new job description for relation with your staff"
            title="Job Description Infos"
        >
          <grid-section :col-tablet="2">
            <!--Title-->
            <t-input-group
                :error="error.name"
                class="col-span-2"
                label="Title"
            >
              <t-input-text id="name" v-model="form.name"/>
            </t-input-group>

            <!--Collar Type-->
            <t-input-group
                :error="error.collar_type"
                label="Collar Type"
            >
              <t-input-select
                  id="collar_type"
                  v-model="form.collar_type"
                  :clear-button="true"
                  :options="collarType"
                  options-label-key="name"
                  options-value-key="id"
                  place-holder="Select a collar type"
              >
                <template #label="{props}">
                  <div class="flex flex-row items-center">
                    <component :is="props.icon" :class="['w-4 h-4 mr-1', props.style]"/>
                    {{ props.name }}
                  </div>
                </template>
              </t-input-select>
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

            <!--Summary-->
            <t-input-group
                :error="error.summary"
                class="col-span-2"
                label="Summary"
            >
              <t-input-text-area
                  id="address"
                  v-model="form.summary"
                  :rows="2"
              />
            </t-input-group>

          </grid-section>
        </t-form-section>

        <!--Job Description Infos-->
        <t-form-section
            description="Job description's definitions"
            title="Requirements, Powers and Responsibilities"
        >

          <grid-section :col="1">
            <!--Job Requirements-->
            <t-input-group
                :error="error.job_requirement"
                label="Job Requirements"
            >
              <t-input-inline-editable-repeatable
                  id="job_requirement"
                  v-model="form.job_requirement"
                  value1name="Requirement"
                  value2name="Level"
              />
            </t-input-group>

            <!--Job Responsibilities-->
            <t-input-group
                :error="error.job_responsibility"
                label="Job Responsibilities"
            >
              <t-input-inline-editable-repeatable
                  id="job_responsibility"
                  v-model="form.job_responsibility"
                  value1name="Requirement"
                  value2name="Level"
              />
            </t-input-group>

            <!--Key Performance Indicators (KPIs)-->
            <t-input-group
                :error="error.kpi"
                label="Key Performance Indicators (KPIs)"
            >
              <t-input-inline-editable-repeatable
                  id="kpi"
                  v-model="form.kpi"
                  value1name="KPI"
                  value2name="Rate"
              />
            </t-input-group>

            <!--Working Conditions and Areas-->
            <t-input-group
                :error="error.working_conditions"
                label="Working Conditions and Areas"
            >
              <t-input-inline-editable-repeatable
                  id="working_conditions"
                  v-model="form.working_conditions"
                  value1name="Condition"
              />
            </t-input-group>

            <!--Working Equipments-->
            <t-input-group
                :error="error.working_equipments"
                label="Working Equipments"
            >
              <t-input-inline-editable-repeatable
                  id="working_equipments"
                  v-model="form.working_equipments"
                  value1name="Equipment"
              />
            </t-input-group>

          </grid-section>

          <grid-section :col-tablet="2">

            <!--It works together with-->
            <t-input-group
                :error="error.working_together"
                label="It works together with"
            >
              <t-input-multi-select
                  id="working_together"
                  v-model="form.working_together"
                  :clear-button="true"
                  :options="staff"
                  :search="true"
                  options-label-key="name"
                  options-value-key="id"
                  place-holder="Select staff"
              >
                <template #label="{props}">
                  <div class="flex flex-row whitespace-nowrap items-center gap-1">
                    <t-avatar :radius="8" :size="1"
                              :src="props.profile_photo_path !== null ? '/storage/'+props.profile_photo_path : null"/>
                    {{ props.name }}
                  </div>
                </template>
              </t-input-multi-select>
            </t-input-group>

            <!--It reports to-->
            <t-input-group
                :error="error.report_to"
                label="It reports to"
            >
              <t-input-multi-select
                  id="report_to"
                  v-model="form.report_to"
                  :clear-button="true"
                  :options="staff"
                  :search="true"
                  options-label-key="name"
                  options-value-key="id"
                  place-holder="Select staff"
              >
                <template #label="{props}">
                  <div class="flex flex-row whitespace-nowrap items-center gap-1">
                    <t-avatar :radius="8" :size="1"
                              :src="props.profile_photo_path !== null ? '/storage/'+props.profile_photo_path : null"/>
                    {{ props.name }}
                  </div>
                </template>
              </t-input-multi-select>
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
import TActionButtonsCreate from "@/Components/Button/ActionButtonsCreate";
import TFormContent from "@/Components/Form/TFormContent";
import TFormSection from "@/Components/Form/TFormSection";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import GridSection from "@/Layouts/GridSection";
import TBadge from "@/Components/Badge/TBadge";
import TXCircleIcon from "@/Components/Icon/TXCircleIcon";
import {StaffConsts} from "@/Mixins/SectionConsts/StaffConsts";
import TInputTextArea from "@/Components/Form/Inputs/TInputTextArea";
import TBlueCollarIcon from "@/Components/Icon/TBlueCollarIcon";
import TWhiteCollarIcon from "@/Components/Icon/TWhiteCollarIcon";
import TLoadingScreen from "@/Components/Misc/TLoadingScreen";
import TInputInlineEditableRepeatable from "@/Components/Form/Inputs/TInputInlineEditableRepeatable";
import TInputMultiSelect from "@/Components/Form/Inputs/TInputMultiSelect";
import TAvatar from "@/Components/Avatar/TAvatar";


export default {
  name: "Create",
  components: {
    TAvatar,
    TInputMultiSelect,
    TInputInlineEditableRepeatable,
    AppLayout,
    GridSection,
    TActionButtonsCreate,
    TBadge,
    TBlueCollarIcon,
    TFormContent,
    TFormSection,
    TInputGroup,
    TInputSelect,
    TInputText,
    TInputTextArea,
    TWhiteCollarIcon,
    TXCircleIcon,
    TLoadingScreen
  },
  mixins: [StaffConsts],
  props: {
    staff: {
      type: Array
    },
    departments: {
      type: Array
    },
    jobDescriptions: {
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
        collar_type: null,
        department_id: null,
        summary: null,
        job_requirement: [],
        job_responsibility: [],
        kpi: [],
        working_conditions: [],
        working_equipments: [],
        working_together: [],
        report_to: [],
      }),
    }
  },
  methods: {
    reset: function () {
      this.form.name = null;
      this.form.collar_type = null;
      this.form.department_id = null;
      this.form.summary = null;
      this.form.job_requirement = [];
      this.form.job_responsibility = [];
      this.form.kpi = [];
      this.form.working_conditions = [];
      this.form.working_equipments = [];
      this.form.working_together = [];
      this.form.report_to = []
    },
    save() {
      this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$delete(this.error, 'name');
      this.form.collar_type === null ? this.$set(this.error, 'collar_type', 'Collar type is required') : this.$delete(this.error, 'collar_type');
      this.form.department_id === null ? this.$set(this.error, 'department_id', 'Related department is required') : this.$delete(this.error, 'department_id');
      this.form.job_requirement === null ? this.$set(this.error, 'job_requirement', 'Job requirements are required') : this.$delete(this.error, 'job_requirement');
      this.form.job_responsibility === null ? this.$set(this.error, 'job_responsibility', 'Job responsibilities are required') : this.$delete(this.error, 'job_responsibility');
      this.form.working_conditions === null ? this.$set(this.error, 'working_conditions', 'Working conditions are required') : this.$delete(this.error, 'working_conditions');
      this.form.working_equipments === null ? this.$set(this.error, 'working_equipments', 'Working equipments are required') : this.$delete(this.error, 'working_equipments');

      if (Object.keys(this.error).length === 0) {
        this.form.post(route('job-description.store'), {
          errorBag: 'job-description',
          preserveScroll: true,
        });
        this.reset();
        this.loading = true;
      }
    }
  }
}
</script>