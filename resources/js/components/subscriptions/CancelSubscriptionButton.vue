<template>
  <div>
    <button class="btn btn-primary font-weight-bold" @click="submit">Termina</button>
  </div>
</template>
<script>
  import { mapState } from 'vuex'
  export default {
    props: [
      'subscriptionId'
    ],
    computed: {
      ...mapState({
        userId: state => state.userId,
        retailerId: state => state.retailerId
      })
    },
    methods: {
      submit() {
        axios
          .post(`/api/stripe/${this.userId}/subscription/cancel`, {
            subscription_id: this.subscriptionId
          })
          .then( response => {
            if (response.data.success) {
              this.$router.push({
                name: 'GenericSuccess',
                params: {
                  message: 'Iscrizione terminata con successo',
                  user: response.data.data.user,
                  subscription: response.data.data.subscription
                }
              })
            } else {
              this.$router.push({ name: 'GenericError' })
            }
          })
          .catch( e => {
            console.log('error', e)
            this.$router.push({ name: 'GenericError' })
          })
      }
    },
  }
</script>