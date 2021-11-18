<template>
    <div class="card mb-2" v-if="showed">
        <div :class="cardHeaderClass" class="py-1 px-2">
            <strong class="order-card-code">CODICE: {{ order.code }}</strong>
            <span style="color:white" v-if="payment.show"
                >{{ payment.type }} - {{ payment.status }}</span
            >
        </div>

        <div :class="cardBodyClass">
            <div class="card-text">
                <div class="row">
                    <div class="col-2">
                        <span >
                            {{ info.date.day_name }}&nbsp;{{
                                info.date.day_number
                            }}&nbsp;{{ info.date.month_name }}&nbsp;
                            <br />
                            {{ info.date.year }}
                        </span>
                        <br />
                        <span>
                            tra le {{ info.time.start }} e le
                            {{ info.time.end }}
                        </span>
                    </div>
                    <div class="col-2">
                        <strong>{{ order.user.name }}</strong>
                        <br />
                        <small>{{ info.phone }}
                        <br />
                        {{ order.user.email }}</small>
                    </div>
                    <div class="col-3" v-if="info.address.city">
                        <strong>{{ info.address.city }}</strong>
                        <br />
                        {{ info.address.address }}
                        ({{ info.address.province }})
                        <br />
                        <small>
                            campanello
                            <strong>&nbsp;{{ info.address.name }}</strong>
                        </small>
                    </div>

                    <div class="col-4 tex-left">
                        <ul class="order-card-items-list">
                            <ordervoice
                                v-for="detail in order.details"
                                v-bind:key="detail.id"
                                :item-data="detail"
                            ></ordervoice>
                            <li class="text-left" v-if="order.is_delivery">
                                <span>spese consegna</span>
                                <strong class="text-monospace"
                                    >&euro; {{ orderCharge }}</strong
                                >
                            </li>
                            <li class="text-left" v-if="info.is_free">
                                <span>spese invio</span>
                                <strong class="text-monospace"
                                    >Gratis</strong
                                >
                            </li>
                            <li class="text-left" v-else-if="info.is_ship">
                                <span>spese invio</span>
                                <strong class="text-monospace"
                                    >&euro; {{ info.ship_charge }}</strong
                                >
                            </li>

                        </ul>
                    </div>
                    <div class="col-1">
                        <strong>&euro; {{ totalPrice }}</strong>
                        <br />
                        <span
                            v-if="
                                info.payment_info && info.payment_info.is_paid
                            "
                        >
                            <span class="badge badge-pill badge-secondary"
                                >pagato</span
                            >
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <CardDelivery :item="deliveryInfo" v-if="deliveryInfo" />
                </div>
            </div>
        </div>
        <div :class="cardFooterClass" class="py-1 px-2">
            <div class="col-12">
                <div class="row justify-content-between py-1">
                    <div class="col-2 d-flex">
                        <p
                            v-if="order.is_delivery"
                            class="order-card-type my-auto"
                        >
                            <i class="fas fa-shipping-fast mr-2"></i>Consegna a
                            Domicilio
                        </p>
                        <p
                            v-if="order.is_takeaway"
                            class="order-card-type my-auto"
                        >
                            <i class="fas fa-box mr-2"></i>Ritiro in Negozio
                        </p>
                    </div>
                    <div class="col-2 d-flex">
                        <div class="form-group my-auto">
                            <select
                                class="form-control"
                                name
                                id
                                v-model="selected"
                                v-on:change="changeStatus($event)"
                            >
                                <option
                                    v-for="status in statuses"
                                    v-bind:key="status.id"
                                    :value="status.id"
                                    >{{ status.name }}</option
                                >
                            </select>
                        </div>
                    </div>
                    <div class="col-2 d-flex">
                        <button
                            class="btn btn-warning my-auto btn-xs"
                            v-if="deliveryOptions"
                        >
                            <i class="fas fa-truck"></i> Spedisci Con SiWeGo
                        </button>
                        <!--select
                                class="form-control"
                                name
                                id
                                v-model="deliverySelect"
                                v-on:change="getDelivery()"
                            >
                                <option v-for="item in deliveryOptions" :key="item.id" :value="item">
                                    Da: {{item.from}} A: {{item.to}}
                                </option>
                            </select-->
                    </div>
                    <div class="col-3 d-flex">
                        <button
                            class="btn btn-success my-auto"
                            @click="gotoPageDetail()"
                        >
                            <i class="fas fa-eye mr-2"></i>Dettagli &nbsp;
                            <span
                                class="badge badge-warning blink_me"
                                v-if="notaPresente"
                                >nota presente</span
                            >
                        </button>
                    </div>
                    <div class="col-3 d-flex">
                        <a
                            class="btn btn-secondary my-auto"
                            :href="'/api/orders/' + order.id + '/pdf-retailer'"
                            target="_blank"
                        >
                            <i class="fas fa-print mr-2"></i>Stampa/Scarica PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import ordervoice from "./OrderItemVoice";
