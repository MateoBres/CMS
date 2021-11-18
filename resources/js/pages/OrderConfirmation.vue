<template>
    <div class="container mt-5" :style="style_data">
        <retailer-logo />
        <h1 class="text-center">{{ order.retailer.name }}</h1>
        <div class="card shadow mt-2">
            <div class="card-header bg-transparent">
                <p class="h5">Ordine Inoltrato con Successo - codice: <strong>{{ order.code }}</strong></p>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-xs-12 col-md-10">
                        <table class="table table-striped text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Articolo</th>
                                    <th>Quantità</th>
                                    <th>Prezzo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in items_list" :key="item.index">
                                    <td>
                                        {{ item.item.name }}
                                        <span v-if="item.variation.parent">
                                        ({{ item.variation.parent}} - {{ item.variation.child }})
                                        </span>
                                        <span v-if="item && item.item && item.item.info && JSON.parse(item.item.info).weight.price">
                                            ({{ JSON.parse(item.item.info).weight.price }} al {{ JSON.parse(item.item.info).weight.unit }})
                                        </span>
                                         <span v-if="item && item.item && item.item.info && JSON.parse(item.item.info).size.price">
                                            ({{ JSON.parse(item.item.info).price }} al {{ JSON.parse(item.item.info).size.unit }})
                                        </span>
                                    </td>
                                    <td>{{ item.qty }}</td>
                                    <td>{{ ((item.item.price * item.qty)/100).toFixed(2) }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td v-if="order_type == 'delivery'">Consegna: {{ delivery_charge.toFixed(2)/100 }}&euro;</td>
                                    <td v-else-if="order_type == 'shipment'">Spedizione: <span v-if="!is_free">{{ shipment_type.charge.toFixed(2)/100 }}&euro;</span><span v-if="is_free">Gratis</span></td>
                                    <td v-else></td>

                                    <td>Totale Articoli: {{ recap.items_number }}</td>

                                    <td v-if="order_type == 'delivery'">Totale: {{ total_with_delivery.toFixed(2) }}&euro;</td>
                                    <td v-else-if="order_type == 'shipment'">Totale: {{ total_with_shipment.toFixed(2) }}&euro;</td>
                                    <td v-else></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-text mt-3">
                    Il tuo ordine è stato inoltrato con successo, clicka sul bottone sottostante per tornare alla homepage
                </div>
                <div class="col-12 py-5">
                    <router-link
                        :to="{path: `/azienda/${$store.state.retailerSlug}/${$store.state.retailerVat}`}"
                        class="btn btn-primary btn-block"
                    >
                        Torna alla Homepage
                    </router-link>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import OrderRecapCard from '../components/customLayout/OrderRecapCard.vue'
import RetailerLogo from '../components/customLayout/RetailerLogo.vue'
export default {
    components: {
        OrderRecapCard,
        RetailerLogo,
    },
    props: ['order', 'items_list', 'recap', 'total_with_delivery', 'delivery_charge', 'order_type', 'total_with_shipment', 'shipment_type', 'is_free'],
    data() {
        return {
            style_data: {
                height: window.innerHeight
            },
        }
    }
}
</script>
<style scoped lang="scss">
    $primary: #005c92;
    $secondary: #f18500;
    $background: #e9d7c3;

    .btn-primary {
        background-color: $primary;
    }
</style>
