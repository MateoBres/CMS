<template>
  <div id="app">
    <component :is="layout">
    <router-view/>
    </component>
  </div>
</template>

<script>
// eslint-disable-next-line
const default_layout = 'default';
export default {
  computed: {
    layout() {
      // eslint-disable-next-line
      return( this.$route.meta.layout || default_layout) + '-layout';
    },
  },
};
</script>
