<template>
  <div>
    <h1 v-if="show"></h1>
  </div>
</template>

<script>
export default {
  data() {
    components: ["TestComponent"];
    return {
      show: true,
    };
  },
};
</script>

<style></style>
