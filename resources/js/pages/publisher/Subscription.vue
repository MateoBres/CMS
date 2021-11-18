<template>
    <div class="container" id="ordersContainer">
        <section class="row my-3 bg-light">
            <div class="col-xs-12 col-md-12">
                <div class="card text-left" id="retailCategoryCard">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <h2 class="h3 mb-3" @click="testReroute">Iscrizione Corrente:</h2>
                                    </div>
                                    <div class="col-8">
                                        <h2 class="h3 mb-3">Cambia Iscrizione:</h2>
                                    </div>
                                    <!-- current sub -->
                                    <div class="col-4">
                                        <free v-if="subscription === 'free'" />
                                        <mid
                                          v-if="subscription === 'standard' && stripePk && priceMid && baseUrl"
                                          :hideButton="true"
                                          :cancel="true"
                                          :update="false"
                                          :stripe-p-k="stripePk"
                                          :price="priceMid"
                                          :currentSubscriptionId="user.stripe_current_subscription_id"
                                          :success-url="`${baseUrl}/subscription-success?session_id={CHECKOUT_SESSION_ID}`"
                                          :cancel-url="`${baseUrl}/subscription-success?session_id={CHECKOUT_SESSION_ID}`"
                                        />
                                        <top
                                          v-if="subscription === 'top' && stripePk && priceTop && baseUrl"
                                          :hideButton="true"
                                          :cancel="true"
                                          :update="false"
                                          :stripe-p-k="stripePk"
                                          :price="priceTop"
                                          :currentSubscriptionId="user.stripe_current_subscription_id"
                                          :success-url="`${baseUrl}/subscription-success?session_id={CHECKOUT_SESSION_ID}`"
                                          :cancel-url="`${baseUrl}/subscription-success?session_id={CHECKOUT_SESSION_ID}`"
                                        />
                                    </div>

                                    <!-- other subs -->
                                    <div v-if="subscription === 'free'" class="col-4">
                                        <mid
                                          v-if="stripePk && priceTop && baseUrl"
                                          :hide-button="false"
                                          :update="false"
                                          :cancel="false"
                                          :stripe-p-k="stripePk"
                                          :price="priceMid"
                                          :currentSubscriptionId="user.stripe_current_subscription_id"
                                          :success-url="`${baseUrl}/subscription-success?session_id={CHECKOUT_SESSION_ID}`"
                                          :cancel-url="`${baseUrl}/subscription-success?session_id={CHECKOUT_SESSION_ID}`"
                                        />
                                    </div>
                                    <div v-if="subscription != 'top'" class="col-4">
                                        <top
                                          v-if="stripePk && priceTop && baseUrl"
                                          :hide-button="subscription === 'standard' ? true : false"
                                          :update="subscription === 'free' ? false : true"
                                          :cancel="false"
                                          :stripe-p-k="stripePk"
                                          :price="priceTop"
                                          :currentSubscriptionId="user.stripe_current_subscription_id"
                                          :success-url="`${baseUrl}/subscription-success?session_id={CHECKOUT_SESSION_ID}`"
                                          :cancel-url="`${baseUrl}/subscription-success?session_id={CHECKOUT_SESSION_ID}`"
                                        />
                                    </div>
                                    <div v-if="subscription === 'top'" class="col-8 border rounded d-flex flex-column">
                                      <div class="d-flex flex-column m-auto">
                                        <span class="h3 mb-3">
                                          Per modificare la tua iscrizione, contattaci:
                                        </span>
                                        <a class="btn btn-primary mb-3">Email: </a>
                                        <a class="btn btn-primary">Telefono</a>
                                      </div>
                                    </div>
                                </div>
                                <!-- <div class="row justify-content-center mt-3">
                                    <div class="col-12 text-center">
                                      <h2 class="h3">Cambia Iscrizione:</h2>
                                    </div>
                                    <div class="col-4">
                                        <mid
                                          v-if="stripePk && priceTop && baseUrl"
                                          :stripe-p-k="stripePk"
                                          :price="priceMid"
                                          :success-url="`${baseUrl}/subscription-success?session_id={CHECKOUT_SESSION_ID}`"
                                          :cancel-url="`${baseUrl}/subscription-success?session_id={CHECKOUT_SESSION_ID}`"
                                        />
                                    </div>
                                    <div class="col-4">
                                        <top
                                          v-if="stripePk && priceTop && baseUrl"
                                          :stripe-p-k="stripePk"
                                          :price="priceTop"
                                          :success-url="`${baseUrl}/subscription-success?session_id={CHECKOUT_SESSION_ID}`"
                                          :cancel-url="`${baseUrl}/subscription-success?session_id={CHECKOUT_SESSION_ID}`"
                                        />
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import { mapState } from 'vuex'
import VueQrcode from '@chenfengyuan/vue-qrcode'
import Free from '../../components/subscriptions/Free.vue'
import Mid from '../../components/subscriptions/Mid.vue'
import Top from '../../components/subscriptions/Top.vue'
export default {
    components: {
        Free,
        Mid,
        Top,
        VueQrcode
    },
    name: "Subscription",
    props: [
      'stripePk',
      'baseUrl',
      'priceMid',
      'priceTop',
      'subscription'
    ],
    data() {
      return {
        successUrl: null,
        cancelUrl: null,
      }
    },
    created() {
      this.successUrl = this.baseUrl ? this.baseUrl + '/subscription-success?session_id={CHECKOUT_SESSION_ID}' : null
      this.cancelUrl = this.baseUrl ? this.baseUrl + '/subscription-success?session_id={CHECKOUT_SESSION_ID}' : null
    },
    computed: {
        ...mapState({
            retailer:   state => state.retailer,
            user:       state => JSON.parse(state.user)
        }),
        RetailerURL: function() {
            return `https://www.spesavicino.it${this.retailer.url}`
        },
        subscriptionState() {
          if (!this.user.stripe_plan_id) {
            return 'free'
          } else if (this.user.stripe_plan_id === this.priceMid) {
            return 'standard'
          } else if (this.user.stripe_plan_id === this.priceTop) {
            return 'top'
          }
        }
    },
    methods: {
      testReroute() {
        this.$router.push({
          name: 'GenericSuccess',
          params: {
            message: 'lorem ipsum dolor sit amet'
          }
        })
      }
    },
};
</script>
