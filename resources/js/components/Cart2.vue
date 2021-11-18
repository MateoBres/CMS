<template>
    <div class="container">
        <div
            class="row fixed-bottom justify-content-center mx-auto cart-container shadow-lg"
            v-if="recap.items_number != 0 && this.$route.name != 'Order'"
            style="background-color: rgba(0,0,0,0.8)"
        >
            <div class="col-12 col-md-8 h-100">
                <div class="row justify-content-center mx-auto p-3">
                    <div class="col-12 bg-light border border-secondary rounded-pill p-3">
                        <div class="d-flex justify-content-between font-weight-bold" @click="toggleCart()">
                            <i class="fas fa-lg fa-shopping-cart my-auto"></i>
                            <p class="my-auto">Prodotti: {{ recap.items_number }}</p>
                            <p class="my-auto">Totale: {{ recap.total_price.toFixed(2) }}&nbsp;<i class="fas fa-euro-sign"></i></p>
                            <i class="fas fa-lg my-auto" :class="{ 'fa-caret-up' : !show_cart, 'fa-caret-down' : show_cart }"></i>
                        </div>
                    </div>
                    <div class="col-12 bg-light border border-secondary mt-3 p-3 items-container" v-if="show_cart">
                        <!-- <div class="d-flex flex-row justify-content-around font-weight-bold m-3" v-for="(item, index) in items" :key="index">
                            <div class="my-auto" >
                                {{ item.item.name }}
                                <span style="font-weight-normal" v-if="item.variation.parent"></span>
                            </div>
                            <div class="my-auto">{{ singleItemTotal(item).toFixed(2) }}<i class="fas fa-euro-sign"></i></div>
                            <div class="d-flex flex-row">
                                <span class="fa-stack fa-1x my-auto" @click="qtyMinus(item)">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fas fa-minus fa-stack-1x fa-inverse"></i>
                                </span>
                                <p class="my-auto mx-3">{{ item.qty }}</p>
                                <span class="fa-stack fa-1x my-auto" @click="qtyPlus(item)">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                </span>
                                <span class="fa-stack fa-1x my-auto ml-3" @click="removeItem(item)">
                                    <i class="fas fa-circle fa-stack-2x text-danger"></i>
                                    <i class="fas fa-trash fa-stack-1x fa-inverse"></i>
                                </span>
                            </div>
                        </div> -->
                        <div class="row py-3 py-md-0 pt-md-2" v-for="(item, index) in items" :key="index" :class="{ 'gray': index%2 != 0 }">
                            <div class="col-xs-12 text-center text-md-left col-md-7">
                                <p class="font-weight-bold text-secondary"> {{ item.item.name }} </p>
                            </div>
                            <div class="item-row col-xs-12 col-md-2 text-center text-md-left">
                                <p class="font-weight-bold">{{ singleItemTotal(item).toFixed(2) }}&nbsp;<i class="fas fa-euro-sign"></i></p>
                            </div>
                            <div class="col-xs-12 col-md-3 text-center text-md-left">
                                <div class="d-flex flex-row justify-content-center">
                                    <span class="fa-stack fa-1x my-auto" @click="qtyMinus(item)">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-minus fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <p class="my-auto mx-3">{{ item.qty }}</p>
                                    <span class="fa-stack fa-1x my-auto" @click="qtyPlus(item)">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <span class="fa-stack fa-1x my-auto ml-3" @click="removeItem(item)">
                                        <i class="fas fa-circle fa-stack-2x text-danger"></i>
                                        <i class="fas fa-trash fa-stack-1x fa-inverse"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <button class="btn btn-block btn-danger rounded-pill" @click="resetState()">
                                    <i class="fas fa-times mr-2"></i>Annulla
                                </button>
                            </div>
                            <div class="alert alert-danger" role="alert" v-if="alert">
                                Questa é una simulazione, non puó comprare nel suo proprio negozio
                            </div>
                            <div class="col-6" v-if="$store.getters.userRoleName != 'publisher' || $store.getters.userRoleName == 'publisher' && user_id != retailer.user_id && !alert">
                                <router-link
                                    v-if="this.order"
                                    :to="{
                                        name: 'Order',
                                        params: {
                                            items_list: this.items,
                                            recap: this.recap,
                                            retailer_id: this.order.retailer_id,
                                            order: this.order
                                        }
                                    }"
                                    class="btn btn-block btn-primary rounded-pill"
                                    @click="hideCart()">
                                    <i class="fas fa-check mr-2"></i>Procedi
                                </router-link>
                            </div>
                            <div class="col-6"  v-else-if="$store.getters.userRoleName == 'publisher' && user_id == retailer.user_id && !alert">
                                <a
                                    class="btn btn-block btn-primary rounded-pill"
                                    @click="alert =true">
                                    <i class="fas fa-check mr-2"></i>Procedi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { eventBus } from '../app'

    export default {
        data() {
            return {
                alert: false,
                show_cart: false,
                caret_class: 'fa-caret-up',
                retailer: null,
                user_id: null
            }
        },
        computed: {
            order() {
                return this.$store.getters.order
            },
            items() {
                return this.$store.getters.items
            },
            recap() {
                let recap = {
                    'items_number': 0,
                    'total_price': 0,
                }

                if(this.items && this.items.length > 0) {
                    console.log('*******items', this.items)
                    this.items.forEach(item => {
                        recap.items_number += item.qty
                        recap.total_price += (item.price * item.qty)

                        if (item && item.item && item.item.info && JSON.parse(item.item.info).weight.unit || JSON.parse(item.item.info).size.unit) {
                            recap.items_number -= item.qty-1
                        }
                    });

                }
                return recap
            }
        },
        mounted() {
            eventBus.$on('toggle-cart', () => {
                this.toggleCart()
            })

            this.user_id = parseInt(this.$store.getters.userId)

            this.getRetailerByVat();

            eventBus.$on('item-added', (product, quantity, price, variation) => {
                let new_retailer_id = product.retailer_id

                if(!this.order || this.order.retailer_id != new_retailer_id) {
                    this.resetState()
                    axios
                        .get(`/api/random-string`)
                        .then(response => {
                            let order = {
                                retailer_id: new_retailer_id,
                                code: new_retailer_id + '-' + response.data.data
                            }
                            this.setOrder(order)
                        })
                        .catch(e => {
                            console.log(e)
                        })
                }

                this.addItem(product, quantity, price, variation)
            })

            eventBus.$on('order-completed', () => {
                console.log('order-completed received')
                this.resetState()
            })
        },
        methods: {
            getRetailerByVat() {
                axios
                    .get(`/api/retails/by-vat/${this.$store.getters.retailerVat}`)
                    .then( response => {
                        this.retailer = response.data.data
                        this.$store.dispatch('setRetailerSlug', response.data.data.slug)
                        this.$store.dispatch('setRetailerVat', response.data.data.vat)
                    })
                    .catch( e => {
                        this.reset_message = response.data.message
                        this.reset_message_class = 'danger'
                        this.show_reset_message = true
                    })
            },
            toggleCart() {
                this.show_cart = !this.show_cart
            },
            hideCart() {
                this.show_cart = false
            },
            addItem(product, quantity, price, variation) {
                this.$store.dispatch('addItem',
                {
                    product: product,
                    quantity: quantity,
                    price: price,
                    variation: variation
                })
            },
            qtyPlus(product) {
                this.$store.dispatch('qtyPlus', product)
            },
            qtyMinus(product) {
                this.$store.dispatch('qtyMinus', product)
            },
            removeItem(product) {
                this.$store.dispatch('removeProduct', product)
            },
            resetState() {
                this.$store.dispatch('resetState')
            },
            setOrder(order) {
                this.$store.dispatch('setOrder', order)
            },
            singleItemTotal(product) {
                //return (product.item.price * product.qty)/100
                return (product.price * product.qty)
            }
        }
    }
</script>
<style scoped>
    .items-container {
        border-radius: 30px;
    }
    
    .cart-container {
        /* border-radius: 30px; */
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
    }
    .gray{
        background-color: #eee
    }
</style>
