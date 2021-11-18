<template>
   <div class="pb-5 d-flex flex-column">

       <!-- <shop-header
        :cover="cover"
        :logo="logo"
        :retailerName="retailer.name"/> -->

        <div id="cover-container" class="d-flex w-100">
            <img id="cover-image" :src="cover" class="w-100">
        </div>

        <div v-if="retailer.is_published" id="shop-content" class="mx-auto">
            <div class="w-100 d-flex" style="height:34vh">
                <div class="d-flex flex-column w-100" style="height:15vh">
                    <div style="width: 15vh; height: 15vh" class="mx-auto">
                        <img :src="logo" class="w-100 rounded-circle">
                    </div>
                    <div style="height: 15vh;" class="d-flex flex-column mx-auto">
                        <div class="d-flex flex-column my-auto p-1 p-md-3 rounded text-white">
                            <p class="main-title d-flex d-sm-none font-weight-bold text-center mx-auto">{{ retailer.name }}</p>
                            <p class="main-title d-none d-md-flex font-weight-bold h1 text-center mx-auto">{{ retailer.name }}</p>
                            <div class="d-flex flex-row justify-content-center">
                                <a
                                    class="mx-1 mx-md-2"
                                    v-if="info_social.facebook != null && info_social.facebook != ''"
                                    :href="info_social.facebook"
                                    target="_blank"
                                >
                                    <span class="d-none d-md-flex fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x text-white"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x text-dark"></i>
                                    </span>
                                    <span class="d-flex d-md-none fa-stack">
                                        <i class="fa fa-circle fa-stack-2x text-white"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x text-dark"></i>
                                    </span>
                                </a>

                                <a
                                    class="mx-1 mx-md-2"
                                    v-if="info_social.twitter != null && info_social.twitter != ''"
                                    :href="info_social.twitter"
                                    target="_blank"
                                >
                                    <span class="d-none d-md-flex fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x text-white"></i>
                                        <i class="fab fa-twitter fa-stack-1x text-dark"></i>
                                    </span>
                                    <span class="d-flex d-md-none fa-stack">
                                        <i class="fa fa-circle fa-stack-2x text-white"></i>
                                        <i class="fab fa-twitter fa-stack-1x text-dark"></i>
                                    </span>
                                </a>

                                <a
                                    class="mx-1 mx-md-2"
                                    v-if="info_social.instagram != null && info_social.instagram != ''"
                                    :href="info_social.instagram"
                                    target="_blank"
                                >
                                    <span class="d-none d-md-flex fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x text-white"></i>
                                        <i class="fab fa-instagram fa-stack-1x text-dark"></i>
                                    </span>
                                    <span class="d-flex d-md-none fa-stack">
                                        <i class="fa fa-circle fa-stack-2x text-white"></i>
                                        <i class="fab fa-instagram fa-stack-1x text-dark m-auto"></i>
                                    </span>
                                </a>

                                <a
                                    class="mx-1 mx-md-2"
                                    v-if="info_im.telegram != null && info_im.telegram != ''"
                                    :href="info_im.telegram"
                                    target="_blank"
                                >
                                    <span class="d-none d-md-flex fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x text-white"></i>
                                        <i class="fab fa-telegram-plane fa-stack-1x text-dark"></i>
                                    </span>
                                    <span class="d-flex d-md-none fa-stack">
                                        <i class="fa fa-circle fa-stack-2x text-white"></i>
                                        <i class="fab fa-telegram-plane fa-stack-1x text-dark"></i>
                                    </span>
                                </a>

                                <a
                                    class="mx-1 mx-md-2"
                                    v-if="info_im.whatsapp != null && info_im.whatsapp != ''"
                                    :href="'https://wa.me/'+info_im.whatsapp"
                                    target="_blank"
                                >
                                    <span class="d-none d-md-flex fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x text-white"></i>
                                        <i class="fab fa-whatsapp fa-stack-1x text-dark"></i>
                                    </span>
                                    <span class="d-flex d-md-none fa-stack">
                                        <i class="fa fa-circle fa-stack-2x text-white"></i>
                                        <i class="fab fa-whatsapp fa-stack-1x text-dark"></i>
                                    </span>
                                </a>

                                <a
                                    class="mx-1 mx-md-2"
                                    v-if="info_im.fb_messenger != null && info_im.fb_messenger !=''"
                                    :href="info_im.fb_messenger"
                                    target="_blank"
                                >
                                    <span class="d-none d-md-flex fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x text-white"></i>
                                        <i class="fab fa-facebook-messenger fa-stack-1x text-dark"></i>
                                    </span>
                                    <span class="d-flex d-md-none fa-stack">
                                        <i class="fa fa-circle fa-stack-2x text-white"></i>
                                        <i class="fab fa-facebook-messenger fa-stack-1x text-dark"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="header-menu" class="shadow-lg">
                <div class="row mx-0">
                    <div class="col-12">
                        <div id="menu" class="row text-uppercase">

                            <div id ="prodotti-tab" ref="prodotti-tab" :class="{'text-tab-active bg-white col-6 text-center p-3' : showProdotti, 'col-6 text-center p-3' : !showProdotti}" @click="swicthToProdotti()" style="cursor: pointer;">
                                <div class="tab-text h5 mt-3" :class="{ 'font-weight-bold' : showProdotti, '' : !showProdotti }">
                                    prodotti
                                </div>
                            </div>
                            <div id ="negozio-tab" ref="negozio-tab" :class="{'text-tab-active bg-white col-6 text-center p-3' : showNegozio, 'col-6 text-center p-3' : !showNegozio}" @click="switchToNegozio()" style="cursor: pointer;">
                                <div class="tab-text h5 mt-3" :class="{ 'font-weight-bold' : showNegozio, '' : !showNegozio }">
                                    informazioni negozio
                                </div>
                            </div>
                        </div>
                    </div>
                    <section id="block-content" class="bg-white">
                        <prodotti-block
                            v-if="showProdotti & !showProduct"
                            :retailer="retailer"
                            :products="products"
                            @showAllProducts="showAllProducts"
                            @showFilteredProduct="showOnlyThisTag"
                        />

                        <prodotto-detail
                            v-if="showProduct && product_id && retailer_id"
                            :product_id="product_id"
                            :retailer_id="retailer_id"
                            @hide-product-detail="showProduct = false"
                        />

                        <negozio-block
                            v-if="showNegozio"
                            :retailer="retailer"
                            :info="info"
                            :geo_lat="geo_lat"
                            :geo_lng="geo_lng"
                        />
                    </section>
                </div>
            </div>
            <footer class="row mt-5 text-center">
                <div id="shop-footer" class="col-12">
                    <p class="footer-address">{{ retailer.name }} - {{ retailer.address.address }} - {{ retailer.address.city}} ({{ retailer.address.province }}) </p>
                    <p> P.I. {{retailer.vat }}</p>
                    <p class="text-uppercase footer-address"> coockie &sdot; privacy policy &sdot; termini e condizioni</p>
                    <p class="text-uppercase font-weight-bold" style="color: #FDAD10;">powered with <span style="color:red;"><i class="fa fa-heart" aria-hidden="true"></i></span> by spesavicino.it</p>
                </div>
            </footer>
        </div>
        <div v-else-if="retailer && !retailer.is_published" class="d-flex h-100 mt-5">
            <div class="m-auto d-flex flex-column">
            <img src="/images/logo/logo-sm-ora.png" class="mx-auto" style="height: 8rem;">
            <span class="font-weight-bold text-center" style="font-size: 2.5rem;">Oops...</span>
            <span class="text-center" style="font-size: 1.5rem;">servizio online di <strong>{{ retailer.name }}</strong> momentaneamente fuori servizio, contattare con il negoziante per maggiori informazioni:</span>
            <span class="text-center" style="font-size: 1.5rem;">Telefono: {{ info.phone }} - Email: {{ info.email }}</span>
            <div class="col-12 text-center mt-3">
                <button class="btn btn-primary" @click="$router.go(-1)">
                    Tornare indietro
                </button>
            </div>
            </div>
        </div>
   </div>
