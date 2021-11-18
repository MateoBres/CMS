<template>
    <div>
        <section class="row my-3">
            <div class="col-xs-12 col-md-4 col-lg-2">
                <div class="card text-white bk-green mt-3" v-on:click="showNew">
                    <div class="card-body">
                        <div class="card-text">
                            <span class="badge badge-primary card-badge mr-2">{{
                                newOrders.length
                            }}</span
                            >
                            <span>Nuovi</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-2">
                <div
                    class="card text-white  mt-3 bk-orange"
                    v-on:click="showOnProcessing"
                >
                    <div class="card-body">
                        <div class="card-text">
                            <span class="badge badge-primary card-badge mr-2">{{
                                onProcessingOrders.length
                            }}</span
                            >Lavorazione
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-2">
                <div
                    class="card text-white bk-lightBlu mt-3"
                    v-on:click="showProcessed"
                >
                    <div class="card-body">
                        <div class="card-text">
                            <span class="badge badge-primary card-badge mr-2">{{
                                processedOrders.length
                            }}</span
                            >Evasi
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-2">
                <div
                    class="card text-white  mt-3 bk-purple"
                    v-on:click="showDelivered"
                >
                    <div class="card-body">
                        <div class="card-text">
                            <span class="badge badge-primary card-badge mr-2">{{
                                deliveredOrders.length
                            }}</span
                            >Consegnati
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-2">
                <div
                    class="card text-white  mt-3 bk-red"
                    v-on:click="showDeleted"
                >
                    <div class="card-body">
                        <div class="card-text">
                            <span class="badge badge-primary card-badge mr-2">{{
                                deletedOrders.length
                            }}</span
                            >Annullati
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-2">
                <div class="card text-white bk-grey mt-3" v-on:click="showAll">
                    <div class="card-body">
                        <div class="card-text">
                            <span class="badge badge-primary card-badge mr-2">{{
                                orders.length
                            }}</span
                            >Totali
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="row my-3" v-if="isLoading">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <span style="font-size:3em"
                                ><i class="fas fa-spinner fa-pulse"></i
                            ></span>
                            <h3>Caricamento dati ordini</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="row" id="orderList" v-if="!isLoading">
            <div class="col-12">
                <div
                    class="card mb-2 top-card-header"
                    style="max-height: 40px;"
                >
                    <div
                        class="card-body bk-beige text-center"
                        style="padding: 0"
                    >
                        <div class="card-text">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2 text-center">data/ora</div>
                                    <div class="col-5 text-center">Cliente</div>
                                    <div class="col-4 text-center">Articoli</div>
                                    <div class="col-1 text-center">Totale</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <orderCard
                    v-for="order in showedOrders"
                    v-bind:key="order.code"
                    :order-data="order"
                    :publisher-data="$attrs.publisher_id"
                    :retail-data="$attrs.retailer_id"
                    :status-data="orderStatusList"
                    :retailerInfo="retailerInfo"
                    v-on:changeStatus="testFunction"
                ></orderCard>
            </div>
        </section>
    </div>
</template>

<script>
import orderCard from "../../components/orders/OrderCard";
export default {
    components: {
        orderCard: orderCard
    },
    data() {
        return {
            isLoading: true,
            orders: [],
            newOrders: [],
            onProcessingOrders: [],
            processedOrders: [],
            deliveredOrders: [],
            deletedOrders: [],
            orderStatusList: [],
            showedOrders: [],
            retailerInfo: '',
        };
    },
    mounted() {
        this.getStatuses();
        this.getOrderList();
        this.getRetailer();
        setInterval(() => {
            this.getOrderList();
        }, 300000);
    },
    methods: {
        testFunction() {
            console.log("change status");
            this.orders = [];
            this.newOrders = [];
            this.onProcessingOrders = [];
            this.processedOrders = [];
            this.deliveredOrders = [];
            this.deletedOrders = [];
            this.orderStatusList = [];
            this.showedOrders = [];
            this.getStatuses();
            this.getOrderList();
        },
        getStatuses() {
            axios
                .get("/api/orderStatuses")
                .then(response => {
                    console.log(response.data);
                    this.orderStatusList = response.data.data;
                })
                .catch(errors => {});
        },
        getOrderList() {
            this.orders = [];
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };
            axios
                .get(`/api/retails/${this.$attrs.retailer_id}/orders`, config)
                .then(response => {
                    let orderList = response.data.data.orders;
                    console.log(orderList);
                    orderList.forEach(order => {
                        this.orders.push(order);
                    });
                    this.populateLists(this.orders);
                    this.showedOrders = this.newOrders;
                    this.isLoading = false;
                })
                .catch();
        },
        populateLists(orders) {
            this.newOrders = [];
            this.onProcessingOrders = [];
            this.processedOrders = [];
            this.deliveredOrders = [];
            this.deletedOrders = [];
            console.log("ciao");
            orders.forEach(order => {
                console.log(order.status.name);
                let orderStatus = order.status.name;
                switch (orderStatus) {
                    case "nuovo":
                        this.newOrders.push(order);
                        break;
                    case "in lavorazione":
                        this.onProcessingOrders.push(order);
                        break;
                    case "evaso completo":
                        this.processedOrders.push(order);
                        break;
                    case "evaso incompleto":
                        this.processedOrders.push(order);
                        break;
                    case "consegnato":
                        this.deliveredOrders.push(order);
                        break;
                    case "annullato":
                        this.deletedOrders.push(order);
                        break;
                    default:
                        console.log("status non riconosciuto");
                }
            });
        },
        showOnProcessing() {
            this.showedOrders = this.onProcessingOrders;
        },
        showNew() {
            this.showedOrders = this.newOrders;
        },
        showProcessed() {
            this.showedOrders = this.processedOrders;
        },
        showDelivered() {
            this.showedOrders = this.deliveredOrders;
        },
        showDeleted() {
            this.showedOrders = this.deletedOrders;
        },
        showAll() {
            this.showedOrders = this.orders;
        },
        getRetailer() {
            axios
                .get(`/api/retails/${this.$attrs.retailer_id}`)
                .then(response => {
                    this.retailerInfo = response.data.data;
                    this.$store.dispatch('setRetailerSlug', response.data.data.slug)
                    this.$store.dispatch('setRetailerVat', response.data.data.vat)
                })
                .catch(e => {
                    console.log(e);
                });
        },
    }
};
</script>

<style>
.bk-orange {
    background-color: #f18500;
}

.bk-beige {
    background-color: #e9d7c3;
}

.bk-lightBlu {
    background-color: #34abeb;
}

.bk-red {
    background-color: #eb343a;
}

.bk-green {
    background-color: #11962b;
}

.bk-grey {
    background-color: #728276;
}

.bk-purple {
    background-color: #2b127a;
}

.order-badge {
    font-size: 1.3em;
}
.card-badge {
    font-size: 1.1em;
    color: #000;
    background-color: #fff;
}
#ordersContainer {
    background-color: #f5f5f5;
}
#orderList {
    min-height: 600px;
}
</style>
