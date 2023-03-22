<script setup>
import MainItem from "@/Layouts/MainMenu/MainItem.vue"
const links = [
{
label: 'Modüller',
type: 'header',
children: [
{
id: 'bm',
label: 'Business Management',
type: 'dropdown',
icon:'building',
children: [
{
id: 'bm-department',
label: 'Departments',
type: 'route',
icon:'sitemap',
},
{
id: 'bm-vehicle',
label: 'Vehicles',
type: 'route',
icon:'car-side',
}
]
},
{
id: 'hr',
label: 'Human Resources',
type: 'dropdown',
icon:'users',
children: [
{
id: 'hr-employee',
label: 'Employees',
type: 'dropdown',
icon:'building',
}
]
},
{
id: 'doc',
label: 'Documentation',
type: 'dropdown',
icon: 'folder-tree'
},
{
id: 'capa',
label: 'CAPA System',
type: 'dropdown',
icon: 'highlighter'
}
]
},
{
label: 'Ayarlar',
type: 'header',
children: [
{
id: 'generalSettings',
label: 'General Settings',
type: 'dropdown',
icon: 'gear'
},
{
id: 'role',
label: 'Role Management',
type: 'dropdown',
icon: 'user-shield'
}
]
}
]

</script>

<template>
<div class="flex flex-col w-72">
<template v-for="link in links" :key=link>
<div class="last:mb-0 mb-6">
<!--Header-->
<div v-if="link.type === 'header'" v-text="link.label" class="header"></div>

<!--Main Menu Item-->
<div v-if="link.hasOwnProperty('children')">
<MainItem v-for="mainItem in link.children" v-bind:link="mainItem" :key="mainItem"/>
</div>
</div>

</template>
</div>
</template>

<style lang="sass" scoped>
.header
    @apply text-sm text-slate-500 font-bold mb-2
.main-item
    @apply flex justify-between items-center cursor-pointer
    &--detail
        @apply flex items-center
    &--icon
        @apply flex justify-center items-center mr-2 w-8 h-8
</style>