</template>

<script>
import ShopHeader from '../components/customLayout/ShopHeader';
import Negozio from '../components/customLayout/Negozio'
import ProdottiNegozio from '../components/customLayout/ProdottiNegozio'
import ProductDetail from '../components/customLayout/ProdottoDetail'

import MappaShop from "../components/shop/MappaShopComponent";
import ProductCard from "../components/CardProdotti";
import opening from "../components/shop/OpeningComponent";
import { eventBus } from "../app";
import IconService from "../components/card/IconService";
import IconeCard from "../components/card/IconeCard";
import moment from "moment";
import social from "../components/social/Social";
import im from "../components/social/Im";


export default {
    name: "Shop",
    components: {
        'shop-header' : ShopHeader,
        'negozio-block' : Negozio,
        'prodotti-block' : ProdottiNegozio,
        'prodotto-detail' : ProductDetail,
        Mappa: MappaShop,
        "card-prodotti": ProductCard,
        "icon-service": IconService,
        "icone-card": IconeCard,
        opening,
        "icone-social": social,
        "icone-im": im
    },
    props: ["id", "vat", "slug"],
    data() {
        return {
            product_id: '',
            showProduct: false,
            showNegozio: false,
            showProdotti: true,
            tabs: [
                {
                    id: 1,
                    name: "prodotti",
                    show: true
                },
                {
                    id: 2,
                    name: "informazioni negozio",
                    show: true
                },
                {
                    id: 3,
                    name: "intervista",
                    show: false
                }
            ],
            active_tab: {
                id: 1,
                name: "prodotti"
            },
            show: false,
            localbusiness: {
                "@context": "https://schema.org",
                "@type": "LocalBusiness",
                name: null,
                address: {
                    "@type": "PostalAddress",
                    streetAddress: null,
                    addressLocality: null,
                    addressRegion: null,
                    postalCode: null
                },
                image: "https://www.spesavicino.it",
                email: null,
                telePhone: null,
                url: "https://spesavicino.it",
                baseUrl: "https://spesavicino.it",
                geo: {
                    "@type": "GeoCoordinates",
                    latitude: null /* "45.541012" */,
                    longitude: null /* "10.213408" */
                },
                priceRange: "$"
            },
            retailer_name: null,
            retailer_id: null,
            retailer: {
                name: null,
                address: { address: null, city: null, province: null },
                does_delivery: null,
                is_published: true,
                does_takeaway: null,
                vat: this.vat
            },
            all_products:[],
            products: '',
            info: {
                description: null,
                email: null,
                phone: null,
                timeslots: [],
                social: null,
                shipments: []
            },
            info_social: {},
            info_im: {},
            logo: "",
            cover: "",
            order_products: [],
            geo_lat: null,
            geo_lng: null,
            opening_type: "opening",
            back: false,
            loading: true,
            interview_text: "",
            dataLoaded: false
        };
    },
    metaInfo() {
        return {
            title: this.retailer_name,
            // override the parent template and just use the above title only
            /*  titleTemplate: null, */
            meta: [
                {
                    name: "description",
                    content:
                        "spesavicino l'ecommerce di prossimità, aiuta le piccole attività nella loro attività online"
                },
                {
                    property: "og:title",
                    content: this.retailer_name + " | spesavicino.it"
                },
                {
                    property: "og:description",
                    content:
                        "Da oggi ci trovi su spesavicino.it, ordini e consegne a domicilio."
                },
                {
                    property: "og:image",
                    content: this.localbusiness.baseUrl + this.cover
                },
                { property: "og:site_name", content: "spesavicino.it" },
                { property: "og:type", content: "website" }
            ],
            script: [
                {
                    type: "application/ld+json",
                    json: this.localbusiness
                }
            ],
            link: [{ rel: "canonical", href: this.localbusiness.url }]
        };
    },
    created() {
        eventBus.$on('show-tab-product', (value) => {
            // console.log(value);
            this.product_id = value;
            this.showNegozio = false;
            this.showProdotti = true;
            this.showProduct = true;
        })
    },
    mounted() {
        this.getRetailer();
        eventBus.$on("order-created", function(payload) {
            /*  console.log("order-created received", payload); */
            this.order = payload;
            /* console.log("(Shop) order id", this.order.id); */
        });

        eventBus.$on("item-added", (product, qty) => {
            let duplicates = this.order_products.filter(item => {
                return item.item.id == product.id;
            });

            if (duplicates[0]) {
                duplicates[0].qty += qty;
            } else {
                let new_item = {
                    item: product,
                    qty: qty,
                    is_modified: false
                };
                this.order_products.push(new_item);
            }
            /* console.log("updated products list (Shop)", this.order_products); */
            eventBus.$emit("items-list-updated", this.order_products);
        });
    },
    methods: {
        swicthToProdotti() {
            this.showNegozio = false;
            this.showProdotti = true;
            this.showProduct = false;
        },
        switchToNegozio() {
            this.showNegozio = true;
            this.showProdotti = false;
            this.showProduct = false;
        },
        async getRetailer() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };
            await axios
                .get(`/api/retails/detail/${this.slug}/${this.vat}`, config)
                .then(response => {
                    this.retailer = response.data.data;
                    this.retailer_id = response.data.data.id;
                    this.$store.dispatch('setRetailerSlug', response.data.data.slug)
                    this.$store.dispatch('setRetailerVat', response.data.data.vat)
                    console.log("*****retailer***", this.retailer);
                    var temp = response.data.data.items;
                    temp = temp.sort(
                        (a, b) =>
                            new Date(a.created_at) - new Date(b.created_at)
                    );
                    console.log("temp", temp);
                    if (
                        !response.data.data.premium &&
                        temp &&
                        temp.length > 7
                    ) {
                        this.products = temp.slice(0, 7);
                    } else {
                        this.products = temp;
                    }
                    this.info = JSON.parse(response.data.data.info);
                    let shopInfo = JSON.parse(response.data.data.info);
                    if (shopInfo.interview) {
                        this.interview_text = shopInfo.interview;
                        this.tabs[2].show = true;
                    }
                    console.log(shopInfo);
                    this.geo_lat = this.info.geo.lat;
                    this.geo_lng = this.info.geo.lng;
                    this.info_social = shopInfo.social;
                    this.info_im = shopInfo.im;
                    this.logo = `/storage/${this.retailer.vat}/img/profile/logo.jpg`;
                    this.cover = `/storage/${this.retailer.vat}/img/profile/cover.jpg`;
                    this.retailer_name = response.data.data.name;
                    /* add alse schema org info */
                    this.localbusiness.name = response.data.data.name;
                    this.localbusiness.address.streetAddress =
                        response.data.data.address.address;
                    this.localbusiness.address.addressLocality =
                        response.data.data.address.city;
                    this.localbusiness.address.addressRegion =
                        response.data.data.address.province;
                    this.localbusiness.address.postalCode =
                        response.data.data.address.zip_code;
                    this.localbusiness.image =
                        this.localbusiness.image + this.logo;
                    this.localbusiness.email = this.info.email;
                    this.localbusiness.telePhone = this.info.phone;
                    this.localbusiness.url =
                        this.localbusiness.url +
                        `/azienda/${this.slug}/${this.vat}`;
                    this.localbusiness.geo.latitude = this.info.geo.lat;
                    this.localbusiness.geo.longitude = this.info.geo.lng;
                    /*  this.localbusiness["@type"] = response.data.data
                            .categories[0]
                            ? response.data.data.categories[0].nome
                            : "LocalBusiness"; */
                    this.emitRetailerId();
                    this.loading = false;
                    this.all_products = this.products;
                    this.dataLoaded = true;

                })
                .catch(e => {
                    console.log(e);
                });
        },
        emitRetailerId() {
            // console.log("retailer-id emitted", this.retailer_id);
            // eventBus.$emit("retailer-id", this.retailer_id);
            /*  console.log("retailer-id emitted", this.retailer_id); */
        },
        limitProducts() {
            if (this.products && this.products.length > 7) {
                this.products = this.producits.slice(0, 7);
            }
        },
        showOnlyThisTag(tag_id){

            this.dataLoaded = false;
            let products = this.all_products;
            this.products = '';
            let productsArray = [];

            products.forEach(product => {
                product.tags.forEach(tag => {
                    if(tag.id == tag_id){
                        productsArray.push(product);
                    }
                })
            });

            this.products = productsArray.filter((c, index) => {
                return productsArray.indexOf(c) === index;
            });
            this.dataLoaded = true;
        },
        showAllProducts(){
            this.products = this.all_products;
        },
        switchToInfo() {
            this.active_tab = this.tabs[1];
        },
        switchToProducts() {
            this.active_tab = this.tabs[0];
        },
        switchToInterview() {
            this.active_tab = this.tabs[2];
        }
    },
    watch: {
        retailer: function() {
            this.emitRetailerId();
        },
        products:function(){
            this.products;
        }
    }
};
</script>

