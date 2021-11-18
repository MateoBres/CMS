<template>
  <!--Copertina-->
  <div id="cover" class="carousel slide position-relative min-vh-100" style="width: 100%; height: 100vh; overflow:hidden" data-ride="carousel">
    <div ref="carousel" class="carousel-inner min-vh-100">
      <div class="carousel-item min-vh-100" v-for="(item, index) in items" :key="index" :class="{ active : index==0}">
        <img class="img-fluid h-100" style="object-fit: cover; object-position: center" :src="item.image" :alt="item.alt">
      </div>
    </div>

    <div id="content" class="testo-cover text-center text-white position-absolute text-center dark-opacity d-flex flex-column py-5" style="top: 0; left: 0; height: 100%; width:100%; z-index: 80;">
      <div class="row justify-content-center my-auto">
        <div class="col-12">
          <div class="row justify-content-center">
            <div class="col-3 col-lg-2 col-xl-2">
              <img src="/customLayout/images/logo-sm-ora.png" class="w-100 img-fluid">
            </div>
          </div>
        </div>
        <div class="col-10 my-5">
          <div class="row justify-content-center">
            <div class="col-10">
              <p class="d-none d-md-block h2 text-white text-center cutsom-text"> IL COMMERCIO LOCALE PASSA AL DIGITALE</p>
              <p class="d-block d-md-none h4 text-white text-center custom-text mb-5"> IL COMMERCIO LOCALE PASSA AL DIGITALE</p>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-10">
              <p class="d-none d-md-block h2 text-white text-center cutsom-text">Crea il tuo negozio online in pochi click!</p>
              <p class="d-block d-md-none h4 text-white text-center custom-text">Crea il tuo negozio online in pochi click!</p>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="row justify-content-center">
            <div class="col-12">
              <button class="btn btn-warning border-0 rounded text-white py-2 px-4 small" style="background-color: #e59e26;"
                @click="$router.push('/login')">
                inizia ora
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</template>

<script>
export default {
    name: 'Copertina',
    props: ['items'],
    data() {
        return {
        }
    }
}
</script>

<style scoped>
  .custom-text {
    text-shadow: 1px 2px #2f2f2f;
  }
</style>