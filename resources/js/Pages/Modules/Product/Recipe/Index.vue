<template>
  <app-layout>
    <!--Header-->
    <template #header>Products Recipes</template>
    <template #subHeader>All of product's recipes in your company</template>
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

            <!--Recipe Code-->
            <t-input-group
                label="Recipe Code"
            >
              <t-input-text
                  v-model="searchData.code"
                  @input="search"
              />
            </t-input-group>

            <!--Product-->
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
          <t-action-buttons-index model="recipe"/>
        </template>

        <!--Recipe Items-->
        <template #recipe_items="{props}">
          <div class="flex flex-col cursor-pointer" @click="recipeModalController(props)">
            <t-clipboard-icon class="w-6 h-6 text-blue-400 hover:text-gray-700"/>
          </div>
        </template>
      </t-table>

      <!--Recipe Items List Modal-->
      <t-modal :show="showRecipeModal" @close="showRecipeModal = $event ">
        <template #header>
          {{ selectedRecipe.product_name + ' (' +selectedRecipe.code + ')' }}
          <br>
          <span class="text-base">Recipe Items</span>
        </template>
        <template #content>
          <t-table
              :content="selectedRecipe.recipe_items"
              :header="[
                  {key:'raw_material', label: 'Raw Material',align: 'center'},
                  {key:'amount', label: 'Amount',align: 'center'},
                  {key:'unit', label: 'Unit',align: 'center'}
                  ]"
              :searchable-keys="[['raw_material','name']]"
              :shadow="true"
              :zebra="true"
              class="-mt-4"
              color="solid-blue"
          >
            <!--Recipe Item Name-->
            <template #raw_material="{props}">
              {{ props.raw_material.name }}
            </template>

            <!--Unit-->
            <template #unit="{props}">
              {{ recipeAmounts.find(ra=> ra.id === props.unit).name }}
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
    },
    recipeAmounts: {
      type: Array
    }
  },
  data() {
    return {
      showRecipeModal: false,
      selectedRecipe: {},
      tableHeaders: [
        {label: 'Recipe Code', key: 'code', align: 'left'},
        {label: 'Recipe Amount', key: 'recipe_amount', align: 'left'},
        {label: 'Product', key: 'product_name', align: 'left'},
        {label: 'Department', key: 'department_name', align: 'left'},
        {label: 'Recipe Items List', key: 'recipe_items', align: 'center'},
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
    recipeModalController(recipe) {
      this.selectedRecipe = recipe;
      this.showRecipeModal = !this.showRecipeModal;
    }
  }
}
</script>
