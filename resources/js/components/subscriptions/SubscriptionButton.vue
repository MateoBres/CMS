<template>
<div>
  <stripe-checkout
    v-if="sessionId"
    class="m-auto py-5"
    ref="checkoutRef"
    mode="subscription" 
    :pk="stripePK"
    :session-id="sessionId"
  />
  <button class="btn btn-primary font-weight-bold" @click="submit">Seleziona</button>
</div>
</template>
<script>
  import { mapState } from 'vuex'
  import { StripeCheckout } from '@vue-stripe/vue-stripe'
  export default {
    components: {
      StripeCheckout
    },
    props: [
      'stripePK',
      'price',
      'successUrl',
      'cancelUrl'
    ],
    data() {
      return {
        sessionId: null,
      }
    },
    methods: {
      generateSession () {
        axios
          .post(`/api/stripe/${this.userId}/generate-session`, {
            'success_url': this.successUrl,
            'cancel_url': this.cancelUrl,
            price: this.price
          })
          .then( response => {
            this.sessionId = response.data.data.id
            console.log('session-id', response.data.data.id)
          })
      },
      submit () {
        this.$refs.checkoutRef.redirectToCheckout()
      }
    },
    mounted() {
      console.log('price', this.price)
      this.generateSession()
    },
    computed: {
      ...mapState({
        userId: state => state.userId
      }),
    }
  }
</script>