<template>
    <div class="container" id="ordersContainer">
        <section class="row my-3 bg-light">
            <div class="col-xs-12 col-md-12">
                <div class="card text-left" id="retailCategoryCard">
                    <div class="card-body">
                        <h5 class="card-title">
                            Categorie associate alla tua attività
                        </h5>
                        <div class="card-text">
                            <div class="row">
                                <div class="col-6 my-auto">
                                    <strong class="lead"
                                        >Scegli una categoria tra quelle
                                        disponibili</strong
                                    ><br />
                                    <small>max tre categorie</small>
                                </div>
                                <div class="col-4 my-auto">
                                    <div class="autocomplete">
                                        <input
                                            type="text"
                                            class="form-control col-12 my-auto"
                                            v-model="cat_search"
                                            v-on:keyup="
                                                getCategories(cat_search)
                                            "
                                        />
                                        <ul
                                            class="autocomplete-results"
                                            v-show="isOpen"
                                        >
                                            <li
                                                class="autocomplete-result"
                                                v-for="result in results"
                                                :key="result.id"
                                                @click="setResult(result)"
                                            >
                                                {{ result.nome }}
                                                <small
                                                    >({{
                                                        result.verticale
                                                    }})</small
                                                >
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-2 my-auto">
                                    <button
                                        class="btn btn-block btn-success mr-2"
                                        :disabled="validated" @click="addCategorie()"
                                    >
                                        <i class="fas fa-plus mr-2"></i>Aggiungi
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <p><small>le tue categorie:</small></p>
                                </div>
                                <div class="col-12">
                                    <button
                                        v-for="category in shopCategories"
                                        v-bind:key="category.id"
                                        type="button"
                                        class="btn btn-primary mr-2"
                                        @click="deleteCat(category.id)"
                                    >
                                        <i class="fas fa-times"></i>&nbsp;{{
                                            category.nome
                                        }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-light">
            <div class="row bg-light">
                <div class="col-12">
                    <div
                        :class="message.class"
                        role="alert"
                        v-if="message.is_showed"
                    >
                        <strong>{{ message.text }}</strong>
                    </div>
                </div>
            </div>
        </section>
        <section class="row my-3 bg-light">
            <div class="col-12">
                <div class="card text-left" id="itemsTagCard">
                    <div class="card-body">
                        <h5 class="card-title">
                            Categorie per i tuoi prodotti
                        </h5>
                        <div class="card-text">
                            <div class="row">
                                <div class="col-6 my-auto">
                                    <strong class="lead"
                                        >aggiungi le categorie per i tuoi
                                        prodotti</strong
                                    ><br />
                                </div>
                                <div class="col-4 my-auto">
                                    <div class="autocomplete">
                                        <input
                                            type="text"
                                            class="form-control col-12 my-auto"
                                            v-model="itemCategory"
                                        />
                                    </div>
                                </div>
                                <div class="col-2 my-auto">
                                    <button
                                        class="btn btn-block btn-success mr-2"
                                        @click="addItemsCategory()"
                                    >
                                        <i class="fas fa-plus mr-2"></i>Aggiungi
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <p><small>Categorie Prodotti:</small></p>
                                </div>
                                <div class="col-12">
                                    <button
                                        v-for="category in itemsCategories"
                                        v-bind:key="category.id"
                                        type="button"
                                        class="btn btn-primary mr-2"
                                        @click="deleteItemsCat(category.id)"
                                    >
                                        <i class="fas fa-times"></i>&nbsp;{{
                                            category.name
                                        }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: "Categories",
    data() {
        return {
            categories_list: [],
            cat_search: null,
            results: [],
            isOpen: false,
            selected_result: {
                name: null,
                id: null
            },
            shopCategories: [],
            message: {
                is_showed: false,
                text: null,
                class: null
            },
            itemCategory: null,
            itemsCategories: [],
            validated: false
        };
    },
    mounted() {
        this.getShopCategories();
        this.getItemsCategories();
    },
    methods: {
        getCategories(cat) {
            axios
                .get(`/api/categories/${cat}`)
                .then(response => {
                    console.log(response.data.data);
                    this.results = response.data.data;
                    this.isOpen = true;
                    this.validated = true;
                })
                .catch(errors => {});
        },
        setResult(result) {
            this.selected_result = result;
            this.cat_search = result.nome;
            this.isOpen = false;
            this.validated = false;
        },
        getShopCategories() {
            let token = this.$store.state.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
            axios
                .get(
                    `/api/retails/${this.$attrs.retailer_id}/categories/list`,
                    config
                )
                .then(response => {
                    this.shopCategories = response.data.data;
                })
                .catch(errors => {});
        },
        getItemsCategories() {
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
                    this.itemsCategories = response.data.data;
                })
                .catch(errors => {});
        },
        addCategorie() {
            if (this.cat_search) {

                let token = this.$store.state.token;
                const config = {
                    headers: { Authorization: `Bearer ${token}` }
                };
                axios
                    .post(
                        `/api/retails/${this.$attrs.retailer_id}/categories/add_category`,
                        { category: this.selected_result },
                        config
                    )
                    .then(response => {
                        if (
                            response.data.message == "Category successfully added"
                        ) {
                            this.shopCategories.push(this.selected_result);
                            this.selected_result = {
                                name: null,
                                id: null
                            };
                            this.cat_search = null;
                            this.message.is_showed = false;
                        } else if (response.data.message == "Max limit exceeded") {
                            this.selected_result = {
                                name: null,
                                id: null
                            };
                            this.cat_search = null;
                            this.message.text =
                                "Attenzione: con la versione gratuita si possono inserire al massimo 3 categorie!";
                            this.message.class = "alert alert-danger";
                            this.message.is_showed = true;
                        }
                    })
                    .catch(errors => {
                        this.selected_result = {
                            name: null,
                            id: null
                        };
                        this.cat_search = null;
                        this.message.text = "Oops, si e' verificato un problema";
                        this.message.class = "alert alert-danger";
                        this.message.is_showed = true;
                    });
            } else {
                this.message.text =
                                "Attenzione: la categoria è vuota";
                            this.message.class = "alert alert-danger";
                            this.message.is_showed = true;
            }
        },
        deleteCat(cat) {
            let token = this.$store.state.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
            axios
                .delete(
                    `/api/retails/${this.$attrs.retailer_id}/categories/${cat}`,
                    config
                )
                .then(response => {
                    this.message.is_showed = false;
                    this.message.text = "Categoria eliminata correttamente";
                    this.message.class = "alert alert-success";
                    this.message.is_showed = true;
                    this.shopCategories = this.shopCategories.filter(
                        category => {
                            return category.id != cat;
                        }
                    );
                })
                .catch(erros => {});
        },
        deleteItemsCat(cat) {
            let token = this.$store.state.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
            axios
                .delete(
                    `/api/retails/${this.$attrs.retailer_id}/tags/${cat}`,
                    config
                )
                .then(response => {
                    this.message.is_showed = false;
                    this.message.text = "Categoria eliminata correttamente";
                    this.message.class = "alert alert-success";
                    this.message.is_showed = true;
                    this.itemsCategories = this.itemsCategories.filter(
                        category => {
                            return category.id != cat;
                        }
                    );
                })
                .catch(erros => {});
        },
        addItemsCategory() {
            // console.log(this.itemCategory);
            // this.itemsCategories.push(this.itemCategory);
            let token = this.$store.state.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
            axios
                .post(
                    `/api/retails/${this.$attrs.retailer_id}/tags/add_tag`,
                    { tag: this.itemCategory },
                    config
                )
                .then(response => {
                    if (response.data.success == true) {
                        this.itemsCategories.push(response.data.data);
                        this.itemCategory = "";
                        this.message.is_showed = false;
                    } else if (response.data.success == false) {
                        this.message.text =
                            "Oops, si e' verificato un problema, riprova per favore.";
                        this.message.class = "alert alert-danger";
                        this.message.is_showed = true;
                    }
                })
                .catch(errors => {
                    this.selected_result = {
                        name: null,
                        id: null
                    };
                    this.cat_search = null;
                    this.message.text = "Oops, si e' verificato un problema";
                    this.message.class = "alert alert-danger";
                    this.message.is_showed = true;
                });
        }
    }
};
</script>

<style>
li {
    color: #333;
}
#retailCategoryCard,
#itemsTagCard {
    min-height: 200px;
}
.autocomplete {
    position: relative;
    /* width: 130px; */
}

.autocomplete-results {
    padding: 0;
    margin: 0;
    border: 1px solid #eeeeee;
    max-height: 120px;
    overflow: auto;
    position: absolute;
    z-index: 99;
}

.autocomplete-result {
    list-style: none;
    text-align: left;
    padding: 4px 2px;
    cursor: pointer;
}

.autocomplete-result:hover {
    background-color: #4aae9b;
    color: white;
}
</style>
