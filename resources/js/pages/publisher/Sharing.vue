<template>
    <div class="container" id="ordersContainer">
        <section class="row my-3 bg-light">
            <div class="col-xs-12 col-md-12">
                <div class="card text-left" id="retailCategoryCard">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="row">
                                <div class="d-none d-md-block col-6">
                                    <div class="alert alert-info mb-4" role="alert">
                                        Qui a destra trovate il QR Code e il Link relativi al vostro negozio.<br />
                                        Fate click sui pulsanti per scaricare l'immagine del QR Code o per copiare l'indirizzo web.
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 text-center d-flex flex-column justify-content-center">
                                    <div
                                        class="mb-3 border rounded mx-auto"
                                    >
                                        <vue-qrcode
                                            :value="RetailerURL"
                                            :options="{ width: 200 }"
                                            v-if="retailer && retailer.url"
                                            tag="img"
                                            ref="qrcode"
                                            id="qrcode"
                                        ></vue-qrcode>
                                    </div>
                                    <button
                                        @click.prevent="downloadImg()"
                                        class="btn btn-info text-white uppercase mb-3"
                                    >
                                        <i class="fas fa-cloud-download-alt mr-3"></i>
                                        Scarica immagine
                                    </button>
                                    <span class="text-center border rounded p-1 mb-3">
                                        {{ RetailerURL }}
                                    </span>
                                    <button
                                        @click.prevent="copyURL()"
                                        class="btn btn-info text-white uppercase"
                                    >
                                        <i :class="[copy_link_icon, 'mr-3']"></i>
                                        {{ copy_text_label }}
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
import { mapState } from 'vuex'
import VueQrcode from '@chenfengyuan/vue-qrcode'
export default {
    components: {
        VueQrcode
    },
    data() {
        return {
            copy_text_label: 'Copia Link',
            copy_link_icon: 'far fa-clipboard',
        }
    },
    name: "Sharing",

    methods: {
        downloadImg() {
            var a = document.createElement("a"); //Create <a>
            a.href = this.QRCodeSource //Image Base64 Goes here
            a.download = "qrcode.png"; //File name Here
            a.click(); //Downloaded file
        },
        async copyURL() {
            await navigator.clipboard.writeText(this.RetailerURL);
            this.copy_text_label = 'Link Copiato'
            this.copy_link_icon = 'fas fa-check'
        }
    },
    computed: {
        ...mapState({
            retailer:   state => state.retailer
        }),
        RetailerURL: function() {
            if(this.retailer){
                return `https://www.spesavicino.it${this.retailer.url}`
            }

        },
        QRCodeSource: function() {
            return document.querySelector('#qrcode').src
        }

    }
};
</script>
<style>
</style>
