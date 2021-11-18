<template>
  <div class="row justify-content-center">
      <div class="col col-12 col-md-4">
          <div class="form-row justify-content-center">
              <img
                  class="mb-4 mx-auto"
                  :class="$store.state.retailerVat ? 'w-50 h-50' : ''"
                  :src="imgUrl"
                  alt=""
                  height=""
              />
          </div>
      </div>
  </div>
</template>
<script>
  export default {
    computed: {
      imgUrl() {
        if (this.$store.state.retailerVat) {
          return `/storage/${this.$store.state.retailerVat}/img/profile/logo.jpg`
        } return `/images/logo-spesa-vicino-bianco-small.png`
      }
    }
  }
</script>