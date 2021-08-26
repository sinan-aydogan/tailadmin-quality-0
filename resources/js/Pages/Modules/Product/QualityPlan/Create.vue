<template>
  <app-layout :action-buttons="true">
    <!--Header-->
    <template #header>Create New Product Quality Plan</template>
    <template #subHeader
    >You can new product quality plan for your company
    </template
    >
    <!--Action Buttons-->
    <template #action-buttons>
      <t-action-buttons-create model="product-quality-plan"/>
    </template>
    <template #default>
      <t-form-content @reset="reset" @submitted="save()">
        <!--Product Info-->
        <t-form-section
            description="You going to determine your product's quality spects"
            title="Product Infos"
        >
          <grid-section :col-tablet="2">
            <!-- Plan Code -->
            <t-input-group
                :error="form.code"
                class="col-span-full"
                label="Plan Code"
            >
              <t-input-text
                  id="code"
                  v-model="form.code"
              />
            </t-input-group>

            <!--Related Department-->
            <t-input-group
                :error="error.department_id"
                label="Related Department"
            >
              <t-input-select
                  id="department_id"
                  v-model="form.department_id"
                  :clear-button="true"
                  :options="departments"
                  :search="true"
                  options-label-key="name"
                  options-value-key="id"
                  place-holder="Select a department"
                  @input="departmentChange(); form.product_id = null"
              />
            </t-input-group>

            <!--Related Product-->
            <t-input-group
                :error="
                    form.department_id === null ?
                    '<span class=\'text-yellow-500\'>Please firstly select a department</span>' :
                    error.product_id"
                label="Related Product"
            >
              <t-input-select
                  id="product_id"
                  v-model="form.product_id"
                  :clear-button="true"
                  :disabled="form.department_id === null"
                  :options="products"
                  :search="true"
                  options-label-key="name"
                  options-value-key="id"
                  place-holder="Select a product"
              />
            </t-input-group>
          </grid-section>
        </t-form-section>
        <t-form-section
            description="You ara going to determine the spects of quality for this product"
            title="Quality Spects"
        >

          <div v-for="(item,index) in form.spects"
               class="flex justify-between items-center w-full col-span-full border rounded-lg h-16 px-4 gap-4 fade"
          >


            <div class="flex items-center justify-center gap-4">
              <!--Order-->
              <span
                  class="font-semibold border rounded-full w-6 h-6 items-center text-center border-gray-400 text-gray-500">
                {{ index + 1 }}
              </span>
              <!--Moving Buttons-->
              <div class="flex flex-col">
                <t-chevron-up-icon v-if="index !==0"
                                   class="w-5 h-5 cursor-pointer hover:bg-green-200 rounded-full p-0.5"
                                   @click.native="changeOrder($event, index,'up')"/>
                <t-chevron-down-icon v-if="form.spects.length-1!==index"
                                     class="w-5 h-5 cursor-pointer hover:bg-yellow-200 rounded-full p-0.5"
                                     @click.native="changeOrder($event, index,'down')"/>
              </div>
            </div>
            <t-input-select
                v-model="item.spect_id"
                :clear-button="true"
                :options="spects"
                class="w-full"
                options-label-key="name"
                options-value-key="id"
                place-holder="Select a spect"
            />

            <t-input-select
                v-model="item.limit_type"
                :clear-button="true"
                :options="limit_type"
                class="w-full"
                options-label-key="name"
                options-value-key="id"
                place-holder="Select a limit type"
            />


            <t-input-select
                v-model="item.rule"
                :clear-button="true"
                :options="rule"
                class="w-full"
                options-label-key="name"
                options-value-key="id"
                place-holder="Select a rule"
            />


            <t-input-text
                v-model="item.value"
                placeholder="Value"
            />


            <t-button color="solid-red" @click.native="deleteRow(index)">
              <t-trash-icon class="w-5 h-5"/>
            </t-button>
          </div>
          <t-button
              class="col-span-full"
              color="solid-green"
              type="button"
              @click.native="cloneRow"

          >
            <t-plus-circle-icon class="w-5 h-5"/>
            Add new spect
          </t-button>

        </t-form-section>
      </t-form-content>
      <t-loading-screen v-if="loading"/>
    </template>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import GridSection from "@/Layouts/GridSection";
