<template>
    <li class="media mt-3 mediaCard rounded border" v-if="is_showed">
        <img
            :src="defaultThumb"
            class="mr-3 position-relative"
            alt="..."
            style="max-width: 100px;"
        />
        <div class="position-absolute top-left mt-2"  v-if="index > 9">
            <span class="fa-stack fa-2x">
                <i class="fas fa-circle fa-stack-2x text-danger"></i>
                <i class="fas fa-eye-slash fa-stack-1x fa-inverse"></i>
            </span>
            <!-- <i class="fa fa-eye-slash text-danger m-3"></i> -->
        </div>
        <div class="media-body">
            <div class="row h-100">
                <div class="col-9">
                    <h4 class="mt-0 mb-1">
                        <small>{{ item.sku }}</small> -
                        <strong>{{ item.name }}</strong> -
                        <span class="badge badge-pill badge-primary"
                            >&euro; {{ item.price }}</span
                        >
                    </h4>
                    <div class="row">
                        <div class="col-12">
                            <span v-for="tag in item.tags" v-bind:key="tag.id" >
                                <span class="badge badge-pill badge-secondary">{{ tag.name }}</span>&nbsp;
                            </span>
                        </div>
                    </div>
                    {{ item.desc }}
                    
                </div>
                <div class="col-3 d-flex justify-content-center h-100 my-auto">
                    <div class="text-left my-auto">
                        <button
                            type="button"
                            class="btn btn-primary"
                            v-on:click="goToDetails"
                            float-right
                        >
                            Modifica
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger"
                            :id="'delete_' + item.id"
                            data-toggle="modal"
                            :data-target="'#deleteModal_' + item.id"
                            float-right
                        >
                            Cancella
                        </button>
                        <div
                            class="modal fade"
                            :id="'deleteModal_' + item.id"
                            tabindex="-1"
                            role="dialog"
                        >
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            Cancella Articolo
                                        </h5>
                                        <button
                                            type="button"
                                            class="close"
                                            data-dismiss="modal"
                                            aria-label="Close"
                                        >
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{ item.name }} verra' cancellato, sicuri di
                                        procedere?
                                    </div>
                                    <div class="modal-footer">
                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-dismiss="modal"
                                        >
                                            Annulla
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            v-on:click="deleteItem"
                                        >
                                            Procedi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </li>
</template>

<script>
export default {
    name: "articleCard",
    props: ["itemData", "publisherData", "retailData", 'index', 'tags'],
    data() {
        return {
            item: this.itemData,
            defaultThumb: `/storage/${this.$store.state.retailerVat}/img/items/${this.itemData.sku}/thumbnail.jpg`,
            is_showed: true
        };
    },
    mounted() {
        let version_number = Math.floor(Math.random() * 100);
        let url_image = this.defaultThumb + `?version=${version_number}`;
        this.defaultThumb = url_image;
    },
    methods: {
        goToDetails() {
            this.$router.push(
                `/publisher/${this.publisherData}/retailer/${this.retailData}/items/${this.item.id}`
                /*  () => this.$router.go() */
            );
        },
        deleteItem() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };
            axios
                .delete(
                    `/api/retails/${this.retailData}/items/${this.item.id}`,
                    config
                )
                .then(response => {
                    alert("articolo modificato correttamente");
                    this.is_showed = false;
                    $(".modal-backdrop").remove();
                    $(document.body).removeClass("modal-open");
                })
                .catch(errors => {
                    alert("si e' verificato un problema");
                    $(".modal-backdrop").remove();
                    $(document.body).removeClass("modal-open");
                });
        }
    }
};
</script>

<style>
.mediaCard {
    padding: 10px;
    background-color: #f5f5f5;
}
</style>
