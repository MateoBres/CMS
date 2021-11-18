<template>
    <div class="card shadow mb-5">
        <div class="card-body">
            <div class="col-12">
                <div class="row text-left">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="h5">
                                    <i class="fas fa-key mr-2"></i
                                    >Cambia Password
                                </label>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <label for="" class="h5">
                                    Vecchia Password/Codice Reset
                                </label>
                            </div>
                            <div class="col-4">
                                <label for="" class="h5">
                                    Nuova Password
                                </label>
                            </div>
                            <div class="col-4">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 form-group">
                                <input
                                    type="password"
                                    class="form-control"
                                    v-model="old_password"
                                />
                            </div>
                            <div class="col-4 form-group">
                                <input
                                    type="password"
                                    class="form-control"
                                    v-model="new_password"
                                />
                            </div>
                            <div class="col-4 form-group">
                                <button class="btn btn-success btn-block" @click.prevent="change_password()" :disabled="old_password == '' || new_password == ''">
                                    <i class="fas fa-check mr-2"></i>Conferma
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" v-if="show_alert">
                <div class="alert" :class="alert_class">
                    <p class="mx-auto my-auto">{{ message }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: [
            'user_id'
        ],
        data() {
            return {
                old_password: null,
                new_password: null,
                alert_class: null,
                show_alert: false,
                message: null
            }
        },
        methods: {
            change_password() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };
            axios
                .post(`/api/users/${this.user_id}/change_password`, {
                    old_password: this.old_password,
                    new_password: this.new_password
                }, config)
                .then(response => {
                    this.old_password = ''
                    this.new_password = ''
                    if(response.data.success) {
                        this.alert_class = 'alert-success'
                        this.message = 'Password modificata con successo'
                        this.show_alert = true
                    } else {
                        this.alert_class = 'alert-danger',
                        this.message = 'Si è verificato un errore, riprova'
                        this.show_alert = true
                    }
                })
                .catch(e => {
                    console.log(e)
                })
            }
        },
    }
</script>