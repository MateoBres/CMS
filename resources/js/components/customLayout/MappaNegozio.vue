<template>
    <div class="justify-content-center" style="height:500px">
        <div id="mappa"></div>
    </div>
</template>

<script>
import "leaflet/dist/leaflet.css";
import "leaflet/dist/leaflet";
import L from "leaflet";

// eslint-disable-next-line
delete L.Icon.Default.prototype._getIconUrl;
// eslint-disable-next-line
L.Icon.Default.mergeOptions({
    iconRetinaUrl: require("leaflet/dist/images/marker-icon-2x.png"),
    iconUrl: require("leaflet/dist/images/marker-icon.png"),
    shadowUrl: require("leaflet/dist/images/marker-shadow.png")
});

/* import Search from "./Search"; */
export default {
    name: "MappaNegozio",
    props: ["lat", "lng", "retailerData"],
    data() {
        return {
            map: null,
            marker_lat: this.lat,
            marker_lng: this.lng
        };
    },
    mounted() {
        this.initMap();
        this.initMarker();
    },
    methods: {
        initMap() {
            this.map = L.map("mappa", {
                zoomControl: false,
                dragging: !L.Browser.mobile
            }).setView([14, 25], 11);

            L.tileLayer(
                "https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}{r}.png",
                { maxZoom: 17, minZoom: 3 }
            ).addTo(this.map);

            this.map.invalidateSize()
        },

        initMarker() {
            if (this.marker_lat && this.marker_lng) {
                let marker = new L.marker([this.marker_lat, this.marker_lng]);
                marker.addTo(this.map);
                this.centerLeafletMapOnMarker(this.map, marker);
                marker.on("click", e => {
                    L.DomEvent.stopPropagation(e);
                    console.log("click:", e);
                });
                marker
                    .bindPopup(
                        `<b>${this.retailerData.name}</b><br>
                        <small>${this.retailerData.address.address}</small><br>
                        <small>${this.retailerData.address.city} - ${this.retailerData.address.province}</small><br>
                        `
                    )
                    .openPopup();
            }

            this.map.invalidateSize()
        },
        centerLeafletMapOnMarker(map, marker) {
            var latLngs = [marker.getLatLng()];
            var markerBounds = L.latLngBounds(latLngs);
            map.fitBounds(markerBounds);
        }
    }
};
</script>

<style scoped>
#mappa {
    width: 100%;
    height: 100%;
}
</style>