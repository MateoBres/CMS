<template>
    <div class="card shadow mb-5 border-0 overflow-hidden">
        <table class="table text-left mb-0" v-if="orders != null">
            <thead class="thead-light table-borderless">
                <tr>
                    <th></th>
                    <th>Codice</th>
                    <th>Data</th>
                    <th>Negozio</th>
                    <th>Totale</th>
                    <th>Stato</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(order, index) in filteredOrders" :key="index">
                    <td class="my-auto align-middle" v-if="order.is_delivery"><i class="fas fa-shipping-fast text-primary"></i></td>
                    <td class="my-auto align-middle" v-else><i class="fas fa-box text-secondary"></i></td>
                    <td class="my-auto align-middle">{{ order.code }}</td>
                    <td class="my-auto align-middle">{{ formatDate(order.created_at) }}</td>
                    <td class="my-auto align-middle">{{ order.retailer.name }}</td>
                    <td class="my-auto align-middle">{{ orderTotal(order) }}&euro;</td>
                    <td class="my-auto align-middle">{{ order.status.name }}</td>
                    <td class="text-left">
                        <router-link :to="{name: 'OrderDetails', params: { user_id:$route.params.user_id, order_id: order.id, order: order }}" class="btn btn-primary text-white mx-1" exact v-if="order && order.details != null">
                            <i class="fas fa-eye mr-2"></i>Dettagli
                        </router-link>
                        <a class="btn btn-secondary text-white my-2 mx-1" :href="'/api/orders/' + order.id + '/pdf'" target="_blank">
                            <i class="fas fa-file mr-2"></i>Scarica/Stampa PDF
                        </a>
                        <button class="btn btn-danger text-white my-2 mx-1" @click.prevent="cancelOrder(order, index)" v-if="order.status.name == 'nuovo'">
                            <i class="fas fa-times-circle mr-2"></i>Annulla ordine
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import moment from 'moment'
export default {
    props: [
        'user_id'
    ],
    data() {
        return {
            orders: null,
            user: null,
            open_details: [],
            retailer: null,
            filteredOrders: null
        }
    },
    methods: {
        async getRetailerByVat() {
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
        getUser() {
            this.getRetailerByVat();
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };
            axios
                .get(`/api/users/${this.user_id}`, config)
                .then(response => {
                    this.user = response.data.data;
                    this.orders = response.data.data.orders.sort((a, b) => {
                        return new Date(b.created_at) - new Date(a.created_at); // descending
                    });
                    this.filteredOrders = this.orders.filter(order => {
                        return order.retailer_id == this.retailer.id
                    })

                })
                .catch(errors => {
                    console.log(errors)
                });
        },
        itemQty(item) {
            if(item.pivot.modify) {
                return parseInt(JSON.parse(item.pivot.modify).qty);
            } else {
                return 'error'
            }
        },
        orderTotal(order) {
            if(order.details) {
                let totalPrice = 0;
                let info = JSON.parse(order.delivery_info);
                order.details.forEach(item => {
                    let qty = 1;
                    if (item.pivot.modify) {
                        let mult = JSON.parse(item.pivot.modify);
                        qty = parseInt(mult.qty) * qty;
                    }
                    totalPrice = totalPrice + parseInt(item.price) * qty;
                });
                if (info && info.delivery_charge && info.delivery_charge > 0 && order.is_delivery) {
                    return (
                        totalPrice / 100 +
                        parseInt(info.delivery_charge)
                    ).toFixed(2);
                } else {
                    return (totalPrice / 100).toFixed(2);
                }
            }
        },
        totalPrice(item) {
            let totalPrice = item.price * this.itemQty(item);
            return totalPrice/100;
        },
        formatDate(date) {
            return moment(date).locale('it').format('DD-MM-YYYY');
        },
        open(order) {
            console.log('push')
            this.open_details.push(order)
        },
        generatePdf() {
            window.open(`/api/orders/${this.order.id}/pdf`, '_blank');
            // axios
            //     .get(`/api/orders/${this.order.id}/pdf`)
        },
        cancelOrder(order, index) {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };
            axios
                .get(`/api/orders/${order.id}/cancel`, config)
                .then(response => {
                    this.orders.splice(index, 1, response.data.data)
                })
                .catch(e => {
                    console.log(e)
                })
        }
    },
    async mounted() {
        await this.getUser()
    }
}
</script>
<style scoped>
/* th {
    width: 20%;
} */
</style>
