<template>
<div class="col col-12">
    <div class="row">
        <div class="col-12">
            <div class="row justify-content-start">
                <div class="col-12 border-top border-bottom mt-2">
                    <a id="indietro" class="btn btn-light mt-0 mb-0" @click="$emit('hide-product-detail')">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024"><path d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 0 0 0 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281l360-281.1c3.8-3 6.1-7.7 6.1-12.6z" fill="currentColor"/></svg>
                        <span id="text-indietro">torna indietro</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5 mb-4">
                <div id="images-container" class="col-md-4">
                    <div class="row">
                        <div class="col-12">
                            <figure class="px-0">
                                <img id="immagine_principale" class="img-fluid w-100"  :src="item_featured_img" alt="" />
                            </figure>
                        </div>
                    </div>
                    <div class="row" v-if="product && product.images">
                        <div class="col-4" v-for="image in product.images" :key="image.id">
                            <figure class="shop-thumbnail float-left" >
                                <a :href="image.file" data-lightbox="product.id">
                                    <img :src="image.thumbnail" alt="" class="img-fluid">
                                </a>
                            </figure>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100 d-flex flex-column bg-dark text-center sv-round text-white p-1" v-if="item_info && item_info.size && item_info.size.unit">
                                <h5 class="py-1 d-none d-sm-block">{{ truncateString(item_name, 20) }}</h5>
                                <span class="text-center prezzo-text">prezzo al {{ item_info.size.unit }}: &euro;{{ item_price }}</span>
                            </div>
                            <div class="w-100 d-flex flex-column bg-dark text-center sv-round text-white p-1" v-else-if="item_info && item_info.weight && item_info.weight.unit">
                                <h5 class="py-1 d-none d-sm-block">{{ truncateString(item_name, 20) }}</h5>
                                <span class="text-center prezzo-text">prezzo al {{ item_info.weight.unit }}: &euro;{{ item_price }}</span>
                            </div>
                            <div class="w-100 d-flex flex-column bg-dark text-center sv-round text-white p-1" v-else>
                                <h5 class="py-1 d-none d-sm-block">{{ truncateString(item_name, 20) }}</h5>
                                <span class="text-center prezzo-text">prezzo: &euro;{{ item_price }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row justify-content-center h-100 mt-4 mt-sm-1">
                        <section class="col-12">
                            <article>
                                <header>
                                    <h2 class="article-name text-uppercase text-center text-sm-left">{{ item_name }}</h2>
                                    <h3 class="sottotitolo text-center text-sm-left">{{ item_desc }}</h3>
                                </header>
                                <main class="text-left p-3" v-html="item_long_description">
                                </main>
                                <section class="mt-0 mb-2 row justify-content-end">
                                    <div v-if="showColorList" class="col-xs-12 col-md-6">
                                        <label for="">Colori</label>
                                        <select
                                            class="form-control"
                                            v-model="color_field"
                                        >
                                            <option
                                                v-for="(item, index) in colorList"
                                                :key="index"
                                                :value="item"
                                            >{{ item }}</option>
                                        </select>
                                    </div>
                                <!-- </section>
                                <section class="mt-0 mb-2 row justify-content-end"> -->
                                    <div v-if="showSizeList" class="col-xs-12 col-md-6">
                                        
                                        <label for="">Misure/Taglie</label>
                                        <select
                                            class="form-control"
                                            v-model="size_field"
                                        >
                                            <option
                                                v-for="(item, index) in sizeList"
                                                :key="index"
                                                :value="item"
                                            >{{ item }}</option>
                                        </select>
                                        
                                    </div>
                                </section>
                                <footer class="mt-5">
                                    <div class="col-xs-12 mb-1 mb-lg-0 mt-auto form-group mb-3" v-if="$store.getters.userRoleName != 'publisher'">
                                        <!-- <label class="text-left w-100">Quantità</label> -->
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4">
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
                                            <div class="col-xs-12 col-md-4">
                                                <div
                                                    class="btn btn-dark btn-block"
                                                    @click="addToCart()"
                                                >
                                                    <i class="fas fa-cart-plus mr-2"></i>Aggiungi
                                                </div>
                                            </div>
                                        </div>
                                       
                                         
                                    </div>
                                </footer>
                            </article>
                        </section>
                        <!-- <div class="col-10 text-left">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h3 class="h1">{{ item_name }} - desktop</h3>
                                    <p class="h5 my-3">{{ item_desc }}</p>

                                    <div class="col col-12 my-3 mx-0 px-0" v-if="showVariationsForm">
                                        <variation-selection :items="item_variations"
                                        @setVariation="setVariation" />
                                    </div>



                                    <div v-if="showColorList">
                                        <label for="">Colori</label>
                                        <select
                                            class="form-control"
                                            v-model="color_field"
                                        >
                                            <option
                                                v-for="(item, index) in colorList"
                                                :key="index"
                                                :value="item"
                                            >{{ item }}</option>
                                        </select>
                                    </div>

                                    <div v-if="showSizeList">
                                        <label for="">Misure/Taglie</label>
                                        <select
                                            class="form-control"
                                            v-model="size_field"
                                        >
                                            <option
                                                v-for="(item, index) in sizeList"
                                                :key="index"
                                                :value="item"
                                            >{{ item }}</option>
                                        </select>
                                    </div>
                                    <p class="h3 text-right" v-if="item_info && item_info.size && item_info.size.unit">
                                        prezzo al {{ item_info.size.unit }}: &euro;{{ item_price }}
                                    </p>
                                    <p class="h3 text-right" v-else-if="item_info && item_info.weight && item_info.weight.unit">
                                        prezzo al {{ item_info.weight.unit }}: &euro;{{ item_price }}
                                    </p>
                                    <p class="h3 text-right" v-else>
                                        prezzo: &euro;{{ item_price }}
                                    </p>


                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-10">
                            <div class="row mt-3">

                                <div class="col-xs-12 mb-1 mb-lg-0 col-lg-4 mt-auto form-group">
                                    <label class="text-left w-100">Quantità</label>
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
                                <div class="col-xs-12 mb-1 mb-lg-0 col-lg-6 mt-auto">
                                    <div
                                        class="btn btn-primary btn-block"
                                        @click="addToCart()"
                                    >
                                        <i class="fas fa-cart-plus mr-2"></i>Aggiungi
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- <div class="col col-12 d-block d-md-none mt-5">
                    <h3 class="text-center">{{ item_name }}</h3>
                    <p class="text-center">{{ item_desc }}</p>
                    <p class="text-center">
                        <span class="h3 mr-2">prezzo:</span><span class="h3">&euro;{{ item_price }}</span>
                    </p>
                    <div class="row divs-row justify-content-center">
                        <div class="col-xs-12 mb-1 mb-lg-0 col-lg-4 mt-auto form-group mb-3" v-if="$store.getters.userRoleName != 'publisher'">
                            <label class="text-left w-100">Quantità</label>
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
                        <div class="col-xs-12 mb-1 mb-lg-0 col-lg-6 mt-auto" v-if="$store.getters.userRoleName != 'publisher'">
                            <div
                                class="btn btn-lg btn-block btn-dark btn-block"
                                @click="addToCart()"

                            >
                                <i class="fas fa-cart-plus mr-2"></i>Aggiungi
                            </div>
                        </div>
                    </div>
                </div> -->
    </div>

    <!-- <div class="row mt-5">
                <div class="col-12">
                    <div class="card" v-if="item_long_description">
                        <div class="card-body">
                            <article class="text-left" v-html="item_long_description"></article>
                        </div>
                    </div>
                </div>
    </div> -->

</div>
</template>

<script>
import { eventBus } from "../../app";

import 'lightbox2/dist/css/lightbox.css'
import 'lightbox2/dist/js/lightbox'
import SizeQuantityComponent from '../card/SizeQuantityComponent';
import VariationSelection from '../shop/VariationSelection';

export default {
    name: "ProductDetail",
    props: ["product_id", "retailer_id"],
    components: {
        'size-quantity-component' : SizeQuantityComponent,
        'variation-selection' : VariationSelection
    },
    data() {
        return {
            item_name: null,
            item_sku: null,
            item_desc: null,
            item_price: null,
            item_price_tmp: null,
            item_price_width_size: '',
            item_featured_img: "gatto",
            retailer_name: null,
            retailer_vat: null,
            item_long_description: null,
            product:null,
            qty:1,
            item_info:null,
            type_unit: null,
            item_variations: '',
            selected_variation: {
                parent: '',
                child: '',
            },
            size_field: '',
            color_field: '',
        };
    },
    /* watch: {
        values: function() {
            this.initValues();
        },
    }, */
    mounted() {
        this.getRetailer();
        this.getArticleData();
    },

    methods: {
        async getRetailer() {
            await axios
                .get(`/api/retails/${this.retailer_id}`)
                .then(response => {
                    let retailer = response.data.data;
                    console.log(retailer);
                    this.retailer_name = retailer.name;
                    this.retailer_vat = retailer.vat;
                    this.$store.dispatch('setRetailerSlug', response.data.data.slug)
                    this.$store.dispatch('setRetailerVat', response.data.data.vat)
                    this.getArticleData();
                })
                .catch(errors => {});
        },
        truncateString(str, len) {
            if(str.length <= len) {
                return str
            } else {
                return `${str.slice(0, len)}...`
            }
        },
        getArticleData() {
            /*  let token = this.$store.state.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            }; */
            axios
                .get(
                    `/api/retails/${this.retailer_id}/items/${this.product_id}`
                )
                .then(response => {
                    this.product = response.data.data;
                    let itemDetails = response.data.data;
                    this.item_name = itemDetails.name;
                    this.item_sku = itemDetails.sku;
                    this.item_desc = itemDetails.description;
                    this.item_price = (itemDetails.price / 100).toFixed(2);
                    this.item_featured_img = `/storage/${this.retailer_vat}/img/items/${itemDetails.sku}/thumbnail.jpg`;
                    this.item_long_description = itemDetails.long_description;
                    let list_array = [];
                    if (this.item_long_description.indexOf('<li>') && this.item_long_description.indexOf('<p>') == -1) {
                        this.item_long_description.split('<li>').forEach(element => list_array.push(element+'<br><li>'))
                        this.item_long_description = list_array.join('')
                        console.log(this.item_long_description)
                    }
                    this.item_info = JSON.parse(itemDetails.info);
                    // if (this.item_info.size.price) {
                    //     this.item_price_width_size = (parseInt(this.item_info.size.price).toFixed(2));
                    //     this.item_price_tmp = this.item_price_width_size
                    //     this.type_unit = "Lunghezza in " + this.item_info.size.unit;
                    // }
                    // if (this.item_info.weight.price) {
                    //     this.item_price_width_size = (parseInt(this.item_info.weight.price).toFixed(2));
                    //     this.item_price_tmp = this.item_price_width_size;
                    //      this.type_unit = "Peso in " + this.item_info.weight.unit;
                    // }
                    this.item_variations = JSON.parse(itemDetails.variation);
                })
                .catch(errors => {});
        },
        qtyPlus() {
            this.qty++;
        },
        qtyMinus() {
            if (this.qty > 1) {
                this.qty--;
            }
        },
        addToCart() {
            let tmp_product = this.product;
            if (this.size_field || this.color_field) {
                tmp_product.name = this.product.name + ` (Misura: ${this.size_field}  |  Colore: ${this.color_field})`
            } else if (this.selected_variation.parent) {
                tmp_product.name = this.product.name + ` (${this.selected_variation.parent} ${this.selected_variation.child})`
            } else {
                tmp_product.name  =  this.product.name;
            }
            eventBus.$emit("item-added", tmp_product, this.qty, this.item_price, this.selected_variation);
        },
        setColor() {
            alert("ciao color")
        },
        setNewPrice(value) {
            this.item_price_width_size = (this.item_price_tmp * value).toFixed(2);
            this.item_price = this.item_price_width_size;
        },
        setVariation(value) {
            this.selected_variation = value;
        }
    },
    computed: {
        showComp: function() {
            try {
                if(this.item_info) {
                    if (this.item_info.size.price || this.item_info.weight.price) {
                        return true
                    } else {
                        return false
                    }
                } else {
                    return false
                }
            } catch (error) {
                console.log(error);
                return false
            }
        },
        showVariationsForm: function() {
            try {
                if (this.item_variations.composition[0]) {
                    return true
                } else {
                    return false
                }
            } catch (error) {
                return false
            }
        },
        showColorList: function() {
            try {
                if (this.item_info.color_list) {
                    return true
                } else {
                    return false
                }
            } catch (error) {
                return false
            }
        },
        showSizeList: function() {
            try {
                if (this.item_info.size_list) {
                    return true
                } else {
                    return false
                }
            } catch (error) {
                return false
            }
        },
        colorList: function() {
            try {
                return this.item_info.color_list.split(",")
            } catch (error) {
                return []
            }
        },
        sizeList: function() {
            try {
                return this.item_info.size_list.split(",")
            } catch (error) {
                return []
            }
        },
    }
};
</script>

<style>
.product {
    padding-top: 60px;
    padding-bottom: 100px;
    padding-left: 30px;padding-right: 30px;
}
.prezzo-text{
    font-size: 1.2rem
}
.divs-row {
    bottom: 0;
}
.article-name{
    font-size:2rem;
    font-weight: 700;
    color:#333;
}
.sottotitolo{
    font-size: 1.2rem;
    color:#555;
}
.sv-round{
    border-radius: 10px;
}
#indietro {
    color: #555;
    font-size: 1rem;
    margin-left: 2%;
    background-color: white;
    border: white;
    transition: transform .2s;
}
#indietro:hover {
    color: black;
    transform: scale(1.2);
}
hr {
    border-top: 2px solid lightgrey;
    width: 95%;
    border-radius: 8px;
}
img {
    border-radius: 8px !important;
}
#images-container {
    margin-left: 2%;
}
#inputGroupPrepend{
    background-color: #fff;
}


</style>
