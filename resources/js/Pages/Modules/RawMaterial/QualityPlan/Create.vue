<template>
  <app-layout :action-buttons="true">
    <!--Header-->
    <template #header>Create New Raw Material Quality Plan</template>
    <template #subHeader
    >You can new raw material quality plan for your company
    </template
    >
    <!--Action Buttons-->
    <template #action-buttons>
      <t-action-buttons-create model="raw-material-quality-plan"/>
      <t-button
          color="solid-yellow"
          type="button"
          @click.native="showSpectList = !showSpectList"
      >
        <t-collection-icon class="w-5 h-5"/>
        Spect Inventory
      </t-button>
    </template>
    <template #default>
      <t-form-content @reset="reset" @submitted="save()">
        <!--Product Info-->
        <t-form-section
            description="You going to determine your raw material's quality spects"
            title="Raw Material Infos"
        >
          <grid-section :col-tablet="2">
            <!-- Plan Code -->
            <t-input-group
                :error="error.code"
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
                  @input="departmentChange(); form.raw_material_id = null"
              />
            </t-input-group>

            <!--Related Raw Material-->
            <t-input-group
                :error="
                    form.department_id === null ?
                    '<span class=\'text-yellow-500\'>Please firstly select a department</span>' :
                    error.raw_material_id"
                label="Related Raw Material"
            >
              <t-input-select
                  id="raw_material_id"
                  v-model="form.raw_material_id"
                  :clear-button="true"
                  :disabled="form.department_id === null"
                  :options="rawMaterials"
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
                :options="spects.data"
                class="w-full"
                options-label-key="name"
                options-value-key="id"
                place-holder="Select a spect"
            />

            <t-input-select
                v-model="item.limit_type_id"
                :clear-button="true"
                :options="limit_type"
                class="w-full"
                options-label-key="name"
                options-value-key="id"
                place-holder="Select a limit type"
            />


            <t-input-select
                v-model="item.rule_id"
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
      <!--Spect List-->
      <t-modal
          :show="showSpectList"
          color="solid-white"
          @close="showSpectList = $event"
      >
        <template #header>
          Spect Management
        </template>
        <template #content>
          <t-table
              :content="spects.data"
              :header="spectHeader"
              :pagination="true"
              :searchable-keys="['name']"
              :shadow="false"
              :zebra="false"
              color="solid-gray"
          >
            <template #spect_type="{props}">
              <div v-for="item in props.spect_type" class="mr-2">
                <t-tooltip v-if="spect_type.findIndex( s => s.id === props.spect_type )" class="bg-white px-2 rounded-md"
                           position="right">
                  <template #mainContent>
                    {{ item === 1 ? 'P' : 'RM' }}
                  </template>
                  <template #secondContent>
                    {{ spect_type[spect_type.findIndex(s => s.id === item)].name }}
                  </template>
                </t-tooltip>
              </div>
            </template>
          </t-table>
          <t-button class="mt-2 w-full" size="sm" @click.native="showSpectList=false;showSpectForm=true">
            <t-plus-icon class="w-5 h-5"/>
            Add new spect
          </t-button>
        </template>
      </t-modal>
      <!--Spect Form-->
      <t-modal
          :show="showSpectForm"
          color="solid-white"
          @close="showSpectForm = $event"
      >
        <template #header>
          Add new spect
        </template>
        <template #content>
          <form @submit.prevent="spectSave">
            <grid-section :col="1">
              <!--Spect Name-->
              <t-input-group
                  :error="spectError.name"
                  label="Spect Name"
              >
                <t-input-text
                    id="spect_name"
                    v-model="spectForm.name"
                />
              </t-input-group>

              <!--Unit-->
              <t-input-group
                  :error="spectError.unit"
                  label="Unit"
              >
                <t-input-text
                    id="spect_unit"
                    v-model="spectForm.unit"
                />
              </t-input-group>

              <!--Spect Type-->
              <t-input-group
                  :error="spectError.spect_type"
                  label="Type"
              >
                <t-input-multi-select
                    id="spect_spect_type"
                    v-model="spectForm.spect_type"
                    :options="spect_type"
                    options-label-key="name"
                    options-value-key="id"
                />
              </t-input-group>

              <!--Related Departments-->
              <t-input-group
                  :error="spectError.department_id"
                  label="Related Departments"
              >
                <t-input-multi-select
                    id="spect_department_id"
                    v-model="spectForm.department_id"
                    :clear-button="true"
                    :options="generalDepartments"
                    class="flex-grow-0"
                    options-label-key="name"
                    options-value-key="id"
                />
              </t-input-group>

              <!--Related Standards-->
              <t-input-group
                  :error="spectError.standard_id"
                  label="Related Standards"
              >
                <t-input-multi-select
                    id="spect_standard_id"
                    v-model="spectForm.standard_id"
                    :clear-button="true"
                    :options="standards"
                    options-label-key="name"
                    options-value-key="id"
                />
              </t-input-group>
              <t-button color="solid-green" type="submit">Submit</t-button>
            </grid-section>
          </form>
        </template>
        <template #footer-left>
          <t-button class="mt-2 col-span-full" size="sm">
            <t-plus-icon class="w-5 h-5"/>
            Save
          </t-button>
        </template>
      </t-modal>
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
import TCollectionIcon from "@/Components/Icon/TCollectionIcon";
import TModal from "@/Components/Modal/TModal";
import TPlusIcon from "@/Components/Icon/TPlusIcon";
import TInputMultiSelect from "@/Components/Form/Inputs/TInputMultiSelect";
import TTooltip from "@/Components/Tooltip/TTooltip";