import CardDelivery from "./CardDelivery";

export default {
    name: "oderCard",
    components: {
        ordervoice,
        CardDelivery
    },
    props: [
        "orderData",
        "publisherData",
        "retailData",
        "statusData",
        "retailerInfo"
    ],
    data() {
        return {
            user: null,
            id_publisher: this.publisherData,
            id_retail: this.retailData,
            order: this.orderData,
            cardHeaderClass: "card-header order-card-header",
            cardBodyClass: "card-body order-card-body",
            cardFooterClass: "card-footer order-card-footer",
            statuses: this.statusData,
            selected: null,
            showed: true,
            payment: {
                type: null,
                status: "",
                show: false
            },
            info: {
                address: {
                    address: null,
                    city: null,
                    province: null,
                    zip_code: null
                },
                date: {
                    day_name: null,
                    day_number: null
                },
                time: {
                    end: null,
                    start: null
                },
                notes: null
            },
            deliveryOptions: "",
            deliverySelect: "",
            deliveryInfo: ""
        };
    },
    computed: {
        totalPrice() {
            let totalPrice = 0;
            this.order.details.forEach(item => {
                let qty = 1;
                if (item.pivot.modify) {
                    let mult = JSON.parse(item.pivot.modify);
                    qty = parseInt(mult.qty) * qty;
                }
                totalPrice = totalPrice + parseInt(item.price) * qty;
            });
            if (this.info.delivery_charge) {
                return (
                    totalPrice / 100 +
                    parseInt(this.info.delivery_charge)
                ).toFixed(2);
            } else if (this.info.is_ship && !this.info.is_free) {
                return (
                    totalPrice / 100 +
                    parseInt(this.info.ship_charge)
                ).toFixed(2);
            } else {
                return (totalPrice / 100).toFixed(2);
            }
        },
        notaPresente() {
            let info = JSON.parse(this.order.delivery_info);
            if (info.notes) {
                return true;
            } else {
                return false;
            }
        },
        orderCharge() {
            if (this.info.delivery_charge && this.order.is_delivery) {
                return parseInt(this.info.delivery_charge).toFixed(2);
            } else {
                return (0).toFixed(2);
            }
        }
    },
    mounted() {
        this.setCard();
        setTimeout(() => {
            this.getDeliveryOption();
        }, 500);
        this.info = JSON.parse(this.order.delivery_info);
        this.payment.status = this.info.payment_info.is_paid
            ? "Pagato"
            : "Pagare Alla Consegna";
        this.payment.type = this.info.payment_info.payment_type
            ? this.info.payment_info.payment_type
            : "";
        this.payment.show = true;

    },
    methods: {
        changeStatus(event) {
            console.log(event.target.value);
            let newStatus = this.statuses.filter(status => {
                return status.id == event.target.value;
            });
            console.log(newStatus[0].name);
            let token = this.$store.state.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
            axios
                .post(
                    `/api/retails/${this.retailData}/orders/${this.order.id}/change_status`,
                    {
                        updatedStatus: newStatus[0].id
                    },
                    config
                )
                .then(response => {
                    this.order.status = newStatus[0];
                    this.setCard();
                    this.$emit("changeStatus");
                    this.showed = false;
                })
                .catch();
        },
        setCard() {
            let status = this.order.status.name;
            this.showed = true;
            switch (status) {
                case "nuovo":
                    this.cardHeaderClass =
                        "card-header order-card-header bg-green";
                    this.cardBodyClass =
                        "card-body order-card-body bg-green-light";
                    this.cardFooterClass =
                        "card-footer order-card-footer bg-green";
                    this.selected = 1;
                    break;
                case "in lavorazione":
                    this.cardHeaderClass =
                        "card-header order-card-header bg-orange";
                    this.cardBodyClass =
                        "card-body order-card-body bg-orange-light";
                    this.cardFooterClass =
                        "card-footer order-card-footer bg-orange";
                    this.selected = 2;
                    break;
                case "evaso completo":
                    this.cardHeaderClass =
                        "card-header order-card-header bg-blue";
                    this.cardBodyClass =
                        "card-body order-card-body bg-blue-light";
                    this.cardFooterClass =
                        "card-footer order-card-footer bg-blue";
                    this.selected = 3;
                    break;
                case "evaso incompleto":
                    this.cardHeaderClass =
                        "card-header order-card-header bg-cyan";
                    this.cardBodyClass =
                        "card-body order-card-body bg-cyan-light";
                    this.cardFooterClass =
                        "card-footer order-card-footer bg-cyan";
                    this.selected = 4;
                    break;
                case "consegnato":
                    this.cardHeaderClass =
                        "card-header order-card-header bg-purple";
                    this.cardBodyClass =
                        "card-body order-card-body bg-purple-light";
                    this.cardFooterClass =
                        "card-footer order-card-footer bg-purple";
                    this.selected = 5;
                    break;
                case "annullato":
                    this.cardHeaderClass =
                        "card-header order-card-header bg-red";
                    this.cardBodyClass =
                        "card-body order-card-body bg-red-light";
                    this.cardFooterClass =
                        "card-footer order-card-footer bg-red";
                    this.selected = 6;
                    break;
                default:
                    this.cardHeaderClass = "card-header order-card-header";
                    this.cardBodyClass = "card-body order-card-body";
                    this.cardFooterClass = "card-footer order-card-footer";
                    this.selected = null;
            }
        },
        gotoPageDetail() {
            this.$router.push({
                path: `/publisher/${this.id_publisher}/retailer/${this.id_retail}/orders/${this.order.id}`
            });
        },
        getDeliveryOption() {
            /*
            let formData = new FormData();
            formData.append("type", 'carry');
            formData.append("from", 'Brescia, BS, Italia');
            formData.append("to", 'Milano, MI, Italia');
            formData.append("date", '2020-12-06');
            */
           if (this.order.is_delivery) {
               var from =
                   this.retailerInfo.address.city +
                   ", " +
                   this.retailerInfo.address.province +
                   ", Italia";
               var to =
                   this.info.address.city +
                   ", " +
                   this.info.address.province +
                   ", Italia";
               var date =
                   this.info.date.year +
                   "-" +
                   this.info.date.month_number +
                   "-" +
                   this.info.date.day_number;
               console.log("date", date);
               console.log("retailer info", this.retailerInfo);

               var url = `/api/siwego?type=carry&from=${from}&to=${to}&date=${date}`;

               axios
                   .get(url)
                   .then(response => {
                       console.log("sewego", response.data);
                       this.deliveryOptions = response.data.data;
                   })
                   .catch(error => {
                       console.log(error);
                   });
           }
        },
        getDelivery() {
            console.log("test select value", this.deliverySelect);
            this.deliveryInfo = this.deliverySelect;
        }
    }
};
</script>

