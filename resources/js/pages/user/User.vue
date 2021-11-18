<template>
    <div class="container py-5" style="min-height: 80vh">
        <section class="d-flex justify-content-between mt-5">
            <div class="col-4 d-flex flex-row mb-3">
                <div class="row justify-content-start" v-if="retailer">
                    <router-link class="btn btn-primary text-white mt-2" role="button" :to="{path: `/azienda/${retailer.slug}/${retailer.vat}`}">
                        <i class="fas fa-chevron-circle-left mr-2"></i>
                        Torna al negozio
                    </router-link>
                </div>
            </div>
            <div class="col-12">
                <h5 v-if="!loading_data && user != null">Benvenuto al tuo pannello di controllo {{ user.name }}</h5>
            </div>
        </section>
        <section class="row mt-3">
            <div class="col-12">
                <ul class="nav nav-tabs justify-content-left">
                    <li class="nav-item">
                        <router-link :to="{name: 'UserOrders', params: { user_id: user.id }}" class="nav-link" exact v-if="!loading_data && user != null">
                            <h5>Ordini</h5>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'UserAddresses', params: { user_id: user.id }}" class="nav-link" exact v-if="!loading_data && user != null">
                            <h5>Indirizzi</h5>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'ChangeUserPassword', params: { user_id: user.id }}" class="nav-link" exact v-if="!loading_data && user != null">
                            <h5>Password</h5>
                        </router-link>
                    </li>
                </ul>
            </div>
        </section>
        <section class="row mt-3">
            <div class="col-xs-12 col-md-12">
                <router-view></router-view>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: "User",
    data() {
        return {
            user_id: this.$route.params.user_id,
            user: null,
            addresses: 'test addresses',
            orders: 'test orders',
            loading_data: true,
            retailer: null
        };
    },
    // computed: {
    //     token: function () {
    //         return this.
    //     }
    // }
    async mounted() {
        await this.getUser();
        await this.getRetailerByVat();
        this.loading_data = false;
    },
    methods: {
        getRetailerByVat() {
            axios
                .get(`/api/retails/by-vat/${this.$store.getters.retailerVat}`)
                .then( response => {
                    this.retailer = response.data.data
                    this.$store.dispatch('setRetailerSlug', response.data.data.slug)
                    this.$store.dispatch('setRetailerVat', response.data.data.vat)
                    console.log('******retailer', this.retailer)
                })
                .catch( e => {
                    this.reset_message = response.data.message
                    this.reset_message_class = 'danger'
                    this.show_reset_message = true
                })
        },
        getUser() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };
            axios
                .get(`/api/users/${this.user_id}`, config)
                .then(response => {
                    this.user = response.data.data;
                    this.addresses = response.data.data.addresses;
                    this.orders = response.data.data.orders;
                })
                .catch(errors => {
                    console.log(errors)
                });
        }
    }
};
</script>

<style></style>
