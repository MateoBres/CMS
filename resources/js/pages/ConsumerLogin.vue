<template>
    <div class="container py-5 mt-5" style="min-height:80vh">
        <div class="col-12 d-flex flex-row">
            <div class="row justify-content-start">
                <a class="btn btn-primary text-white mt-2" @click="$router.go(-1)">
                    <i class="fas fa-chevron-circle-left mr-2"></i>
                    Torna alla pagina precedente
                </a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-xs-12 col-lg-12 mb-3">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger" v-show="show_error">
                            {{ error_msg }}
                        </div>
                        <div class="alert alert-success" v-show="success_message">
                            Registrazione realizzata con successo. Nella sezione Profilo potrai aggiungere altri dati.
                        </div>
                    </div>
                    <div class="col-12">
                        <!-- login/register -->
                        <div class="card shadow mb-3">
                            <div class="card-body">
                                <!-- login -->
                                <div class="col-12">
                                    <div class="row justify-content-center" v-show="!show_register">
                                        <div class="col-xs-10 col-md-8 form-group text-left">
                                            <label for="" class="h5">Email</label>
                                            <input type="email" class="form-control" v-model="email">
                                        </div>
                                        <div class="col-xs-10 col-md-8 form-group text-left">
                                            <label for="" class="h5">Password</label>
                                            <input type="password" class="form-control" v-model="password">
                                        </div>
                                        <div class="col-xs-10 col-md-8">
                                            <button class="btn btn-block btn-primary" @click="login()">
                                                Accedi
                                            </button>
                                        </div>
                                        <div class="col-xs-10 col-md-8 mt-2">
                                            <p>se non sei ancora registrato, clicca sul bottone qui sotto per registrarti</p>
                                        </div>
                                        <div class="col-xs-10 col-md-8">
                                            <button class="btn btn-block btn-secondary text-white" @click="show_register = true">
                                                Registrati
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- registrazione -->
                                <div class="col-12" v-show="show_register && !success_message">
                                    <div class="row justify-content-center">
                                        <div class="col-xs-10 col-md-8 form-group text-left">
                                            <label for="" class="h5">Nome</label>
                                            <input type="text" class="form-control" v-model="name">
                                        </div>
                                        <div class="col-xs-10 col-md-8 form-group text-left">
                                            <label for="" class="h5">Email</label>
                                            <input type="email" class="form-control" v-model="email">
                                        </div>
                                        <div class="col-xs-10 col-md-8 form-group text-left">
                                            <label for="" class="h5">Password</label>
                                            <input type="password" class="form-control" v-model="password">
                                        </div>
                                        <div class="col-xs-10 col-md-8 form-group text-left">
                                            <label for="" class="h5">Conferma Password</label>
                                            <input type="password" class="form-control" v-model="password_confirmation">
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="privacy" class="form-check-input" required v-model="privacy">
                                            <label id="privacy" class="form-check-label" for="privacy">
                                                Dichiaro di aver letto e compreso le finalità e le modalità del <a href="/Condizioni" target="_blank">trattamento dei dati personali</a>
                                            </label>
                                        </div>
                                        <div class="col-xs-10 col-md-8">
                                            <button class="btn btn-block btn-primary" @click="register()">
                                                Registrati
                                            </button>
                                        </div>
                                        <div class="col-xs-10 col-md-8 mt-2">
                                            <p>se sei già un utente registrato, clicca sul bottone qui sotto per accedere</p>
                                        </div>
                                        <div class="col-xs-10 col-md-8">
                                            <button class="btn btn-block btn-secondary text-white" @click="show_register = false">
                                                Accedi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { eventBus } from "../app";
import TestPayment from "../pages/TestPayment";
import moment from 'moment';
import { mapState } from 'vuex'

