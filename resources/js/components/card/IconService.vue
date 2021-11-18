<template>
  <div class="service-card">
      <div class="col col-12 my-2 delivery"
        v-if="delivery">
          <p><i class="fas fa-shipping-fast mr-2"></i>Consegna a Domicilio</p>
      </div>
      <div class="col col-12 my-2 takeaway"
        v-if="takeaway">
          <p><i class="fas fa-box mr-2"></i>Ritiro in Negozio</p>
      </div>
      <div class="col col-12 payment" v-if="payment">
        <p><i class="fas fa-credit-card"></i> Paga Online</p>
      </div>
  </div>
</template>

<script>
export default {
    name: 'IconService',
    props: ['delivery', 'takeaway', 'payment'],
    data () {
        return {

        }
    }
}
</script>

<style lang="scss">
    $primary :#005c92;
    $secondary:#f18500;
    $background:#e9d7c3;
    .service-card {width:auto; border-radius:0.4rem}
    .service-card .col-12 {
      margin: 1px;
      border-radius: 0.4rem;
    }
    .service-card .delivery {background-color: $secondary; color:white}
    .service-card .takeaway {background-color: $primary; color:white}
    .service-card .payment {background-color: $secondary; color:white}
    .service-card p {
        font-size: 11pt;font-weight: lighter;text-align: left; color: white;
        margin:0px; padding-top: 5px;padding-bottom: 5px;}
</style>