<template>
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col col-12 col-md-12">
                <form @submit.prevent="registerRetailer()" class="form-signup">
                    <!-- {{form.info}} -->
                    <div class="card shadow p-4 box-anagrafiche">
                        <div class="col-12">
                            <div class="row justify-content-center">
                                <h1>REGISTRA LA TUA AZIENDA</h1>
                            </div>
                        </div>

                        <div class="col-12">
                            <div
                                class="alert alert-danger text-center my-3"
                                role="alert"
                            >
                                <span class="important-msg">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <strong>Attenzione:</strong><br>
                                    una volta
                                    completata questa fase di registrazione, avrai
                                    la possibilità di associare<br>un indirizzo mail
                                    specifico per il tuo negozio
                                </span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row my-3">
                                <div class="col-xs-12 col-md-6">
                                    <label for="">Il Tuo Nome*</label>
                                    <input
                                        type="text"
                                        v-model="username"
                                        class="form-control"
                                        required
                                    />
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="">La Tua Email*</label>
                                    <input
                                        type="email"
                                        v-model="email"
                                        class="form-control"
                                        required
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row my-3">
                                <div class="col-xs-12 col-md-6">
                                    <label for="">Password*</label>
                                    <input
                                        type="password"
                                        v-model="password"
                                        class="form-control"
                                        required
                                    />
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="">Conferma Password*</label>
                                    <input
                                        type="password"
                                        v-model="password_confirmation"
                                        class="form-control"
                                        required
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row my-3">
                                <div class="col-xs-12 col-md-6">
                                    <label for=""
                                        >Nome Azienda* (Scrivi l'insegna del tuo
                                        Negozio, non la ragione
                                        sociale!):</label
                                    >
                                    <input
                                        type="text"
                                        v-model="name"
                                        class="form-control"
                                        required
                                    />
                                    <small
                                        id="helpId"
                                        class="form-text text-muted"
                                        >Attenzione, non sara' possibile in
                                        futuro modificare questo dato</small
                                    >
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for=""
                                        >Partita IVA*( deve essere di 11
                                        caratteri ):</label
                                    >
                                    <input
                                        type="text"
                                        v-model="vat"
                                        class="form-control"
                                        required
                                    />
                                    <small
                                        id="helpId"
                                        class="form-text text-muted"
                                        >Attenzione, non sara' possibile in
                                        futuro modificare questo dato</small
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check my-1">
                                <input id="privacy" type="checkbox" class="form-check-input" v-model="privacy">
                                <label class="form-check-label" for="privacy">
                                    Dichiaro di aver letto e compreso le finalità e le modalità del <a href="" @click.prevent="$router.push({ name: 'Condizioni' })">trattamento dei dati personali</a>
                                </label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div
                                class="alert text-center my-3"
                                :class="this.a_class"
                                v-show="a_class && a_message"
                            >
                                {{ a_message }}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row justify-content-center my-4">
                                <div class="col-xs-12 col-md-6">
                                    <button
                                        class="btn btn-block btn-primary"
                                        v-if="loading"
                                    >
                                        ELABORANDO..&nbsp;<span
                                            class="spinner-border spinner-border-sm text-white mx-2"
                                            role="status"
                                            aria-hidden="true"
                                        ></span>
                                    </button>
                                    <button
                                        class="btn btn-block btn-primary"
                                        v-else
                                    >
                                        REGISTRA LA TUA AZIENDA&nbsp;<i
                                            class="fa fa-check mx-2"
                                            aria-hidden="true"
                                        ></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /row box anagrafiche -->
                </form>

            </div>
        </div>
    </div>
</template>

<script>
import RetailerService from "../services/RetailerService";
// import CategoryForm from './publisher/CategoriesSignUp';


