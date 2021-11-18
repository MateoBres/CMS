<template>
    <div class="container" :style="{'min-height': h}" v-if="!loading">
        <div class="row">
            <div class="col-12 text-left mt-5">
                <a class="btn btn-primary text-white my-2" @click="$router.go(-1)">
                    <i class="fas fa-chevron-circle-left mr-2"></i>
                    Torna alla pagina precedente
                </a>
            </div>
            <div class="col-12 text-center">
                <div class="card shadow mb-5 border-0">
                    <table class="table mb-0">
                        <thead class="thead-light table-borderless">
                            <th>Articolo</th>
                            <th>Quantità</th>
                            <th>Prezzo</th>
                        </thead>
                        <tbody v-if="!loading">
                            <tr v-for="item in order.details" :key="item.index">
                                <td>{{ item.name }}</td>
                                <td>{{ itemQty(item) }}</td>
                                <td>{{ totalPrice(item) }}&euro;</td>
                            </tr>
                            <tr v-if="order.is_delivery">
                                <td>Spese di spedizione</td>
                                <td></td>
                                <td>{{ deliveryCharge() }}&euro;</td>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Totale: {{ orderTotal(order) }}&euro;</th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row justify-content-center">
                        <div class="col-10 text-left">
                            <div class="d-flex flex-row justify-content-between mt-5">
                                <div class="d-flex flex-column">
                                    <label>Codice Ordine</label>
                                    <p class="font-weight-bold"><i :class="iconClass"></i>{{ order.code }}</p>
                                </div>
                                <div class="d-flex flex-column">
                                    <label>Negozio</label>
                                    <p class="font-weight-bold">{{ order.retailer.name }}</p>
                                </div>
                                <div class="d-flex flex-column">
                                    <label>Data</label>
                                    <p class="font-weight-bold">{{ JSON.parse(order.delivery_info).date.day_number }} {{ JSON.parse(order.delivery_info).date.month_name }} {{ JSON.parse(order.delivery_info).date.year }}</p>
                                </div>
                                <div class="d-flex flex-column">
                                    <label>Stato</label>
                                    <p class="font-weight-bold">{{ order.status.name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-right">
                <a class="btn btn-secondary text-white my-2" :href="'/api/orders/' + $route.params.order_id + '/pdf'" target="_blank">
                    <i class="fas fa-file mr-2"></i>Scarica/Stampa PDF
                </a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: [
        'orderProp'
    ],
    data() {
        return {
            order:null,
            loading:true
        }
    },
    computed: {
        h: function() {
            return (window.innerHeight - 369.67) + 'px'
        },

        iconClass: function() {
            if(this.order && this.order.is_delivery) {
                return 'fas fa-shipping-fast mr-2 text-primary'
            } else {
                return 'fas fa-box mr-2 text-secondary'
            }
        }
    },
    mounted() {
        this.getOrder()
    },
    methods: {
        itemQty(item) {
            if(item.pivot.modify) {
                return parseInt(JSON.parse(item.pivot.modify).qty);
            } else {
                return 'error'
            }
        },
        totalPrice(item) {
            let totalPrice = item.price * this.itemQty(item);
            return totalPrice/100;
        },
        deliveryCharge() {
            let info = JSON.parse(this.order.delivery_info);
            if(info.delivery_charge) {
                return parseInt(info.delivery_charge)
            } else {
                return 0
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
                if (info.delivery_charge > 0 && order.is_delivery) {
                    return (totalPrice / 100 + parseInt(info.delivery_charge)).toFixed(2);
                } else {
                    return (totalPrice / 100).toFixed(2);
                }
            }
        },
        generatePdf() {
            window.open(`/api/orders/${this.order.id}/pdf`, '_blank');
            // axios
            //     .get(`/api/orders/${this.order.id}/pdf`)
        },
        getOrder() {
            console.log('getOrder', this.$route.params.order_id)
            let token = this.$store.getters.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
            axios
                .get(
                    `/api/orders/${this.$route.params.order_id}`,
                    config
                )
                .then(response => {
                    let order
                    order = response.data.data
                    this.order = order
                    this.loading = false
                })
                .catch(errors => {});
        },
    }
}
</script>
