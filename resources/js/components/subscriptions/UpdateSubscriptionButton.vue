<template>
  <div>
    <button class="btn btn-primary font-weight-bold" @click="submit">Upgrade</button>
  </div>
</template>
<script>
  import { mapState } from 'vuex'
  export default {
    props: [
      'subscriptionId',
      'newPlanId'
    ],
    methods: {
      submit () {
        axios
          .post(`/api/stripe/${this.userId}/subscription/update`, {
            subscription_id: this.subscriptionId,
            new_plan_id: this.newPlanId
          })
          .then( response => {
            if (response.data.success) {
              this.$router.push({
                name: 'GenericSuccess',
                params: {
                  message: 'Iscrizione aggiornata con successo',
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
    computed: {
      ...mapState({
        retailerId: state => state.retailerId,
        userId: state => state.userId
      })
    }
  }
</script>