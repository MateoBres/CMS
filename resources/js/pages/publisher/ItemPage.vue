<template>
    <div class="container text-left">
        <div class="row" style="margin-top: 8rem !important;">
            <div class="col-12">
                <a
                    class="btn btn-primary text-white"
                    @click="$router.push({ name: 'ItemPublisher' })"
                >
                    <i class="fas fa-chevron-circle-left mr-2"></i>
                    Torna alla pagina precedente
                </a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xs-12 col-md-12">
                <div class="card shadow mb-5" style="min-height: 450px;">
                    <div class="card-body">
                        <h3 class="card-title">
                            {{ item_name }}
                        </h3>
                        <form
                            v-on:submit.prevent="updateArticle"
                            id="updateItemForm"
                        >
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label for=""
                                                >codice articolo (SKU)</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="sku"
                                                id="sku"
                                                v-model="item_sku"
                                                required
                                                disabled
                                            />
                                            <small>Non modificabile</small>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for=""
                                                >nome articolo<i class="fa fa-asterisk ml-1 text-danger"></i></label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="title"
                                                id="article-title"
                                                v-model="item_name"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for=""
                                                >Descrizione Breve Articolo<i class="fa fa-asterisk ml-1 text-danger"></i><br/>
                                                (max 240 caratteri)</label
                                            >
                                            <textarea
                                                class="form-control"
                                                name="description"
                                                id="article-desc"
                                                rows="3"
                                                v-model="item_desc"
                                                required
                                                v-on:keyup="countTextArea()"
                                            ></textarea>
                                            <small
                                                >caratteri rimanenti:
                                                {{ charactersLeft }}</small
                                            >
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
                                                <label for="">Prezzo al: *</label>
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



                                        <!-- variazione Prodotti -->
                                        <!-- <div class="col-12 px-0">
                                            <input type="checkbox" v-model="showVariation">
                                            Crea Variazione Prodotti
                                        </div>
                                        <div class="col-12 px-0 my-2">
                                            <composition-form
                                                v-if="showVariation"
                                                @setComposition="setComposition">
                                            </composition-form>
                                        </div>
                                        <div class="col-12 mx-0 my-2">
                                            <variation-table v-if="variation"
                                                :items="variation"
                                                @deleteCombination="deleteCombination"></variation-table>
                                        </div> -->
                                        <!-- /variazione prodotti -->
                                    <!-- </div>/row -->



                                    <!-- <div class="row">
                                        <div class="form-group col-4">
                                            <label for="">Prezzo <i class="fa fa-asterisk ml-1 text-danger"></i></label>
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
                                        </div>
                                    </div> -->
                                </div>
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
                                                    :src="item_temp_img"
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
                                                <label>Carica un'immagine:</label><br />
                                                <input
                                                    type="file"
                                                    name="imageData"
                                                    ref="imageData"
                                                    @change="previewImage"
                                                    accept="image/*"
                                                    style="display: none"
                                                />
                                                <button
                                                    class="btn btn-info text-white"
                                                    @click.prevent="
                                                        $refs.imageData.click()
                                                    "
                                                >
                                                    Aggiorna Immagine
                                                </button>
                                            </div>
                                        </div>
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

                            <div class="row" v-if="tag_list.length">
                                <div class="col-4">
                                <small
                                    ><i class="fa fa-asterisk text-danger"></i> : Campo obbligatorio.</small
                                >
                            </div>
                                <div class="col-12">
                                    <section class="border rounded p-4" style="margin-bottom: 2%;">
                                        <p>Scegli le categorie per questo prodotto</p>
                                        <div class="form-check form-check-inline mr-4" v-for="tag in tag_list" v-bind:key="tag.id">
                                          <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" :name="tag.name" :id="tag.id" :value="tag.id" v-model="selected_tags">
                                            {{ tag.name }}
                                          </label>
                                        </div>

                                    </section>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-12">
                                    <label>Descrizione Lunga</label>
                                    <vue-editor
                                        v-model="long_desc"
                                    ></vue-editor>
                                </div>
                            </div>

                            <div class="row border rounded p-4 mt-4 ml-2 mr-2">
                                <div class="col-12" >
                                    <h4 class="font-bold text-center">
                                        Galleria Immagini Prodotto
                                    </h4>
                                    <p class="text-center">
                                        * Massimo 3 foto
                                    </p>
                                </div>
                                 <div class="col col-12 col-md-4" v-for="(item, index) in gallery_images" :key="index">
                                    <img :src="item.thumbnail" class="img-fluid">
                                    <button class="btn btn-danger custom-danger mt-4"
                                    style="margin-bottom: 10%;"
                                        @click.prevent="removeImage(retailer_id, item_id, item.id)">
                                        <i class="fas fa-minus-circle"></i> Rimuovi
                                    </button>
                                </div>
                                <div class="col col-12 col-md-4" v-for="index in gallery_images_size" :key="'a'+index">
                                    <FormItemImage
                                        :key="componentKey"
                                        :retailerId="retailer_id"
                                        :itemId="item_id"
                                        :numberImage="index"
                                        @refreshGallery="reloadData()" />
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

                            <div class="row mt-3">
                                <div class="col-12">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Aggiorna Articolo
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import FormItemImage from '../../components/FormItemImage';
import CompositionForm from '../../components/card/CompositionForm';
import ItemVariationTable from '../../components/ItemVariationTable';
export default {
    name: "ItemPage",
    components: {
        VueEditor,
        FormItemImage,
        'composition-form' : CompositionForm,
        'variation-table' : ItemVariationTable,
    },
    data() {
        return {
            long_desc:
                "<p>inserisci qui una descrizione dettagliata del prodotto</p>",
            item_id: this.$attrs.item_id,
            publisher_id: this.$attrs.publisher_id,
            retailer_id: this.$attrs.retailer_id,
            tag_list: [],
            selected_tags:[],
            item_name: null,
            item_sku: null,
            item_desc: null,
            item_tags: [],
            articlePrice: null,
            item_featured_img: `/storage/default-vat/img/items/default-sku/featured.jpg`,
            item_temp_img: null,
            unit_weight: ['kg', 'g', 'lt', 'ml'],
            unit_size: ['mm', 'cm', 'mt'],
            showPrice: true,
            showSize: false,
            showWeight: false,
            showListSize:false,
            showListColor: false,
            showVariation: false,
            item_color_list: '',
            item_size_list: '',
            info: {
                weight: {
                    unit: '',
                    value: '',
                    price: '',
                },
                size: {
                    unit: '',
                    value: '',
                    price: '',
                },
                size_list: '',
                color_list: '',
            },
            operationMessage: {
                type: "alert alert-danger",
                content: null,
                status: false
            },
            imageData: "", // we will store base64 format of image in this string
            content: null,
            config: {
                // Get options from
                // https://alex-d.github.io/Trumbowyg/documentation
            },
            gallery_images: '',
            variation: {
                color_list: [],
                size_list: [],
                composition: []
            },
            componentKey: 0
        };
    },
    computed: {
        charactersLeft() {
            if(this.item_desc) {
                let char = this.item_desc.length,
                    limit = 240;
                return limit - char + " / " + limit + "";
            }

        },
        gallery_images_size() {
            if (this.gallery_images) {
                return (3 - this.gallery_images.length)
            } else {
                return 3
            }
        }
    },
    async mounted() {
        this.getTagList();
        await this.getArticleData();
    },
    methods: {
        getTagList() {
            let token = this.$store.state.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
            axios
                .get(`/api/retails/${this.$attrs.retailer_id}/tags/list`, config)
                .then( response => {
                    this.tag_list = response.data.data
                })
                .catch(errors => {
                    this.tagList = []
                })
        },
        getArticleData() {
            let token = this.$store.state.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
            axios
                .get(
                    `/api/retails/${this.retailer_id}/items/${this.item_id}`,
                    config
                )
                .then(response => {
                    let itemDetails = response.data.data;
                    this.item_name = itemDetails.name;
                    this.item_sku = itemDetails.sku;
                    this.item_desc = itemDetails.description;
                    this.articlePrice = itemDetails.price / 100;
                    this.long_desc = itemDetails.long_description;
                    this.item_tags = itemDetails.tags;
                    if (itemDetails.info) {
                        this.info = JSON.parse(itemDetails.info);
                    }
                    itemDetails.tags.forEach(tag => {
                        this.selected_tags.push(tag.id)
                    });
                    this.item_featured_img = `/storage/${this.$store.state.retailerVat}/img/items/${itemDetails.sku}/featured.jpg`;
                    let version_number = Math.floor(Math.random() * 100);
                    let url_image =
                        this.item_featured_img + `?version=${version_number}`;
                    this.item_temp_img = url_image;
                    this.gallery_images = response.data.data.images;
                    if(itemDetails.variation) {
                        this.variation = JSON.parse(itemDetails.variation);
                    }
                    if (this.info.size.unit) {
                        this.showPrice = false;
                        this.showSize = true;
                        this.showWeight = false;
                    } else if (this.info.weight.unit) {
                        this.showPrice = false;
                        this.showSize = false;
                        this.showWeight = true;
                    };
                })
                .catch(errors => {});
        },
        updateArticle() {
            let uniqueTags = [...new Set(this.selected_tags)]
            let updateArticle = {
                id: null,
                sku: this.item_sku,
                name: this.item_name,
                price: this.articlePrice * 100,
                description: this.item_desc,
                long_description: this.long_desc,
                tags: uniqueTags,
                info: this.info,
                variation: this.variation,
            };

            let token = this.$store.state.token;

            let formData = new FormData();
            formData.append("retailer_vat", this.$store.state.retailerVat);
            formData.append("sku", this.item_sku);
            formData.append("item_image", this.imageData);

            axios
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
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`,
                }
            };
            axios
                .put(
                    `/api/retails/${this.retailer_id}/items/${this.item_id}`,
                    updateArticle,
                    config
                )
                .then(response => {
                    this.operationMessage.type = "alert alert-success";
                    this.operationMessage.content =
                        "Articolo modificato correttamente";
                    this.operationMessage.status = true;
                })
                .catch(errors => {
                    this.operationMessage.content =
                        "Oops, si e' verificato un problema";
                    this.operationMessage.status = true;
                });

        },
        previewImage: function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                this.imageData = input.files[0];
                var reader = new FileReader();
                reader.onload = e => {
                    this.item_temp_img = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
        removeImage(retailerId, itemId, id) {
            let formData = new FormData();
            formData.append("file", this.imageData);

            let token = this.$store.state.token;
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`,
                }
            };

            axios
                .delete(`/api/retails/${retailerId}/items/${itemId}/images/${id}`, config)
                .then( response => {
                    console.log("reposne". response);
                })
                .catch(errors => {
                    console.log("erro", error)
                })
            this.getArticleData();
        },
        reloadData() {
            this.getArticleData();
            this.$forceUpdate();
            this.forceRerender();
            //window.location.reload();
        },
        setComposition(color, size) {
            var composition = {
                parent: '',
                childs: [],
            };
            composition.parent = color;
            composition.childs = size;
            this.variation.composition.push(composition);
        },
        deleteCombination(index) {
            this.variation.composition.splice(index, 1);
        },
        forceRerender() {
            this.componentKey += 1;
        }
    }
};
</script>

<style scoped>
 .custom-danger {width:100%;}
</style>
