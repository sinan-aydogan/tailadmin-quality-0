<template>
  <app-layout :action-buttons="true">
    <!--Header-->
    <template #header>Create Staff</template>
    <template #subHeader>You can new staff for your company</template>
    <!--Action Buttons-->
    <template #action-buttons>
      <t-action-buttons-create model="staff"/>
    </template>
    <template #default>
      <t-form-content @reset="reset" @submitted="save()">
        <!--Personal Info-->
        <t-form-section
            description="This information is subject to personal data protection law."
            title="Personal Infos"
        >
          <grid-section :col-tablet="2">
            <!--Staff Name-->
            <t-input-group
                :error="error.name"
                label="Staff Name"
            >
              <t-input-text id="name" v-model="form.name"/>
            </t-input-group>

            <!--Citizen ID-->
            <t-input-group
                :error="error.citizen_id"
                label="Citizen ID"
            >
              <t-input-text id="citizen_id" v-model="form.citizen_id"/>
            </t-input-group>

            <!--Birthday-->
            <t-input-group
                :error="error.birthday_date"
                label="Birthday"
            >
              <t-input-date id="birthday_date" v-model="form.birthday_date"/>
            </t-input-group>

            <!--Blood Group-->
            <t-input-group
                :error="error.blood_group"
                label="Blood Group"
            >
              <t-input-select
                  id="blood_group"
                  v-model="form.blood_group"
                  :clear-button="true"
                  :options="bloodGroup"
                  options-label-key="name"
                  options-value-key="id"
                  place-holder="Select a blood group"
              />
            </t-input-group>

            <!--Phone-->
            <t-input-group
                :error="error.phone"
                label="Phone"
            >
              <t-input-repeatable
                  id="phone"
                  v-model="form.phone"
                  value1name="Phone"
              />
            </t-input-group>

            <!--Address-->
            <t-input-group
                :error="error.address"
                label="Address"
            >
              <t-input-text-area
                  id="address"
                  v-model="form.address"
                  :rows="2"
              />
            </t-input-group>

            <!--Emergency Contacts-->
            <t-input-group
                :error="error.emergency_contacts"
                label="Emergency Contacts"
            >
              <t-input-repeatable
                  id="emergency_contacts"
                  v-model="form.emergency_contacts"
                  value1name="Name"
                  value2name="Phone"
              />
            </t-input-group>

            <!--Education Info-->
            <t-input-group
                :error="error.education_info"
                label="Education Info"
            >
              <t-input-repeatable
                  id="education_info"
                  v-model="form.education_info"
                  value1name="School"
                  value2name="Section"
              />
            </t-input-group>

            <!--Skill Info-->
            <t-input-group
                :error="error.skill_info"
                label="Skill Info"
            >
              <t-input-repeatable
                  id="skill_info"
                  v-model="form.skill_info"
                  value1name="Skill"
                  value2name="Reg. No/Place"
              />
            </t-input-group>

            <!--Additional Tasks-->
            <t-input-group
                :error="error.additional_task"
                label="Additional Tasks"
            >
              <t-input-repeatable
                  id="additional_task"
                  v-model="form.additional_task"
                  value1name="Task"
                  value2name="Additional Info"
              />
            </t-input-group>

          </grid-section>
        </t-form-section>

        <!--Staff of business information-->
        <t-form-section
            description="The position and other information about of the staff in the business"
            title="Staff of business information"
        >
          <grid-section :col-tablet="2">
            <!--Email-->
            <t-input-group
                :error="error.email"
                label="Email"
            >
              <t-input-text id="email" v-model="form.email"/>
            </t-input-group>

            <!--Department-->
            <t-input-group
                :error="error.department_id"
                label="Department"
            >
              <t-input-select
                  id="department_id"
                  v-model="form.department_id"
                  :options="departments"
                  options-label-key="name"
                  options-value-key="id"
                  :clear-button="true"
                  :search="true"
                  place-holder="Select a department"
              />
            </t-input-group>

            <!--Collar Type-->
            <t-input-group
                :error="error.collar_type"
                label="Collar Type"
            >
              <t-input-select
                  id="collar_type"
                  v-model="form.collar_type"
                  :options="collarType"
                  options-label-key="name"
                  options-value-key="id"
                  :clear-button="true"
                  place-holder="Select a collar type"
                  @input="jobDescriptionChange"
              >
                <template #label="{props}">
                  <div class="flex flex-row items-center">
                    <component :is="props.icon" :class="['w-4 h-4 mr-1', props.style]"/> {{props.name}}
                  </div>
                </template>
              </t-input-select>
            </t-input-group>

            <!--Job Description-->
            <t-input-group
                :error="form.collar_type === null ? 'Please firstly select collar type' : error.job_description_id"
                label="Job Description"
            >
              <t-input-select
                  id="job_description_id"
                  v-model="form.job_description_id"
                  :options="jobDescriptions"
                  options-label-key="name"
                  options-value-key="id"
                  :clear-button="true"
                  :search="true"
                  place-holder="Select a description"
                  :disabled="form.collar_type === null"
              />
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
                  :options="managers"
                  options-value-key="id"
                  options-label-key="name"
                  @input="managerChange"
              >
                <template #label="{props}">
                  <div class="flex flex-wrap whitespace-nowrap items-center gap-1">
                    <t-avatar :radius="8" :size="1"
                              :src="props.profile_photo_path !== null ? '/storage/'+props.profile_photo_path : null"/>
                    {{ props.name }}
                  </div>
                </template>
              </t-input-select>
            </t-input-group>

            <!--Directed Staff-->
            <t-input-group
                label="Directed Staff"
                :error="error.directed_staff"
            >
              <t-input-multi-select
                  id="directed_staff"
                  v-model="form.directed_staff"
                  :search="true"
                  place-holder="Select staff"
                  :clear-button="true"
                  :options="staff"
                  options-value-key="id"
                  options-label-key="name"
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

        <!--Employment status of the staff-->
        <t-form-section>
          <grid-section :col-tablet="2">

            <!--Employment Start Date-->
            <t-input-group
                :error="error.starting_date"
                label="Employment Start Date"
            >
              <t-input-date id="starting_date" v-model="form.starting_date"/>
            </t-input-group>

            <!--Employment Status-->
            <t-input-group
                :error="error.status"
                label="Employment Status"
            >
              <t-input-select
                  id="status"
                  v-model="form.status"
                  :options="status"
                  options-label-key="name"
                  options-value-key="id"
                  :clear-button="true"
                  place-holder="Select a collar type"
                  @input="jobDescriptionChange"
              >
                <template #label="{props}">
                  <div class="flex flex-row items-center">
                    <t-badge :color="status[status.findIndex( s => s.id === props.id )].color">
                      {{props.name}}
                    </t-badge>

                  </div>
                </template>
              </t-input-select>
            </t-input-group>

            <!--Finish Date of Employment-->
            <t-input-group
                :error="error.leaving_date"
                label="Finish Date of Employment"
                v-if="form.status > 1"
            >
              <t-input-date id="leaving_date" v-model="form.leaving_date"/>
            </t-input-group>

            <!--Leaving Reason-->
            <t-input-group
                :error="error.leaving_reason"
                :label="form.status === 2 ? 'Reason for Leaving': 'Reason to be Fired'"
                v-if="form.status === 2 || form.status === 3"
            >
              <t-input-text-area
                  id="leaving_reason"
                  v-model="form.leaving_reason"
                  :rows="2"
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
import {StaffConsts} from "@/Mixins/SectionConsts/StaffConsts";
import TInputDate from "@/Components/Form/Inputs/TInputDate";
import TInputRepeatable from "@/Components/Form/Inputs/TInputRepeatable";
import TInputTextArea from "@/Components/Form/Inputs/TInputTextArea";
import TBlueCollarIcon from "@/Components/Icon/TBlueCollarIcon";
import TWhiteCollarIcon from "@/Components/Icon/TWhiteCollarIcon";
import TInputMultiSelect from "@/Components/Form/Inputs/TInputMultiSelect";
import TLoadingScreen from "@/Components/Misc/TLoadingScreen";


