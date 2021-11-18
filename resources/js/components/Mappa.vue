<template>
    <div class="justify-content-center">
        <div id="mappa"></div>
    </div>
</template>

<script>
import "leaflet/dist/leaflet.css";
import "leaflet/dist/leaflet"

import "leaflet.markercluster/dist/leaflet.markercluster"
import "leaflet.markercluster/dist/MarkerCluster.Default.css";

import * as L from 'leaflet';
import 'leaflet.markercluster';

//import L from 'leaflet';

// eslint-disable-next-line  
delete L.Icon.Default.prototype._getIconUrl  
// eslint-disable-next-line  
L.Icon.Default.mergeOptions({  
  iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),  
  iconUrl: require('leaflet/dist/images/marker-icon.png'),  
  shadowUrl: require('leaflet/dist/images/marker-shadow.png')  
})

import Search from './Search'
import { eventBus } from '../app';
export default {
    name: 'Mappa',
    props: ['item', 'startPosition', 'startPositionGPS', 'update'],
    components: {
        Search
    },
    data () {
        return {
            map: null,
            center: null,
            zoom: null,
        }
    },
    watch: {
        startPosition: function() {
            this.map.remove();
            this.initMap();
            this.initCluster();
        },
        startPositionGPS: function() {
            this.map.remove();
            this.initMap();
            this.initCluster();
        }
    },
    mounted () {
        if(!this.update) {
            this.initMap();
        } else {
            console.log('update', [this.update, this.item])
            this.updateMap();
        }
        this.initCluster();
    },
    methods: {
        initMap() {
            var startCoordinates = [45.5431049,10.1799031];
            if (this.startPositionGPS) {
                console.log("vedi gps?", this.startPositionGPS);
                var lat =  this.startPositionGPS.coords.latitude;
                var lon = this.startPositionGPS.coords.longitude;
                startCoordinates = [lat, lon];
            }
            else if (this.startPosition) {
                console.log("coordinate ip", this.startPosition.lat, this.startPosition.lon);
                var lat = this.startPosition.lat;
                var lon = this.startPosition.lon;
                startCoordinates = [lat, lon];
            }
            this.map = L.map('mappa', {
                maxBounds: L.latLngBounds(L.latLng(-200, -250), L.latLng(200, 250)),
                zoomControl: true,
            }).setView(startCoordinates, 15);

            L.tileLayer(
                'https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}{r}.png',
                { maxZoom: 18, minZoom: 0 }
            ).addTo(this.map)

        },

        updateMap() {
            this.centerMap(this.item)

            this.map = L.map('mappa', {
                maxBounds: L.latLngBounds(L.latLng(-200, -250), L.latLng(200, 250)),
                zoomControl: true,
            }).setView([this.center[0], this.center[1]], this.zoom);

            L.tileLayer(
                'https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}{r}.png',
                { maxZoom: 18, minZoom: 0 }
            ).addTo(this.map)

            var markers = L.markerClusterGroup({
                spiderfyOnMaxZoom: false,
                showCoverageOnHover: false,
                zoomToBoundsOnClick: false
            });

            this.item.forEach(retailer => {
                let info = JSON.parse(retailer.info)
                if(info.geo.lat && info.geo.lng) {
                    markers.addLayer(L.marker(info.geo).on('click', (e) => {
                        L.DomEvent.stopPropagation(e)
                        this.retailerDetail('Retailer', retailer.slug, retailer.vat)
                    }))
                }
                this.map.addLayer(markers)
            })
        },

        initMarker() {
            this.item.map((m) => {
                let info = JSON.parse(m.info);
                // console.log("coordinates:", info.geo);
                
                if (info.geo.lat && info.geo.lng) {

                    b.push(info.geo);

                    var marker = new L.marker(info.geo);
                    marker.addTo(this.map);

                     marker.on('click', (e) => {
                        L.DomEvent.stopPropagation(e)
                        console.log("click:", e);
                        this.retailerDetail('Retailer', m.slug, m.vat);
                    });
                }

            })
        },

        initCluster () {
            console.log('initCluster', this.item)
            var markers = L.markerClusterGroup({
                spiderfyOnMaxZoom: false,
                showCoverageOnHover: false,
                zoomToBoundsOnClick: false
            });

            this.item.map((m) => {
                let info = JSON.parse(m.info);
                // console.log("coordinates:", info.geo);
                
                if (info.geo.lat && info.geo.lng) {
                    markers.addLayer(L.marker(info.geo).on('click', (e) => {
                                L.DomEvent.stopPropagation(e)
                                console.log("click:", e);
                                this.retailerDetail('Retailer', m.slug, m.vat);
                            })
                        );
                this.map.addLayer(markers);    
                }
            })
            this.map.addLayer(markers);
        },

        retailerDetail(PageName, slug, vat) {
            this.$router.push({ name: PageName, params: { slug: slug, vat: vat} });
        },

        panMap() {
            this.map.panTo(this.center, this.zoom)
        },

        distance(lat1, lon1, lat2, lon2, unit) {
            if ((lat1 == lat2) && (lon1 == lon2)) {
                return 0;
            }
            else {
                var radlat1 = Math.PI * lat1/180;
                var radlat2 = Math.PI * lat2/180;
                var theta = lon1-lon2;
                var radtheta = Math.PI * theta/180;
                var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
                if (dist > 1) {
                    dist = 1;
                }
                dist = Math.acos(dist);
                dist = dist * 180/Math.PI;
                dist = dist * 60 * 1.1515;
                if (unit=="K") { dist = dist * 1.609344 }
                if (unit=="N") { dist = dist * 0.8684 }
                return dist;
            }
        },

        centerMap(results) {
            console.log('centerMap results', results)
            if(results.length == 1) {
                this.center = [
                    Number(JSON.parse(results[0].info).geo.lat),
                    Number(JSON.parse(results[0].info).geo.lng),
                ],
                this.zoom = 15
            }
            
            else {
                let lats = []
                let lngs = []
    
                results.forEach(retailer => {
                    let info = JSON.parse(retailer.info)
                    if(info.geo.lat && info.geo.lng) {
                        lats.push(info.geo.lat)
                        lngs.push(info.geo.lng)
                    }
                })
    
                lats.sort(function(a, b){return a - b});
                lngs.sort(function(a, b){return a - b});
    
                let lat_len = 0;
                let lng_len = 0;
    
                if (lats[0] < 0) {
                    lat_len = Math.abs(lats[0]) + lats[lats.length-1]
                } else {
                    lat_len = lats[lats.length-1] - lats[0]
                }
    
                if (lngs[0] < 0) {
                    lng_len = Math.abs(lngs[0]) + lngs[lngs.length-1]
                } else {
                    lng_len = lngs[lngs.length-1] - lngs[0]
                }
    
                this.center = [
                    Number(lats[0]) + lat_len/2,
                    Number(lngs[0]) + lng_len/2
                ]
    
                let my_unit = 'M'
                let dist = this.distance(lats[0], lngs[0], lats[lats.length-1], lngs[lngs.length-1], my_unit);
                this.zoom = Math.round(14-Math.log(dist/2)/Math.LN2)-1;
            }
        },
    },
}
</script>

<style scoped>
    #mappa {width: 100%;height: 75vh; z-index: 0;}
</style>