<style>
    .main-title {
        text-shadow: 2px 2px 3px rgba(33,14,9,0.44);
        font-size: 4rem;
    }
    .text-tab-active {
        color: #FDAD10;
        font-weight: bold;
    }
    #block-content{
        width: 100%;
    }
    #prodotti-tab, #negozio-tab{
       -webkit-border-top-left-radius: 40px;
        -webkit-border-top-right-radius: 40px;
        -moz-border-radius-topleft: 40px;
        -moz-border-radius-topright: 40px;
        border-top-left-radius: 40px;
        border-top-right-radius: 40px; 
    }
    #header-menu{
        -webkit-border-top-left-radius: 40px;
        -webkit-border-top-right-radius: 40px;
        -moz-border-radius-topleft: 40px;
        -moz-border-radius-topright: 40px;
        border-top-left-radius: 40px;
        border-top-right-radius: 40px;
        background-color: rgba(255, 255, 255, 0.5);
    }
    #menu {
        
        -webkit-border-top-left-radius: 40px;
        -webkit-border-top-right-radius: 40px;
        -moz-border-radius-topleft: 40px;
        -moz-border-radius-topright: 40px;
        border-top-left-radius: 40px;
        border-top-right-radius: 40px;
    }
    #cover-image {
        object-fit: cover;
        object-position: center;
        filter: blur(6px);
        -webkit-filter: blur(6px);
    }
    #cover-container {
        height: 70vh;
    }
    #shop-content {
        min-height: 60vh;
        width: 60%;
        margin-top: -60vh;
        z-index: 1;
        font-family: 'Montserrat', sans-serif;
    }
    .btn-circle {
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 50%;
    }


    #white-section {
        min-height:1000px;
        height: auto;
        width: 80%;
        /* margin: -300px auto 0; */
        /* box-shadow: 0px 5px 20px #1f1f1f; */
    }

    #shop-footer{
        line-height: 0.3rem;
    }
  .dark-opacity {
    background-color: rgba(47, 47, 47, 0.5)
  }

  li {
    float: left;
    color: white;
  }

