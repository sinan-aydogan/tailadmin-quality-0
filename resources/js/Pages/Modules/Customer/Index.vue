<template>
  <app-layout>
    <!--Header-->
    <template #header>Customers</template>
    <template #subHeader>All of customers in your company</template>
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
            <!--Customer Name-->
            <t-input-group
                label="Department Name"
            >
              <t-input-text
                  v-model="searchData.name"
                  @input="search"
              />
            </t-input-group>

            <!--Tax ID-->
            <t-input-group
                label="Tax ID"
            >
              <t-input-text
                  v-model="searchData.tax_id"
                  @input="search"
              />
            </t-input-group>

            <!--Phone-->
            <t-input-group
                label="Phone"
            >
              <t-input-text
                  v-model="searchData.phone"
                  @input="search"
              />
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
          <t-action-buttons-index model="customer"/>
        </template>
        <!--Status-->
        <template #status="{props}">
          <t-badge :color="status[status.findIndex( s => s.id === props.status )].color">
            {{ status[status.findIndex(s => s.id === props.status)].name }}
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
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputSelectItem from "@/Components/Form/Inputs/TInputSelectItem";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TTable from "@/Components/Table/TTable";
import {CustomerConsts} from "@/Mixins/SectionConsts/CustomerConsts";

export default {
  name: "Index",
  components: {
    AppLayout,
    GridSection,
    TActionButtonsIndex,
    TBadge,
    TInputGroup,
    TInputSelect,
    TInputSelectItem,
    TInputText,
    TTable
  },
  mixins: [CustomerConsts],
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
        {label: 'Customer', key: 'name', align: 'left'},
        {label: 'Tax ID', key: 'tax_id', align: 'left'},
        {label: 'Email', key: 'email', align: 'left'},
        {label: 'Phone', key: 'phone', align: 'left'},
        {label: 'Status', key: 'status', align: 'center'},
      ],
      searchData: {
        name: '',
        tax_id: null,
        phone: null,
        status: null
      }
    }
  },
  methods: {
    search() {
      this.$inertia.reload({
        data: {
          name: this.searchData.name,
          tax_id: this.searchData.tax_id,
          phone: this.searchData.phone,
          status: this.searchData.status
        },
        only: ['tableData'],
      })
    }
  }
}
</script>