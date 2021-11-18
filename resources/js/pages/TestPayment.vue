<template>
    <!-- <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-10"> -->
                                <form class="w-100 d-flex flex-column align-items-center">
                                    <div ref="card" class="form-control my-auto"></div>
                                    <button class="btn btn-warning btn-block mt-3" :disabled="lockSubmit" v-if="loading && !success && !error">
                                        <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Elaborando
                                    </button>
                                    <button class="btn btn-success btn-block mt-3" :disabled="lockSubmit" v-if="success && !loading && !error" @click="returnHome()">
                                        <i class="fas fa-check mr-2"></i>Pagamento effettuato con successo
                                    </button>
                                    <button class="btn btn-primary btn-block mt-3" type="submit" v-on:click.prevent="purchase" :disabled="lockSubmit" v-if="!loading && !success">
                                        <i class="fas fa-money mr-2"></i>Procedi con il pagamento
                                    </button>
                                    <button class="btn btn-danger btn-block mt-3" disabled v-if="error && !loading && !success">
                                        <i class="fas fa-times mr-2"></i>{{ error_msg }}
                                    </button>
                                </form>
                            <!-- </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</template>

<script>

// let stripe = Stripe(`pk_test_8VujsPss74u3aUCtnbyajRSv00X9lnqUtq`),
//     elements = stripe.elements(),
//     card = undefined;
import { eventBus } from '../app'
export default {
    props: [
        'amountProp',
        'msgProp',
        'pkProp',
        'skProp'
    ],
    mounted: function () {
        var self = this;
        self.stripe = Stripe(self.pkProp, {
            locale: 'it'
        });
        self.card = self.stripe.elements().create('card', {
            hidePostalCode: true,
        });
        self.card.mount(self.$refs.card);
    },
    data () {
        return {
            // spk:"pk_test_8VujsPss74u3aUCtnbyajRSv00X9lnqUtq",
            stripe:undefined,
            card:undefined,
            msg: this.msgProp,
            amount: this.amountProp,
            lockSubmit: false,
            token:'',
            api:"https://yourdomain.com/api/",

            success: false,
            error: false,
            loading: false,
            error_msg: '',
        }
    },
    methods: {
        purchase() {
            var self = this;
            self.lockSubmit = true
            self.error = false
            self.success = false
            self.loading = true

            self.stripe.createToken(self.card)
            .then(function(result) {
                if (result.error) {
                    // alert(result.error.message)
                    // self.$forceUpdate(); // Forcing the DOM to update so the Stripe Element can update.
                    self.success = false,
                    self.loading = false,
                    self.error = true,
                    self.lockSubmit=false
                    return;
                }
                else{
                    self.token = result.token.id,
                    // self.processTransaction(result.token.id)

                    axios
                        .post('/api/test/pay', {
                            'source': result.token.id,
                            'amount': self.amount,
                            'currency': 'EUR',
                            'description': self.msg,
                            'stripe_sk': self.skProp,
                            'stripe_pk': self.pkProp
                        })
                        .then(response => {
                            if (response.data.success) {
                                console.log(response)
                                self.loading = false,
                                self.error = false,
                                self.success = true,
                                self.lockSubmit = false
                                eventBus.$emit('payment-successful')
                            } else {
                                // alert(response.description),
                                self.error_msg = response.data.description
                                self.loading = false,
                                self.success = false,
                                self.error = true,
                                self.lockSubmit = false
                            }
                        })
                }
            })
            .catch((err) => {
                alert("error1: "+err.message)
                this.lockSubmit=false
            });
        },
        returnHome() {
            this.$router.push({ name: "Home"})
        }
        // processTransaction(transactionToken){
        //     // var self=this;
        //     dt= {
        //         amount:this.stripCurrency(this.payAmount), //stripe uses an int [with shifted decimal place] so we must convert our payment amount
        //         currency:"USD",
        //         description:"something to say",
        //         token:transactionToken
        //     }
        //     var route=this.api+"/charge/card"
        //     this.$http.post(route,dt, {
        //         headers: {
        //         }
        //     }).then(response => {
        //         if(response.status==200){
        //             alert("Transaction succeeded")
        //             this.lockSubmit=false
        //         }
        //         else{
        //             throw new Error("failed donation")
        //         }
        //     }).catch((err) => {
        //         alert("error: "+err.message)
        //         this.lockSubmit=false
        //     });
        // },
        // stripCurrency(val){
        //     return val.replace(',','').relpace('$','').replace('.','')
        // }
    }
};
</script>