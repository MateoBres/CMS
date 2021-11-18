<template>
    <div>
        <div id="mappa"></div>
    </div>
</template>

<script>
import "leaflet/dist/leaflet.css";
import "leaflet/dist/leaflet"
import L from 'leaflet';

export default {
    name: 'MappaDetail',
    components: {
    },
    data () {
        return {
            map: null
        }
    },
    mounted () {
        this.initMap();
    },
    methods: {
        initMap() {

            this.map = L.map('mappa', {
                maxBounds: L.latLngBounds(L.latLng(-200, -250), L.latLng(200, 250)),
                zoomControl: false,
            }).setView([15, 25], 4);

            L.tileLayer(
                'https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}{r}.png',
                { maxZoom: 15, minZoom: 3 }
            ).addTo(this.map)
        },
    }
}
</script>

<style scoped>
    #mappa {width: 100%;height: 400px;}
    .cx {margin-left: 20%;margin-right:20%;}
</style>