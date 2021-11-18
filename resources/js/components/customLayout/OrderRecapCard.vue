<template>
  <div class="card shadow mt-2">
    <div class="card-header bg-transparent">
      <p class="h5">Ordine Inoltrato con Successo - codice: {{ order.code }}</p>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-10">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Articolo</th>
                            <th>Quantità</th>
                            <th>Prezzo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in itemsList" :key="item.index">
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
                </table>
            </div>
            <div class="col-xs-12 col-md-10">
                <div class="row">
                    <div class="col-xs-6 col-md-6 text-right">
                        Totale Articoli: {{ recap.items_number }}
                    </div>
                    <div class="col-xs-6 col-md-6 text-right" v-if="orderType != 'delivery'">
                        Totale: {{ recap.total_price.toFixed(2) }}&euro;
                    </div>
                </div>
                <div class="row" v-if="orderType == 'delivery'">
                    <div class="col-6 text-right">
                        Consegna: {{ deliveryCharge.toFixed(2)/100 }}&euro;
                    </div>
                    <div class="col-6 text-right">
                        Totale: {{ totalWithDelivery.toFixed(2) }}&euro;
                    </div>
                </div>
            </div>
        </div>
        <div class="card-text mt-3">
            Il tuo ordine è stato inoltrato con successo, clicka sul bottone sottostante per tornare alla homepage
        </div>
    </div>
    <div class="card-footer bg-bg-transparent">
        <router-link :to="{path: `/azienda/${$store.state.retailerSlug}/${$store.state.retailerVat}`}" class="btn btn-primary btn-block">
            Torna alla Homepage
        </router-link>
    </div>
  </div>
</template>
<script>
  export default {
    props: [
      'deliveryCharge',
      'itemsList',
      'order',
      'orderType',
      'recap',
      'totalWithDelivery',
    ]
  }
</script>