export default {
  name: "Create",
  components: {
    TLoadingScreen,
    TInputMultiSelect,
    TBlueCollarIcon,
    TWhiteCollarIcon,
    TInputTextArea,
    TInputRepeatable,
    TInputDate,
    TAvatar,
    TXCircleIcon,
    TCheckCircleIcon,
    TBadge,
    GridSection,
    TInputSelectItem,
    TInputSelect, TInputText, TInputGroup, TFormSection, TFormContent, TActionButtonsCreate, AppLayout
  },
  mixins: [StaffConsts],
  props: {
    managers: {
      type: Array
    },
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
        email: null,
        department_id: null,
        job_description_id: null,
        collar_type: null,
        manager_id: null,
        directed_staff: [],
        citizen_id: null,
        status: null,
        starting_date: null,
        birthday_date: null,
        leaving_date: null,
        leaving_reason: null,
        blood_group: null,
        phone: [],
        address: null,
        emergency_contacts: [],
        education_info: [],
        skill_info: [],
        additional_task: [],
      }),
    }
  },
  methods: {
    reset: function () {
      this.form.name = null;
      this.form.email = null;
      this.form.department_id = null;
      this.form.job_description_id = null;
      this.form.collar_type = null;
      this.form.manager_id = null;
      this.form.directed_staff = [];
      this.form.citizen_id = null;
      this.form.status = 1;
      this.form.starting_date = null;
      this.form.birthday_date = null;
      this.form.leaving_date = null;
      this.form.leaving_reason = null;
      this.form.blood_group = null;
      this.form.phone = [];
      this.form.address = null;
      this.form.emergency_contacts = [];
      this.form.education_info = [];
      this.form.skill_info = [];
      this.form.additional_task = [];
    },
    save() {
      this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$delete(this.error, 'name');
      this.form.email === null ? this.$set(this.error, 'email', 'Email is required') : this.$delete(this.error, 'email');
      this.form.department_id === null ? this.$set(this.error, 'department_id', 'Department is required') : this.$delete(this.error, 'department_id');
      this.form.job_description_id === null ? this.$set(this.error, 'job_description_id', 'Job description is required') : this.$delete(this.error, 'job_description_id');
      this.form.collar_type === null ? this.$set(this.error, 'collar_type', 'Collar type is required') : this.$delete(this.error, 'collar_type');
      this.form.manager_id === null ? this.$set(this.error, 'manager_id', 'Manager is required') : this.$delete(this.error, 'manager_id');
      this.form.citizen_id === null ? this.$set(this.error, 'citizen_id', 'Name is required') : this.$delete(this.error, 'citizen_id');
      this.form.starting_date === null ? this.$set(this.error, 'starting_date', 'Starting date is required') : this.$delete(this.error, 'starting_date');
      this.form.birthday_date === null ? this.$set(this.error, 'birthday_date', 'Birthday is required') : this.$delete(this.error, 'birthday_date');

      if(this.status > 1){
        this.form.leaving_date === null ? this.$set(this.error, 'leaving_date', 'Leaving date is required') : this.$delete(this.error, 'leaving_date');
      }

      if(this.status === 2 || this.status === 3){
        this.form.leaving_reason === null ? this.$set(this.error, 'leaving_reason', 'Reason of Leaving/Fired is required') : this.$delete(this.error, 'leaving_reason');
      }
      console.log(Object.keys(this.error).length)
      console.log(this.error)
      if (Object.keys(this.error).length === 0) {
        this.form.post(route('staff.store'), {
          errorBag: 'staff',
          preserveScroll: true,
        });
        this.reset();
        this.loading = true;
      }
    },
    jobDescriptionChange() {
      this.$inertia.reload({
        method: 'get',
        data: {
          collar_type: this.form.collar_type,
        },
        replace: true,
        preserveState: true,
        preserveScroll: true,
        only: ['jobDescriptions'],
      })
    },
    managerChange() {
      this.$inertia.reload({
        method: 'get',
        data: {
          manager_id: this.form.manager_id,
        },
        replace: true,
        preserveState: true,
        preserveScroll: true,
        only: ['staff'],
      })
    }
  }
}
</script>