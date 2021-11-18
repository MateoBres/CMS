<template>
    <div class="row no-gutters">
        <div
            @click="goToShopPage('Retailer', item.slug, item.vat)"
            class="col-12 position-relative rounded header-cover"
            :style="{ height: '35vh', backgroundImage: 'url(/storage/' + item.vat + '/img/profile/cover.jpg)', backgroundSize: 'cover', backgroundPosition: 'center' }"
        >
            <div class="position-absolute badge-container d-flex flex-column">
                <button class="btn rounded-pill bg-dark text-white m-1 text-left d-flex shadow" v-for="(group, index) in item.groups" :key="index">
                    <img class="img img-circle mr-2 my-auto" style="border-radius:50%" height="30" width="30" :src="'/storage/groups/' + group.filename">
                    <p class="my-auto h6">
                        {{ group.name }}
                    </p>
                </button>
            </div>
            <div class="position-absolute service-badge-container d-flex flex-row py-2 px-1">
                <span class="fa-stack" v-if="item.does_delivery">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-shipping-fast fa-stack-1x text-white fa-inverse"></i>
                </span>
                <span class="fa-stack" v-if="item.does_takeaway">
                    <i class="fas fa-circle fa-stack-2x text-secondary"></i>
                    <i class="fas fa-box fa-stack-1x text-white fa-inverse"></i>
                </span>
                <span class="fa-stack" v-if="info.payments && info.payments.card.checked">
                    <i class="fas fa-circle fa-stack-2x text-success"></i>
                    <i class="fas fa-credit-card fa-stack-1x text-white fa-inverse"></i>
                </span>
            </div>
            <div class="position-absolute shop-name-overlay d-flex">
                <div class="mx-auto border-dark rounded mb-3 d-flex flex-column bg-white text-primary shadow" style="width:80%; min-width:50%">
                    <div class="m-3 d-flex flex-row">
                        <img
                            :src="'/storage/' + item.vat + '/img/profile/logo.jpg'"
                            class="img-fluid rounded border border-light my-auto"
                            alt
                            style="max-height: 80px; margin-left:-40px"
                        />
                        <div class="d-flex flex-column ml-3 text-left">
                            <h2 class="h3 mt-auto d-none d-md-block">{{ item.name }}</h2>
                            <h2 class="h4 mt-auto d-block d-md-none">{{ item.name }}</h2>
                            <p class="h6 mb-auto d-none d-md-block">
                                {{ this.item.address.address}}, {{ this.item.address.city }} - {{ this.item.address.province }}
                            </p>
                            <p class="small  mb-auto d-block d-md-none">
                                {{ this.item.address.address}}, {{ this.item.address.city }} - {{ this.item.address.province }}
                            </p>
                        </div>
                    </div>
                    <div class="position-absolute mx-auto logo-container" style="height:80px; width:80px; top:0; margin-top:-40px"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="card mx-auto card-shop">
        <div class="position-relative">
            <img
                class="card-img-top home-card img-fluid"
                :src="'/storage/' + item.vat + '/img/profile/cover.jpg'"
                alt="Card image cap"
                v-on:click="goToShopPage('Retailer', item.slug, item.vat)"
            />
            <div class="position-absolute w-100">
                <div class="d-flex justify-content-start position-absolute w-100 mb-1" style="bottom:0">
                <div class="" v-for="(group, index) in item.groups.filter(g => { return g.filename != null })" :key="index">
                    <a :href="group.url" target="_blank" class="mx-1">
                        <img class="img img-circle" width="33" height="33" style="border-radius:50%" :src="'/storage/groups/' + group.filename">
                    </a>
                </div>
            </div>
            </div>
        </div>
        <icon-service
            class="icon-service ml-2"
            :delivery="item.does_delivery"
            :takeaway="item.does_takeaway"
        ></icon-service>
        <icon-service
            class="icon-service icon-service-dx mr-2"
            :payment="info.payments && info.payments.card ? info.payments.card.checked : false">

        </icon-service>
        <h3 class="card-title shop-card-name d-flex">
            <span class="m-auto">
                {{ item.name }}
            </span>
        </h3>
        <p class="bg-address text-center shop-card-address d-flex" v-if="item.address">
            <span class="m-auto">
            {{ item.address.address }} - {{ item.address.zip_code }}
            {{ item.address.city }}
            </span>
        </p>
        <p class="card-text bg-address" v-else>&nbsp;</p>
        <div class="card-body position-relative">
            <div class="row justify-content-center mb-3">
                <p class="card-text">
                    <a :href="'tel:'+info.phone" style="text-decoration:none">
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-phone-alt fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a :href="'mailto:'+info.email" style="text-decoration:none">
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a :href="info.website" v-if="info.website">
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-globe-asia fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                </p>
            </div> -->


            <!-- <div class="row justify-content-center mb-3"> -->
                <!-- <router-link
                    :to="{ name: 'Retailer', params: { id: item.id } }"
                    class="btn btn-primary"
                >
                    <i class="fas fa-eye mr-2"></i>Vedi
                </router-link> -->
                <!-- <button
                    type="button"
                    class="btn btn-primary btn-lg"
                    v-on:click="goToShopPage('Retailer', item.slug, item.vat)"
                >
                    <i class="fas fa-eye mr-2"></i>Vedi
                </button> -->

            <!-- </div> -->
            

        <!-- </div>
        <div class="top-footer-card">
            <TotalItems :item="item.items.length" />
        </div>
        <div class="card-footer" @click="goToShopPage('Retailer', item.slug, item.vat)">
            <p class="w-100 text-center h4 my-auto">
                <i class="fas fa-eye mr-2"></i>Vedi
            </p> -->

            <!-- <icone-card
                :phone="info.phone"
                :email="info.email"
                :telegram="info.im.telegram"
                :whatsapp="info.im.whatsapp"
                :messenger="info.im.fb_messenger"
                :social="info.social"
            ></icone-card> -->

        <!-- </div>
    </div> -->
