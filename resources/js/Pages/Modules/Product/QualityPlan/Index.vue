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
          :searchable="['name']"
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

            <!--Product Name-->
            <t-input-group
                label="Product Name"
            >
              <t-input-text
                  v-model="searchData.name"
                  @input="search"
              />
            </t-input-group>

            <!--Product Type-->
            <t-input-group
                label="Product Type"
            >
              <t-input-select
                  v-model="searchData.product_type_id"
                  :clear-button="true"
                  :options="searchDataType"
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

            <!--Standard-->
            <t-input-group
                label="Standard"
            >
              <t-input-select
                  v-model="searchData.standard_id"
                  :clear-button="true"
                  :options="searchDataStandard"
                  options-label-key="name"
                  options-value-key="id"
                  @input="search"
              />
            </t-input-group>

            <!--Certification-->
            <t-input-group
                label="Certification"
            >
              <t-input-select
                  v-model="searchData.is_certified"
                  :clear-button="true"
                  :options="is_certified"
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
          <t-action-buttons-index model="product-quality-plan"/>
        </template>

        <!--Code-->
        <template #code="{props}">
          <div class="inline-flex whitespace-nowrap items-center gap-1">
            {{ props.code }}
          </div>
        </template>

        <!--Name-->
        <template #name="{props}">
          <div class="flex flex-row whitespace-nowrap items-center gap-2">
            <div v-if="props.photo" class="flex items-center justify-center rounded-lg overflow-hidden w-12 h-12 gap-2 bg-gray-200 bg-opacity-50">
              <img :src="props.photo" class="cover-image"/>
            </div>

            {{ props.name }}
          </div>
        </template>

        <!--Standard-->
        <template #standard_code="{props}">

          <t-tooltip position="top">
            <template #mainContent>
              {{ props.standard_code }}
            </template>
            <template #secondContent>
              {{ props.standard_name }}
            </template>
          </t-tooltip>
        </template>

        <!--Certification-->
        <template #is_certified="{props}">
          <t-badge :color="is_certified[is_certified.findIndex( s => s.id === props.is_certified )].color">
            {{ is_certified[is_certified.findIndex(s => s.id === props.is_certified)].name }}
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
import TInputText from "@/Components/Form/Inputs/TInputText";
import TTable from "@/Components/Table/TTable";
import {ProductConsts} from "@/Mixins/SectionConsts/ProductConsts";
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
  mixins: [ProductConsts],
  props: {
    tableData: {
      type: Object
    },
    searchDataDepartment: {
      type: Array
    },
    searchDataType: {
      type: Array
    },
    searchDataStandard: {
      type: Array
    }
  },
  data() {
    return {
      tableHeaders: [
        {label: 'Product Code', key: 'code', align: 'left'},
        {label: 'Product Name', key: 'name', align: 'left'},
        {label: 'Product Type', key: 'job_description_name', align: 'left'},
        {label: 'Department', key: 'department_name', align: 'left'},
        {label: 'Production Standard', key: 'standard_code', align: 'left'},
        {label: 'Certification', key: 'is_certified', align: 'center'},
      ],
      searchData: {
        name: '',
        code: '',
        department_id: null,
        product_type_id: null,
        standard_id: null,
        is_certified: null,
      }
    }
  },
  methods: {
    search() {
      this.$inertia.reload({
        data: {
          name: this.searchData.name,
          code: this.searchData.code,
          department_id: this.searchData.department_id,
          product_type_id: this.searchData.product_type_id,
          standard_id: this.searchData.standard_id,
          is_certified: this.searchData.is_certified
        },
        only: ['tableData'],
      })
    }
  }
}
</script>