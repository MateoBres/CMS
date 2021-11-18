<template>
    <div class="container product">
        <div class="row mt-5">
            <div class="col-12 text-left">
                <a
                    class="btn btn-primary text-white"
                    @click="$router.go(-1)"
                    style="color: #fff"
                >
                    <i class="fas fa-chevron-circle-left mr-2"></i>
                    Torna alla pagina precedente
                </a>
            </div>
        </div>
        <div class="row mt-3">
            <!-- -->
            <div class="col-12 col-lg-12 d-flex">
                <img
                    :src="logo ? logo : '/storage/default-vat/img/items/default-sku/featured.jpg'"
                    class="img-fluid rounded m-1"
                    alt=""
                    style="max-height: 80px"
                />
                <span class="my-auto ml-3"
                    ><h1 class="m-0" style="font-size:2.5rem">
                        {{ retailer_name }}
                    </h1></span
                >

                <hr style="margin: 0 0 0 " />
            </div>
        </div>
        <div class="row mt-5">
            <div class="col col-12 col-lg-6">
                <img :src="item_featured_img" alt="" class="img-fluid w-100" />
                <div class="row" v-if="product.images">
                    <div class="col col-12 col-md-4 mt-2"
                        v-for="image in product.images" :key="image.id">
                        <a :href="image.file" data-lightbox="product.id">
                            <img :src="image.thumbnail" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col col-12 d-none d-lg-block col-lg-6 position-relative">
                <div class="row justify-content-center">
                    <div class="col-10 text-left">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="h1">{{ item_name }}</h3>
                                <p class="h5 my-5">{{ item_desc }}</p>

                                <div class="col col-12 my-3 mx-0 px-0" v-if="showVariationsForm">
                                    <variation-selection :items="item_variations"
                                    @setVariation="setVariation" />
                                </div>

                                <div v-if="showComp">
                                    <p class="h6 my-2" v-if="item_info.size.price">
                                        <strong>Dimensioni:</strong> €. {{ item_price_tmp}} al {{ item_info.size.unit }}
                                    </p>
                                    <p class="h6 my-2" v-if="item_info.weight.price">
                                        <strong>Peso:</strong> €. {{ item_price_tmp }} al {{ item_info.weight.unit }}
                                    </p>
                                   <div class="w-full">
                                       <label for="">Seleziona: {{ type_unit }}</label>
                                       <size-quantity-component @calcolusPrice="setNewPrice" />
                                   </div>
                                </div>

                                <div v-if="showColorList">
                                    <label for="">Colori</label>
                                    <select class="form-control"
                                        v-model="color_field">
                                        <option
                                            v-for="(item, index) in colorList"
                                            :key="index"
                                            :value="item">{{ item }}</option>
                                    </select>
                                </div>

                                <div v-if="showSizeList">
                                    <label for="">Misure/Taglie</label>
                                    <select class="form-control"
                                        v-model="size_field">
                                        <option
                                            v-for="(item, index) in sizeList"
                                            :key="index"
                                            :value="item">{{ item }}</option>
                                    </select>
                                </div>

                                <p v-if="item_price_width_size"
                                    class="h3 text-right">
                                    prezzo: {{ item_price_width_size }}
                                </p>
                                <p class="h3 text-right" v-else>
                                    prezzo: {{ item_price }}
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row position-absolute w-100 buttons-row justify-content-center">
                    <div class="col-xs-12 mb-1 mb-lg-0 col-lg-4 mt-auto form-group" v-if="$store.getters.userRoleName != 'publisher'">
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
                        <button
                            class="btn btn-primary btn-block"
                            @click="addToCart()"
                        >
                            <i class="fas fa-cart-plus mr-2"></i>Aggiungi
                        </button>
                    </div>
                </div>
            </div>
            <div class="col col-12 d-block d-lg-none mt-5">
                <h3 style="font-size:2rem">{{ item_name }}</h3>
                <p class="text-center">{{ item_desc }}</p>
                <p class="text-center">
                    <span style="font-size:1.75rem" class="mr-2">prezzo:</span><span style="font-size:2.5rem">&euro;{{ item_price }}</span>
                </p>
                <div class="row buttons-row justify-content-center">
                    <div class="col-xs-12 mb-1 mb-lg-0 col-lg-4 mt-auto form-group mb-3" v-if="$store.getters.userRoleName != 'publisher'">
                        <label class="text-left w-100">Quantità</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span
                                    class="input-group-text"
                                    id="inputGroupPrepend"
                                    @click="qtyMinus()"
                                    style="font-size:2rem"
                                    ><i class="fas fa-minus"></i
                                ></span>
                            </div>
                            <input
                                style="font-size:2rem"
                                type="text"
                                class="form-control text-center"
                                v-model="qty"
                            />
                            <div class="input-group-append">
                                <span
                                    class="input-group-text"
                                    id="inputGroupPrepend"
                                    @click="qtyPlus()"
                                    style="font-size:2rem"
                                    ><i class="fas fa-plus "></i
                                ></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 mb-1 mb-lg-0 col-lg-6 mt-auto" v-if="$store.getters.userRoleName != 'publisher'">
                        <button
                            class="btn btn-primary btn-block"
                            @click="addToCart()"
                            style="font-size:2rem"
                        >
                            <i class="fas fa-cart-plus mr-2"></i>Aggiungi
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="card" v-if="item_long_description">
                    <div class="card-body">
                        <article class="text-left" v-html="item_long_description"></article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { eventBus } from "../app";
import 'lightbox2/dist/css/lightbox.css'
import 'lightbox2/dist/js/lightbox'
import SizeQuantityComponent from '../components/card/SizeQuantityComponent';
import VariationSelection from '../components/shop/VariationSelection';

export default {
    name: "Product_old",
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
            logo: "",
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
                    this.product = response.data.data
                    let itemDetails = response.data.data;
                    this.item_name = itemDetails.name;
                    this.item_sku = itemDetails.sku;
                    this.item_desc = itemDetails.description;
                    this.item_price = (itemDetails.price / 100).toFixed(2);
                    this.logo = `/storage/${this.retailer_vat}/img/profile/logo.jpg`;
                    this.item_featured_img = `/storage/${this.retailer_vat}/img/items/${itemDetails.sku}/thumbnail.jpg`;
                    this.item_long_description = itemDetails.long_description;
                    /* this.item_featured_img = "cane"; */
                    this.item_info = JSON.parse(itemDetails.info);
                    if (this.item_info.size.price) {
                        this.item_price_width_size = (parseInt(this.item_info.size.price).toFixed(2));
                        this.item_price_tmp = this.item_price_width_size
                        this.type_unit = "Lunghezza in " + this.item_info.size.unit;
                    }
                    if (this.item_info.weight.price) {
                        this.item_price_width_size = (parseInt(this.item_info.weight.price).toFixed(2));
                        this.item_price_tmp = this.item_price_width_size;
                         this.type_unit = "Peso in " + this.item_info.weight.unit;
                    }
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
    padding-bottom: 300px;
}
.buttons-row {
    bottom: 0;
}
</style>
