<template>
  <div class="border border-secondary rounded h-100">
      <h2 class="font-weight-bold text-center py-4 border-bottom border-2 border-secondary bg-secondary text-white h3">Top</h2>
      <h2 class="font-weight-bold text-center py-4 h4">€ 24,90 / mese<br /><small>pagamento annuale</small></h2>
      <p class="text-center h5 mb-4 p-3">
          Logo e insegna<br />
          Indirizzo geolocalizzato<br />
          Info sull'attività<br />
          Vetrina del negozio<br />
          Menu Virtuale <br />
          Badge per pagine social<br />
          Gestione Takeaway e Delivery<br />
          Gestione Spedizioni<br />
          Gestione ordini clienti<br />
          Gestione avanzata articoli<br />
          Pagamenti online<br />
          2 ore di consulenza<br />
          4 immagini per prodotto<br />
          categorie prodotto<br />
          fino a 700 prodotti
      </p>
      <subscription-button
        v-if="!hideButton && !update && !cancel"
        class="my-3 row justify-content-center"
        :stripe-p-k="stripePK"
        :price="price"
        :successUrl="successUrl"
        :cancelUrl="cancelUrl"
      />
      <update-subscription-button
        class="my-3 row justify-content-center"
        v-if="update"
        :subscription-id="currentSubscriptionId"
        :new-plan-id="price"
        :user-id="userId"
      />
      <cancel-subscription-button
        class="my-3 row justify-content-center"
        v-if="cancel"
        :subscription-id="currentSubscriptionId"
        :user-id="userId"
      />
  </div>
</template>
<script>
  import { mapState } from 'vuex'
  import CancelSubscriptionButton from './CancelSubscriptionButton.vue'
  import SubscriptionButton from './SubscriptionButton.vue'
  import UpdateSubscriptionButton from './UpdateSubscriptionButton.vue'
  export default {
    components: {
      CancelSubscriptionButton,
      SubscriptionButton,
      UpdateSubscriptionButton
    },
    props: [
      'stripePK',
      'price',
      'successUrl',
      'cancelUrl',
      'hideButton',
      'currentSubscriptionId',
      'update',
      'cancel'
    ],
    computed: {
      ...mapState({
        userId: state => state.userId
      })
    }
  }
</script>