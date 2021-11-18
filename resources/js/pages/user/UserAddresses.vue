<template>
    <div class="card shadow mb-5 border-0 overflow-hidden">
        <table class="table text-left" v-if="addresses != null">
            <thead class="table-borderless thead-light">
                <tr>
                    <th>Indirizzo</th>
                    <th>Campanello</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="address in addresses" :key="address.index" class="border-bottom">
                    <td class="align-middle">{{ address.address }}, {{ address.zip_code}} - {{ address.city }}, {{ address.province }}</td>
                    <td class="text-left align-middle">{{ address.name }}</td>
                    <td class="text-right align-middle">
                        <button class="btn btn-danger text-white mx-auto" @click="deleteAddress(address)">
                            <i class="fas fa-trash mr-2"></i>Elimina
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row p-3">
            <div class="col-12 text-left mt-3">
                <div class="row">
                    <div class="col-12">
                        <p class="h4 mb-3">Aggiungi Indirizzo</p>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Campanello</label>
                            <input class="form-control" type="text" v-model="new_address.name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Indirizzo</label>
                            <input class="form-control" type="text" v-model="new_address.address">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>CAP</label>
                            <input class="form-control" type="text" v-model="new_address.zip_code">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Città</label>
                            <input class="form-control" type="text" v-model="new_address.city">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Provincia</label>
                            <input class="form-control" type="text" v-model="new_address.province">
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button
                            class="btn btn-primary"
                            :disabled="!checkFields"
                            @click="storeAddress()"
                        >
                            <i class="fas fa-check mr-2"></i>Conferma
                        </button>
                    </div>
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
            addresses: null,
            user: null,
            new_address: {
                address:null,
                city:null,
                name:null,
                province:null,
                zip_code:null,
            }
        }
    },
    computed: {
        checkFields: function() {
            if(
                !this.new_address.address &&
                !this.new_address.city &&
                !this.new_address.name &&
                !this.new_address.province &&
                !this.new_address.zip_code
            ) {
                return false
            } else {
                return true
            }
        }
    },
    methods: {
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
                })
                .catch(errors => {
                    console.log(errors)
                });
        },
        deleteAddress(address) {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };
            axios
                .delete(`/api/addresses/${address.id}`, config)
                .then(response => {
                    this.getUser()
                })
                .catch()
        },
        storeAddress() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            }
            let data = {
                address: this.new_address.address,
                name: this.new_address.name,
                city: this.new_address.city,
                province: this.new_address.province,
                zip_code: this.new_address.zip_code,
                user_id: this.$route.params.user_id
            }
            axios
                .post(`/api/addresses/create`, data, config)
                .then(response => {
                    this.addresses.push(response.data.data)
                    this.resetFields()
                })
        },
        resetFields() {
            this.new_address.address = null
            this.new_address.name = null
            this.new_address.city = null
            this.new_address.province = null
            this.new_address.zip_code = null
        }
    },
    async mounted() {
        await this.getUser()
    }
}
</script>