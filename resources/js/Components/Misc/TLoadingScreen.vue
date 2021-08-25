<template>
  <div
      class="fixed left-0 top-0 right-0 bottom-0 flex flex-col justify-center items-center pt-10 space-y-10 bg-gray-300 z-50 bg-opacity-70">
    <div class="flex justify-center">
      <t-cog-icon class="w-1/6 animate-spin-slow"/>
      <t-cog-icon class="w-1/12 animate-spin-slow-reverse mt-16 -ml-5"/>
    </div>
    <span class="text-2xl font-semibold">You will redirected items list, please wait...</span>
  </div>
</template>

<script>
import TCogIcon from "@/Components/Icon/TCogIcon";

export default {
  name: 'TLoadingScreen',
  components:
      {
        TCogIcon,
      }
}
</script>
