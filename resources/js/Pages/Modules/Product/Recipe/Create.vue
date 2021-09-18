<template>
    <app-layout :action-buttons="true">
        <!--Header-->
        <template #header>Create New Product Recipe</template>
        <template #subHeader
        >You can new product recipe for your company
        </template
        >
        <!--Action Buttons-->
        <template #action-buttons>
            <t-action-buttons-create model="recipe"/>
        </template>
        <template #default>
            <t-form-content @reset="reset" @submitted="save()">
                <!--Recipe Info-->
                <t-form-section
                    title="Recipe Infos"
                >
                    <grid-section :col-tablet="2">
                        <!-- Recipe Code -->
                        <t-input-group
                            :error="error.code"
                            label="Recipe Code"
                        >
                            <t-input-text
                                id="code"
                                v-model="form.code"
                            />
                        </t-input-group>

                        <!--Recipe Amount-->
                        <t-input-group
                            label="Recipe Amount"
                        >
                            <t-input-text
                                v-model="form.recipe_amount"
                                placeholder="1 tons"
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
                <!--Recipe Items Form-->
                <t-form-section
                    description="You ara going to determine the raw materials and amounts in the production recipe"
                    title="Recipe Materials"
                    class="relative"
                >
                    <div class="relative col-span-full">
                        <grid-section
                            :col-tablet="3"
                            :class="rawMaterials.length===form.recipeItems.length  && form.recipeItems.length>0 && 'opacity-20'"
                        >
                            <!--Recipe Item-->
                            <t-input-group
                                label="Raw Material"
                                :error="
                                form.department_id === null ?
                                '<span class=\'text-yellow-500\'>Please firstly select a department</span>' :
                                recipeItemError.raw_material_id"
                            >
                                <t-input-select
                                    v-model="recipeItemForm.raw_material_id"
                                    :disabled="form.department_id === null"
                                    :clear-button="true"
                                    :options="unSelectedrecipeItems"
                                    :search="true"
                                    class="w-full"
                                    options-label-key="name"
                                    options-value-key="id"
                                    place-holder="Select a raw material"
                                />
                            </t-input-group>

                            <!--Recipe Item Amount Value-->
                            <t-input-group
                                label="Amount"
                            >
                                <t-input-text
                                    v-model="recipeItemForm.amount"
                                    placeholder="Value"
                                />
                            </t-input-group>
                            <!--Recipe Item Amount Type-->
                            <t-input-group
                                label="Unit"
                            >
                                <t-input-select
                                    v-model="recipeItemForm.unit"
                                    :clear-button="true"
                                    :options="recipeAmounts"
                                    class="w-full"
                                    options-label-key="name"
                                    options-value-key="id"
                                    place-holder="Select a unit"
                                />
                            </t-input-group>
                        </grid-section>
                        <!--TODO: Düğmelere disabled özelliği gelince yeniden düzenle-->
                        <t-button
                            :class="[
                                'w-full -mt-2',
                                rawMaterials.length===form.recipeItems.length && form.recipeItems.length>0 && 'opacity-20'
                                ]"
                            :color="recipeItemForm.raw_material_id === null || recipeItemForm.amount === null || recipeItemForm.unit === null ? 'light-white' : 'solid-green'"
                            :disabled="recipeItemForm.raw_material_id === null || recipeItemForm.amount === null || recipeItemForm.unit === null || form.recipeItems.length === rawMaterials.length"
                            type="button"
                            @click.native="addItem"
                        >
                            <t-plus-circle-icon class="w-5 h-5"/>
                            Add new raw material to recipe
                        </t-button>
                        <div
                            v-if="rawMaterials.length===form.recipeItems.length && form.recipeItems.length>0"
                            class="absolute flex border justify-center items-center gap-2 left-0 top-0 h-full w-full bg-yellow-100 rounded-md bg-opacity-50">
                            <t-information-circle-icon class="w-5 h-5"/>
                            You added all of the raw materials, if you want to change any data, firstly please delete it
                        </div>
                    </div>
                </t-form-section>
                <!--Empty List Message-->
                <div v-if="form.recipeItems.length===0"
                     :class="[
                     'flex m-4 p-2 gap-2 justify-center border items-center rounded-md text-gray-600',
                     error.recipeItems ? 'bg-red-100 border-red-300' : 'bg-yellow-100 border-yellow-300'
                     ]">
                    <t-information-circle-icon class="w-5 h-5"/>
                    <span v-if="!error.recipeItems">Your recipe item's list is empty, Let's add something from up</span>
                    <span v-else>{{error.recipeItems}}</span>
                </div>
                <!--Recipe List-->
                <div v-else>
                    <div class="m-4">
                        <transition-group name="fade">
                            <div v-for="(item,index) in form.recipeItems"
                                 :key="item.raw_material_id"
                                 :class="[
                             'flex justify-between items-center h-14 pl-2 pr-4',
                             'odd:bg-gray-100 odd:border',
                             'even:bg-gray-50 even:border-r even:border-l',
                             'first:rounded-t-lg',
                             'last:rounded-b-lg last:border-b',
                             ]"
                            >
                                <div class="flex items-center justify-center">
                                    <!--Order-->
                                    <span
                                        class="font-semibold px-4 border-r">
                                {{ index + 1 }}
                            </span>
                                    <!--Moving Buttons-->
                                    <div class="flex flex-col px-4">
                                        <t-chevron-up-icon v-if="index !==0"
                                                           class="w-5 h-5 cursor-pointer hover:bg-green-200 rounded-full p-0.5"
                                                           @click.native="changeOrder($event, index,'up')"/>
                                        <t-chevron-down-icon v-if="form.recipeItems.length-1!==index"
                                                             class="w-5 h-5 cursor-pointer hover:bg-yellow-200 rounded-full p-0.5"
                                                             @click.native="changeOrder($event, index,'down')"/>
                                    </div>
                                </div>
                                <span
                                    class="flex w-2/3">{{
                                        rawMaterials.find(rm => rm.id === item.raw_material_id).name
                                    }}</span>
                                <div class="flex w-1/3">
                                    <span class="flex w-full">{{ item.amount }}</span>
                                    <span
                                        class="flex w-full">{{
                                            recipeAmounts.find(rm => rm.id === item.unit).name
                                        }}</span>
                                </div>
                                <div
                                    class="text-red-500 cursor-pointer hover:bg-red-500 hover:text-white rounded-full p-1"
                                    @click="deleteRow(index)">
                                    <t-trash-icon class="w-5 h-5"/>
                                </div>
                            </div>
                        </transition-group>
                    </div>
                </div>
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
import TInformationCircleIcon from "@/Components/Icon/TInformationCircleIcon";