.titolo {
    font-family: 'Staatliches', cursive;
    font-size:xx-large;
    color: white;
    text-align: center;
}
.testo {
    font-family: 'Spartan', sans-serif;
    color: white;
    z-index:50;
    font-size: medium;

}
.testo-cover {
    font-family: 'Spartan', sans-serif;
    text-align: center;
    color: white;
    font-weight: 500;
    font-size: xx-large;
    z-index: 99;
}

.titolo-section {
    color: #e59e26;
    font-family: 'Spartan', sans-serif;
    font-weight: 500;
    }

.titolo-card {
    text-align: center;
    font-weight:400;
    color: #e59e26;
    font-size: 20px;
    font-weight:bold;
    font-family: 'Spartan', sans-serif;
}
.sottotitolo-card {
    text-align: center;
    font-weight: bold;
    color: black;
    font-size: 20px;
    font-family: 'Spartan', sans-serif;
}

.testo-card {
    text-align: center;
    color: black;
    font-size: 15px;
    font-family: 'Spartan', sans-serif;
}

.titolo-info {
    font-size: 30px;
    font-weight: 500;
    text-transform: uppercase;
}

table.Table {
  width: 80%;
  text-align: left;
  border-collapse: collapse;
}
table.Table td, table.Table th {
  padding: 3px 2px;
  padding-left: 10px;
  line-height: 30px;
}
table.Table tbody td {
  font-size: 14px;
}
table.Table thead {
  background: #1F1F1F;
}
table.Table thead th {
  font-size: 16px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 1px solid #FFFFFF;
}
table.Table thead th:first-child {
  border-left: none;
}

table.Table tfoot td {
  font-size: 14px;
}
table.Table tfoot .links {
  text-align: right;
}
table.Table tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}

/* media query per mobile/desktop */
@media only screen and (min-width: 1600px) {
    #shop-content {
        min-height: 60vh;
        width: 60%;
        margin-top: -60vh;
    }
}

@media only screen and (max-width: 1600px) {
    #shop-content {
        min-height: 60vh;
        width: 70%;
        margin-top: -60vh;
    }
}

@media only screen and (max-width: 1400px) {
    #shop-content {
        min-height: 60vh;
        width: 80%;
        margin-top: -60vh;
    }
    .main-title {
        text-shadow: 2px 2px 3px rgba(33,14,9,0.44);
        font-size: 2.2rem;
        line-height: 1;
    }
}

@media only screen and (max-width: 700px) {
    .main-title {
        text-shadow: 2px 2px 3px rgba(33,14,9,0.44);
        font-size: 1.5rem;
        line-height: 1;
    }
    #shop-content {
        min-height: 60vh;
        width: 95%;
        margin-top: -60vh;
    }
    .footer-address{
        line-height: 1;
    }
    .tab-text{ 
        font-size: 1rem;
    }
}
</style>
