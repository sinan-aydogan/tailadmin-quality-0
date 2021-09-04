<template>
  <div class="table-container">
    <!--Top Bar-->
    <div
        v-if="$slots.search || searchableKeys.length>0 || $slots.right"
        class="table-bar">
      <!--Top Bar Main Area-->
      <div
          class="table-top-container">
        <!--Left Area-->
        <div v-if="searchableKeys.length>0" class="table-top-left">
          <t-search-icon class="table-top-search-icon"/>
          <!--Search Box-->
          <input id="search"
                 v-model="search"
                 placeholder="Simple Search"
                 type="text"
                 @change="filteredContent">
          <!--PagedItem Count Selector-->
          <div v-if="pagination"
               :class="[
                   'table-top-pagination',
                   $slots.search ? 'right-11' : 'right-1 rounded-r-full'
                   ]"
               title="Paginated item count"
               @click="showPagedItemChooser = !showPagedItemChooser">
            {{ pagedItem }}
          </div>
          <transition name="fade">
            <div v-if="showPagedItemChooser"
                 :class="[
                   'table-top-pagination-ul',
                   $slots.search ? 'right-11' : 'right-2'
                   ]">
              <ul>
                <li v-for="i in 5" class="table-top-pagination-li"
                    @click="pagedItem = i*5; showPagedItemChooser=false">{{ i * 5 }}
                </li>
              </ul>
            </div>
          </transition>
          <!--Advanced Search Trigger-->
          <div
              v-if="$slots.search"
              class="absolute right-1 px-2 flex cursor-pointer bg-gray-200 hover:bg-blue-500 hover:text-white items-center rounded-r-full h-9 w-9"
              @click="showSearch = !showSearch">
            <t-adjustments class="w-5 h-5"/>
          </div>
        </div>
        <!--Right Area-->
        <div v-if="$slots.right" class="table-top-right">
          <slot name="right"/>
        </div>
      </div>
      <!--Advanced Search Area-->
      <transition name="fade">
        <div v-if="showSearch && $slots.search" class="table-advanced-search-area">
            <slot name="search"/>
        </div>
      </transition>
    </div>
    <!--Table-->
    <div :class="[
            'overflow-x-auto scrollbar scrollbar-thin ',
            calculatedTableStyle,
            ]">
      <table class="w-full">
        <!--Header-->
        <thead>
        <!--Header Row-->
        <tr :class="headerColors[color]">
          <!--Header Cell-->
          <th
              v-for="(item,index) in header"
              :key="index"
              :style="{width: item.width ? item.width+'%' : 'auto'}"
          >
            <div :class="[
                            'flex px-4 py-2',
                            item.align === 'right' ? 'justify-end' :
                            item.align === 'center' ? 'justify-center' :
                            'justify-start'
                            ]">
              {{ item.label }}
            </div>
          </th>
        </tr>
        </thead>
        <!--Content-->
        <tbody class="bg-white">
        <tr v-if="paginatedContent.length === 0">
          <td :class="noContentColors[color]" :colspan="header.length">
            <div>
              <font-awesome-icon icon="info-circle"/>
              Any record not found
            </div>
          </td>
        </tr>
        <!--Content Row-->
        <tr
            v-for="(item,index) in paginatedContent"
            :key="index"
            :class="[
                        'transition duration-300 ease-in-out',
                        contentColors[color],
                        zebra && index%2 === 0 ? 'bg-opacity-0' : 'bg-opacity-10',
                        paginatedContent.length > index+1 && border && 'border-b'
                        ]">
          <!--Content Cell-->
          <td v-for="i in header.length" :key="i" class="whitespace-normal">
            <div :class="[
                            'flex px-4 py-2',
                            header[i-1].align === 'right' ? 'justify-end' :
                            header[i-1].align === 'center' ? 'justify-center' :
                            'justify-start'
                        ]">
              <!--SlotScope Content-->
              <span
                  v-if="!$scopedSlots[header[i-1].key]"
                  v-html="item[header[i-1].key]"
              />
              <!--Simple Content-->
              <slot
                  v-else
                  :name="header[i-1].key"
                  :props="item"
              />

            </div>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <div v-if="filteredContent.length > pagedItem" class="flex py-4 justify-center">
      <t-paginate v-model="page" :color="paginationStyle" :range="5"
                  :total="Math.ceil(filteredContent.length/pagedItem)"/>
    </div>
  </div>
</template>

<script>
import InputText from "@/Components/Form/Inputs/TInputText"
import TAdjustments from "@/Components/Icon/TAdjustmentsIcon"
import TCollection from "@/Components/Icon/TCollectionIcon";
import TInputDropdown from "@/Components/Form/Inputs/TInputSelect";
import TInputDropdownItem from "@/Components/Form/Inputs/TInputSelectItem";
import TInputGroup from "@/Components/Form/TInputGroup";
import TPaginate from "@/Components/Paginate/TPaginate";
import TSearchCircle from "@/Components/Icon/TSearchCircleIcon";
import TSearchIcon from "@/Components/Icon/TSearchIcon";
import {faInfoCircle} from '@fortawesome/free-solid-svg-icons';
import {library} from '@fortawesome/fontawesome-svg-core';
import {tableStyleMixin} from "@/Mixins/Styles/tableStyleMixin";

library.add(faInfoCircle)

export default {
  name: "TTable",
  components: {
    InputText,
    TAdjustments,
    TCollection,
    TInputDropdown,
    TInputDropdownItem,
    TInputGroup,
    TPaginate,
    TSearchCircle,
    TSearchIcon
  },
  mixins: [tableStyleMixin],
  props: {
    header: {
      type: Array
    },
    content: {
      type: Array
    },
    paginationColor: {
      type: String,
    },
    pagination: {
      type: Boolean,
      default: false
    },
    searchableKeys: {
      type: Array,
      default: Array
    },
    zebra: {
      type: Boolean,
      default: true
    },
    border: {
      type: Boolean,
      default: true
    },
    shadow: {
      type: Boolean,
      default: true
    }
  },
  data() {
    return {
      search: '',
      showSearch: false,
      showPagedItemChooser: false,
      pagedItem: this.pagination ? 5 : 10,
      page: 1
    }
  },
  computed: {
    paginationStyle() {
      if (this.color && !this.paginationColor) {
        return this.color
      } else {
        return this.paginationColor
      }
    },
    paginatedContent() {
      let content = [...this.finalContent]
      return content.slice((this.page - 1) * this.pagedItem, this.pagedItem * this.page)
    },
    filteredContent() {
      return this.content.filter((item) => {
        let query;
        if (this.searchableKeys.length > 0) {
          for (let searchKey of this.searchableKeys) {
            if (typeof searchKey === 'string') {
              query = item[searchKey].toString().toLowerCase().includes(this.search.toLowerCase()) || query
            } else {
              let result = item;
              for (let key of searchKey) {
                result = result[key];
              }
              query = result.toString().toLowerCase().includes(this.search.toLowerCase()) || query
            }
          }
        }

        return query
      })
    },
    finalContent() {
      if (this.searchableKeys.length > 0 && this.searchableKeys) {
        return this.filteredContent
      } else {
        return this.content
      }
    }
  }
}
</script>
