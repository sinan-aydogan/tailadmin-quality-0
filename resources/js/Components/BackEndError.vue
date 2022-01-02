<template>
  <div v-if="hasErrors">
    <div
      class="
        flex
        justify-start
        items-center
        space-x-2
        bg-white bg-opacity-60
        dark:bg-red-400 dark:text-gray-100
        rounded-md
        py-2
        px-4
        mb-2
        text-red-500
      "
    >
      <icon icon="exclamation" />
      <span class="font-medium" v-t="'somethingWentWrong'" />
    </div>

    <Message v-for="(error, key) of errors" severity="error" :key="key">
      {{ error }}
    </Message>
  </div>
</template>

<script>
import { computed, defineComponent, watch, ref } from "vue";
import Message from "primevue/message";
import { usePage } from "@inertiajs/inertia-vue3";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faExclamation } from "@fortawesome/free-solid-svg-icons";

library.add(faExclamation);

export default defineComponent({
  name: "BackEndError",
  components: {
    Message,
  },
  setup(props) {
    const errors = computed(() => {
      console.log(usePage());
      return usePage().props.value.errors;
    });

    const hasErrors = computed(() => {
      return Object.keys(errors.value).length > 0;
    });

    return { errors, hasErrors };
  },
});
</script>
