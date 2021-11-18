<template>
    <div>
        <form v-on:submit.prevent="registerUser">
            <div class="form-group row mt-3">
                <label
                    for="name"
                    class="col-md-4 col-form-label text-md-right"
                    >{{ name_label }}</label
                >
                <div class="col-md-6">
                    <input
                        :id="typeOfRegistration + '_name'"
                        type="text"
                        class="form-control"
                        name="name"
                        v-model="name"
                        required
                        autocomplete="name"
                        autofocus
                    />
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right"
                    >la tua email</label
                >
                <div class="col-md-6">
                    <input
                        :id="typeOfRegistration + '_email'"
                        type="email"
                        class="form-control"
                        name="email"
                        v-model="email"
                        value=""
                        required
                        autocomplete="email"
                    />
                </div>
            </div>
            <div class="form-group row">
                <label
                    for="password"
                    class="col-md-4 col-form-label text-md-right"
                    >Scegli una password</label
                >

                <div class="col-md-6">
                    <input
                        :id="typeOfRegistration + '_password'"
                        type="password"
                        class="form-control"
                        name="password"
                        v-model="password"
                        required
                        autocomplete="new-password"
                    />
                </div>
            </div>
            <div class="form-group row">
                <label
                    for="password-confirm"
                    class="col-md-4 col-form-label text-md-right"
                    >Conferma la password</label
                >

                <div class="col-md-6">
                    <input
                        :id="typeOfRegistration + '_password_confirmation'"
                        type="password"
                        class="form-control"
                        name="password_confirmation"
                        v-model="password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                </div>
            </div>
            <div
                class="form-group row"
                v-if="typeOfRegistration == 'publisher'"
            >
                <label for="" class="col-md-4 col-form-label text-md-right"
                    >tipo di attivita'</label
                >
                <div class="col-md-6">
                    <select class="form-control" name="typeOfService" id="">
                        <option value="restaurant">Ristorante/Pizzeria</option>
                        <option value="restaurant">Bar/Pasticceria</option>
                        <option value="shop">Negozio Alimentari</option>
                        <option value="shop">Altro</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Registrati
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "registrationForm",
    props: ["type"],
    data() {
        return {
            typeOfRegistration: this.type,
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            name_label: null
        };
    },
    mounted() {
        console.log("mounted");
        this.fillNameLabel();
    },
    methods: {
        registerUser() {
            console.log("click");
        },
        fillNameLabel() {
            if (this.typeOfRegistration == "publisher") {
                this.name_label = "il nome del tuo negozio";
            } else {
                this.name_label = "il tuo nome";
            }
        }
    }
};
</script>

<style></style>
