<template>
    <div class="container py-5" style="min-height: 80vh">
        <div class="container">
            <section class="row mt-5" style="margin-top: 6rem !important;">
                <div class="col-12 d-flex justify-content-between">
                    <title-widget :name="retail_name" :vat="retail_vat" :premium="premium" :subscription="subscriptionState" />
                    <div class="d-none d-md-block col-6">
                        <div class="form-check form-check-inline ml-5 row">
                            <label id="is_pub" class="form-switch ml-5">
                                <input id="is_pub" type="checkbox" v-on:click="togglePub()">
                                <i class="ml-4"></i>
                                <p v-if="retailer && !retailer.is_published">Pubblicare Negozio</p>
                                <p v-else-if="retailer && retailer.is_published">Disattiva Negozio</p>
                            </label>
                        </div>
                        <button type="button" class="btn btn-primary ml-5" v-on:click="goToPage()">Anteprima</button>
                    </div>
                </div>

                    <div v-if="retailer && !retailer.is_published" class="alert alert-danger col-12" role="alert">
                       <strong>Attenzione, in questo momento nessuno puó vedere il tuo negozio!!</strong>
                    </div>
                <div class="alert alert-danger w-100 mt-3" v-if="!articles && !loading">
                    <p class="my-auto">
                    N.B: Per rendere la vostra card visibile, dovete aggiungere almeno un articolo/prodotto.
                    </p>
                </div>
            </section>
        </div>
        <section class="row mt-3">
            <div class="col-12">
                <ul class="nav nav-tabs justify-content-left">
                    <li class="nav-item">
                        <router-link
                            :to="
                                '/publisher/' +
                                    user_id +
                                    '/retailer/' +
                                    retailer_id +
                                    '/orders'
                            "
                            class="nav-link"
                            exact
                            ><h5>Ordini</h5>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            :to="
                                '/publisher/' +
                                    user_id +
                                    '/retailer/' +
                                    retailer_id +
                                    '/info'
                            "
                            class="nav-link"
                            exact
                        >
                            <h5>Informazioni</h5>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            :to="
                                '/publisher/' +
                                    user_id +
                                    '/retailer/' +
                                    retailer_id +
                                    '/items'
                            "
                            class="nav-link"
                            exact
                            ><h5>Articoli</h5>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="'/publisher/' + user_id + '/retailer/' + retailer_id + '/categories'" exact class="nav-link">
                            <h5>Categorie</h5>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="'/publisher/' + user_id + '/retailer/' + retailer_id + '/payments'" exact class="nav-link">
                            <h5>Pagamenti</h5>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="'/publisher/' + user_id + '/retailer/' + retailer_id + '/sharing'" exact class="nav-link">
                            <h5>Il mio Negozio</h5>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="'/publisher/' + user_id + '/retailer/' + retailer_id + '/subscription'" exact class="nav-link">
                            <h5>Iscrizione</h5>
                        </router-link>
                    </li>
                </ul>
            </div>
        </section>
        <section class="row mt-3">
            <div class="col-xs-12 col-md-12">
                <router-view
                    :stripe-pk="stripePk"
                    :price-mid="priceMid"
                    :price-top="priceTop"
                    :base-url="baseUrl"
                    :subscription="subscriptionState"
                />
            </div>
        </section>

        <help-widget />

    </div>
</template>

<script>
import HelpWidget from '../../components/HelpWidget'
import RetailNameVat from '../../components/RetailNameVat'
import { mapState } from 'vuex'

