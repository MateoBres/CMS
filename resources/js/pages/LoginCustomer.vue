<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-12 col-md-4"></div>

            <div class="col col-12 col-md-4">
                <form class="form-signin" @submit.prevent="login">
                    <div class="form-row justify-content-center">
                        <img
                            class="my-4 mx-auto w-50 h-50"
                            :src="`/storage/${this.$store.state.retailerVat}/img/profile/logo.jpg`"
                            alt=""
                            height=""
                        />
                    </div>
                    <h1 class="h3 mb-3 font-weight-normal text-center">LOG IN</h1>
                    <div class="alert alert-danger mb-3" v-show="show_error">
                        {{ error_msg }}
                    </div>
                    <label for="inputEmail" class="sr-only"
                        >Email address</label
                    >
                    <input
                        type="email"
                        id="inputEmail"
                        class="form-control mb-3"
                        placeholder="Email address"
                        required=""
                        autofocus=""
                        v-model="form.email"
                    />
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input
                        type="password"
                        id="inputPassword"
                        class="form-control mb-3"
                        placeholder="Password"
                        required=""
                        v-model="form.password"
                    />
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me" />
                            Remember me
                        </label>
                    </div>
                    <button
                        class="btn btn-lg btn-primary btn-block"
                        type="submit"
                    >
                        ENTRA
                    </button>
                    <!-- <router-link
                        :to="{ name: 'Registrati' }"
                        class="btn btn-lg btn-danger btn-block"
                        >REGISTRATI</router-link
                    > -->
                    <router-link
                        :to="{ name: 'RegistraAzienda' }"
                        class="btn-success btn btn-lg btn-block"
                    >
                        REGISTRA NEGOZIO
                    </router-link>
                    <button class="btn btn-lg btn-secondary btn-block text-white" data-toggle="modal" data-target="#passwordReset" @click.prevent>RECUPERA PASSWORD</button>
                    <div class="modal fade" id="passwordReset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row justify-content-center">
                                        <div class="col-10 form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="text" v-model="recovery_email">
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-10">
                                            <button class="btn btn-block btn-primary" @click.prevent="reset_password()">
                                                Resetta Password
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center" v-if="show_reset_message">
                                        <div class="col-10 mt-3">
                                            <div class="alert alert-dismissible fade show p-3" :class="'alert-'+reset_message_class" role="alert">
                                                <div class="row justify-content-center">
                                                    <div class="col-10 my-auto">
                                                        {{ reset_message }}
                                                    </div>
                                                    <div class="col-2 my-auto">
                                                        <i class="fas fa-times" @click="show_reset_message = false"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="mt-5 mb-3 text-muted">© 2020</p>
                </form>
            </div>

            <div class="col col-12 col-md-4"></div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</template>

<script>
import UserService from "../services/UserService";
import { eventBus } from "../app";

export default {
    name: "LoginCustomer",
    props: ["slug"],
    data() {
        return {
            form: {
                email: null,
                password: null
            },

            show_error: false,
            error_msg: null,
            recovery_email: '',

            reset_message: '',
            show_reset_message: false,
            reset_message_class: '',

            retailer: null,
        };
    },
    mounted() {
        this.getRetailerBySlug()
    },
    methods: {
        async login() {
            let formData = new FormData();
            for (var [key, value] of Object.entries(this.form)) {
                console.log(key, value);
                formData.append(key, value);
            }

            axios
                .post('/api/login', {
                    'email': this.form.email,
                    'password': this.form.password,
                    'retailerLogin': false,
                }, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    }
                })
                .then(r => {
                    if(!r.data.success) {
                        this.error_msg = 'Credenziali incorrette, riprovare'
                        this.show_error = true
                    } else {
                        this.$store.dispatch('login', r.data.data)
                        if (r.data.data.user.isRetailer) {
                            let retailer_info = JSON.parse(r.data.data.user.retailers[0].info)
                            let retailer_address = r.data.data.user.retailers[0].address

                            if(!retailer_address || !retailer_info.phone || !retailer_info.email) {
                                this.$router.push(
                                    {
                                        path: `/publisher/${r.data.data.user.id}/retailer/${r.data.data.user.retailers[0].id}/wizard`,
                                        params: {
                                            publisher_id: r.data.data.user.id,
                                            retailer_id: r.data.data.user.retailers[0].id
                                        }
                                    }
                                );
                            } else {
                                this.$router.push(
                                    {
                                        path: `/publisher/${r.data.data.user.id}/retailer/${r.data.data.user.retailers[0].id}/orders`,
                                        params: {
                                            publisher_id: r.data.data.user.id,
                                            retailer_id: r.data.data.user.retailers[0].id
                                        }
                                    }
                                );
                            }
                        } else {
                            this.$store.dispatch('setRetailerSlug', this.slug)
                            this.$store.dispatch('setRetailerVat', this.retailer.vat)
                            this.$router.push({
                                name: "Retailer",
                                params: {
                                    slug: this.slug,
                                    vat: this.retailer.vat
                                }
                            });
                        }
                    }
                })
                .catch(e => {
                    this.error_msg = 'Credenziali incorrette, riprovare'
                    console.log(e)
                    this.show_error = true
                })
        },

        reset_password() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };

            axios
                .post(`/api/reset_password`, {
                    mail: this.recovery_email
                })
                .then(response => {
                    if (response.data.success) {
                        this.reset_message = 'Password resettata con successo'
                        this.reset_message_class = 'success'
                        this.show_reset_message = true
                    } else {
                        this.reset_message = response.data.message
                        this.reset_message_class = 'danger'
                        this.show_reset_message = true
                    }
                })
                .catch(e => {
                    this.reset_message = response.data.message
                    this.reset_message_class = 'danger'
                    this.show_reset_message = true
                })
        },

        async getRetailerBySlug() {
            await axios
                .get(`/api/retails/by-slug/${this.slug}`)
                .then( response => {
                    this.retailer = response.data.data
                    this.$store.dispatch('setRetailerSlug', response.data.data.slug)
                    this.$store.dispatch('setRetailerVat', response.data.data.vat)
                })
                .catch( e => {
                    this.reset_message = response.data.message
                    this.reset_message_class = 'danger'
                    this.show_reset_message = true
                })
        }
    }
};
</script>

<style scoped lang="scss">
.form-signin {
    margin-top: 100px;
    margin-bottom: 300px;
}
</style>
