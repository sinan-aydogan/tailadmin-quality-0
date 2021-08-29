<template>
  <app-layout>
    <!--Header-->
    <template #header>Products Quality Plans</template>
    <template #subHeader>All of product's quality plans in your company</template>
    <!--Content-->
    <template #default>
      <t-table
          :content="tableData.data"
          :header="tableHeaders"
          :pagination="true"
          :searchable="['code']"
          color="solid-blue"
      >
        <!--Search Area-->
        <template #search>
          <grid-section :col-tablet="3">

            <!--Product Code-->
            <t-input-group
                label="Product Code"
            >
              <t-input-text
                  v-model="searchData.code"
                  @input="search"
              />
            </t-input-group>

            <!--Product Type-->
            <t-input-group
                label="Product"
            >
              <t-input-select
                  v-model="searchData.product_id"
                  :clear-button="true"
                  :options="searchDataProduct"
                  :search="true"
                  options-label-key="name"
                  options-value-key="id"
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
          <t-action-buttons-index model="product-quality-plan"/>
        </template>

        <!--Spects-->
        <template #spects="{props}">
          <div v-for="(item,index) in props.spects">
            {{item.spect_id}}
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
    },
    searchDataProduct: {
      type: Array
    }
  },
  data() {
    return {
      tableHeaders: [
        {label: 'Plan Code', key: 'code', align: 'left'},
        {label: 'Product', key: 'product_name', align: 'left'},
        {label: 'Department', key: 'department_name', align: 'left'},
        {label: 'Spects', key: 'spects', align: 'left'},
      ],
      searchData: {
        code: '',
        department_id: null,
        product_id: null,
      }
    }
  },
  methods: {
    search() {
      this.$inertia.reload({
        data: {
          code: this.searchData.code,
          department_id: this.searchData.department_id,
          product_id: this.searchData.product_id,
        },
        only: ['tableData'],
      })
    }
  }
}
</script>