<template>
    <app-layout>
        <template #header>Properties</template>
        <template #subHeader>Management of Properties</template>
        <initial-vertical-menu :menu="menuList"/>

        <!--Property Table-->
        <t-table
            :content="tableData"
            :header="propertyHeaders"
            :searchable-keys="['name']"
            :pagination="true"
            class="mt-4"
        >
            <template #search>
                <grid-section :col-tablet="3">

                    <!--Name-->
                    <t-input-group
                        label="Property Name"
                    >
                        <t-input-text
                            v-model="searchPropertyData.name"
                            @input="search"
                        />
                    </t-input-group>

                    <!--Type-->
                    <t-input-group
                        label="Property Type"
                    >
                        <t-input-select
                            v-model="searchPropertyData.property_type_id"
                            :clear-button="true"
                            :options="propertyTypes"
                            :search="true"
                            options-label-key="name"
                            options-value-key="id"
                            @input="search"
                        />
                    </t-input-group>

                    <!--Module-->
                    <t-input-group
                        label="Related Module"
                    >
                        <t-input-select
                            v-model="searchPropertyData.module_id"
                            :clear-button="true"
                            :options="calculatedModules"
                            :search="true"
                            options-label-key="name"
                            options-value-key="id"
                            @input="search"
                        />
                    </t-input-group>
                </grid-section>
            </template>
            <template #right>
                <t-button
                    color="solid-green"
                    type="button"
                    @click.native="showPropertyForm = true"
                >
                    <t-plus-icon class="w-5 h-5"/>
                    Add New Property
                </t-button>
                <t-button
                    color="solid-yellow"
                    type="button"
                    @click.native="showPropertyTypeList = true"
                >
                    <t-collection-icon class="w-5 h-5"/>
                    Property Type Management
                </t-button>
            </template>
            <template #id="{props}">
                <t-dropdown align="right" size="fit">
                    <template #trigger>
                        <t-dots-vertical-icon class="w-6 h-6 cursor-pointer"/>
                    </template>
                    <!--Delete User-->
                    <t-list :radius="3">
                        <t-list-item class="hover:bg-red-100 hover:text-red-500 cursor-pointer"
                                     @click.native="showDeleteModal(selectedItem.itemType = 'property',selectedItem.id = props.id)">
                            <div class="inline-flex items-center">
                                <t-trash-icon class="w-5 h-5"/>
                                Delete
                            </div>
                        </t-list-item>
                        <t-list-item class="hover:bg-blue-100 hover:text-blue-500 cursor-pointer"
                                     @click.native="editProperty(selectedProperty = props.id)">
                            <div class="inline-flex items-center">
                                <t-pencil-alt-icon class="w-5 h-5"/>
                                Edit
                            </div>
                        </t-list-item>
                    </t-list>
                </t-dropdown>
            </template>
            <template #property_type_id="{props}">
                {{propertyTypes.find(pt=>pt.id === props.property_type_id).name}}
            </template>
            <template #module_id="{props}">
                {{modules.find(m=>m.id === propertyTypes.find(pt=>pt.id === props.property_type_id).module_id).name}}
            </template>
        </t-table>
        <!--Content Delete Modal-->
        <t-modal style="z-index: 100" :show="showModal" @close="showModal = $event">
            <template #header>
                Property Deleting
            </template>
            <template #content>
                <span v-html="modalContent"></span>
            </template>
            <template #footer-left>
                <t-button color="light-green" @click.native="showModal = false">No, Nevermind</t-button>
            </template>
            <template #footer-right>
                <form id="delete" @submit.prevent="deleteItem()">

                    <t-button color="light-gray" type="submit">Yes, Delete</t-button>
                </form>
            </template>
        </t-modal>
        <!--Property Type Form Modal-->
        <t-modal
            :show="showPropertyTypeForm"
            color="solid-white"
            @close="showPropertyTypeForm = $event"
        >
            <template #header>
                Add new property type
            </template>
            <template #content>
                <form @submit.prevent="propertyTypeSave">
                    <grid-section :col="1">
                        <!--Related Section-->
                        <t-input-group
                            :error="propertyTypeError.module_id"
                            label="Related Section"
                        >
                            <t-input-select
                                id="property_type_id"
                                v-model="propertyTypeForm.module_id"
                                :options="modules"
                                options-label-key="name"
                                options-value-key="id"
                            />
                        </t-input-group>

                        <!--Property Type Name-->
                        <t-input-group
                            :error="propertyTypeError.name"
                            label="Property Type Name"
                        >
                            <t-input-text
                                id="property_type_name"
                                v-model="propertyTypeForm.name"
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
        <!--Property Type List-->
        <t-modal
            :show="showPropertyTypeList"
            color="solid-white"
            @close="showPropertyTypeList = $event"
        >
            <template #header>
                Property Type Management
            </template>
            <template #content>
                <t-table
                    :content="propertyTypes"
                    :header="propertyTypeHeaders"
                    :pagination="true"
                    :searchable-keys="['name']"
                    :shadow="false"
                    :zebra="false"
                    color="solid-gray"
                >
                    <template #id="{props}">
                        <t-dropdown align="right" size="fit">
                            <template #trigger>
                                <t-dots-vertical-icon class="w-6 h-6 cursor-pointer"/>
                            </template>
                            <!--Delete User-->
                            <t-list :radius="3">
                                <t-list-item class="hover:bg-red-100 hover:text-red-500 cursor-pointer"
                                             @click.native="showDeleteModal(selectedItem.itemType='propertyType',selectedItem.id = props.id)">
                                    <div class="inline-flex items-center">
                                        <t-trash-icon class="w-5 h-5"/>
                                        Delete
                                    </div>
                                </t-list-item>
                                <t-list-item class="hover:bg-blue-100 hover:text-blue-500 cursor-pointer"
                                             @click.native="editProperty(selectedPropertyType = props.id)">
                                    <div class="inline-flex items-center">
                                        <t-pencil-alt-icon class="w-5 h-5"/>
                                        Edit
                                    </div>
                                </t-list-item>
                            </t-list>
                        </t-dropdown>
                    </template>
                    <template #module_id="{props}">
                        {{modules.find(m=>m.id === propertyTypes.find(pt=>pt.id === props.id).module_id).name}}
                    </template>
                </t-table>
                <t-button class="mt-2 w-full" size="sm" @click.native="showPropertyTypeList=false;showPropertyTypeForm=true">
                    <t-plus-icon class="w-5 h-5"/>
                    Add New Property Type
                </t-button>
            </template>
        </t-modal>
        <!--Property Form Modal-->
        <t-modal
            :show="showPropertyForm"
            color="solid-white"
            @close="showPropertyForm = $event"
        >
            <template #header>
                Add new property
            </template>
            <template #content>
                <form @submit.prevent="propertySave">
                    <grid-section :col="1">
                        <!--Related Module-->
                        <t-input-group
                            :error="propertyError.module_id"
                            label="Related Module"
                        >
                            <t-input-select
                                id="property_type_id"
                                v-model="propertyForm.module_id"
                                :options="calculatedModules"
                                options-label-key="name"
                                options-value-key="id"
                                @input="moduleChange();propertyForm.property_type_id = null"
                            />
                        </t-input-group>

                        <!--Property Type-->
                        <t-input-group
                            :error="propertyError.property_type_id"
                            label="Type"
                        >
                            <t-input-select
                                id="property_type_id"
                                v-model="propertyForm.property_type_id"
                                :options="newPropertyTypes"
                                options-label-key="name"
                                options-value-key="id"
                                :disabled="!propertyForm.module_id"
                            />
                        </t-input-group>

                        <!--Property Name-->
                        <t-input-group
                            :error="propertyError.name"
                            label="Property Name"
                        >
                            <t-input-text
                                id="property_name"
                                v-model="propertyForm.name"
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

    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import InitialVerticalMenu from "@/Layouts/InitialVerticalMenu";
