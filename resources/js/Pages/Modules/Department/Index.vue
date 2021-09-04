<template>
  <app-layout>
    <!--Header-->
    <template #header>Departments</template>
    <template #subHeader>Management of the departments</template>
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
          <grid-section :col-tablet="4">
            <!--Department Name-->
            <t-input-group
                label="Department Name"
            >
              <t-input-text
                  v-model="searchData.name"
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
            <!--Customer Complaints-->
            <t-input-group
                label="Get a Complaints?"
            >
              <t-input-select
                  v-model="searchData.is_complaint"
                  :clear-button="true"
                  :options="is_complaint"
                  options-label-key="name"
                  options-value-key="id"
                  @input="search"
              >
                <template #label="{props}">
                  <t-badge :color="props.color" :radius="8">
                    <template #icon>
                      <t-check-circle-icon v-if="props.id == 1" :radius="8"/>
                      <t-x-circle-icon v-if="props.id == 2" :radius="8"/>
                    </template>
                    {{ props.name }}
                  </t-badge>
                </template>
              </t-input-select>
            </t-input-group>
            <!--Production-->
            <t-input-group
                label="Make Production?"
            >
              <t-input-select
                  v-model="searchData.is_production"
                  :clear-button="true"
                  :options="is_production"
                  options-label-key="name"
                  options-value-key="id"
                  @input="search"
              >
                <template #label="{props}">
                  <t-badge :color="props.color" :radius="8">
                    <template #icon>
                      <t-check-circle-icon v-if="props.id == 1" :radius="8"/>
                      <t-x-circle-icon v-if="props.id == 2" :radius="8"/>
                    </template>
                    {{ props.name }}
                  </t-badge>
                </template>
              </t-input-select>
            </t-input-group>
          </grid-section>
        </template>
        <template #right>
          <t-action-buttons-index model="department"/>
        </template>
        <!--Manager-->
        <template #manager_name="{props}">
          <div class="inline-flex whitespace-nowrap items-center gap-1">
            <t-avatar :radius="8" :size="2"
                      :src="props.manager_photo !== null ? 'storage/'+props.manager_photo : null"/>
            {{ props.manager_name }}
          </div>
        </template>
        <!--Customer Complaints-->
        <template #is_complaint="{props}">
          <t-badge :color="is_complaint[is_complaint.findIndex( s => s.id === props.is_complaint )].color" :radius="8">
            <template #icon>
              <t-x-circle-icon v-if="props.is_complaint === 0" :radius="8"/>
              <t-check-circle-icon v-else :radius="8"/>
            </template>
            {{ is_complaint[is_complaint.findIndex( s => s.id === props.is_complaint )].name }}
          </t-badge>
        </template>
        <!--Production-->
        <template #is_production="{props}">
          <t-badge :color="is_production[is_production.findIndex( s => s.id === props.is_production )].color" :radius="8">
            <template #icon>
              <t-x-circle-icon v-if="props.is_production === 0" :radius="8"/>
              <t-check-circle-icon v-else :radius="8"/>
            </template>
            {{ is_production[is_production.findIndex( s => s.id === props.is_production )].name }}
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
import {DepartmentConsts} from "@/Mixins/SectionConsts/DepartmentConsts";

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
  mixins: [DepartmentConsts],
  props: {
    tableData: {
      type: Object
    },
    searchDataManager: {
      type: Array
    }
  },
  data() {
    return {
      tableHeaders: [
        {label: 'Department', key: 'name', align: 'left'},
        {label: 'Manager', key: 'manager_name', align: 'left'},
        {label: 'Get a Complaints?', key: 'is_complaint', align: 'center'},
        {label: 'Make Production?', key: 'is_production', align: 'center'},
      ],
      searchData: {
        name: '',
        manager_id: null,
        is_complaint: null,
        is_production: null
      }
    }
  },
  methods: {
    search() {
      this.$inertia.reload({
        data: {
          name: this.searchData.name,
          manager_id: this.searchData.manager_id,
          is_complaint: this.searchData.is_complaint,
          is_production: this.searchData.is_production
        },
        only: ['tableData'],
      })
    }
  }
}
</script>