export default {
  name: "Create",
  components: {
    TTooltip,
    TInputMultiSelect,
    TPlusIcon,
    TModal,
    TCollectionIcon,
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
    generalDepartments: {
      type: Array
    },
    standards: {
      type: Array
    },
    rawMaterials: {
      type: Array
    },
    spects: {
      type: Object
    }
  },
  data() {
    return {
      showSpectList: false,
      showSpectForm: false,
      loading: false,
      error: {},
      spectError: {},
      spectHeader: [
        {key: 'name', label: 'Spect', align: 'left'},
        {key: 'unit', label: 'Unit', align: 'center'},
        {key: 'spect_type', label: 'Type', align: 'center'},
        {key: 'department_name', label: 'Department', align: 'center'},
        {key: 'standard_code', label: 'Standard', align: 'center'},
      ],
      form: this.$inertia.form({
        _method: 'POST',
        code: null,
        department_id: null,
        raw_material_id: null,
        spects: [
          {
            spect_id: null,
            limit_type_id: null,
            rule_id: null,
            value: null
          }
        ]
      }),
      spectForm: this.$inertia.form({
        _method: 'POST',
        name: null,
        unit: null,
        spect_type: [],
        department_id: [],
        standard_id: []
      }),
    }
  },
  methods: {
    reset: function () {
      this.form.reset()
    },
    spectReset: function () {
      this.spectForm.reset()
    },
    save() {
      //TODO Multi field validation for Spects
      this.form.code === null ? this.$set(this.error, 'code', 'Code is required') : this.$delete(this.error, 'code');
      this.form.department_id === null ? this.$set(this.error, 'department_id', 'Department is required') : this.$delete(this.error, 'department_id');
      this.form.raw_material_id === null ? this.$set(this.error, 'raw_material_id', 'Product is required') : this.$delete(this.error, 'raw_material_id');

      if (Object.keys(this.error).length === 0) {
        this.form.post(route('raw-material-quality-plan.store'), {
          errorBag: 'raw-material-quality-plan',
          preserveScroll: true,
        });
        this.reset();
        this.loading = true;
      }
    },
    spectSave() {
      this.spectForm.name === null ? this.$set(this.spectError, 'name', 'Name is required') : this.$delete(this.spectError, 'name');
      this.spectForm.spect_type.length === 0 ? this.$set(this.spectError, 'spect_type', 'Type is required') : this.$delete(this.spectError, 'spect_type');
      this.spectForm.department_id.length === 0 ? this.$set(this.spectError, 'department_id', 'Department is required') : this.$delete(this.spectError, 'department_id');

      if (Object.keys(this.spectError).length === 0) {
        this.spectForm.post(route('quality-spect.store'), {
          errorBag: 'quality-spect',
          preserveScroll: true,
          onSuccess: () => [this.loading=false, this.showSpectForm = false],
        });
        this.spectReset();
        this.loading = true;
      }
    },
    cloneRow() {
      this.form.spects.push({
        spect_id: null,
        limit_type_id: null,
        rule_id: null,
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
        only: ['rawMaterials'],
      })
    },
    changeOrder($event, index, direction) {
      let item = this.form.spects[index];
      if (direction === 'up' && index > 0) {
        this.form.spects.splice(index, 1);
        this.form.spects.splice(index - 1, 0, item);
      }

      if (direction === 'down' && this.form.spects.length > index) {
        this.form.spects.splice(index, 1);
        this.form.spects.splice(index + 1, 0, item);
      }
    },
  },
}
</script>
