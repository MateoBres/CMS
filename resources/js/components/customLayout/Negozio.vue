<template>
<div class="col-12">
    <div class="row justify-content-center">

        <div class="col-12 col-lg-6 p-1">
            <div class="col-12">
                <section class="row">
                    <div class="col-12 mt-2">
                        <p class="pt-2 d-block border-top border-bottom text-uppercase font-weight-bold pb-2">Dati Azienda</p>
                    </div>
                </section>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <p class="bn-negozio"> {{ retailer.name }} </p>
                        <p class="font-weight-bold" v-if="info.description">
                            {{ info.description }}
                        </p>
                        <p>
                            {{ this.retailer.address.address }},
                            {{ this.retailer.address.city }} -
                            {{ this.retailer.address.province }}
                        <br/>
                        Tel. {{ info.phone }}<br />
                        email: <a :href="'mailto:' + info.email">{{ info.email }}</a></p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-12">
                        
                    </div>
                    <!-- SHOW SHIPMENT SECTION -->
                    <div class="col-12 col-md-6 col-lg-12">
                        <p class=""  style="margin-bottom: 0px;" v-if="info.does_shipment"><i class="fa fa-check" aria-hidden="true" style="color:green; font-size:12pt;"></i>
                            <strong>SI EFFETTUANO SPEDIZIONI</strong> - <a href="#nogo" class="" v-on:click="showDetail = !showDetail">Vedi dettaglio costi</a>
                        </p>
                     
                        <div class="row" style="font-size:10pt; margin-left: -10px;">
                            <div class="col-12">
                                <div class="pl-2" v-for="shipment in info.shipments" :key="shipment.name">
                                    <strong>tipo di spedizione: {{ shipment.name }}</strong><br>
                                    <div v-show="showDetail">
                                        <ul>
                                            <li>Costo: {{ shipment.charge }}&euro;</li><br>
                                            <li v-if="shipment.min_ship">Minimo spesa: {{ shipment.min_ship }}&euro;</li><br>
                                            <li v-if="shipment.free_ship">Minimo spesa per invio gratuito: {{ shipment.free_ship }}&euro;</li><br>
                                        </ul>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FINISH SHIPMENT SECTION -->
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 p-1">
            <TimeTable :info="info" />
        </div>

        <div class="col-12 mb-3">
            <div class="col-12 p-0 rounded overflow-hidden border">
                <mappa-shop
                    :lat="geo_lat"
                    :lng="geo_lng"
                    v-if="geo_lat"
                    :retailer-data="retailer"
                />
            </div>
        </div>

    </div><!-- /row -->
</div>
</template>

<script>
import TimeTable from './TimeTable'
import MappaNegozio from './MappaNegozio'
export default {
    name: 'Negozio',
    props: [
        'retailer',
        'info',
        'geo_lat',
        'geo_lng'
    ],
    components: {
        TimeTable,
        'mappa-shop' : MappaNegozio
    },
    data() {
        return {
            showDetail: false,
        }
    }
}
</script>

<style>
.bn-negozio{
    color: #FDAD10;
    font-weight: bold;
    font-size: 1.3rem;
}
</style>
