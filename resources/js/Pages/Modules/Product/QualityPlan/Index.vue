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
          :searchable-keys="['code']"
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
        <template #product_spects="{props}">
          <div class="flex flex-col cursor-pointer" @click="spectModalController(props)">
            <t-clipboard-icon class="w-6 h-6 text-blue-400 hover:text-gray-700"/>
          </div>
        </template>
      </t-table>

      <!--Quality Spects List Modal-->
      <t-modal :show="showSpectModal" @close="showSpectModal = $event ">
        <template #header>
          {{ selectedProduct.product_name + ' (' +selectedProduct.code + ')' }}
          <br>
          <span class="text-base">Quality Spects</span>
        </template>
        <template #content>
          <t-table
              :content="selectedProduct.product_spects"
              :header="[
                  {key:'quality_spect', label: 'Spect'},
                  {key:'rule_id', label: 'Rule',align: 'center'},
                  {key:'limit_type_id', label: 'Limit Type',align: 'center'},
                  {key:'value', label: 'Value',align: 'center'}
                  ]"
              :searchable-keys="[['quality_spect','name']]"
              :shadow="true"
              :zebra="true"
              class="-mt-4"
              color="solid-blue"
          >
            <!--Spect Name-->
            <template #quality_spect="{props}">
              {{ props.quality_spect.name }}
            </template>

            <!--Rule-->
            <template #rule_id="{props}">
              {{ rule[rule.findIndex(s => s.id === props.rule_id)].name }}
            </template>

            <!--Limit Type-->
            <template #limit_type_id="{props}">
              {{ limit_type[limit_type.findIndex(s => s.id === props.limit_type_id)].name }}
            </template>
          </t-table>
        </template>
      </t-modal>
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
import TModal from "@/Components/Modal/TModal";
import TInformationIcon from "@/Components/Icon/TInformationIcon";
import {QualitySpectConsts} from "@/Mixins/SectionConsts/QualitySpectConsts";
import TClipboardIcon from "@/Components/Icon/TClipboardIcon";

export default {
  name: "Index",
  components: {
    TClipboardIcon,
    TInformationIcon,
    TModal,
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
  mixins: [QualitySpectConsts],
  data() {
    return {
      showSpectModal: false,
      selectedProduct: {},
      tableHeaders: [
        {label: 'Plan Code', key: 'code', align: 'left'},
        {label: 'Product', key: 'product_name', align: 'left'},
        {label: 'Department', key: 'department_name', align: 'left'},
        {label: 'Spects', key: 'product_spects', align: 'center'},
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
    },
    spectModalController(product) {
      this.selectedProduct = product;
      this.showSpectModal = !this.showSpectModal;
    }
  }
}
</script>
