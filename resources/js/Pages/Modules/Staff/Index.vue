<template>
  <app-layout>
    <!--Header-->
    <template #header>Staff</template>
    <template #subHeader>Management of the staff</template>
    <!--Content-->
    <template #default>
      <t-table
          :content="tableData.data"
          :header="tableHeaders"
          :pagination="true"
          :searchable-keys="['name']"
          color="solid-blue"
      >
        <!--Search Area-->
        <template #search>
          <grid-section :col-tablet="3">
            <!--Staff Name-->
            <t-input-group
                label="Person Name"
            >
              <t-input-text
                  v-model="searchData.name"
                  @input="search"
              />
            </t-input-group>

            <!--Department-->
            <t-input-group
                label="Department"
            >
              <t-input-select
                  v-model="searchData.department_id"
                  :clear-button="true"
                  :options="searchDataDepartment"
                  :search="true"
                  options-label-key="name"
                  options-value-key="id"
                  @input="search"
              />
            </t-input-group>

            <!--Job Description-->
            <t-input-group
                label="Job Description"
            >
              <t-input-select
                  v-model="searchData.job_description_id"
                  :clear-button="true"
                  :options="searchDataJobDescription"
                  :search="true"
                  options-label-key="name"
                  options-value-key="id"
                  @input="search"
              />
            </t-input-group>

            <!--Manager-->
            <t-input-group
                label="Manager"
            >
              <t-input-select
                  v-model="searchData.manager_id"
                  :clear-button="true"
                  :options="searchDataManager"
                  :search="true"
                  options-label-key="name"
                  options-value-key="id"
                  @input="search"
              >
                <template #label="{props}">
                  <div class="flex flex-wrap whitespace-nowrap items-center gap-1">
                    <t-avatar :radius="8" :size="2"
                              :src="props.profile_photo_path !== null ? 'storage/'+props.profile_photo_path : null"/>
                    {{ props.name }}
                  </div>
                </template>
              </t-input-select>
            </t-input-group>

            <!--Status-->
            <t-input-group
                label="Status"
            >
              <t-input-select
                  v-model="searchData.status"
                  :clear-button="true"
                  :options="status"
                  options-label-key="name"
                  options-value-key="id"
                  @input="search"
              >
                <template #label="{props}">
                  <t-badge :color="props.color">
                    {{ props.name }}
                  </t-badge>
                </template>
              </t-input-select>
            </t-input-group>
          </grid-section>
        </template>
        <template #right>
          <t-action-buttons-index model="staff"/>
        </template>
        <!--Name-->
        <template #name="{props}">
          <div class="inline-flex whitespace-nowrap items-center gap-1">
            <t-avatar :radius="8" :size="2"
                      :src="props.photo !== null ? 'storage/'+props.photo : null"/>
            {{ props.name }}
          </div>
        </template>
        <!--Status-->
        <template #status="{props}">
          <t-badge :color="status[status.findIndex( s => s.id === props.status )].color">
            {{ status[status.findIndex( s => s.id === props.status )].name }}
          </t-badge>
        </template>
      </t-table>
    </template>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import TTable from "@/Components/Table/TTable";
import TActionButtonsIndex from "@/Components/Button/ActionButtonsIndex";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputSelectItem from "@/Components/Form/Inputs/TInputSelectItem";
import GridSection from "@/Layouts/GridSection";
import TBadge from "@/Components/Badge/TBadge";
import TXCircleIcon from "@/Components/Icon/TXCircleIcon";
import TCheckCircleIcon from "@/Components/Icon/TCheckCircleIcon";
import TAvatar from "@/Components/Avatar/TAvatar";
import {StaffConsts} from "@/Mixins/SectionConsts/StaffConsts";

export default {
  name: "Index",
  components: {
    TAvatar,
    TCheckCircleIcon,
    TXCircleIcon,
    TBadge,
    GridSection,
    TInputSelectItem,
    TInputSelect,
    TInputText,
    TInputGroup,
    TActionButtonsIndex,
    TTable,
    AppLayout
  },
  mixins: [StaffConsts],
  props: {
    tableData: {
      type: Object
    },
    searchDataDepartment : {
      type: Array
    },
    searchDataManager: {
      type: Array
    },
    searchDataJobDescription: {
      type: Array
    }
  },
  data() {
    return {
      tableHeaders: [
        {label: 'Person Name', key: 'name', align: 'left'},
        {label: 'Department', key: 'department_name', align: 'left'},
        {label: 'Job Description', key: 'job_description_name', align: 'left'},
        {label: 'Manager', key: 'manager_name', align: 'left'},
        {label: 'Status', key: 'status', align: 'center'},
      ],
      searchData: {
        name: '',
        department_id: null,
        job_description_id: null,
        manager_id: null,
        status: null,
      }
    }
  },
  methods: {
    search() {
      this.$inertia.reload({
        data: {
          name: this.searchData.name,
          department_id: this.searchData.department_id,
          job_description_id: this.searchData.job_description_id,
          manager_id: this.searchData.manager_id,
          status: this.searchData.status,
        },
        only: ['tableData'],
      })
    }
  }
}
</script>