</template>

<script>
import IconeCard from "./card/IconeCard";
import IconService from "./card/IconService";
import TotalItems from  './card/TotalItems';
import { eventBus } from "../app";

export default {
    name: "Card",
    props: ["item"],
    components: {
        "icone-card": IconeCard,
        "icon-service": IconService,
        TotalItems
    },
    data() {
        return {
            info: JSON.parse(this.item.info)
        };
    },
    methods: {
        goToShopPage(PageName, slug, vat) {
            this.$router.push({ name: PageName, params: { slug: slug, vat: vat} });
        }
    }
};
</script>

<style scoped lang="scss">
$primary: #005c92;
$secondary: #f18500;
$background: #e9d7c3;

// .card {margin-bottom: 30px;border-color:$primary;border-width: 3px;background-color: transparent;}
.card {
    margin-bottom: 30px;
    border: 2px solid $primary;
    border-radius: 0.4rem;
    background-color: transparent;
    max-width: 22rem;
}
.shop-card-name {
    height: 70px !important;
}

.shop-card-address {
    height: 50px;
}

.text-muted {
    font-size: 14pt;
}
.btn-primary {
    background: $secondary;
    border-color: $secondary;
    position: absolute;
    bottom: 25px;
}
.card-body {
    background-color: rgba(255, 255, 255, 0.7);
    // min-height: 214px;
    position: relative;
}
.card-body .row {
    min-height: 21px;
}
.card-footer {
    background-color: $primary;
    // padding-bottom: 5px;
    // padding-top: 5px;
    color: white;
    cursor: pointer;
    // min-height: 75px;
}

.icon-service {
    position: absolute;
    top: 0px;
}

.icon-service-dx {
    top: 160px;
    bottom: 0px !important;right: 0px !important;
}

.card-title {
    background-color: $primary;
    color: #ffffff;
    padding: 5px;
    margin-bottom: 0px;
    font-weight: 100;
}

.card-text,
.card-text a:link,
.card-text a:visited,
.card-text a:hover {
    color: #000000;
    font-size: 12pt;
    line-height: 2.2rem;
    font-weight: 100;
}

.card-text .fas {
    font-size: 14pt;
}

.bg-address {
    background-color: $secondary;
    padding: 2px;
    margin-bottom: 0px;
    color: #ffffff;
    font-size: 10pt;
}

.home-card {
    height: 200px;
}
.top-footer-card {padding-bottom: 5px;padding-top: 5px;background-color: $secondary;margin-bottom:0px;}

.header-cover:hover{
    cursor: pointer;
}

.badge-container {
    top: 0;
    right: 0;
}

.service-badge-container {
    top: 0;
    left: 0;
}
</style>
