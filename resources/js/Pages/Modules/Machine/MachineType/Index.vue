<template>
  <app-layout>
    <!--Header-->
    <template #header>Machine Type</template>
    <template #subHeader>Management of the machine type</template>
    <!--Content-->
    <template #default>
      <t-table
          :content="tableData.data"
          :header="tableHeaders"
          :pagination="true"
          :searchable-keys="['name','description']"
          color="solid-blue"
      >
        <template #right>
          <t-action-buttons-index model="machine-type"/>
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
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TTable from "@/Components/Table/TTable";

export default {
  name: "Index",
  components: {
    AppLayout,
    GridSection,
    TActionButtonsIndex,
    TInputGroup,
    TInputSelect,
    TInputText,
    TTable
  },
  props: {
    tableData: {
      type: Object
    }
  },
  data() {
    return {
      tableHeaders: [
        {label: 'Type Name', key: 'name', align: 'left'},
        {label: 'Description', key: 'description', align: 'left'},
      ],
      searchData: {
        name: '',
        description: '',
      }
    }
  }
}
</script>
