<template>
    <div class="container" id="">
        <section class="row my-3">
            <div class="col-xs-12 col-md-12">
                <div class="card text-left" id="retailCategoryCardSignUp">
                    <div class="card-body">
                        <h5 class="card-title">
                            <br>
                            Categorie associate alla tua attività
                        </h5>
                        <div class="card-text">
                            <div class="row">
                                <div class="col-6 my-auto">
                                    <div class="alert alert-info border-primary d-flex my-3">
                                        <p class="text-center my-auto mx-auto text-primary font-weight-bold">Inizia a digitare il nome della categoria nella casella a lato, poi clicca sull'opzione appropriata e infine sul bottone 'Aggiungi' per confermare</p>
                                    </div>
                                    <strong class="lead">
                                        Massimo 3 categorie
                                    </strong>
                                    <br />
                                </div>
                                <div class="col-4 my-auto" v-if="allow">
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
                                            class="autocomplete-results bg-white p-2 w-100"
                                            v-if="isOpen"
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
                                <div class="col-4 my-auto" v-else>
                                    <h3 class="text-center">Hai raggiunto il limite massimo di categorie consentite!</h3>
                                </div>
                                <div class="col-2 my-auto">
                                    <span
                                        class="btn btn-block btn-success mr-2"
                                        @click="addCategorie()"
                                    >
                                        <i class="fas fa-plus mr-2"></i>Aggiungi
                                    </span>
                                </div>
                            </div>
                            <div class="row mt-2">

                            </div>
                            <div class="row mt-2">
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: "CategoriesSignUp",
    props: ['allow'],
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
            selectedCategory: []
        };
    },
    mounted() {
        this.getShopCategories();
    },
    watch: {
        results: function() {
            console.log('trigger')
            if(!this.results || this.results.length < 1) {
                this.isOpen = false
            }
        }
    },
    methods: {
        getCategories(cat) {
            axios
                .get(`/api/categories/${cat}`)
                .then(response => {
                    console.log(response.data.data);
                    this.results = response.data.data;
                    this.isOpen = true;
                })
                .catch(errors => {});
        },
        setResult(result) {
            this.selected_result = result;
            this.cat_search = result.nome;
            this.isOpen = false;
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
        addCategorie() {
            this.$emit('getCategoria', this.selected_result);
            this.cat_search = null;
            this.isOpen = false;
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
        }
    }
};
</script>

<style>
#retailCategoryCardSignUp {
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
    overscroll-behavior: contain;
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
