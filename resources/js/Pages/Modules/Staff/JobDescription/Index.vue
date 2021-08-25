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
          :searchable="['name']"
          color="solid-blue"
      >
        <!--Search Area-->
        <template #search>
          <grid-section :col-tablet="4">
            <!--Department Name-->
            <t-input-group
                label="Person Name"
            >
              <t-input-text
                  v-model="searchData.name"
                  @input="search"
              />
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
    searchDataManager: {
      type: Array
    }
  },
  data() {
    return {
      tableHeaders: [
        {label: 'Person Name', key: 'name', align: 'left'},
        {label: 'Department', key: 'department_name', align: 'left'},
        {label: 'Job Description', key: 'job_description_name', align: 'left'},
        {label: 'Status', key: 'status', align: 'center'},
      ],
      searchData: {
        name: '',
      }
    }
  },
  methods: {
    search() {
      this.$inertia.reload({
        data: {
          name: this.searchData.name,
        },
        only: ['tableData'],
      })
    }
  }
}
</script>