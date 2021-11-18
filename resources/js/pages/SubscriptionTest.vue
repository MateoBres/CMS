<template>
<div class="row w-100 d-flex py-5 mx-auto">
  <stripe-checkout
    v-if="sessionId"
    class="m-auto py-5"
    ref="checkoutRef"
    mode="subscription" 
    :pk="publishableKey"
    :session-id="sessionId"
  />
  <button class="btn btn-success font-weight-bold my-5 mx-auto" @click="submit">Subscribe</button>
</div>
</template>
<script>
  import { StripeCheckout } from '@vue-stripe/vue-stripe'
  export default {
    components: {
      StripeCheckout,
    },
    data() {
      this.publishableKey = 'pk_test_C6ya1zR2bcjzdhHhCiZ2vbKQ00qyIYg2y4'
      return {
        sessionId: null,
        loading: false,
      }
    },

    computed: {
      stripeSessionId() {
        return this.sessionId
      },
      testComputed() {
        return 'hello'
      }
    },
    mounted() {
      this.generateSession()
    },
    methods: {
      submit () {
        this.$refs.checkoutRef.redirectToCheckout();
      },
      generateSession () {
        axios
          .post(`/api/stripe/generate-session`, {
            'success_url': 'http://localhost:9191?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url': 'http://localhost:9191',
            price: 'price_1JhFVbABmjXTPEshxr3msyNj',
          })
          .then( response => {
            console.log('session response', response.data.data.id)
            this.sessionId = response.data.data.id
            return response.data.data.id
          })
          .catch( e => {
            console.log('error', e)
          })
      }
    },
  }
</script>