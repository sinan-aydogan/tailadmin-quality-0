<template>
<div class="inline-flex gap-1">
  <!--Back button-->
  <t-button
      color="solid-blue"
      type="link"
      :link="route(model+'.index')"
  >
    <t-chevron-left-icon class="w-5 h-5"/>
    Back to Contents List
  </t-button>
</div>
</template>

<script>
import TButton from "@/Components/Button/TButton";
import TChevronLeftIcon from "@/Components/Icon/TChevronLeftIcon";
export default {
  name: "TActionButtonsCreate",
  components: {TChevronLeftIcon, TButton},
  props: {
    model: {
      type: String
    }
  }
}
</script>