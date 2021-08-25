<template>
    <div class="fixed left-0 top-0 right-0 bottom-0 flex flex-col justify-center items-center pt-10 space-y-10 bg-gray-300 z-50 bg-opacity-70">
        <ProgressSpinner />
        <span class="text-2xl font-semibold">You will redirected items list, please wait...</span>
    </div>
</template>

<script>
import ProgressSpinner from 'primevue/progressspinner';

export default {
    components:
        {
            ProgressSpinner
        }
}
</script>

<style scoped>

</style>
