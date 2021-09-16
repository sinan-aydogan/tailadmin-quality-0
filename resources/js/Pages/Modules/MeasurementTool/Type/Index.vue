<template>
  <app-layout>
    <!--Header-->
    <template #header>Measurement Tool Types</template>
    <template #subHeader>All of measurement tool types in your company</template>
    <!--Content-->
    <template #default>
      <t-table
          :content="tableData.data"
          :header="tableHeaders"
          :pagination="true"
          :searchable-keys="['name']"
          color="solid-blue"
      >
        <template #right>
          <t-action-buttons-index model="measurement-tool-type"/>
        </template>
      </t-table>
    </template>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import GridSection from "@/Layouts/GridSection";
import TActionButtonsIndex from "@/Components/Button/ActionButtonsIndex";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TTable from "@/Components/Table/TTable";

export default {
  name: "Index",
  components: {
    AppLayout,
    GridSection,
    TActionButtonsIndex,
    TInputGroup,
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
        {label: 'Description', key: 'description', align: 'left'},
      ]
    }
  }
}
</script>
