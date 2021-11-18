<template>
    <div class="col col-12">
        <div class="col col-12">
            <div class="col-12">
                <figure class="figure" v-if="item_featured_img.length > 0">
                    <img
                        style="cursor:pointer;"
                        @click.prevent="$refs.imageData.click()"
                        :src="item_temp_img"
                        class="figure-img img-fluid rounded"
                        alt="..."
                    />
                    <figcaption class="figure-caption">
                        Carica una immagine
                    </figcaption>
                </figure>
            </div>

            <div class="file-upload-form">
                <!-- <p class="text-center">
                Carica un Immagine
              </p> -->
                <input
                    type="file"
                   
                    ref="imageData"
                    @change="previewImage"
                    accept="image/*"
                    style="display: none"
                />
                <div v-if="imageError" class="alert alert-danger">
                    {{imageError}}
                </div>
                <button
                    v-if="imageData && valid"
                    class="btn btn-info text-white"
                    @click.prevent="saveImage()"
                >
                    <i class="fas fa-upload"></i> Salva
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "FormItemImage",
    props: ["retailerId", "itemId", "numberImage"],
    data() {
        return {
            item_featured_img: `/storage/default-vat/img/items/default-sku/featured.jpg`,
            item_temp_img: `/images/placeholder_uploadImage.jpg`,
            imageData: "", // we will store base64 format of image in this string,
            valid: true,
            imageError: ""
        };
    },
    methods: {
        previewImage: function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                this.imageData = input.files[0];
                console.log(input.files[0].size);
                if(input.files[0].size > 800000) {
                    this.imageError = `L'immagine troppo pesante (massimo consentito: 800kb).`;
                    this.valid = false;
                    return;
                }
                var reader = new FileReader();
                reader.onload = e => {
                    this.item_temp_img = e.target.result;
                    this.valid = true;
                    this.imageError = ""
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
        saveImage() {
            let formData = new FormData();
            formData.append("file", this.imageData);

            let token = this.$store.state.token;
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };

            axios
                .post(
                    `/api/retails/${this.retailerId}/items/${this.itemId}/images`,
                    formData,
                    config
                )
                .then(response => {
                    console.log("reponse".response);
                    this.$emit("refreshGallery");
                })
                .catch(errors => {
                    console.log("erro", error);
                });
        }
    },
    watch: {
        numberImage: function(oldValue, newValue) {
            this.item_featured_img = `/storage/default-vat/img/items/default-sku/featured.jpg`;
            this.item_temp_img = `/images/placeholder_uploadImage.jpg`;
            this.imageData = "";
            return newValue;
        }
    }
};
</script>

<style scoped>
.btn-info {
    width: 100%;
}
</style>
