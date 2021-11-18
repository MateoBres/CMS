<template>
  <div class="d-flex h-100 mt-5">
    <div class="m-auto d-flex flex-column">
      <img src="/images/logo/logo-sm-ora.png" class="mx-auto" style="height: 8rem;">
      <span class="font-weight-bold text-center" style="font-size: 2.5rem;">Oops...</span>
      <span class="text-center" style="font-size: 1.5rem;">pagina non trovata</span>
      <div class="col-12 text-center mt-5">
        <button class="btn btn-primary" @click="$router.go(-1)">
            Tornare indietro
        </button>
      </div>
    </div>
  </div>
</template>