export default {
    name: "Create",
    components: {
        TInformationCircleIcon,
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
        products: {
            type: Array
        },
        rawMaterials: {
            type: Array
        },
        recipeAmounts: {
            type: Array
        }
    },
    data() {
        return {
            unSelectedrecipeItems: [...this.rawMaterials],
            loading: false,
            error: {},
            recipeItemError: {},
            recipeItemForm: {
                raw_material_id: null,
                amount: null,
                unit: null,
            },
            form: this.$inertia.form({
                _method: 'POST',
                code: null,
                department_id: null,
                product_id: null,
                recipe_amount: null,
                recipeItems: []
            }),
        }
    },
    methods: {
        reset: function () {
            this.form.reset()
        },
        recipeItemFormReset(){
          this.recipeItemForm.raw_material_id  = null;
          this.recipeItemForm.amount  = null;
          this.recipeItemForm.unit  = null;
        },
        save() {
            //TODO Multi field validation for recipeItems
            this.form.code === null ? this.$set(this.error, 'code', 'Code is required') : this.$delete(this.error, 'code');
            this.form.recipe_amount === null ? this.$set(this.error, 'recipe_amount', 'Recipe amount is required') : this.$delete(this.error, 'recipe_amount');
            this.form.department_id === null ? this.$set(this.error, 'department_id', 'Department is required') : this.$delete(this.error, 'department_id');
            this.form.product_id === null ? this.$set(this.error, 'product_id', 'Product is required') : this.$delete(this.error, 'product_id');
            this.form.recipeItems.length === 0 ? this.$set(this.error, 'recipeItems', 'Raw material/s is required') : this.$delete(this.error, 'recipeItems');

            if (Object.keys(this.error).length === 0) {
                this.form.post(route('recipe.store'), {
                    errorBag: 'recipe',
                    preserveScroll: true,
                });
                this.reset();
                this.loading = true;
            }
        },
        addItem() {
            this.form.recipeItems.push(Object.assign({}, this.recipeItemForm));
            this.unSelectedrecipeItems.splice(this.unSelectedrecipeItems.findIndex(rm => rm.id === this.recipeItemForm.raw_material_id), 1)
            this.recipeItemFormReset();
        },
        deleteRow(index) {
            this.unSelectedrecipeItems.push(this.rawMaterials.find(rm => rm.id === this.form.recipeItems[index].raw_material_id))
            this.form.recipeItems.splice(index, 1)
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
                only: ['products', 'rawMaterials'],
            })
        },
        changeOrder($event, index, direction) {
            let item = this.form.recipeItems[index];
            if (direction === 'up' && index > 0) {
                this.form.recipeItems.splice(index, 1);
                this.form.recipeItems.splice(index - 1, 0, item);
            }

            if (direction === 'down' && this.form.recipeItems.length > index) {
                this.form.recipeItems.splice(index, 1);
                this.form.recipeItems.splice(index + 1, 0, item);
            }
        },
    },
    watch: {
        rawMaterials() {
            this.unSelectedrecipeItems = [...this.rawMaterials]
        }
    }
}
</script>
