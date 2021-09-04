<template>
  <app-layout>
    <!--Header-->
    <template #header>Job Descriptions</template>
    <template #subHeader>All of staff in your company</template>
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
            <!--Title-->
            <t-input-group
                label="Title"
            >
              <t-input-text
                  v-model="searchData.name"
                  @input="search"
              />
            </t-input-group>

            <!--Collar Type-->
            <t-input-group
                label="Collar Type"
            >
              <t-input-select
                  v-model="searchData.collar_type"
                  :clear-button="true"
                  :options="collarType"
                  options-label-key="name"
                  options-value-key="id"
                  @input="search"
              >
                <template #label="{props}">
                  <t-badge>
                    <component :is="props.icon" slot="icon" :class="['w-4 h-4', props.style]"/>
                    {{ props.name }}
                  </t-badge>
                </template>
              </t-input-select>
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
          </grid-section>
        </template>
        <template #right>
          <t-action-buttons-index model="job-description"/>
        </template>
        <!--Name-->
        <template #collar_type="{props}">
          <t-badge>
            <component :is="collarType[collarType.findIndex( s => s.id === props.collar_type )].icon"
                       slot="icon"
                       :class="['w-4 h-4',collarType[collarType.findIndex( s => s.id === props.collar_type )].style]"/>
            {{ collarType[collarType.findIndex(s => s.id === props.collar_type)].name }}
          </t-badge>
        </template>
      </t-table>
    </template>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import GridSection from "@/Layouts/GridSection";
import TActionButtonsIndex from "@/Components/Button/ActionButtonsIndex";
import TBadge from "@/Components/Badge/TBadge";
import TBlueCollarIcon from "@/Components/Icon/TBlueCollarIcon";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TTable from "@/Components/Table/TTable";
import TWhiteCollarIcon from "@/Components/Icon/TWhiteCollarIcon";
import {StaffConsts} from "@/Mixins/SectionConsts/StaffConsts";

export default {
  name: "Index",
  components: {
    AppLayout,
    GridSection,
    TActionButtonsIndex,
    TBadge,
    TBlueCollarIcon,
    TInputGroup,
    TInputSelect,
    TInputText,
    TTable,
    TWhiteCollarIcon,
  },
  mixins: [StaffConsts],
  props: {
    tableData: {
      type: Object
    },
    searchDataDepartment: {
      type: Array
    }
  },
  data() {
    return {
      tableHeaders: [
        {label: 'Title', key: 'name', align: 'left'},
        {label: 'Collar Type', key: 'collar_type', align: 'center'},
        {label: 'Related Department', key: 'department_name', align: 'left'},
      ],
      searchData: {
        name: '',
        collar_type: null,
        department_id: null,
      }
    }
  },
  methods: {
    search() {
      this.$inertia.reload({
        data: {
          name: this.searchData.name,
          collar_type: this.searchData.collar_type,
          department_id: this.searchData.department_id,
        },
        only: ['tableData'],
      })
    }
  }
}
</script>