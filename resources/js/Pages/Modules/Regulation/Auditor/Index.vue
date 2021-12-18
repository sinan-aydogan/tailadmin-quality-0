<template>
  <app-layout>
    <!--Header-->
    <template #header>Auditors</template>
    <template #subHeader>Management of the staff of the audit firms</template>
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
          <grid-section :col-tablet="3">
            <!--Staff Name-->
            <t-input-group
                label="Person Name"
            >
              <t-input-text
                  v-model="searchData.name"
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

              <!--Firm-->
              <t-input-group
                  label="Firm"
              >
                  <t-input-select
                      v-model="searchData.audit_firm_id"
                      :clear-button="true"
                      :options="searchDataFirm"
                      :search="true"
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
          <t-action-buttons-index model="auditor"/>
        </template>
        <!--Status-->
        <template #status="{props}">
          <t-badge :color="status.find( s => s.id === props.status ).color">
            {{ status.find( s => s.id === props.status ).name }}
          </t-badge>
        </template>
      </t-table>
    </template>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import TTable from "@/Components/Table/TTable";
import TActionButtonsIndex from "@/Components/Button/ActionButtonsIndex";
import TInputGroup from "@/Components/Form/TInputGroup";
import TInputText from "@/Components/Form/Inputs/TInputText";
import TInputSelect from "@/Components/Form/Inputs/TInputSelect";
import GridSection from "@/Layouts/GridSection";
import TBadge from "@/Components/Badge/TBadge";
import {AuditorConsts} from "@/Mixins/SectionConsts/AuditorConsts";

export default {
  name: "Index",
  components: {
    TBadge,
    GridSection,
    TInputSelect,
    TInputText,
    TInputGroup,
    TActionButtonsIndex,
    TTable,
    AppLayout
  },
  mixins: [AuditorConsts],
  props: {
    tableData: {
      type: Object
    },
    searchDataFirm : {
      type: Array
    }
  },
  data() {
    return {
      tableHeaders: [
        {label: 'Person Name', key: 'name', align: 'left'},
        {label: 'Firm', key: 'firm_name', align: 'left'},
        {label: 'Title', key: 'title', align: 'left'},
        {label: 'Email', key: 'email', align: 'left'},
        {label: 'Phone', key: 'phone', align: 'left'},
        {label: 'Status', key: 'status', align: 'center'},
      ],
      searchData: {
        name: '',
        audit_firm_id: null,
        email: '',
        phone: '',
        status: null,
      }
    }
  },
  methods: {
    search() {
      this.$inertia.reload({
        data: {
          name: this.searchData.name,
          audit_firm_id: this.searchData.audit_firm_id,
          email: this.searchData.email,
          phone: this.searchData.phone,
          status: this.searchData.status,
        },
        only: ['tableData'],
      })
    }
  }
}
</script>
