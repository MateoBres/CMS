<template>
  <div>
      <form>
          <div class="row">
              <div class="col col-12 col-md-6">
                  <label for="">Nome:</label>
                  <input type="text" v-model="form.nome" class="form-control">
              </div>
              <div class="col col-12 col-md-6">
                  <label for="">Cognome:</label>
                  <input type="text" v-model="form.cognome" class="form-control">
              </div>
              <div class="col col-12 col-md-6">
                  <label for="">Telefono:</label>
                  <input type="text" v-model="form.phone" class="form-control">
              </div>
              <div class="col col-12 col-md-6">
                  <label for="">Email:</label>
                  <input type="text" v-model="form.email" class="form-control">
              </div>
              <div class="col col-12 col-md-12">
                  <label for="">Oggetto:</label>
                  <input type="text" v-model="form.oggetto" class="form-control">
              </div>
              <div class="col col-12">
                  <label for="">Descrizione:</label>
                  <textarea v-model="form.description" id="" rows="10" class="form-control"></textarea>
              </div>
              <div class="col col-12">
                  <button class="btn btn-primary btn-block mt-3" @click="send()">Invia</button>
              </div>
              <div class="col col-12">
                  <div class="alert alert-success text-center mt-3" v-show="show_alert" @click="show_alert = false">
                      Mail inviata
                  </div>
              </div>
          </div>
      </form>
  </div>
</template>

<script>
export default {
    name: 'Contatti',
    data () {
        return {
            form: {
                nome: null,
                cognome: null,
                email: null,
                phone: null,
                oggetto: null,
                description: null
            },
            show_alert: false
        }
    },
    methods: {
        send() {
            axios
                .post('/api/contacts', {
                    'data': this.form
                })
                .then(response => {
                    console.log('email sent')
                    this.form.nome = null,
                    this.form.cognome = null,
                    this.form.email = null,
                    this.form.oggetto = null,
                    this.form.description = null,

                    this.show_alert = true
                })
                .catch(e => {
                    console.log(e)
                })
        }
    }
}
</script>

<style scoped lang="scss">
$primary :#005c92;
$secondary:#f18500;
$background:#e9d7c3;
label {float: left;text-align: left;color: #ffffff !important;font-weight: bolder;}
/* .form-control {background-color: rgba(255,255,255,0.7)} */
.btn-primary {
    background-color: $secondary
}
</style>