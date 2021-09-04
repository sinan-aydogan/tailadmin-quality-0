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
        :searchable-keys="['name']"
        color="solid-blue"
      >
        <!--Search Area-->
        <template #search>
          <grid-section :col-tablet="4">
            <!--Search by Machine Type Name-->
            <t-input-group
              label="Machine Type Name"
            >
              <t-input-text
                v-model="searchData.name"
                @input="search"
              />
            </t-input-group>
            <!--Search by Machine Type Description-->
            <t-input-group
              label="Machine Type Description"
            >
              <t-input-text
                v-model="searchData.description"
                @input="search"
              />
            </t-input-group>
          </grid-section>
        </template>
        <template #right>
          <t-action-buttons-index model="machine-type"/>
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
  props: {
    tableData: {
      type: Object
    }
  },
  data() {
    return {
      tableHeaders: [
        {label: 'Name', key: 'name', align: 'left'},
        {label: 'Description', key: 'description', align: 'left'},
      ],
      searchData: {
        name: '',
        description: '',
      }
    }
  },
  methods: {
    search() {
      this.$inertia.reload({
        data: {
          name: this.searchData.name,
          description: this.searchData.description,
        },
        only: ['tableData'],
      })
    }
  }
}
</script>
