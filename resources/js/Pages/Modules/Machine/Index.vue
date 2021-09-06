<template>
  <app-layout>
    <!--Header-->
    <template #header>Machines</template>
    <template #subHeader>Management of the machines</template>
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
            <!--Machine Code-->
            <t-input-group label="Machine Code">
              <t-input-text v-model="searchData.code" @input="search" />
            </t-input-group>
            <!--Machine Name-->
            <t-input-group label="Machine Name">
              <t-input-text v-model="searchData.name" @input="search" />
            </t-input-group>
            <!--Machine Model-->
            <t-input-group label="Machine Model">
              <t-input-text v-model="searchData.model" @input="search" />
            </t-input-group>
            <!-- Machine Manufacturer-->
            <t-input-group label="Machine Manufacturer">
              <t-input-text v-model="searchData.manufacturer" @input="search" />
            </t-input-group>
            <!--Machine Department-->
            <t-input-group label="Department">
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
            <!--Machine machineType-->
            <t-input-group label="Machine Type">
              <t-input-select
                v-model="searchData.machine_type_id"
                :clear-button="true"
                :options="searchDataMachineType"
                :search="true"
                options-label-key="name"
                options-value-key="id"
                @input="search"
              />
            </t-input-group>

            <!--Main Machine -->
            <t-input-group label="Main Machine">
              <t-input-select
                v-model="searchData.machine_id"
                :clear-button="true"
                :options="searchDataMachine"
                :search="true"
                options-label-key="name"
                options-value-key="id"
                @input="search"
              />
            </t-input-group>
          </grid-section>
        </template>
        <template #right>
          <t-action-buttons-index model="machine" />
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

export default {
  name: "Index",
  components: {
    GridSection,
    TInputSelectItem,
    TInputSelect,
    TInputText,
    TInputGroup,
    TActionButtonsIndex,
    TTable,
    AppLayout,
  },
  props: {
    tableData: {
      type: Object,
    },
    searchDataMachineType: {
      type: Array,
    },
    searchDataDepartment: {
      type: Array,
    },
    searchDataMachine: {
      type: Array,
    },
  },
  data() {
    return {
      tableHeaders: [
        { label: "Code", key: "code", align: "left" },
        { label: "Name", key: "name", align: "left" },
        { label: "Type", key: "machine_type_name", align: "left" },
        { label: "Model", key: "model", align: "left" },
        { label: "Manufacturer", key: "manufacturer", align: "left" },
        { label: "Department", key: "department_name", align: "left" },
        { label: "Main Machine", key: "machine_name", align: "left" },
      ],
      searchData: {
        code: "",
        name: "",
        model: "",
        manufacturer: "",
        department_id: null,
        machine_type_id: null,
        machine_id: null,
      },
    };
  },
  methods: {
    search() {
      this.$inertia.reload({
        data: {
          code: this.searchData.code,
          name: this.searchData.name,
          machine_type_id: this.searchData.machine_type_id,
          model: this.searchData.model,
          manufacturer: this.searchData.manufacturer,
          department_id: this.searchData.department_id,
          machine_id: this.searchData.machine_id,
        },
        only: ["tableData"],
      });
    },
  },
};
</script>
