<template>
    <!-- card squared -->
    <!-- <div class="card bg-transparent border-0">
        <div class="row">
            <div class="col-12">
                <img :src="thumbImage"
                    class="card-img" alt=""
                    @click="goToDetails()"
                    @mouseover="showText = true"
                    @mouseleave="showText = false"
                />

                <div class="text-data" v-if="showText">
                    <h5 class="card-title prod-card-title mt-1">
                        {{ product.name }}
                    </h5>
                    <p class="card-text text-center prod-price mb-1">
                        <i class="fas fa-euro-sign"></i> {{ (product.price / 100).toFixed(2) }}
                    </p>
                </div>
            </div>

        </div>
    </div> -->
    <div
        @click="goToDetails()"
        class="d-flex flex-column"
        style="cursor:pointer"
    >
        <div class="sv-round w-100 overflow-hidden mb-1">
            <img :src="thumbImage" class="img-fluid w-100">
        </div>
        <div class="w-100 d-flex flex-column bg-dark text-center sv-round text-white p-1">
            <h5 class="py-1">{{ truncateString(product.name, 20) }}</h5>
            <span class="text-center">&euro;{{ (product.price/100).toFixed(2) }}</span>
        </div>
    </div>
    <!-- /card squared -->
</template>

<script>
import { eventBus } from "../../app";
export default {
    name: "CardProdotti",
    props: ["product", "vat", "sku", "imgsrc"],
    data() {
        let version_number = Math.floor(Math.random() * 100);
        return {
            showText: false,
            img_src : '',
            qty: 1,
        };
    },
    methods: {
        qtyPlus() {
            this.qty++;
        },
        qtyMinus() {
            if (this.qty > 1) {
                this.qty--;
            }
        },
        addToCart() {
            // eventBus.$emit("item-added", this.product, this.qty);
            eventBus.$emit('item-added-from-product-page', this.product, this.qty)
            console.log("item-added emitted (CardProdotti)", this.product);
        },
        goToDetails() {
            // console.log(this.product.id)
            /*
            this.$router.push(
                `/retailer/${this.product.retailer_id}/product/${this.product.id}`
            );*/
            eventBus.$emit('show-tab-product', this.product.id)
            // window.scrollTo(0,1000);
        },
        truncateString(str, len) {
            if(str.length <= len) {
                return str
            } else {
                return `${str.slice(0, len)}...`
            }
        }
    },
    watch: {
        // whenever question changes, this function will run
        imgsrc: function (newValue, oldValue) {
            console.log("old", oldValue);
            console.log("new", newValue)
            return newValue;
        }
    },
    computed: {
        thumbImage: function() {
            try {
                return this.imgsrc
            } catch (error) {
                console.log("thumbImage", error);
                return ''
            }
        }
    }
};
</script>

<style scoped>
.bg-translucent {
    background-color: rgba(0,0,0,0.5);
}
.sv-round{
    border-radius: 10px;
}
/* .card-text {font-size: 10pt;text-align: left;}
    .card-footer {
        position: absolute;
        bottom: 0;
    } */
.prod-card-body {
    padding: 0;
}
.prod-card-title {
    margin-bottom: 0;
}
.card-img:hover {
    cursor: pointer;
}
.text-data {
    background-color: rgba(0,0,0,0.5);
    position: absolute;
    bottom: 0;
    color: #ffffff;
    width:93%;
    margin-left: auto;margin-right: auto;
}
.prod-card-title {font-size: 14pt;font-weight: bold;text-align: center;}
.prod-price {font-size: 18pt;font-weight: bold;text-align: right}
</style>
