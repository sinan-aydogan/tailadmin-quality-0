<script setup>
import SubItem from "@/Layouts/MainMenu/SubItem.vue"
import {ref} from "vue"
defineProps({
link:{
type: Object,
default: ()=>{}
}
})

const showMenu = ref(false)
const toggleMenu = ()=>{
showMenu.value = !showMenu.value
}
</script>

<template>
<div class="item" @click="toggleMenu">
<!--Item Detail-->
<div class="item--detail">
<!--Icon-->
<div class="item--icon">
<font-awesome-icon v-if="link.icon" :icon="link.icon"/>
</div>

<!--Label-->
<span v-text="link.label"></span>
</div>

<!--Children Indicator-->
<font-awesome-icon v-if="link.hasOwnProperty('children')" icon="circle-chevron-right" :class="showMenu && 'rotate-90'"/>
</div>

<!--Sub Item-->
<div v-if="link.hasOwnProperty('children') && showMenu" class="ml-4 border-l">
<SubItem v-for="subItem in link.children" v-bind:link="subItem" :key="subItem"/>
</div>
</template>

<style lang="sass" scoped>
.item
    @apply flex justify-between items-center cursor-pointer hover:font-bold
    &--detail
        @apply flex items-center
    &--icon
        @apply flex justify-center items-center mr-2 w-8 h-8
</style>