<template>
  <div>
    <homepage-mobile class="d-lg-none"></homepage-mobile>
    <homepage-desktop class="d-none d-lg-block"></homepage-desktop>
  </div>
</template>
<script>
  import HomepageDesktop from './HomepageDesktop.vue'
  import HomepageMobile from './HomepageMobile.vue'
  export default {
    components: {
      HomepageDesktop,
      HomepageMobile
    },
  }
</script>