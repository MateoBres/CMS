<template>
    <div class="container text-left">
        <div class="row">
            <div class="col-xs-12 col-md-12 d-flex">
                <h3 class="d-flex">
                    <span
                        style="font-size: 32px; color: Dodgerblue;"
                        class="my-auto"
                        v-on:click="togglePanel"
                    >
                        <i :class="iconClass" class="my-auto mr-2"></i>
                    </span>
                    <span class="my-auto">
                        Aggiungi un articolo
                    </span>
                </h3>
            </div>
        </div>
        <div
            class="alert alert-danger w-100 d-flex"
            v-if="!premium && articlesList"
        >
            <p class="w-100 text-center my-auto font-weight-bold p-2 h4">
                Attenzione: nella versione gratuita verranno visualizzati solo i
                primi 7 articoli inseriti.
            </p>
        </div>
        <div class="row" v-if="is_open">
            <div class="col-12">
                <div class="card  shadow mb-5">
                    <div class="card-header">
                        <span
                            class="clickable close-icon float-right "
                            data-effect="fadeOut"
                            v-on:click="togglePanel"
                            ><i class="fa fa-times"></i
                        ></span>
                        <h5 class="">Aggiungi articolo</h5>
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="addArticle">
                            <div class="row">
                                <div class="form-group col-4">
                                     <div class="form-check">
                                        <input id="insert_sku" class="form-check-input" type="checkbox" v-model="insert_sku">
                                        <label class="form-check-label" for="insert_sku">Inserire Manualmente Codice Prodotto</label>
                                    </div>
                                    <div v-if="insert_sku">
                                        <input type="text" class="form-control mt-2" v-model="product_sku">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="">nome articolo *</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="title"
                                        id="article-title"
                                        v-model="articleName"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="article-desc"
                                        >Descrizione Breve Articolo* (max 240
                                        caratteri)</label
                                    >
                                    <textarea
                                        class="form-control"
                                        name="desc"
                                        id="article-desc"
                                        rows="3"
                                        v-model="articleDesc"
                                        required
                                    ></textarea>
                                </div>
                            </div>
                            <!-- prezzo unitario, lunghezza e peso-->
                            <div class="row m-1 px-0">
                                <!-- unitario -->
                                <div class="col col-12 col-md-12 px-0">
                                    <input
                                        id="unitPrice"
                                        type="radio"
                                        value="true"
                                        name="price"
                                        v-model="showPrice"
                                        v-on:click="showSize=false, showWeight=false"
                                        />
                                    <label for="unitPrice">Inserisci Prezzo unitario</label>
                                    <div class="row">
                                        <div class="form-group col-4" v-if="showPrice">
                                            <label for="article-price">Prezzo *</label>
                                            <div class="d-flex flex-row">
                                                <input
                                                    type="number"
                                                    min="0.00"
                                                    max="10000.00"
                                                    step="0.01"
                                                    class="form-control"
                                                    name="price"
                                                    id="article-price"
                                                    v-model="articlePrice"
                                                    required
                                                />
                                                <button><i class="bi bi-currency-euro">€</i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /unitario -->
                                    <br>
                                    <!-- lunghezza -->
                                    <input
                                        id="size"
                                        type="radio"
                                        value="true"
                                        name="price"
                                        v-model="showSize" v-on:click="showPrice=false, showWeight=false"/>
                                    <label for="size">Inserisci Prezzo per Lunghezza</label>
                                    <div
                                        class="form-group col-12"
                                        v-if="showSize"
                                    >
                                        <div class="row mr-1">
                                             <div class="col col-12 col-md-4">
                                                <label for="">U. Misura:</label>
                                                <select
                                                    class="form-control"
                                                    v-model="info.size.unit"
                                                >
                                                    <option
                                                        v-for="(item,
                                                        index) in unit_size"
                                                        :key="index"
                                                        :value="item"
                                                        >{{ item }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col col-12 col-md-8">
                                                <label for="article-size">Prezzo al: *</label>
                                                <div class="row">
                                                    <div class="d-flex flex-row">
                                                        <input
                                                            id="article-size"
                                                            type="number"
                                                            min="0.00"
                                                            max="10000.00"
                                                            step="0.01"
                                                            v-model="articlePrice"
                                                            class="form-control"
                                                        />
                                                        <button><i class="bi bi-currency-euro">€</i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /lunghezza -->

                                <!-- peso -->
                                <div class="col col-12 col-md-12 px-0">
                                    <input
                                        id="weight"
                                        type="radio"
                                        value="true"
                                        name="price"
                                        v-model="showWeight"
                                        v-on:click="showPrice=false, showSize=false"
                                    />
                                    <label for="weight">Inserisci Prezzo per Peso</label>
                                    <div
                                        class="form-group col-12"
                                        v-if="showWeight"
                                    >
                                        <div class="row mr-1">
                                            <div class="col col-12 col-md-4">
                                                <label for="weight">U. Misura</label>
                                                <select
                                                    class="form-control"
                                                    v-model="info.weight.unit"
                                                >
                                                    <option
                                                        v-for="(item,
                                                        index) in unit_weight"
                                                        :key="index"
                                                        :value="item"
                                                        >{{ item }}</option
                                                    >
                                                </select>
                                            </div>
                                            <div class="col col-12 col-md-8">
                                                <label for="article_weight">Prezzo al: *</label>
                                                <div class="d-flex flex-row">
                                                    <input
                                                        id="article_weight"
                                                        type="number"
                                                        min="0.00"
                                                        max="10000.00"
                                                        step="0.01"
                                                        v-model="articlePrice"
                                                        class="form-control"
                                                    />
                                                    <button><i class="bi bi-currency-euro">€</i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /prezzo unitario, lunghezza e peso -->

                            <!-- Variazioni sul prodotto -->
                            <div>
                                <h4 style="color:dark-grey;" class="mt-3">Variazioni sul prodotto</h4>
                                <!-- lista colori -->
                                <div class="col col-12 px-0">
                                    <input
                                        id="listColor"
                                        type="checkbox"
                                        value="true"
                                        v-model="showListColor"
                                    />
                                    <label for="listColor">Inserisci Lista Colori</label>
                                    <div
                                        class="form-group col-12"
                                        v-if="showListColor || info.color_list"
                                    >
                                        <input
                                            type="text"
                                            v-model="info.color_list"
                                            placeholder="Inserisci valori separati da virgola (es: blu, giallo, rosso)"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <!-- /lista colori -->

                                <!-- lista tagie -->
                                <div class="col col-12 px-0">
                                    <input
                                        id="listSize"
                                        type="checkbox"
                                        value="true"
                                        v-model="showListSize"
                                    />
                                    <label for="listSize">Inserisci Lista Taglie</label>
                                    <div
                                        class="form-group col-12"
                                        v-if="showListSize || info.size_list"
                                    >
                                        <input
                                            type="text"
                                            v-model="info.size_list"
                                            placeholder="Inserisci valori separati da virgola (es: s, m, xl)"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <!-- /lista taglie -->
                            </div>
                            <!-- /variazioni sul prodotto -->
                            <div class="row mb-3 mt-3">
                                <div class="col-12">
                                    <label>Descrizione Lunga</label>
                                    <vue-editor
                                        v-model="articleLongDesc"
                                    ></vue-editor>
                                </div>
                            </div>

                            <div class="row" v-if="articlePresent">
                                <div class="col-12">
                                    <div
                                        class="alert alert-primary"
                                        role="alert"
                                    >
                                        <strong
                                            >un articolo con lo stesso codice e'
                                            gia' presente nella lista.</strong
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="operationMessage.status">
                                <div class="col-12">
                                    <div
                                        :class="operationMessage.type"
                                        role="alert"
                                    >
                                        <strong>{{
                                            operationMessage.content
                                        }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4 mb-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <figure
                                                class="figure"
                                                v-if="
                                                    item_featured_img.length > 0
                                                "
                                            >
                                                <img
                                                    :src="item_featured_img"
                                                    class="figure-img img-fluid rounded"
                                                    alt="..."
                                                />
                                                <figcaption
                                                    class="figure-caption"
                                                >
                                                    Immagine in evidenza
                                                </figcaption>
                                            </figure>
                                        </div>
                                        <div class="col-12">
                                            <div class="file-upload-form">
                                                <input
                                                    type="file"
                                                    name="imageData"
                                                    ref="imageData"
                                                    @change="previewImage"
                                                    accept="image/*"
                                                    style="display: none"
                                                />
                                                <button
                                                    class="btn btn-info text-white mb-2"
                                                    @click.prevent="
                                                        $refs.imageData.click()
                                                    "
                                                >
                                                    Carica un'immagine
                                                </button>
                                                <div class="alert alert-secondary" role="alert">
                                                    <span>Attenzione: altre immagini potranno essere aggiunte nella sezione modifica prodotto</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6" v-if="tagList.length">
                                    <section class="border rounded p-4">
                                        <p>
                                            Scegli le categorie per questo
                                            prodotto
                                        </p>
                                        <div
                                            class="form-check form-check-inline mr-4"
                                            v-for="tag in tagList"
                                            v-bind:key="tag.id"
                                        >
                                            <label class="form-check-label">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    :name="tag.name"
                                                    :id="tag.id"
                                                    :value="tag.id"
                                                    v-model="selected_tags"
                                                />
                                                {{ tag.name }}
                                            </label>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Aggiungi Articolo
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="card shadow mb-5" style="min-height: 450px;">
                    <div class="card-body">
                        <h4 class="card-title mt-1">I tuoi articoli</h4>
                        <ul class="list-unstyled">
                            <articleCard
                                v-for="(item, index) in articlesList"
                                :key="index"
                                :item-data="item"
                                :publisher-data="$attrs.publisher_id"
                                :retail-data="$attrs.retailer_id"
                                :tags="tagList"
                                :class="{ 'border-danger': index > 9 }"
                                :index="index"
                            ></articleCard>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import articleCard from "./ArticleCard";
import { VueEditor } from "vue2-editor";
export default {
    components: {
        VueEditor,
        articleCard: articleCard
    },
    data() {
        return {
            is_open: false,
            iconClass: "fas fa-plus-circle",
            insert_sku:false,
            product_sku: null,
            articleName: null,
            articleDesc: null,
            articleLongDesc: null,
            articlePrice: null,
            articlePresent: false,
            articlesList: [],
            imageData: "",
            item_featured_img: `/storage/default-vat/img/items/default-sku/featured.jpg`,
            operationMessage: {
                type: "alert alert-danger",
                content: null,
                status: false
            },
            premium: null,
            tagList: [],
            selected_tags: [],
            showPrice: true,
            showSize: false,
            showWeight: false,
            showListSize: false,
            showListColor: false,
            unit_weight: ["kg", "hg", "g", "lt", "ml"],
            unit_size: ["mm", "cm", "mt"],
            info: {
                weight: {
                    unit: "",
                    value: "",
                    price: ""
                },
                size: {
                    unit: "",
                    value: "",
                    price: ""
                },
                size_list: "",
                color_list: ""
            },
            composition: {
                parent: "",
                childs: []
            },
            variation: {
                color_list: [],
                size_list: [],
                composition: []
            }
        };
    },
    async mounted() {
        this.checkAut();
        await this.getArticleList();
        this.getTagList();
        this.isPremium();
    },

    methods: {
        checkAut() {
            let status = this.$store.getters.isLoggedIn;
            if (status == false) {
                this.$router.push("/");
            }
        },
        togglePanel() {
            if (this.is_open) {
                this.is_open = false;
                this.iconClass = "fas fa-plus-circle";
            } else {
                this.is_open = true;
                this.iconClass = "fas fa-minus-circle";
            }
        },
        getArticleList() {
            let token = this.$store.state.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
            axios
                .get(`/api/retails/${this.$attrs.retailer_id}/items`, config)
                .then(response => {
                    let listOfItems = response.data.data.sort((a, b) => {
                        return new Date(a.created_at) - new Date(b.created_at);
                    });
                    listOfItems.forEach(item => {
                        item.price = item.price / 100;
                        item.desc = item.description;
                        this.articlesList.push(item);
                    });
                })
                .catch();
        },
        getTagList() {
            let token = this.$store.state.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
            axios
                .get(
                    `/api/retails/${this.$attrs.retailer_id}/tags/list`,
                    config
                )
                .then(response => {
                    this.tagList = response.data.data;
                })
                .catch(errors => {
                    this.tagList = [];
                });
        },
        previewImage: function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                this.imageData = input.files[0];
                var reader = new FileReader();
                reader.onload = e => {
                    this.item_featured_img = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
        async addArticle() {
            if (this.showSize) {
                this.info.size.price = this.articlePrice
            } else if (this.showSize) {
                this.info.weight.price = this.articlePrice
            }
            console.log("add item");
            this.articlePresent = false;
            let skuIsPresent = [];
            if(!this.insert_sku) {
                this.product_sku = (Date.now().toString(36).substr(2, 5) + Math.random().toString(36).substr(2, 5)).toUpperCase()
            }
            if (this.articlesList.length != 0) {
                let sku = this.product_sku;
                skuIsPresent = this.articlesList.filter(function(item) {
                    return item.sku == sku;
                });
                if (skuIsPresent.length > 0) {
                    this.articlePresent = true;
                }
            } else {
                skuIsPresent = [];
            }
            console.log("skuIsPresent: " + skuIsPresent);
            if (this.articlePresent == false) {
                let formData = new FormData();
                formData.append("retailer_vat", this.$store.state.retailerVat);
                formData.append("sku", this.product_sku);
                if (this.selected_tags.length > 0) {
                    formData.append("tags", this.selected_tags);
                }
                formData.append("item_image", this.imageData);
                await axios
                    .post("/api/image_upload", formData, {
                        header: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(e => {
                        console.log(e.data);
                    });

                let addArticle = {
                    id: null,
                    sku: this.product_sku,
                    name: this.articleName,
                    price: this.articlePrice * 100,
                    desc: this.articleDesc,
                    long_description: this.articleLongDesc,
                    tags: this.selected_tags,
                    info: JSON.stringify(this.info)
                };
                let token = this.$store.state.token;
                const config = {
                    headers: { Authorization: `Bearer ${token}` }
                };
                axios
                    .post(
                        `/api/retails/${this.$attrs.retailer_id}/items/create`,
                        addArticle,
                        config
                    )
                    .then(response => {
                        this.operationMessage.type = "alert alert-success";
                        this.operationMessage.content =
                            "Articolo aggiunto correttamente";
                        this.operationMessage.status = true;
                        let itemAdded = response.data.data;
                        console.log(itemAdded);
                        itemAdded.price = (itemAdded.price / 100).toFixed(2);
                        this.articlesList.push(itemAdded);
                        this.is_open = false;
                        this.iconClass = "fas fa-plus-circle";
                        this.$router.go();
                    })
                    .catch(errors => {
                        this.operationMessage.content =
                            "Oops, si e' verificato un problema";
                        this.operationMessage.status = true;
                    });

                this.product_sku = null;
                this.articleName = null;
                this.articleDesc = null;
                this.articleLongDesc = null;
                this.articlePrice = null;
                this.item_featured_img = `/storage/default-vat/img/items/default-sku/featured.jpg`;
            }
        },

        isPremium() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };

            axios
                .get(
                    `/api/retails/${this.$attrs.retailer_id}/is_premium`,
                    config
                )
                .then(response => {
                    this.premium = response.data;
                });
        }
    }
};
</script>

<style scoped>
li {
    width: 100%;
    color: #333;
}
.mediaCard {
    width: 100%;
}
.btn-danger {
    margin-top: 10px;
}
</style>