import TActionButtonsCreate from "@/Components/Button/ActionButtonsCreate";
import TBadge from "@/Components/Badge/TBadge";
import TFingerPrintIcon from "@/Components/Icon/TFingerPrintIcon";
import TFormContent from "@/Components/Form/TFormContent";
import TFormSection from "@/Components/Form/TFormSection";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TInputTextArea from "@/Components/Form/Inputs/TInputTextArea";
import TLoadingScreen from "@/Components/Misc/TLoadingScreen";
import TInputFile from "@/Components/Form/Inputs/TInputFile";
import {QualitySpectConsts} from "@/Mixins/SectionConsts/QualitySpectConsts";
import TTable from "@/Components/Table/TTable";
import TButton from "@/Components/Button/TButton";
import TCheckCircleIcon from "@/Components/Icon/TCheckCircleIcon";
import TPlusCircleIcon from "@/Components/Icon/TPlusCircleIcon";
import TTrashIcon from "@/Components/Icon/TTrashIcon";
import TChevronUpIcon from "@/Components/Icon/TChevronUpIcon";
import TChevronDownIcon from "@/Components/Icon/TChevronDownIcon";


export default {
  name: "Create",
  components: {
    TChevronDownIcon,
    TChevronUpIcon,
    TTrashIcon,
    TPlusCircleIcon,
    TCheckCircleIcon,
    TButton,
    TTable,
    TInputFile,
    AppLayout,
    GridSection,
    TActionButtonsCreate,
    TBadge,
    TFormContent,
    TFormSection,
    TInputGroup,
    TInputSelect,
    TInputText,
    TInputTextArea,
    TLoadingScreen,
    TFingerPrintIcon
  },
  mixins: [QualitySpectConsts],
  props: {
    departments: {
      type: Array
    },
    products: {
      type: Array
    },
    spects: {
      type: Array
    }
  },
  data() {
    return {
      loading: false,
      error: {},
      tableHeader: [
        {key: 'spect_id', label: 'Spect', position: '', width: '35'},
        {key: 'limit_type', label: 'Limit Type', position: '', width: '20'},
        {key: 'rule', label: 'Rule', position: '', width: '20'},
        {key: 'value', label: 'Value', position: '', width: '20'},
        {key: 'action', label: 'Action', position: 'center', width: '5'},
      ],
      tableContent: [
        {
          spect_id: null,
          limit_type: null,
          rule: null,
          value: null,
          action: null,
        }
      ],
      form: this.$inertia.form({
        _method: 'POST',
        code: null,
        department_id: null,
        product_id: null,
        spects: [
          {
            spect_id: null,
            limit_type: null,
            rule: null,
            value: null
          }
        ]
      }),
    }
  },
  methods: {
    reset: function () {
      this.form.code = null;
      this.form.department_id = null;
      this.form.product_id = null;
    },
    save() {
      this.form.code === null ? this.$set(this.error, 'code', 'Code is required') : this.$delete(this.error, 'code');
      this.form.department_id === null ? this.$set(this.error, 'department_id', 'Department is required') : this.$delete(this.error, 'department_id');
      this.form.product_id === null ? this.$set(this.error, 'product_id', 'Product is required') : this.$delete(this.error, 'product_id');

      console.log(Object.keys(this.error).length)
      console.log(this.error)
      if (Object.keys(this.error).length === 0) {
        this.form.post(route('product-quality-plan.store'), {
          errorBag: 'product-quality-plan',
          preserveScroll: true,
        });
        this.reset();
        this.loading = true;
      }
    },
    cloneRow() {
      this.form.spects.push({
        spect_id: null,
        limit_type: null,
        rule: null,
        value: null
      })
    },
    deleteRow(index) {
      this.form.spects.splice(index, 1)
    },
    departmentChange() {
      this.$inertia.reload({
        method: 'get',
        data: {
          department_id: this.form.department_id,
        },
        replace: true,
        preserveState: true,
        preserveScroll: true,
        only: ['products'],
      })
    },
    changeOrder($event, index, direction) {
      let item = this.form.spects[index];
      if (direction === 'up' && index > 0) {
        console.log('çalıştı')
        this.form.spects.splice(index, 1);
        this.form.spects.splice(index - 1, 0, item);
      }

      if (direction === 'down' && this.form.spects.length > index) {
        this.form.spects.splice(index, 1);
        this.form.spects.splice(index + 1, 0, item);
      }
    },
  }
}
</script>