export default {
    props: ["retailer_id"],
    components: {
        "payment": TestPayment
    },
    data() {
        return {
            success_message: false,
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            user_id: null,
            user: null,
            bearer_token: null,
            show_register: false,

            show_error: false,
            error_msg: null,
            privacy: false,

            retailer_info: null,
            retailer: null,

            userAddress: '',
            address_id: null,
            address: {
                'name': '',
                'address': '',
                'zip_code': '',
                'city': '',
                'province': '',
            },

            phone: null
        }
    },
    computed: {
        newAddress: function() {
            this.old_address=false
            this.address.name=""
            this.address.zip_code=""
            this.address.city=""
            this.address.province=""
        },
        h: function() {
            return (window.innerHeight - 383.2) + 'px'
        },

        userId: function() {
            return this.$store.getters.userId
        },

        token: function() {
            return this.$store.getters.token
        },
    },
    methods: {
        logout() {
            this.$store.dispatch('logout')
        },
        checkPassword() {
            if (this.password === this.password_confirmation) {
                return true;
            }
        },
        async check_repeated() {
            await axios
                .post('/api/check_repeated', {
                    'mail': this.email
                })
                .then(response => {
                    if(!response.data.success) {
                        this.error_msg = response.data.message
                        this.show_error = true
                    } else {
                        this.show_error = false
                        this.error_msg = null
                    }
                })
                .catch(e => {
                    console.log(e)
                })
        },
        login() {
            this.show_error = false
            let headers = {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
            let data = {
                email: this.email,
                password: this.password
            }
            if(!this.show_error) {
                axios
                    .post('/api/login', data, headers)
                    .then(response => {
                        this.user = response.data.data.user
                        this.user_id = response.data.data.user.id
                        this.bearer_token = response.data.data.token
                        this.$store.dispatch('login', response.data.data)
                        history.back()
                    })
                    .catch(e => {
                        this.error_msg = 'Credenziali incorrette, riprovare'
                        this.show_error = true
                        console.log(e)
                    })
            }
        },
        async register() {
            this.show_error = false
            await this.check_repeated();

            if(!this.privacy && !this.show_error) {
                this.error_msg = 'È necessario acconsentire al trattamento dei dati personali per procedere'
                this.show_error = true
            }

            if(!this.show_error && this.privacy) {
                if(this.checkPassword()) {
                    this.show_error = false,
                    axios
                        .post('/api/register/user', {
                            'name': this.name,
                            'email': this.email,
                            'password': this.password,
                            'c_password': this.password_confirmation
                        })
                        .then(response => {
                            this.user = response.data.data.user
                            this.user_id = response.data.data.user.id
                            this.bearer_token = response.data.data.token
                            this.$store.dispatch('login', response.data.data)
                            this.success_message = true
                        })
                        .catch(e => {
                            console.log(e)
                        })
                } else {
                    this.error_msg = 'Le password non coincidono, riprovare',
                    this.show_error = true
                }
            }
        },
        async getUser() {
            // let userId = this.$store.getters.userId;
            let userId = this.userId;
            let token = this.$store.getters.token;

            if(userId && token) {
                let config = {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                };

                await axios
                    .get(`/api/users/${userId}`, config)
                    .then(response => {
                        this.user = response.data.data
                        this.user_id = response.data.data.id
                        console.log('*****user****', this.user)
                    })
                    .catch(e => {
                        console.log(e)
                    })
            }
        },
        async getRetailer() {
            await axios
                .get(`/api/retails/${this.retailer_id}`)
                .then(response => {
                    this.retailer_info = JSON.parse(response.data.data.info);
                    this.retailer = response.data.data;
                    this.$store.dispatch('setRetailerSlug', response.data.data.slug)
                    this.$store.dispatch('setRetailerVat', response.data.data.vat)
                    console.log('*******retailer:', this.retailer)
                })
                .catch(e => {
                    console.log(e)
                })
        },
        initAddresses() {
            if(this.user && this.user.addresses && this.user.addresses.length > 0) {
                this.address = this.user.addresses[0];
                this.userAddress = 'old'
            } else {
                this.UserAddress = 'new'
            }
        },
        async saveAddress() {
            if(this.check_fields()) {
                if (this.order_type == 'takeaway') {
                    this.confirmOrder()
                } else {
                    let address_data = {
                        'name': this.address.name,
                        'city': this.address.city,
                        'address': this.address.address,
                        'province': this.address.province,
                        'zip_code': this.address.zip_code,
                        'user_id': this.user_id,
                    }

                    let config = {
                        headers: {
                            Authorization: `Bearer ${this.bearer_token}`
                        }
                    };

                    if (this.userAddress == 'new') {
                        await axios
                            .post('/api/addresses/create', address_data, config)
                            .then(response => {
                                this.address_id = response.data.data.id;
                                this.confirmOrder()
                            })
                            .catch(e => {
                                console.log(e)
                            })
                    } else {
                        await axios
                            .put(`/api/addresses/${this.address.id}`, address_data, config)
                            .then(response => {
                                console.log(response)
                                this.address_id = response.data.data.id
                                this.confirmOrder()
                            })
                            .catch(e => {
                                console.log(e)
                            })
                    }
                }
            }
        },
        check_fields() {
            if(this.order_type == 'takeaway') {
                if(this.selected_date == null || this.selected_timeslot == null || this.phone == null) {
                    this.error_msg = 'Compilare tutti i campi per procedere'
                    this.show_error = true
                    console.log('return false', ['takeaway', this.selected_date, this.selected_timeslot, this.phone])
                    return false
                } else {
                    this.show_error = false
                    this.error_msg = null
                    console.log('return true', ['takeaway', this.selected_date, this.selected_timeslot, this.phone])
                    return true
                }
            } else if(this.order_type == 'delivery') {
                if(this.selected_date == null || this.selected_timeslot == null || this.phone == null || this.address.name == '' || this.address.city == '' || this.address.address == '' || this.address.province == '' || this.address.zip_code == '') {
                    this.error_msg = 'Compilare tutti i campi per procedere'
                    this.show_error = true
                    console.log('return false', ['delivery', this.selected_date, this.selected_timeslot, this.phone])
                    return false
                } else {
                    this.show_error = false
                    this.error_msg = null
                    console.log('return true', ['delivery', this.selected_date, this.selected_timeslot, this.phone, this.address.name, this.address.city, this.address.address, this.address.province, this.address.zip_code])
                    return true
                }
            } else {
                if(this.phone == null || this.address.name == '' || this.address.city == '' || this.address.address == '' || this.address.province == '' || this.address.zip_code == '') {
                    this.error_msg = 'Compilare tutti i campi per procedere'
                    this.show_error = true
                    console.log('return false', ['shipment', this.shipment_type.name, this.phone])
                    return false
                } else {
                    this.show_error = false
                    this.error_msg = null
                    console.log('return true', ['shipment', this.shipment_type.name, this.phone, this.address.name, this.address.city, this.address.address, this.address.province, this.address.zip_code])
                    return true
                }
            }
        },
    }
}
</script>