<style>
.bg-green-light {
    background-color: #c9f2d4;
}
.bg-red-light {
    background-color: #f5b3b3;
}
.bg-orange-light {
    background-color: #f5d3b3;
}
.bg-purple-light {
    background-color: #f7d1ff;
}
.bg-blue-light {
    background-color: #dee3fc;
}
.bg-cyan-light {
    background-color: #f8f8f8;
}
.bg-green {
    background-color: #11962b;
}
.bg-red {
    background-color: #eb343a;
}
.bg-orange {
    background-color: #f18500;
}
.bg-blue {
    background-color: #34abeb;
}
.bg-purple {
    background-color: #2b127a;
}
.bg-cyan {
    background-color: #34abeb;
}

.order-card-header {
    max-height: 30px;
    padding: 0 0 0 5px;
    text-align: left;
}

/* .order-card-body {
        padding-bottom: 0;
    } */
/* .order-card-footer {
        max-height: 50px;
        padding: 5px 5px 5px 5px;
    } */
.order-card-items-list {
    padding: 0;
    list-style: none;
}

.order-card-code {
    color: #fff;
}

.order-card-type {
    color: #fff;
    font-size: 1.2em;
}

.blink_me {
    animation: blinker 1s linear infinite;
}

@keyframes blinker {
    50% {
        opacity: 0;
    }
}
</style>
