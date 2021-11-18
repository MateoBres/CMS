<template>
    <div class="container">
        <div class="row">
            <div class="col col-12 col-md-4"></div>

            <div class="col col-12 col-md-4">
                <form class="form-signin" @submit.prevent="check_repeated">
                    <img
                        class="mb-4"
                        src="/images/logo-spesa-vicino-bianco-small.png"
                        alt=""
                        height=""
                    />
                    <h1 class="h3 mb-3 font-weight-normal">REGISTRATI</h1>
                    <div class="alert alert-danger" v-show="show_error">
                        {{ error_msg }}
                    </div>
                    <label for="inputName" class="sr-only">
                        Nome Utente
                        </label>
                    <input
                        type="text"
                        id="inputName"
                        class="form-control mb-3"
                        placeholder="Nome Utente"
                        required=""
                        autofocus=""
                        v-model="form.name"
                    />
                    <label for="inputEmail" class="sr-only"
                        >Indirizzo Email</label
                    >
                    <input
                        type="email"
                        id="inputEmail"
                        class="form-control mb-3"
                        placeholder="Indirizzo Email"
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
                    <label for="inputPassword" class="sr-only">Conferma Password</label>
                    <input
                        type="password"
                        id="inputPasswordConfirmation"
                        class="form-control mb-3"
                        placeholder="Conferma Password"
                        required=""
                        v-model="form.c_password"
                    />

                    <div class="form-check my-1">
                        <input id="privacy" type="checkbox" class="form-check-input" v-model="privacy">
                        <label class="form-check-label" for="privacy">
                            Dichiaro di aver letto e compreso le finalità e le modalità del <a href="" @click.prevent="$router.push({ name: 'Condizioni' })">trattamento dei dati personali</a>
                        </label>
                    </div>
                    <button
                        class="btn btn-lg btn-primary btn-block"
                        type="submit"
                    >
                        REGISTRATI
                    </button>
                    <router-link
                        :to="{ name: 'Login' }"
                        class="btn btn-lg btn-danger btn-block"
                        >ENTRA</router-link
                    >
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
    name: "Registrati",
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
                c_password: null
            },
            error_msg: '',
            show_error: false,
            privacy: false,
        };
    },
    methods: {
        createUser() {
            this.show_error = false
            // const response = await this.check_repeated();

            if(!this.privacy && !this.show_error) {
                this.error_msg = 'È necessario acconsentire al trattamento dei dati personali per procedere'
                this.show_error = true
            }

            if(!this.show_error && this.privacy) {
                if(this.checkPassword()) {
                    this.show_error = false,
                    axios
                        .post('/api/register/user', {
                            'name': this.form.name,
                            'email': this.form.email,
                            'password': this.form.password,
                            'c_password': this.form.c_password
                        })
                        .then(response => {
                            this.$store.commit('login', response.data.data)
                            /* this.$router.push('/login') */
                            this.$router.push({path: '/'});
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
        // async createUser() {
        //     this.show_error = false,
        //     await this.check_repeated

        //     if(!this.privacy && !this.show_error) {
        //         this.error_msg = "È necessario accnsentire al trattamento dei dati"
        //         this.show_error = true;
        //     } else {
        //         this.show_error = false,
        //         this.error_msg = null
        //     }

        //     if(!this.show_error && this.privacy) {
        //         if (this.checkPassword()) {
        //             this.show_error = false;
        //             let formData = new FormData();
        //             for (var [key, value] of Object.entries(this.form)) {
        //                 console.log(key, value);
        //                 formData.append(key, value);
        //             }
        //             //formData.append('formData', this.form);
        //             const response = await UserService.create(formData).then(r => {
        //                 localStorage.setItem("token", r.data.data.token);
        //                 localStorage.setItem("user-data", r.data.data.user);
        //                 localStorage.setItem("user-name", r.data.data.user.name);
        //                 localStorage.setItem("user-role-name", r.data.data.user.roles[0].name);
        //                 localStorage.setItem("user-id", r.data.data.user.id);
        //                 console.log('register', response)
        //                 this.flash("Registrazione Avvenuta con Successo", {
        //                     timeout: 3000
        //                 });
        //                 /* this.$router.push('/login') */
        //                 this.$router.push({name: 'Home'});
        //             });
        //         } else {}
        //     }
        // },
        checkPassword() {
            if (this.password === this.c_password) {
                return true;
            }
        },

        async check_repeated() {
            await axios
                .post('/api/check_repeated', {
                    'mail': this.form.email
                })
                .then(response => {
                    console.log(response);
                    if(!response.data.success) {
                        this.error_msg = response.data.message
                        this.show_error = true
                    } else {
                        this.show_error = false
                        this.error_msg = null
                        this.createUser()
                    }
                })
                .catch(e => {
                    console.log(e)
                })
        },
    }
};
</script>

<style scoped lang="scss">
.form-signin {
    margin-top: 100px;
    margin-bottom: 300px;
}
</style>
