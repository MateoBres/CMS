<template>
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-12 text-left mt-3">
                <a class="btn btn-primary text-white" @click="$router.go(-1)" style="color: #fff">
                    <i class="fas fa-chevron-circle-left mr-2"></i>
                    Torna alla pagina precedente
                </a>
            </div>
        </div>
        <div class="row my-3 justify-content-start">
            <div class="col-12">
                <div class="card">
                    <div :class="cardHeaderClass">
                        <h5>{{ order_status_message }} - {{ order_code }}</h5>
                    </div>
                    <div :class="cardBodyClass">
                        <div class="card-text">
                            <div class="row justify-content-center">
                                <div class="col-xs-12 col-md-4">
                                    <div :class="order_type_class">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ order_type }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-xs-12 col-md-12">
                                    <div class="card-deck">
                                        <div class="card">
                                            <div class="card-header">
                                                <small>Orario di consegna</small>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-text">
                                                    <span>
                                                        {{
                                                        info.date.day_name
                                                        }}&nbsp;{{
                                                        info.date
                                                        .day_number
                                                        }}&nbsp;{{
                                                        info.date
                                                        .month_name
                                                        }}&nbsp;{{
                                                        info.date.year
                                                        }}
                                                    </span>
                                                    <br />
                                                    <span>
                                                        tra le
                                                        {{ info.time.start }} e
                                                        le
                                                        {{
                                                        info.time.end
                                                        }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <small>
                                                    Indirizzo di
                                                    consegna
                                                </small>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-text">
                                                    {{ info.address.address
                                                    }}
                                                    <br />
                                                    {{ info.address.zip_code
                                                    }}
                                                    <br />
                                                    {{
                                                    info.address.city
                                                    }}&nbsp;{{
                                                    info.address.province
                                                    }}
                                                    <br />
                                                    {{ info.address.name }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <small>Contatti</small>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-text">
                                                    <strong>
                                                        {{
                                                        user_name
                                                        }}
                                                    </strong>
                                                    <br />
                                                    <strong>
                                                        {{
                                                        user_email
                                                        }}
                                                    </strong>
                                                    <br />
                                                    <strong>
                                                        {{
                                                        info.phone
                                                        }}
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3" v-if="info.notes">
                                <div class="col-xs-12 col-md-12">
                                    <div class="card">
                                        <div class="card-header">Nota dal cliente</div>
                                        <div class="card-body">
                                            <p class="card-text">{{ info.notes }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-xs-12 col-md-12">
                                    <div class="card">
                                        <div class="card-header">Riepilogo Ordine</div>
                                        <div class="card-body">
                                            <div class="card-text">
                                                <table class="table table-borderless text-left">
                                                    <thead>
                                                        <th>codice</th>
                                                        <th>nome</th>
                                                        <th>desc</th>
                                                        <th>quantità</th>
                                                        <th>p/cad</th>
                                                        <th>tot</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            v-for="item in order_items"
                                                            v-bind:key="item.id"
                                                        >
                                                            <td>{{ item.sku }}</td>
                                                            <td>{{ item.name }}

                                                            </td>
                                                            <td>
                                                                {{
                                                                item.description
                                                                | truncateText
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                item.details
                                                                .qty
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                (
                                                                item.price /
                                                                100
                                                                ).toFixed(
                                                                2
                                                                )
                                                                }}&nbsp;&euro;
                                                            </td>
                                                            <td>
                                                                {{
                                                                (
                                                                (item.price /
                                                                100) *
                                                                item
                                                                .details
                                                                .qty
                                                                ).toFixed(
                                                                2
                                                                )
                                                                }}&nbsp;&euro;
                                                            </td>
                                                        </tr>
                                                        <tr
                                                            v-if="
                                                                order_type ==
                                                                    'Consegna a Domicilio'
                                                            "
                                                        >
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                spesa di
                                                                consegna
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                {{
                                                                orderCharge
                                                                }}
                                                                &nbsp;&euro;
                                                            </td>
                                                        </tr>
                                                        <tr
                                                            v-if="
                                                                order_type ==
                                                                    'Spedizione'
                                                            "
                                                        >
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                spesa di
                                                                spedizione
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                {{
                                                                orderCharge
                                                                }}
                                                                &nbsp;&euro;
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right mr-5">
                                            <small>totale:</small>&nbsp;
                                            <strong>
                                                {{
                                                totalPrice
                                                }}&nbsp;&euro;
                                            </strong>
                                            &nbsp;
                                            <span
                                                v-if="
                                                    info.payment_info && info.payment_info.is_paid
                                                "
                                                class="badge badge-pill badge-secondary"
                                            >pagato con carta di credito</span>
                                        </div>
                                    </div>
                                    <div class="row mt-4 justify-content-center">
                                        <!-- <a class="btn btn-primary" :href="'/api/orders/' + order_id + '/pdf-retailer'" target="_blank">
                                            <i class="fas fa-print mr-2"></i>Stampa/Scarica PDF
                                        </a>-->
                                        <a
                                            class="btn btn-secondary text-white my-2"
                                            :href="
                                                '/api/orders/' +
                                                    order_id +
                                                    '/pdf-retailer'
                                            "
                                            target="_blank"
                                        >
                                            <i class="fas fa-file mr-2"></i>Scarica/Stampa PDF
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "OrderDetail",
    props: ["order_id", "publisher_id", "retailer_id"],
    data() {
        return {
            id_order: this.order_id,
            order_code: "",
            order_type: "",
            order_type_class: "",
            cardHeaderClass: "card-header order-card-header",
            cardBodyClass: "card-body order-card-body",
            cardFooterClass: "card-footer order-card-footer",
            order_status: "",
            order_status_message: "",
            user_name: null,
            user_mail: null,
            user_phone: null,
            orderDetails: null,
            info: {
                address: {
                    address: null,
                    city: null,
                    province: null,
                    zip_code: null,
                    name: null
                },
                date: {
                    day_name: null,
                    day_number: null
                },
                time: {
                    end: null,
                    start: null
                }
            },
            order_items: []
        };
    },
    computed: {
        totalPrice() {
            let totalPrice = 0;
            this.order_items.forEach(item => {
                /*   totalPrice = totalPrice + parseInt(item.price); */
                let qty = 1;
                if (item.pivot.modify) {
                    let mult = JSON.parse(item.pivot.modify);
                    qty = parseInt(mult.qty) * qty;
                }
                totalPrice = totalPrice + parseInt(item.price) * qty;
            });
            /*  return (totalPrice / 100).toFixed(2); */
            if (this.info.delivery_charge) {
                return (
                    totalPrice / 100 +
                    parseInt(this.info.delivery_charge)
                ).toFixed(2);
            } else if (this.info.is_ship == true && !this.info.is_free) {
                console.log(this.info.ship_charge)
                return (
                    totalPrice / 100 +
                    parseInt(this.info.ship_charge)
                ).toFixed(2);
            } else {
                return (totalPrice / 100).toFixed(2);
            }
        },
        orderCharge() {
            if ( this.info.delivery_charge && this.order_type == "Consegna a Domicilio") {
                return parseInt(this.info.delivery_charge).toFixed(2);
            } else if ( this.info.is_ship && this.order_type == "Spedizione" && !this.info.is_free) {
                return parseInt(this.info.ship_charge).toFixed(2);
            } else {
                return (0).toFixed(2);
            }
        }
    },
    mounted() {
        this.getOrder();
    },
    methods: {
        getOrder() {
            let token = this.$store.state.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
            axios
                .get(
                    `/api/retails/${this.retailer_id}/orders/${this.order_id}`,
                    config
                )
                .then(response => {
                    this.orderDetails = response.data.data;
                    this.order_code = this.orderDetails.code;
                    this.order_status = this.orderDetails.status.name;
                    this.info = JSON.parse(this.orderDetails.delivery_info);
                    this.user_name = this.orderDetails.user.name;
                    this.user_email = this.orderDetails.user.email;
                    let items = this.orderDetails.details;
                    items.forEach(item => {
                        if (item.pivot.modify) {
                            console.log(JSON.parse(item.pivot.modify));
                            item.details = JSON.parse(item.pivot.modify);
                        } else {
                            item.details = {
                                qty: 1
                            };
                        }

                        this.order_items.push(item);
                    });
                    if (this.orderDetails.is_delivery == true) {
                        this.order_type = "Consegna a Domicilio";
                        this.order_type_class = "card order-type-delivery";
                    } else if (this.info.is_ship == true)  {
                        this.order_type = "Spedizione";
                        this.order_type_class = "card order-type-delivery";
                    } else {
                        this.order_type = "Ritiro in Negozio";
                        this.order_type_class = "card order-type-takeaway";
                    }
                    this.setCard();
                })
                .catch(errors => {});
        },
        setCard() {
            let status = this.order_status;
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
                    this.order_status_message = "Nuovo Ordine";
                    break;
                case "in lavorazione":
                    this.cardHeaderClass =
                        "card-header order-card-header bg-orange";
                    this.cardBodyClass =
                        "card-body order-card-body bg-orange-light";
                    this.cardFooterClass =
                        "card-footer order-card-footer bg-orange";
                    this.selected = 2;
                    this.order_status_message = "Ordine in lavorazione";
                    break;
                case "evaso completo":
                    this.cardHeaderClass =
                        "card-header order-card-header bg-blue";
                    this.cardBodyClass =
                        "card-body order-card-body bg-blue-light";
                    this.cardFooterClass =
                        "card-footer order-card-footer bg-blue";
                    this.selected = 3;
                    this.order_status_message = "Ordine Evaso e Completato";
                    break;
                case "evaso incompleto":
                    this.cardHeaderClass =
                        "card-header order-card-header bg-cyan";
                    this.cardBodyClass =
                        "card-body order-card-body bg-cyan-light";
                    this.cardFooterClass =
                        "card-footer order-card-footer bg-cyan";
                    this.selected = 4;
                    this.order_status_message = "Ordine Evaso ma Incompleto";
                    break;
                case "consegnato":
                    this.cardHeaderClass =
                        "card-header order-card-header bg-purple";
                    this.cardBodyClass =
                        "card-body order-card-body bg-purple-light";
                    this.cardFooterClass =
                        "card-footer order-card-footer bg-purple";
                    this.selected = 5;
                    this.order_status_message = "Ordine consegnato";
                    break;
                case "annullato":
                    this.cardHeaderClass =
                        "card-header order-card-header bg-red";
                    this.cardBodyClass =
                        "card-body order-card-body bg-red-light";
                    this.cardFooterClass =
                        "card-footer order-card-footer bg-red";
                    this.selected = 6;
                    this.order_status_message = "Ordine Annullato";
                    break;
                default:
                    this.cardHeaderClass = "card-header order-card-header";
                    this.cardBodyClass = "card-body order-card-body";
                    this.cardFooterClass = "card-footer order-card-footer";
                    this.selected = null;
            }
        },
        getPdf() {
            let data = {
                delivery_time:
                    this.info.date.day_name +
                    " " +
                    this.info.date.day_number +
                    " " +
                    this.info.date.year,
                delivery_address:
                    this.info.address.address +
                    ", " +
                    this.info.address.zip_code +
                    ", " +
                    this.info.address.city +
                    ", " +
                    this.info.address.province +
                    " - " +
                    this.info.address.name,
                contacts:
                    "Nome Utente: " +
                    this.user_name +
                    ", email: " +
                    this.user_email +
                    ", telefono: " +
                    this.info.phone,
                notes: "Note: " + this.info.notes,
                order_id: this.order_id
            };

            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };

            axios
                .post(`/api/orders/${this.order_id}/pdf-retailer`, data, config)
                .then(response => {
                    console.log(response);
                    console.log("did the thing boss");
                })
                .catch(e => {
                    console.log(e);
                });
        }
    }
};
</script>

<style>
    .order-type-delivery {
        background-color: orangered;
        color: white;
    }
    .order-type-takeaway {
        background-color: blue;
        color: white;
    }
</style>
