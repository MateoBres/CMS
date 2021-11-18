<template>
    <div class="container" :style="{ 'min-height': h }" v-if="!loading">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="card shadow mb-5">
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-12">
                                <p class="h3">
                                    Metodi di pagamento
                                </p>
                                <p class="h5">
                                    Selezionare di seguito quali metodi di
                                    pagamento abililtare
                                </p>
                            </div>
                        </div>
                        <div
                            class="col-12 my-3"
                            v-if="
                                !payments.cash.checked &&
                                    !payments.card.checked &&
                                    !payments.transfer.checked
                            "
                        >
                            <div class="alert alert-danger text-center">
                                Attenzione: se nessuno dei metodi di pagamento è
                                abilitato, il negozio non sarà mostrato nei
                                risultati delle ricerche
                            </div>
                        </div>
                        <div class="col-12" v-if="!loading">
                            <div class="row my-3">
                                <div class="col-12 text-left my-auto">
                                    <div
                                        class="form-check form-check-inline my-auto"
                                    >
                                        <input
                                            class="form-check-input position-static my-auto"
                                            type="checkbox"
                                            value="true"
                                            v-model="payments.cash.checked"
                                        />
                                    </div>
                                    <label class="form-check-label h3"
                                        >Pagamento alla consegna</label
                                    >
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-12 text-left my-auto">
                                    <div
                                        class="form-check form-check-inline my-auto"
                                    >
                                        <input
                                            :disabled="!premium"
                                            class="form-check-input position-static my-auto"
                                            type="checkbox"
                                            value="true"
                                            v-model="payments.card.checked"
                                        />
                                    </div>
                                    <label class="form-check-label h3"
                                        >Pagamento con Carta di Credito</label
                                    >
                                    <div
                                        class="row justify-content-center my-3"
                                        v-if="!premium"
                                    >
                                        <div class="col-12">
                                            <div class="alert alert-info text-center">
                                                <p class="p-3 h4 d-block md-none">
                                                    Per poter usufruire dei pagamenti con carta di credito è necessario
                                                    passare alla Versione Premium di Spesavicino.it.

                                                    Per effettuare l'upgrade o per avere informazioni sulla Versione Avanzata,
                                                    <a href="#" @click="goToPage('VersioneAvanzata')">contatta l'assistenza di Spesavicino.it.</a>
                                                </p>
                                                <p class="p-3 h3 d-none md-block">
                                                    Per poter usufruire dei pagamenti con carta di credito è necessario
                                                    passare alla Versione Premium di Spesavicino.it.

                                                    Per effettuare l'upgrade o per avere informazioni sulla Versione Avanzata,
                                                    <a href="#" @click="goToPage('VersioneAvanzata')">contatta l'assistenza di Spesavicino.it.</a>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                    <div
                                        class="row justify-content-center my-3"
                                        v-if="payments.card.checked"
                                    >
                                        <div class="col-12">
                                            <div
                                                class="alert alert-warning text-center"
                                            >
                                                Attenzione, per poter abilitare
                                                i pagamenti con carta di credito
                                                è necessario registrare un
                                                account Stripe.<br />
                                                <div
                                                    class="row justify-content-center my-3"
                                                >
                                                    <a
                                                        class="btn btn-primary text-white mx-1"
                                                        href="https://dashboard.stripe.com"
                                                        target="_blank"
                                                    >
                                                        <i
                                                            class="fas fa-question-circle mr-2"
                                                        ></i
                                                        >Cos'è Stripe?
                                                    </a>
                                                    <a
                                                        class="btn btn-secondary text-white mx-1"
                                                        href="https://dashboard.stripe.com/register"
                                                        target="_blank"
                                                    >
                                                        <i
                                                            class="fas fa-external-link-alt mr-2"
                                                        ></i
                                                        >Crea un account su
                                                        Stripe
                                                    </a>
                                                </div>
                                                Una volta completata la
                                                registrazione, inserire nel
                                                campo sottostante le chiavi API
                                                di Stripe per completare
                                                l'abilitazione dei pagamenti
                                                online
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="row my-1">
                                                <div class="col-4">
                                                    <label class="my-1 mr-2"
                                                        >Chiave
                                                        Pubblicabile</label
                                                    >
                                                </div>
                                                <div class="col-8">
                                                    <input
                                                        type="text"
                                                        class="form-control w-100"
                                                        v-model="
                                                            payments.card
                                                                .stripe_key
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="row my-1">
                                                <div class="col-4">
                                                    <label class="my-1 mr-2"
                                                        >Chiave Segreta</label
                                                    >
                                                </div>
                                                <div class="col-8">
                                                    <input
                                                        type="text"
                                                        class="form-control w-100"
                                                        v-model="
                                                            payments.card
                                                                .stripe_secret_key
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-12 text-left my-auto">
                                    <div
                                        class="form-check form-check-inline my-auto"
                                    >
                                        <input
                                            class="form-check-input position-static my-auto"
                                            type="checkbox"
                                            value="true"
                                            v-model="payments.transfer.checked"
                                        />
                                    </div>
                                    <label class="form-check-label h3"
                                        >Pagamento con Bonifico</label
                                    >
                                    <div
                                        class="row justify-content-center my-3"
                                        v-if="payments.transfer.checked"
                                    >
                                        <div class="col-12">
                                            <div
                                                class="alert alert-warning text-center"
                                            >
                                                Attenzione, per poter abilitare
                                                i pagamenti con bonifico è
                                                necessario fornire il proprio
                                                codice IBAN nel campo
                                                sottostante.
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="row my-1">
                                                <div class="col-4">
                                                    <label class="my-1 mr-2"
                                                        >Codice IBAN</label
                                                    >
                                                </div>
                                                <div class="col-8">
                                                    <input
                                                        type="text"
                                                        class="form-control w-100"
                                                        v-model="
                                                            payments.transfer
                                                                .iban_code
                                                        "
                                                    />
                                                </div>
                                            </div>
                                            <div class="row my-1">
                                                <div class="col-4">
                                                    <label class="my-1 mr-2"
                                                        >Intestatario</label
                                                    >
                                                </div>
                                                <div class="col-8">
                                                    <input
                                                        type="text"
                                                        class="form-control w-100"
                                                        v-model="
                                                            payments.transfer
                                                                .name
                                                        "
                                                    />
                                                </div>
                                            </div>
                                            <div class="row my-1">
                                                <div class="col-4">
                                                    <label class="my-1 mr-2"
                                                        >Numero Conto</label
                                                    >
                                                </div>
                                                <div class="col-8">
                                                    <input
                                                        type="text"
                                                        class="form-control w-100"
                                                        v-model="
                                                            payments.transfer
                                                                .number
                                                        "
                                                    />
                                                </div>
                                            </div>
                                            <div class="row my-1">
                                                <div class="col-4">
                                                    <label class="my-1 mr-2"
                                                        >Banca</label
                                                    >
                                                </div>
                                                <div class="col-8">
                                                    <input
                                                        type="text"
                                                        class="form-control w-100"
                                                        v-model="
                                                            payments.transfer
                                                                .bank
                                                        "
                                                    />
                                                </div>
                                            </div>
                                            <div class="row my-1">
                                                <div class="col-4">
                                                    <label class="my-1 mr-2"
                                                        >Note</label
                                                    >
                                                </div>
                                                <div class="col-8">
                                                    <textarea
                                                        class="form-control w-100"
                                                        v-model="
                                                            payments.transfer
                                                                .notes
                                                        "
                                                        :placeholder="
                                                            notes_placeholder
                                                        "
                                                    ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5" v-if="show">
                                <div class="col-12">
                                    <div :class="alert_class">
                                        {{ alert_message }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <button
                            class="btn btn-block btn-warning p-2"
                            v-if="saving"
                        >
                            <span
                                class="spinner-border spinner-border-sm my-auto"
                                role="status"
                                aria-hidden="true"
                            ></span>
                        </button>
                        <button
                            class="btn btn-primary btn-block"
                            @click="save()"
                            v-else
                        >
                            <i class="fas fa-save mr-2"></i>Salva
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            loading: true,
            saving: false,
            show: false,
            alert_class: "",
            alert_message: "",
            notes_placeholder:
                "L'ordine sarà evaso al ricevimento del bonifico",

            retailer_info: null,
            payments: {
                cash: {
                    checked: null
                },
                card: {
                    checked: null,
                    stripe_key: null,
                    stripe_secret_key: null
                },
                transfer: {
                    checked: null,
                    iban_code: null,
                    name: null,
                    number: null,
                    bank: null,
                    notes: ""
                }
            },
            premium:false
        };
    },
    computed: {
        h: function() {
            return window.innerHeight - 369.67 + "px";
        }
    },
    async mounted() {
        const init = await this.getRetailerInfo();
        this.loading = false;
    },
    methods: {
        getRetailerInfo() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };
            axios
                .get(`/api/retails/${this.$route.params.retailer_id}`, config)
                .then(response => {
                    this.retailer_info = JSON.parse(response.data.data.info);
                    this.payments = this.retailer_info.payments;
                })
                .catch(e => {
                    console.log(e);
                });
            axios
                .get(`/api/retails/${this.$route.params.retailer_id}/is_premium`, config)
                .then(response => {
                    this.premium = response.data
                })
        },
        save() {
            this.saving = true;
            if (this.payments.transfer.notes == "") {
                this.payments.transfer.notes = this.notes_placeholder;
            }
            this.retailer_info.payments = this.payments;
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };
            axios
                .put(
                    `/api/retails/${this.$route.params.retailer_id}`,
                    {
                        info: JSON.stringify(this.retailer_info)
                    },
                    config
                )
                .then(response => {
                    console.log(response);
                    (this.alert_class = "alert alert-success"),
                        (this.alert_message =
                            "Informazioni salvate con successo");
                    (this.saving = false), (this.show = true);
                })
                .catch(e => {
                    (this.alert_class = "alert alert-danger"),
                        (this.alert_message =
                            "Qualcosa è andato storto, riprovare più tardi");
                    (this.saving = false), (this.show = true), console.log(e);
                });
        },
        goToPage(component) {
            this.$router.push({ name: component });
        }
    }
};
</script>
