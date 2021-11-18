<template>
    <div class="col-12 px-3">

        <div class="row text-center mt-3 mx-3 py-2 tab-category">
            <div class="col text-uppercase" @click="showAll" style="cursor: pointer;">
                <span :class="{'font-weight-bold' : currentCat == -1}">
                    tutti
                </span>
            </div>
            <div class="col text-uppercase" 
                v-for="tag in retailer.tags"
                :key="tag.id"
                @click="showCat(tag.id)"
                style="cursor: pointer;"
            >
                <span :class="{ 'font-weight-bold' : currentCat == tag.id }">
                    {{ tag.name }}
                </span>
            </div>
        </div>

        <div class="row gallery-product py-5">
            <div
                class="col-12 col-sm-6 col-md-4 col-xl-3 mb-3"
                v-for="(product, index) in products"
                :key="index"
            >
                <card-prodotti
                    :product="product"
                    :sku.sync="product.sku"
                    :imgsrc="'/storage/' + retailer.vat + '/img/items/' + product.sku + '/thumbnail.jpg'"
                    :vat="retailer.vat"
                ></card-prodotti>
            </div><!-- /col -->
        </div><!-- /row -->

    </div>
</template>

<script>
import CardProdotti from './CardProdotti'

export default {
    name: 'ProdottiNegozio',
    props: ['retailer', 'products'],
    components: {
        'card-prodotti' : CardProdotti
    },
    data() {
        return {
            currentCat: -1
        }
    },
    methods: {
        showAll() {
            this.currentCat = -1
            this.$emit('showAllProducts')
        },
        showCat(catID) {
            this.currentCat = catID;
            this.$emit('showFilteredProduct', catID)
        }
    },
}
</script>

<style scoped>
    .tab-category {
        border-bottom: 1px solid #666; 
        border-top: 1px solid #666;
        color: #666;
    }
    .gallery-product {
        padding-left: 30px;
        padding-right: 30px;
    }
@media only screen and (max-width: 700px) {
    .gallery-product {
        padding-left: 5px;
        padding-right: 5px;
    }
}
</style>