<template>
  <app-layout>
    <!--Header-->
    <template #header>Audit Types</template>
    <template #subHeader>All of audit types in your company</template>
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
          <t-action-buttons-index model="audit-type"/>
        </template>

          <template #firms="{props}">
              <div class="flex flex-col gap-2">
                  <t-badge v-for="(item,index) in props.firms" :key="index">
                      {{item.name}}
                  </t-badge>
              </div>
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
import TBadge from "@/Components/Badge/TBadge";

export default {
  name: "Index",
  components: {
      TBadge,
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
    },
    searchDataDepartment: {
      type: Array
    }
  },
  data() {
    return {
      tableHeaders: [
        {label: 'Type Name', key: 'name', align: 'left'},
        {label: 'Related Firms', key: 'firms', align: 'left'},
        {label: 'Description', key: 'description', align: 'left'},
      ]
    }
  }
}
</script>
