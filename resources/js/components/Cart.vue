<template>
<div class="container-fluid">
    <div class="col-xs-12 offset-md-1 col-md-10 fixed-bottom">
        <div class="row justify-content-center">
            <div class="card shadow col-xs-12 col-md-10 p-0" id="cart-body" v-show="filtered_items.length > 0 && this.$route.name != 'Order'">
                <div class="card-header bg-secondary text-white px-5" @click="toggleCart()">
                    <div class="row justify-content-between">
                        <!-- cart desktop -->
                        <div class="my-auto d-none d-lg-block">
                            <p class="h5 m-0 my-auto"><i class="fas fa-shopping-cart fa-2x"></i></p>
                        </div>
                        <div class="my-auto d-none d-lg-block">
                            <p class="h5 m-0 my-auto">Articoli: {{ recap.items_number }}</p>
                        </div>
                        <div class="my-auto d-none d-lg-block">
                            <p class="h5 m-0 my-auto">Totale: {{ recap.total_price.toFixed(2) }}&euro;</p>
                        </div>
                        <div class="my-auto d-none d-lg-block">
                            <router-link :to="{ name: 'Order', params: {order_id: order.id, items_list: filtered_items, recap: recap, retailer_id: retailer_id, order: order} }" class="btn my-auto btn-primary" v-if="order != null">
                                <i class="fas fa-check fa-lg mr-2"></i>Procedi
                            </router-link>
                        </div>
                        <!-- cart mobile -->
                        <div class="my-auto d-block d-lg-none">
                            <p class="my-auto"><i class="fas fa-shopping-cart fa-lg"></i></p>
                        </div>
                        <div class="my-auto d-block d-lg-none">
                            <p class="my-auto">Articoli: {{ recap.items_number }}</p>
                        </div>
                        <div class="my-auto d-block d-lg-none">
                            <p class="my-auto">Totale: {{ recap.total_price.toFixed(2) }}&euro;</p>
                        </div>
                        <div class="my-auto d-block d-lg-none">
                            <router-link :to="{ name: 'Order', params: {order_id: order.id, items_list: filtered_items, recap: recap, retailer_id: retailer_id, order: order} }" class="btn my-auto btn-primary" v-if="order != null">
                                <i class="fas fa-check fa mr-2"></i>Procedi
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="card-body" v-show="show_cart" style="max-height:30vh; overflow-y:auto">
                    <div class="col-12">
                        <div class="row justify-content-center my-1" v-for="item in filtered_items" :key="item.index">
                            <div class="col-6 text-left d-flex">
                                <span class="my-auto h4">{{ item.item.name }}</span>
                            </div>
                            <!-- <div class="col-6"> -->
                                <div class="input-group col-6 col-lg-3 col-xl-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend" @click="qtyMinus(item)"><i class="fas fa-minus"></i></span>
                                    </div>
                                    <input type="text" class="form-control text-center" :value="item.qty">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="inputGroupPrepend" @click="qtyPlus(item)"><i class="fas fa-plus "></i></span>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent" v-show="show_cart">
                    <div class="col-12">
                        <router-link :to="{ name: 'Order', params: {order_id: order.id, items_list: filtered_items, recap: recap, retailer_id: retailer_id, order: order} }" class="btn btn-block btn-primary" v-if="order != null">
                            <i class="fas fa-check fa-lg mr-2"></i>Finalizza Ordine
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import { eventBus } from "../app";
export default {
    data() {
        return {
            show_cart: false,
            items: [],
            total: 0,
            retailer_id: null,
            order: null,
            order_completed: false,
            
            style_data: {
                height: ''
            },
        }
    },
    methods: {
        toggleCart() {
            this.style_data.height = window.innerHeight
            this.show_cart = !this.show_cart;
        },

        qtyPlus(item) {
            // if (item.qty > value) {
                //TODO - limit number of items?
            // }
            item.qty++
        },

        qtyMinus(item) {
            if (item.qty > 0) {
                item.qty--
            }
        },

        addItem(product, qty) {
            let duplicates = this.items.filter(item => {
                return item.item.id == product.id;
            });

            if (duplicates[0]) {
                duplicates[0].qty += qty;
            } else {
                let new_item = {
                    item: product,
                    qty: qty,
                    is_modified: false
                };
                this.items.push(new_item);
            }
            /* console.log("updated products list (Shop)", this.order_products); */
            // eventBus.$emit("items-list-updated", this.order_products);
        },

        initOrder() {
            let retailer_id = this.retailer_id;
            let user_id = this.$store.state.user_id ? this.$store.state.user_id : null;

            if (user_id) {
                axios
                    .get('/api/lastUnsubmittedOrder', {
                        'user_id': user_id,
                        'retailer_id': this.$store.state.retailer_id
                    })
                    .then(response => {
                        console.log('initOrder - w/ user_id',response)
                        if (response.data.data) {
                            this.order = response.data.data
                        } else {
                            axios
                                .post('/api/orders/tempStore', {
                                    'retailer_id': retailer_id,
                                    'user_id': user_id
                                })
                                .then(response => {
                                    console.log('tempStore response - w/ user_id', response.data.data)
                                    this.order = response.data.data
                                })
                                .catch(e => {
                                    console.log('tempStore error', e)
                                })
                        }
                    })
                    .catch(e => {
                        console.log(e)
                    })
            } else {
                axios
                    .post('/api/orders/tempStore', {
                        'retailer_id': retailer_id
                    })
                    .then(response => {
                        console.log('tempStore response - w/o user_id', response.data.data)
                        this.order = response.data.data
                    })
                    .catch(e => {
                        console.log('tempStore error', e)
                    })
            }

            // eventBus.$emit('order-created', this.order);
            // console.log('order-created emitted', this.order);
        },
    },
    mounted () {
        if (this.recap.items_number != 0) {
            this.show_cart = true;
        }

        eventBus.$on('retailer-id', (retailer_id) => {
            if(this.retailer_id = null) {
                this.retailer_id = retailer_id;
            } else {
                console.log('shop changed')
            }
            console.log('retailer-id received (Cart)', retailer_id);
        })

        eventBus.$on('items-list-updated', (items_list) => {
            this.items = items_list;
            console.log('items list (Cart)', this.items);
        })

        eventBus.$on('order-completed', () => {
            this.order_completed = true;
            this.items = [];
            console.log('order completed (Cart)');
        })

        eventBus.$on('hide-cart', () => {
            this.order_completed = true;
        })

        eventBus.$on('open-cart', () => {
            this.toggleCart();
        })

        eventBus.$on('item-added-from-product-page', (product, qty) => {
            if(!this.retailer_id) {
                this.retailer_id = product.retailer_id
                this.addItem(product, qty)
            } else if(this.retailer_id && this.retailer_id != product.retailer_id) {
                this.retailer_id = product.retailer_id
                this.items = []
                this.addItem(product, qty)
            } else {
                this.addItem(product, qty)
            }
        })
    },
    watch: {
        retailer_id: function() {
            if (this.$store.getters.userRoleName != 'publisher') {
                this.initOrder()
            }
        },

        order: function() {
            console.log('order-created emitted (Cart)', this.order);
            eventBus.$emit('order-created', this.order);
        },

        recap: function() {
            if(this.recap.items_number == 0) {
                this.show_cart = false
            }

            eventBus.$emit('items-number', this.recap.items_number)
        }
    },
    computed: {
        filtered_items: function() {
            let items = this.items.filter(item => {
                return item.qty > 0
            });
            console.log(items);
            return items;
        },

        recap: function() {
            let recap = {
                'items_number': 0,
                'total_price': 0,
            }
            this.filtered_items.forEach(item => {
                recap.items_number += item.qty,
                recap.total_price += (item.item.price * item.qty)/100
            })
            return recap;
        },
    }
}
</script>
<style scoped lang="scss">

$primary: #005c92;
$secondary: #f18500;
$background: #e9d7c3;

.cart {
  width: 100%;
  height: 80px;
}

.open-cart {
  width: 100%;
  height: 100%;
  min-height: 200px;
}

.card {
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
    border-bottom: none;
}

.bg-secondary {
    background-color: $secondary;
}
</style>