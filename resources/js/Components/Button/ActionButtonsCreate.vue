<template>
<div class="inline-flex gap-1">
  <!--Add new button-->
  <t-button
      color="solid-green"
      :link="route(model+'.create')"
  >
    <t-plus-icon class="w-5 h-5"/>
    Add New
  </t-button>
  <!--Deleted items button-->
  <t-button
      color="solid-gray"
      :link="route(model+'.trash')"
  >
    <t-trash-icon class="w-5 h-5"/>
    Deleted Items
  </t-button>
</div>
</template>

<script>
import TPlusIcon from "@/Components/Icon/TPlusIcon";
import TButton from "@/Components/Button/TButton";
import TTrashIcon from "@/Components/Icon/TTrashIcon";
export default {
  name: "TActionButtonsIndex",
  components: {TTrashIcon, TButton, TPlusIcon},
  props: {
    model: {
      type: String
    }
  }
}
</script>

<style scoped>

</style>