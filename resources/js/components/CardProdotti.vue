<template>
    <!-- card squared -->
    <div class="card bg-transparent border-0">
        <div class="row">
            <div class="col-12">
                    <img :src="thumbImage" class="card-img" alt="..." @click="goToDetails()"/>
                
            </div>
            <div class="col-12 d-flex flex-column justify-content-between">
                <h5 class="card-title prod-card-title mt-2">
                    {{ product.name }}
                </h5>
                <p class="card-text text-center mb-2">
                    <i class="fas fa-euro-sign mr-1"></i>{{ (product.price / 100).toFixed(2) }}
                </p>
            </div>
            <!-- <div class="col-12 d-flex flex-row">
                <button
                    class="btn btn-success btn-block my-auto"
                    @click="goToDetails()"
                >
                    <i class="fas fa-eye mr-2"></i>Dettagli
                </button>
                <button
                    class="btn btn-primary btn-block my-auto"
                    @click="addToCart()"
                >
                    <i class="fas fa-cart-plus mr-2"></i>Aggiungi
                </button>
            </div> -->
        </div>
    </div>
    <!-- /card squared -->

    <!-- card narrow row -->
    <!-- <div class="card">
        <div class="row">
            <div class="col-2">
                <img :src="img_src" class="card-img" alt="..." />
            </div>
            <div class="col-6 d-flex flex-column justify-content-between">
                <h5 class="card-title prod-card-title mt-2">
                    {{ product.name }} - &euro;{{
                        (product.price / 100).toFixed(2)
                    }}
                </h5>
                <p class="card-text text-center mb-2">
                    {{ product.description | truncateText }}
                </p>
            </div>
            <div class="col-4 d-flex flex-column">
                <button
                    class="btn btn-success btn-block my-auto"
                    @click="goToDetails()"
                >
                    <i class="fas fa-eye mr-2"></i>Dettagli
                </button>
                <button
                    class="btn btn-primary btn-block my-auto"
                    @click="addToCart()"
                >
                    <i class="fas fa-cart-plus mr-2"></i>Aggiungi
                </button>
            </div>
        </div>
    </div> -->
    <!-- /card narrow row -->




            <!-- <div class="row no-gutters pb-2">
                <div class="col-md-4 col-lg-3 d-flex flex-wrap align-items-center p-1">
                    <img :src="img_src" class="card-img" alt="..." />
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="card-body prod-card-body">
                        <h5 class="card-title prod-card-title my-3">
                            {{ product.name }} - &euro;{{
                                (product.price / 100).toFixed(2)
                            }}
                        </h5>
                        <p class="card-text p-3 text-center">
                            {{ product.description | truncateText }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer px-1 py-2">
                <div class="row justify-content-center">
                    <div class="col-xs-12 mb-1 mb-lg-0" :class="{ 'col-lg-12' : $store.getters.userRoleName == 'publisher', 'col-lg-4' : $store.getters.userRolename != 'publisher'}">
                        <button
                            class="btn btn-success btn-block"
                            @click="goToDetails()"
                        >
                            <i class="fas fa-eye mr-2"></i>Dettagli
                        </button>
                    </div>
                    <div class="col-xs-12 mb-1 mb-lg-0 col-lg-4" v-if="$store.getters.userRoleName != 'publisher'">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span
                                    class="input-group-text"
                                    id="inputGroupPrepend"
                                    @click="qtyMinus()"
                                    ><i class="fas fa-minus"></i
                                ></span>
                            </div>
                            <input
                                type="text"
                                class="form-control text-center"
                                v-model="qty"
                            />
                            <div class="input-group-append">
                                <span
                                    class="input-group-text"
                                    id="inputGroupPrepend"
                                    @click="qtyPlus()"
                                    ><i class="fas fa-plus "></i
                                ></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 mb-1 mb-lg-0 col-lg-4" v-if="$store.getters.userRoleName != 'publisher'">
                        <button
                            class="btn btn-primary btn-block"
                            @click="addToCart()"
                        >
                            <i class="fas fa-cart-plus mr-2"></i>Aggiungi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</template>

<script>
import { eventBus } from "../app";
export default {
    name: "ProductCard",
    props: ["product", "vat", "sku", "imgsrc"],
    data() {
        let version_number = Math.floor(Math.random() * 100);
        return {
            // img_src: `/storage/${this.vat}/img/items/${this.sku}/thumbnail.jpg?version=${version_number}`,
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
            this.$router.push(
                `/retailer/${this.product.retailer_id}/product/${this.product.id}`
            );
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
</style>