export default {
    name: "RegistraAzienda",
    // components: {
    //     CategoryForm
    // },
    data() {
        return {
            token: localStorage.getItem("token"),

            username: null,
            email: null,
            password: null,
            password_confirmation: null,

            name: null,
            vat: null,
            privacy: false,

            a_message: null,
            a_class: null,
            loading: false,

            // listCategorie:[],
            // allowAddCategory: true

        };
    },
    methods: {
        async registerNewStore() {
            console.log('here')
            await axios
                .post('/api/register/new-retailer', {
                    'username': this.username,
                    'email': this.email,
                    'password': this.password,
                    'password_confirmation': this.password_confirmation,
                    'name': this.name,
                    'vat': this.vat
                })
                .then(response => {
                    console.log('setRegistrationData-frontend', response)
                    this.$store.dispatch('setRegistrationData', response.data.data)
                })
        },
        async registerRetailer() {
                this.loading = true;
                let vat_is_ok = this.controllaPartitaIVA(this.vat);
                if(this.privacy) {
                    if (vat_is_ok == "OK") {
                        if (this.checkPassword()) {
                            await axios
                            .post('/api/check_repeated', {
                                'mail': this.email,
                                'vat': this.vat
                            })
                            .then(response => {
                                if(!response.data.success) {
                                    this.a_message = response.data.message,
                                    this.a_class = "alert-danger",
                                    this.loading = false
                                } else {
                                    this.a_message = null,
                                    this.a_class = null
                                }
                            })
                            .catch(e => {
                                console.log(e)
                            })

                            if(!this.a_class && !this.a_message) {
                                axios
                                    .post("/api/register/publisher", {
                                        name: this.username,
                                        email: this.email,
                                        password: this.password,
                                        c_password: this.password_confirmation
                                    })
                                    .then(response => {
                                        let token = response.data.data.token;
                                        let user_id = response.data.data.user.id;

                                        let config = {
                                            headers: {
                                                Authorization: `Bearer ${token}`
                                            }
                                        };

                                        let params = {
                                            name: this.name,
                                            vat: this.vat
                                        };

                                        axios
                                            .post("/api/retails/create", params, config)
                                            .then(response => {
                                                this.a_message =
                                                    "il tuo negozio e' stato registrato con successo, fai click sul pulsante login per accedere alla tua pagina riservata";
                                                this.a_class = "alert-success";
                                                this.loading = false;
                                                var retailer_id = response.data.data.id;

                                                console.log("retailer ID", retailer_id);
                                                console.log(response);
                                                console.log("retailer", response.data.data);
                                                // console.log("lista", this.listCategorie);

                                                // this.listCategorie.map(item => {
                                                //     console.log("item category", item);
                                                //     this.addCategory(retailer_id, item, token);
                                                // });

                                                this.login()
                                            })
                                            .catch(e => {
                                                console.log(e);
                                            });
                                    })
                                    .catch(e => {
                                        this.a_message = "Qualcosa è andato storto..";
                                        this.a_class = "alert-danger";
                                        this.loading = false;
                                        console.log(e);
                                    });
                            }
                        } else {
                            this.a_message =
                                "Sembra che le password non coincidano...";
                            this.a_class = "alert-danger";
                            this.loading = false;
                        }
                    } else {
                        this.a_message = vat_is_ok;
                        this.a_class = "alert-danger";
                        this.loading = false;
                    }
                } else {
                    this.a_message = "È necessario acconsentire al trattamento dei dati personali per procedere"
                    this.a_class = "alert-danger";
                    this.loading = false;
                }
            // }
        },
        checkPassword() {
            if (this.password === this.password_confirmation) {
                return true;
            }
        },
        controllaPartitaIVA(pi) {
            if (pi == "") return "Non hai inserito alcun valore";
            else if (!/^[0-9]{11}$/.test(pi))
                return "La partita IVA deve contenere 11 cifre.";
            else return "OK";
        },
        // createCategoryList(value) {
        //     if (this.listCategorie.length > 2) {
        //         //alert("Hai raggiunto il limite massimo di categorie consentite!");
        //         this.allowAddCategory = false;
        //     } else {
        //         this.listCategorie.push(value);
        //         this.allowAddCategory = true;
        //     }
        // },
        // async addCategory (retailer_id, category_id, token) {
        //     const config = {
        //         headers: { Authorization: `Bearer ${token}` }
        //     };
        //     await axios
        //         .post(
        //             `/api/retails/${retailer_id}/categories/add_category`,
        //             { category: category_id },
        //             config
        //         )
        //         .then(res => {
        //             console.log("ctegorie:", res.data);
        //         })
        //         .catch(errors => {
        //             console.log("categorie:", errors);
        //         });
        // },
        // removeCategory(index) {
        //     this.listCategorie.splice(index, 1);
        //     if (this.listCategorie.length < 3) {
        //         //alert("Hai raggiunto il limite massimo di categorie consentite!");
        //         this.allowAddCategory = true;
        //     }
        // },
        async login() {
            let formData = new FormData()
            // for (var [key, value] of Object.entries(this.form)) {
            //     console.log(key, value);
            //     formData.append(key, value);
            // }

            await axios
                .post('/api/login', {
                    'email': this.email,
                    'password': this.password
                }, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    }
                })
                .then(r => {
                    console.log('here')
                    this.$store.dispatch('login', r.data.data)
                    if(!r.data.success) {
                        this.error_msg = 'Credenziali incorrette, riprovare'
                        this.show_error = true
                    } else {
                        this.show_error = false
                        this.$store.dispatch('login', r.data.data)
                        localStorage.setItem("token", r.data.data.token);
                        localStorage.setItem("user-data", r.data.data.user);
                        localStorage.setItem("user-name", r.data.data.user.name);
                        localStorage.setItem("user-role-name",r.data.data.user.roles[0].name);
                        localStorage.setItem("user-id", r.data.data.user.id);
                        if(r.data.data.user.retailers[0]) {
                            console.log('if retailers[0]')
                            localStorage.setItem(
                                "retailer-id",
                                r.data.data.user.retailers[0].id
                            );
                            localStorage.setItem(
                                "retailer-vat",
                                r.data.data.user.retailers[0].vat
                            );
                            if(r.data.data.user.retailers[0] && r.data.data.user.retailers[0].address) {
                                console.log('retailers length && address.length')
                                localStorage.setItem(
                                    "retailer-address-id",
                                    r.data.data.user.retailers[0].address.id
                                );
                            }
                        }
                        if (r.data.data.user.roles[0].name === "publisher") {
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
                            this.$router.push({ name: "Home" });
                        }
                    }
                })
                .catch(e => {
                    this.error_msg = 'Credenziali incorrette, riprovare'
                    this.show_error = true
                })
        },
    }
};
</script>

<style scoped>
.form-signup {
    padding-top: 100px;
    padding-bottom: 300px;
}

.box-credenziali {
    background-color: #cacaca;
    padding: 30px;
    border-radius: 10px;
    text-align: left;
    box-shadow: 0px 0px 15px 2px #000000;
    margin-bottom: 50px;
}

.box-anagrafiche {
    background-color: #fff;
    /* padding: 30px; */
    border-radius: 0px;
    padding-left: 5px;
    text-align: left;
    /* box-shadow: 0px 0px 15px 2px #000000; */
    /* margin-bottom: 50px; */
}

.main-badge {margin: 5px;font-size: 11pt;border-radius:10px;}

.important-msg {font-size: 14pt;color: black;}
</style>
