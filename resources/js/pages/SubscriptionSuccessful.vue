<template>
  <div class="d-flex h-100">
    <div class="m-auto d-flex flex-column">
      <img src="/images/logo/logo-sm-ora.png" class="mx-auto" style="height: 8rem;">
      <span class="font-weight-bold text-center" style="font-size: 2.5rem;">Iscrizione andata a buon fine</span>
      <span class="text-center" style="font-size: 1.5rem;">grazie per esserti iscritto</span>
      <router-link
        class="btn btn-primary"
        :to="`/publisher/${userId}/retailer/${retailerId}/subscription`"
        >
          Indietro
      </router-link>
    </div>
  </div>
</template>
<script>
import { mapActions, mapState } from 'vuex'
export default {
  data() {
    return {
      sessionId: this.$route.query.session_id,
      subscriptionId: null,
    }
  },
  methods: {
    ...mapActions([
      'updateUser'
    ]),
    getSessionData() {
      if (this.$route.query.session_id) {
        axios
        .post('/api/stripe/retrieve-session', {
          'session_id': this.$route.query.session_id
        })
        .then( response => {
          console.log('response', response.data.data)
          this.updateUser(response.data.data)
        })
      }
    }
  },
  mounted() {
    console.log(this.$route.query.session_id)
    this.getSessionData()
  },
  computed: {
    ...mapState({
      userId: state => state.userId,
      retailerId: state => state.retailerId
    })
  }
}
</script>