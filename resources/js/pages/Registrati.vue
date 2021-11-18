<template>
    <div class="container">
        <div class="row">
            <div class="col col-12 col-md-3"></div>
            <div class="col col-12 col-md-6">
                <form
                    action=""
                    class="form-signup"
                    @submit.prevent="createUser"
                >
                    <h4 class="text-center">REGISTRATI</h4>
                    <div class="row box-credenziali">
                        <div class="col col-12 col-md-12">
                            <label for="">Username:</label>
                            <input
                                type="text"
                                v-model="form.name"
                                placeholder="Username"
                                class="form-control"
                                required
                            />
                        </div>
                        <div class="col col-12 col-md-12">
                            <label for="">email:</label>
                            <input
                                type="text"
                                v-model="form.email"
                                placeholder="email"
                                class="form-control"
                                required
                            />
                        </div>
                        <div class="col col-12 col-md-12">
                            <label for="">Password:</label>
                            <input
                                type="text"
                                v-model="form.password"
                                placeholder="Password"
                                class="form-control"
                                required
                            />
                        </div>
                        <div class="col col-12 col-md-12">
                            <label for="">Verifica Password:</label>
                            <input
                                type="text"
                                v-model="form.c_password"
                                placeholder="Verifica Password"
                                class="form-control"
                                required
                            />
                        </div>
                    </div>

                    <!-- /box row -->

                    <!--div class="row box-anagrafiche">
                      <div class="col col-12 col-md-6">
                          <label for="">Nome:</label>
                          <input type="text" v-model="form.nome" class="form-control">
                      </div>
                      <div class="col col-12 col-md-6">
                          <label for="">Cognome:</label>
                          <input type="text" v-model="form.cognome" class="form-control">
                      </div>

                      <div class="col col-12 col-md-6">
                          <label for="">email:</label>
                          <input type="text" v-model="form.email" class="form-control">
                      </div>
                      <div class="col col-12 col-md-6">
                          <label for="">Telefono:</label>
                          <input type="text" v-model="form.telefono" class="form-control">
                      </div>

                      <div class="col col-12 col-md-10">
                          <label for="">Indirizzo:</label>
                          <input type="text" v-model="form.indirizzo" class="form-control">
                      </div>
                      <div class="col col-12 col-md-2">
                          <label for="">Civico:</label>
                          <input type="text" v-model="form.civico" class="form-control">
                      </div>

                      <div class="col col-12 col-md-4">
                          <label for="">Cap:</label>
                          <input type="text" v-model="form.cap" class="form-control">
                      </div>
                      <div class="col col-12 col-md-8">
                          <label for="">Citta:</label>
                          <input type="text" v-model="form.citta" class="form-control">
                      </div>

                  </div--><!-- /row box anagrafiche -->

                    <button class="btn btn-primary">SALVA</button>
                </form>
            </div>
        </div>
        <div class="col col-12 col-md-3"></div>
    </div>
</template>

<script>
import UserService from "../services/UserService";

export default {
    name: "Registrati",
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
                c_password: null
            }
        };
    },
    methods: {
        async createUser() {
            if (checkPassword()) {
                let formData = new FormData();
                for (var [key, value] of Object.entries(this.form)) {
                    console.log(key, value);
                    formData.append(key, value);
                }
                //formData.append('formData', this.form);
                const response = await UserService.create(formData).then(r => {
                    console.log('register', response)
                    /* this.$router.push('/login') */
                    /* this.$router.push(""); */
                });
            } else {
            }
        },
        checkPassword() {
            if (this.password === this.c_password) {
                return true;
            }
        }
    }
};
</script>

<style scoped>
/* .form-signup {
    padding-top: 100px;
    padding-bottom: 300px;
}

.box-credenziali {
    text-align: left;
    padding: 20px;
    box-shadow: 0px 0px 15px 2px #000000;
    margin-bottom: 50px;
}

.box-anagrafiche {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    text-align: left;
    box-shadow: 0px 0px 15px 2px #000000;
    margin-bottom: 50px;
} */
</style>