export default {
    name: "Publisher",
    components: {
        "help-widget": HelpWidget,
        "title-widget": RetailNameVat
    },
    data() {
        return {
            user_id: this.$route.params.publisher_id,
            retailer_id: this.$route.params.retailer_id,
            retail_name: null,
            retail_vat: null,
            show: false,
            articles: null,
            premium: null,
            loading:true,

            stripePk: null,
            priceMid: null,
            priceTop: null,
            baseUrl: null,
            successUrl: null,
            cancelUrl: null,
        };
    },
    computed: {
        ...mapState({
            retailer:   state => state.retailer,
            user:       state => JSON.parse(state.user)
        }),
        subscriptionState() {
            if (!this.user.stripe_plan_id) {
            return 'free'
            } else if (this.user.stripe_plan_id === this.priceMid) {
            return 'standard'
            } else if (this.user.stripe_plan_id === this.priceTop) {
            return 'top'
            } else {
                return 'error'
            }
        }
    },
    mounted() {
        this.getRetail();
        this.getStripePK();
        this.getPrices();
        this.getBaseUrl();
    },
    methods: {
        togglePub() {
            if (this.retailer.is_published) {
                this.retailer.is_published = false
            } else {
                this.retailer.is_published = true
            }
            console.log(this.retailer.is_published)
            let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.token}`
                    }
                };
            let data = {
                    ...this.retailer,
                    is_published: this.retailer.is_published
                };
            axios
                .put(`/api/retails/${this.retailer.id}`, data, config)
                .then(response => {
                    console.log('******IS PUBLISHED', this.retailer.is_published)
                })
                .catch(e => {
                    console.log(e);
                });
        },
        goToPage() {
            this.$router.push(
                {
                    path: `/azienda/${this.slug}/${this.$store.state.retailerVat}`,
                        params: {
                            retailer_id: this.retailer.id
                        }
                }
            );
        },
        getRetail() {
            axios
                .get(`/api/retails/${this.retailer_id}`)
                .then(response => {
                    this.$store.dispatch('setRetailer', response.data.data);
                    let my_retail = response.data.data;
                    this.retail_name = my_retail.name;
                    this.retail_vat = my_retail.vat;
                    this.articles = response.data.data.items.length;
                    this.isPremium()
                    this.loading = false
                })
                .catch(errors => {});
        },

        isPremium() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };

            axios
                .get(`/api/retails/${this.retailer_id}/is_premium`, config)
                .then(response => {
                    this.premium = response.data
                })
        },

        getStripePK () {
            axios
            .get('/api/stripe/get-stripe-pk')
            .then( response => {
                this.stripePk = response.data
            })
            .catch( e => {
                console.log('error', e)
            })
        },
        getPrices () {
            axios
            .get('/api/stripe/get-prices')
            .then( response => {
                this.priceMid = response.data.mid
                this.priceTop = response.data.top
            })
            .catch( e => {
                console.log('error', e)
            })
        },
        getBaseUrl () {
            axios
            .get('/api/base-url')
            .then( response => {
                this.baseUrl = response.data
                this.successUrl = response.data + '/subscription-success?session_id={CHECKOUT_SESSION_ID}'
                this.cancelUrl = response.data + '/subscription-success?session_id={CHECKOUT_SESSION_ID}'
            })
        }
    }
};
</script>

<style>
/* Styles for the switch. */

.form-switch {
  display: inline-block;
  cursor: pointer;
  -webkit-tap-highlight-color: transparent;
}

.form-switch i {
  position: relative;
  display: inline-block;
  margin-right: .5rem;
  width: 46px;
  height: 26px;
  background-color: lightgray;
  border-radius: 23px;
  vertical-align: text-bottom;
  transition: all 0.3s linear;
}

.form-switch i::before {
  content: "";
  position: absolute;
  left: 0;
  width: 42px;
  height: 22px;
  background-color: #4BD763;
  border-radius: 11px;
  transform: translate3d(2px, 2px, 0) scale3d(1, 1, 1);
  transition: all 0.25s linear;
}

.form-switch i::after {
  content: "";
  position: absolute;
  left: 0;
  width: 22px;
  height: 22px;
  background-color: #fff;
  border-radius: 11px;
  box-shadow: 0 2px 2px rgba(0, 0, 0, 0.24);
  transform: translate3d(2px, 2px, 0);
  transition: all 0.2s ease-in-out;
}

.form-switch:active i::after {
  width: 28px;
  transform: translate3d(2px, 2px, 0);
}

.form-switch:active input:checked + i::after { transform: translate3d(16px, 2px, 0); }

.form-switch input { display: none; }

.form-switch input:checked + i { background-color: gray; }

.form-switch input:checked + i::before { transform: translate3d(18px, 2px, 0) scale3d(0, 0, 0); }

.form-switch input:checked + i::after { transform: translate3d(22px, 2px, 0); }
</style>
