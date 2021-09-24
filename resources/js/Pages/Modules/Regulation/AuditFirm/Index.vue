<template>
    <app-layout>
        <!--Header-->
        <template #header>Audit Firms</template>
        <template #subHeader>All audit firms working with your company</template>
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
                        <!--Firm Name-->
                        <t-input-group
                            label="Firm Name"
                        >
                            <t-input-text
                                v-model="searchData.name"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Firm Type-->
                        <t-input-group
                            label="Firm Type"
                        >
                            <t-input-select
                                v-model="searchData.audit_firm_type_id"
                                :clear-button="true"
                                :options="firm_type"
                                options-label-key="name"
                                options-value-key="id"
                                @input="search"
                            />
                        </t-input-group>

                        <!--Email-->
                        <t-input-group
                            label="Email"
                        >
                            <t-input-text
                                v-model="searchData.email"
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

                        <!--Related Audit Types-->
                        <t-input-group
                            label="Related Audit Types"
                        >
                            <t-input-select
                                v-model="searchData.audit_type_id"
                                :clear-button="true"
                                :options="searchDataAuditType"
                                options-label-key="name"
                                options-value-key="id"
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
                    <t-action-buttons-index model="audit-firm"/>
                </template>
                <!--Firm Type-->
                <template #audit_firm_type_id="{props}">
                        {{firm_type.find(ft=>ft.id === props.audit_firm_type_id).name}}
                </template>

                <!--Related Audit Types-->
                <template #audit_types="{props}">
                        <div class="flex flex-col gap-2">
                            <t-badge v-for="(item,index) in props.audit_types" :key="index">
                                {{ item.name }}
                            </t-badge>
                        </div>
                </template>

                <!--Accreditation Numbers-->
                <template #local_accreditation_numbers="{props}">
                        <ul class="flex flex-col gap-2">
                            <t-popover position="left" v-for="(item,index) in props.local_accreditation_numbers" :key="index">
                                <template #mainContent>
                                    {{ item.value2 }}
                                </template>
                                <template #secondTitle>
                                    Subject
                                </template>
                                <template #secondContent>
                                    {{ item.value1 }}
                                </template>
                            </t-popover>
                        </ul>
                </template>

                <!--Status-->
                <template #status="{props}">
                    <t-badge :color="status.find(s=>s.id === props.status).color">
                        {{ status.find(s => s.id === props.status).name }}
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
import {AuditFirmConsts} from "@/Mixins/SectionConsts/AuditFirmConsts";
import TPopover from "@/Components/Popover/TPopover";

export default {
    name: "Index",
    components: {
        TPopover,
        AppLayout,
        GridSection,
        TActionButtonsIndex,
        TBadge,
        TInputGroup,
        TInputSelect,
        TInputText,
        TTable
    },
    mixins: [AuditFirmConsts],
    props: {
        tableData: {
            type: Object
        },
        searchDataAuditType: {
            type: Object
        }
    },
    data() {
        return {
            tableHeaders: [
                {label: 'Firm', key: 'name', align: 'left'},
                {label: 'Type', key: 'audit_firm_type_id', align: 'left'},
                {label: 'Notified Body Number', key: 'notified_body_number', align: 'center'},
                {label: 'Accreditation Numbers', key: 'local_accreditation_numbers', align: 'left'},
                {label: 'Related Audit Types', key: 'audit_types', align: 'left'},
                {label: 'Status', key: 'status', align: 'center'},
            ],
            searchData: {
                name: '',
                audit_firm_type_id: null,
                phone: null,
                email: null,
                audit_type_id: null,
                status: null
            }
        }
    },
    methods: {
        search() {
            this.$inertia.reload({
                data: {
                    name: this.searchData.name,
                    audit_firm_type_id: this.searchData.audit_firm_type_id,
                    phone: this.searchData.phone,
                    email: this.searchData.email,
                    status: this.searchData.status
                },
                only: ['tableData'],
            })
        }
    }
}
</script>