import {settingsMenuMixin} from "@/Mixins/settingsMenuMixin";
import {PropertyConsts} from "@/Mixins/SectionConsts/PropertyConsts";
import TTable from "@/Components/Table/TTable";
import TButton from "@/Components/Button/TButton";
import TTrashIcon from "@/Components/Icon/TTrashIcon";
import TPencilAltIcon from "@/Components/Icon/TPencilAltIcon";
import TDropdown from "@/Components/Dropdown/TDropdown";
import TDotsVerticalIcon from "@/Components/Icon/TDotsVerticalIcon";
import GridSection from "@/Layouts/GridSection";
import TDropdownItem from "@/Components/Dropdown/TDropdownItem";
import TList from "@/Components/List/TList";
import TListItem from "@/Components/List/TListItem";
import TModal from "@/Components/Modal/TModal";
import TPlusIcon from "@/Components/Icon/TPlusIcon";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import TCollectionIcon from "@/Components/Icon/TCollectionIcon";

export default {
    name: "SettingsProperty",
    components: {
        TCollectionIcon,
        TInputSelect,
        TInputText,
        TInputGroup,
        TPlusIcon,
        TModal,
        TListItem,
        TList,
        TDropdownItem,
        GridSection,
        TDotsVerticalIcon,
        TDropdown,
        TPencilAltIcon,
        TTrashIcon,
        TButton,
        TTable,
        InitialVerticalMenu,
        AppLayout
    },
    mixins: [settingsMenuMixin, PropertyConsts],
    props: {
        tableData: {
            type: Array
        },
        propertyTypes: {
            type: Array
        },
        /*For new property*/
        newPropertyTypes: {
            type: Array
        },
        newPropertyModules: {
            type: Array
        },
    },
    data() {
        return {
            /*Property Type*/
            showPropertyTypeForm: false,
            showPropertyTypeList:false,
            propertyTypeError : {},
            propertyTypeHeaders: [
                {key: 'name', label: 'Name', align: 'left'},
                {key: 'module_id', label: 'Module', align: 'left'},
                {key: 'id', label: 'Action', align: 'center'},
            ],
            propertyTypeForm: this.$inertia.form({
                id: null,
                name: '',
                module_id: null
            }),
            propertyTypeDeleteForm: this.$inertia.form({
                id: null
            }),
            /*Property*/
            showPropertyForm: false,
            propertyError : {},
            propertyHeaders: [
                {key: 'name', label: 'Name', align: 'left'},
                {key: 'property_type_id', label: 'Type', align: 'center'},
                {key: 'module_id', label: 'Module', align: 'center'},
                {key: 'id', label: 'Action', align: 'center'},
            ],
            propertyForm: this.$inertia.form({
                id: null,
                name: '',
                module_id: null,
                property_type_id: null
            }),
            propertyDeleteForm: this.$inertia.form({
                id: null
            }),
            searchPropertyData: {
                name: '',
                property_type_id: null,
                module_id: null
            },
            /*General*/
            selectedItem: {
                id: null,
                itemType: null,
            },
            showModal: false,
            modalContent: null,
        }
    },
    methods: {
        /*Property Type*/
        propertyTypeReset: function () {
            this.propertyTypeForm.reset()
        },
        propertyTypeSave() {
            this.propertyTypeForm.name === null ? this.$set(this.propertyTypeError, 'name', 'Name is required') : this.$delete(this.propertyTypeError, 'name');

            if (Object.keys(this.propertyTypeError).length === 0) {
                this.propertyTypeForm.post(route('settings-property-type.store'), {
                    errorBag: 'settings-property-type',
                    preserveScroll: true,
                    onSuccess: () => [this.loading = false, this.showPropertyTypeForm = false],
                });
                this.propertyTypeReset();
                this.loading = true;
            }
        },
        /*Property*/
        propertyReset: function () {
            this.propertyForm.reset()
        },
        propertySave() {
            this.propertyForm.name === '' ? this.$set(this.propertyError, 'name', 'Name is required') : this.$delete(this.propertyError, 'name');
            this.propertyForm.property_type_id === null ? this.$set(this.propertyError, 'property_type_id', 'Type is required') : this.$delete(this.propertyError, 'property_type_id');

            if (Object.keys(this.propertyError).length === 0) {
                this.propertyForm.post(route('settings-property.store'), {
                    errorBag: 'settings-property',
                    preserveScroll: true,
                    onSuccess: () => [this.loading = false, this.showPropertyForm = false],
                });
                this.propertyReset();
                this.loading = true;
            }
        },
        moduleChange() {
            this.$inertia.reload({
                method: 'get',
                data: {
                    new_module_id: this.propertyForm.module_id,
                },
                replace: true,
                preserveState: true,
                preserveScroll: true,
                only: ['newPropertyTypes','newPropertyModules'],
            })
        },
        /*General*/
        showDeleteModal() {
            let property;
            let propertyType;
            if(this.selectedItem.itemType === 'property'){
                this.tableData.forEach(item => {
                    if (item.id === this.selectedItem.id) {
                        property = item
                    }
                })
                this.modalContent = 'You are going to delete <b>' + property.name + '</b>, Are you sure ?'
            }else{
                this.propertyTypes.forEach(item => {
                    if (item.id === this.selectedItem.id) {
                        propertyType = item
                    }
                })
                this.modalContent = 'You are going to delete <b>' + propertyType.name + '</b>, Are you sure ?'
            }

            this.showModal = true
        },
        deleteItem() {
            if(this.selectedItem.itemType === 'property'){
                this.propertyDeleteForm.id = this.selectedItem.id;
                this.propertyDeleteForm.delete(route('settings-property.destroy', this.selectedItem.id), {
                    preserveScroll: true,
                    onSuccess: () => this.showModal = false,
                })
            }else{
                this.propertyTypeDeleteForm.id = this.selectedItem.id;
                this.propertyTypeDeleteForm.delete(route('settings-property-type.destroy', this.selectedItem.id), {
                    preserveScroll: true,
                    onSuccess: () => this.showModal = false,
                })
            }
        },
        editProperty(id) {

        },
        search() {
            this.$inertia.reload({
                data: {
                    name: this.searchPropertyData.name,
                    module_id: this.searchPropertyData.module_id,
                    property_type_id: this.searchPropertyData.property_type_id,
                },
                only: ['tableData'],
            })
        }
    },
    computed:{
        calculatedModules(){
            return this.modules.filter(m => this.newPropertyModules.includes(m.id));
        }
    }
}
</script>

<style scoped>

</style>
