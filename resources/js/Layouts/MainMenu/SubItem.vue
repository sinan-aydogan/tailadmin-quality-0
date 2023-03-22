<script setup>
defineProps({
link:{
type: Object,
default: ()=>{}
}
})
</script>

<template>
<div class="flex items-center -ml-1">
<div class="w-2 h-2 rounded-full bg-slate-600"></div>
<div class="item">
<!--Item Detail-->
<div class="item--detail">
<!--Icon-->
<div class="item--icon">
<font-awesome-icon v-if="link.icon" :icon="link.icon"/>
</div>

<!--Label-->
<span v-text="link.label"></span>
</div>
</div>
</div>
</template>

<style lang="sass" scoped>
.item
    @apply flex justify-between items-center ml-2 cursor-pointer
    &--detail
        @apply flex items-center
    &--icon
        @apply flex justify-center items-center mr-2 w-8 h-8
    &__active
        @apply text-blue-600
    &__default
        @apply text-slate-700
</style>