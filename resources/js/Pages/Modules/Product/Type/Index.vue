<template>
  <app-layout>
    <!--Header-->
    <template #header>Products Types</template>
    <template #subHeader>All of products types in your company</template>
    <!--Content-->
    <template #default>
      <t-table
          :content="tableData.data"
          :header="tableHeaders"
          :pagination="true"
          :searchable="['name']"
          color="solid-blue"
      >
        <!--Search Area-->
        <template #search>
          <grid-section :col-tablet="3">

            <!--Type Name-->
            <t-input-group
                label="Type Name"
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

          </grid-section>
        </template>
        <template #right>
          <t-action-buttons-index model="product-type"/>
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
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TTable from "@/Components/Table/TTable";
import TTooltip from "@/Components/Tooltip/TTooltip";

export default {
  name: "Index",
  components: {
    TTooltip,
    AppLayout,
    GridSection,
    TActionButtonsIndex,
    TBadge,
    TInputGroup,
    TInputSelect,
    TInputText,
    TTable
  },
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
        {label: 'Type Name', key: 'name', align: 'left'},
        {label: 'Related Department', key: 'department_name', align: 'left'},
        {label: 'Description', key: 'description', align: 'left'},
      ],
      searchData: {
        name: '',
        department_id: null,
      }
    }
  },
  methods: {
    search() {
      this.$inertia.reload({
        data: {
          name: this.searchData.name,
          department_id: this.searchData.department_id,
        },
        only: ['tableData'],
      })
    }
  }
}
</script>