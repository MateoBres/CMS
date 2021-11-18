<template>
    <div class="container">
        <section class="row">
            <div class="col-12">
                <div :class="main_message.message_class" role="alert">
                    {{ main_message.text }}
                </div>
            </div>

        </section>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <!-- card con dati generali -->
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <!-- indirizzo -->
                                <div class="row text-left">
                                    <div class="col-xs-12 col-md-6 form-group">
                                        <label for="" class="h5">
                                            <i
                                                class="fas fa-map-marker-alt mr-2"
                                            ></i
                                            >Indirizzo*</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="retailer_address"
                                            required
                                        />
                                    </div>
                                    <div class="col-xs-12 col-md-6 form-group">
                                        <label for="" class="h5">CAP*</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="retailer_zip_code"
                                            required
                                        />
                                    </div>
                                    <div class="col-xs-12 col-md-6 form-group">
                                        <label for="" class="h5">
                                            <i class="fas fa-city mr-2"></i
                                            >Città*</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="retailer_city"
                                            required
                                        />
                                    </div>
                                    <div class="col-xs-12 col-md-6 form-group">
                                        <label for="" class="h5"
                                            >Provincia*</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="retailer_province"
                                            required
                                        />
                                    </div>
                                </div>

                                <!-- recapiti -->
                                <div class="row text-left">
                                    <div class="col-xs-12 col-md-6 form-group">
                                        <label for="" class="h5">
                                            <i class="far fa-envelope mr-2"></i
                                            >Email*
                                        </label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            v-model="info.email"
                                            required
                                        />
                                    </div>
                                    <div class="col-xs-12 col-md-6 form-group">
                                        <label for="" class="h5">
                                            <i class="fa fa-phone-alt mr-2"></i
                                            >Telefono*
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="info.phone"
                                            required
                                        />
                                    </div>
                                </div>

                                <!-- descrizione -->
                                <div class="row text-left mb-3">
                                    <div class="col-xs-12 col-md-12">
                                        <label class="h5">
                                            <i class="fas fa-edit mr-2"></i
                                            >Descrizione
                                        </label>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <textarea
                                            class="form-control"
                                            v-model="info.description"
                                        ></textarea>
                                    </div>
                                </div>

                                <!-- sito web -->
                                <div class="row text-left mb-3">
                                    <div class="col-xs-12 col-md-12 form-group">
                                        <label for="" class="h5">
                                            <i class="fa fa-globe mr-2"></i>Sito
                                            Web
                                        </label>
                                        <input
                                            type="text"
                                            placeholder="https://example.com"
                                            class="form-control"
                                            v-model="info.website"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row text-left mb-3">
                                    <div class="col-xs-12 col-md-12">
                                        <label class="h5">
                                            <i
                                                class="fas fa-user-circle mr-2"
                                            ></i
                                            >Logo
                                        </label>
                                    </div>
                                    <div class="col-xs-6 col-md-4">
                                        <img
                                            :src="logo_preview"
                                            class="img-fluid"
                                        />
                                    </div>
                                    <div class="col-xs-6 col-md-8 text-left">
                                        <input
                                            type="file"
                                            ref="logo"
                                            name="logo"
                                            style="display: none"
                                            @change="previewLogo"
                                        />
                                        <button
                                            class="btn btn-primary text-white"
                                            @click="$refs.logo.click()"
                                        >
                                            Carica Nuova Immagine
                                        </button>
                                    </div>
                                </div>

                                <div class="row text-left mb-3">
                                    <div class="col-xs-12 col-md-12">
                                        <label class="h5">
                                            <i class="fas fa-image mr-2"></i
                                            >Immagine di copertina
                                        </label>
                                    </div>
                                    <div class="col-xs-6 col-md-4">
                                        <img
                                            :src="cover_preview"
                                            class="img-fluid"
                                            style="max-width:148px"
                                        />
                                    </div>
                                    <div class="col-xs-6 col-md-8 text-left">
                                        <input
                                            type="file"
                                            ref="cover"
                                            name="cover"
                                            style="display: none"
                                            @change="previewCover"
                                        />
                                        <button
                                            class="btn btn-primary text-white"
                                            @click="$refs.cover.click()"
                                        >
                                            Carica Nuova Immagine
                                        </button>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-xs-12 col-md-12">
                                        <div class="alert alert-warning">
                                            Attenzione, si consigliano le
                                            proporzioni 1:1 per l'immagine del
                                            logo e 16:10 per l'immagine di
                                            copertina; Dopo il caricamento le
                                            immagini verranno ritagliate se non
                                            conformi a tali proporzioni.<br />
                                            <strong
                                                >DIMENSIONE MASSIMA CONSENTITA
                                                250kb</strong
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <!-- Social -->
                                <div class="row text-left">
                                    <div class="col-xs-12 col-md-4 form-group">
                                        <label for="" class="h5">
                                            <i
                                                class="fab fa-facebook-f mr-2"
                                            ></i
                                            >Facebook
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="info.social.facebook"
                                            placeholder="https://www.facebook.com/nome_utente/"
                                        />
                                    </div>
                                    <div class="col-xs-12 col-md-4 form-group">
                                        <label for="" class="h5">
                                            <i class="fab fa-twitter mr-2"></i
                                            >Twitter
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="info.social.twitter"
                                            placeholder="https://www.twitter.com/nome_utente"
                                        />
                                    </div>
                                    <div class="col-xs-12 col-md-4 form-group">
                                        <label for="" class="h5">
                                            <i class="fab fa-instagram mr-2"></i
                                            >Instagram
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="info.social.instagram"
                                            placeholder="https://www.instagram.com/nome_utente/"
                                        />
                                    </div>
                                </div>

                                <!-- IM -->
                                <div class="row text-left">
                                    <div class="col-12">
                                        <div
                                            class="alert alert-warning text-center"
                                        >
                                            Inserire i numeri di telefono
                                            preceduti dal prefisso
                                            internazionale (es. +39 per
                                            l'Italia)
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-4 form-group">
                                        <label for="" class="h5">
                                            <i class="fab fa-whatsapp mr-2"></i
                                            >Whatsapp
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="info.im.whatsapp"
                                            placeholder="es: +391234467059"
                                        />
                                    </div>
                                    <div class="col-xs-12 col-md-4 form-group">
                                        <label for="" class="h5">
                                            <i
                                                class="fab fa-facebook-messenger mr-2"
                                            ></i
                                            >Facebook Messenger
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="info.im.fb_messenger"
                                            placeholder="incolla link al tuo messenger"
                                        />
                                    </div>
                                    <div class="col-xs-12 col-md-4 form-group">
                                        <label for="" class="h5">
                                            <i class="fab fa-telegram mr-2"></i
                                            >Telegram
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="info.im.telegram"
                                            placeholder="url di invito ad unirsi al gruppo del negozio"
                                        />
                                    </div>
                                </div>

                                <hr class="w-100" />

                                <!-- cambio password -->
                                <div class="row text-left">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="h5">
                                                    <i
                                                        class="fas fa-key mr-2"
                                                    ></i
                                                    >Cambia Password
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-4">
                                                <label for="" class="h5">
                                                    Vecchia Password/Codice
                                                    Reset
                                                </label>
                                            </div>
                                            <div class="col-4">
                                                <label for="" class="h5">
                                                    Nuova Password
                                                </label>
                                            </div>
                                            <div class="col-4"></div>
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
                                                <button
                                                    class="btn btn-success btn-block"
                                                    @click.prevent="
                                                        change_password()
                                                    "
                                                    :disabled="
                                                        old_password == '' ||
                                                            new_password == ''
                                                    "
                                                >
                                                    <i
                                                        class="fas fa-check mr-2"
                                                    ></i
                                                    >Conferma
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 w-auto">
                            <div
                                :class="error_message.message_class"
                                role="alert"
                                v-show="error_message.show"
                            >
                                {{ error_message.text }}
                                <br>
                                <ul class="list-group">
                                    <li
                                        class="list-group-item list-group-item-danger"
                                        v-for="missing_field in error_message.missing_fields"
                                        :key="missing_field.index"
                                    >
                                        {{ missing_field }}
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div
                            :class="contact_message_class"
                            role="alert"
                            v-show="confirm_contacts"
                        >
                            <strong>{{ contact_message_text }}</strong>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-label="Close"
                                @click="confirm_contacts = false"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent p-2">
                        <button
                            class="btn btn-block btn-warning p-2"
                            v-if="loading_contacts"
                        >
                            <span
                                class="spinner-border spinner-border-sm my-auto"
                                role="status"
                                aria-hidden="true"
                            ></span>
                        </button>
                        <button
                            :disabled="does_delivery && caps_len == 0"
                            class="btn btn-block btn-primary p-2"
                            @click="
                                getGeo('contacts');
                                loading_contacts = true;
                            "
                            v-else
                        >
                            <strong class="h5"
                                ><i class="fas fa-save mr-2"></i>Salva
                                Informazioni Contatti</strong
                            >
                        </button>
                    </div>
                </div>

                <!-- card servizi, cap and shipment -->
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <div class="col-12">
                            <div
                                class="row text-left"
                                :class="{
                                    'mb-3':
                                        does_delivery ||
                                        does_takeaway ||
                                        info.does_shipment
                                }"
                            >
                                <div class="col-6 my-auto">
                                    <strong class="h5">Servizi Offerti</strong>
                                </div>
                                <div class="col-6 my-auto">
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="takeaway"
                                            value="true"
                                            v-model="does_takeaway"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="takeaway"
                                            >Ritiro in Negozio</label
                                        >
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="delivery"
                                            value="true"
                                            v-model="does_delivery"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="delivery"
                                            >Consegna a Domicilio</label
                                        >
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="shipment"
                                            value="true"
                                            v-model="info.does_shipment"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="shipment"
                                            >Spedizione</label
                                        >
                                    </div>
                                </div>
                            </div>

                            <div
                                class="row text-left mb-3"
                                v-show="does_delivery"
                            >
                                <div class="col-12">
                                    <div
                                        class="alert alert-warning text-center"
                                    >
                                        Digita il nome della città o comune per
                                        inserire tutti i CAP relativi.<br />
                                        Potrai in seguito eliminare i CAP per
                                        cui non vuoi dare la disponibilità.
                                    </div>
                                </div>
                                <div class="my-auto d-flex justify-content-start">
                                    <strong class="col-6 h5"
                                        >Scegli la/le località di
                                        consegna:</strong
                                    >
                                     <input
                                        type="text col-4"
                                        class="form-control col-12 my-auto"
                                        v-model="input_district"
                                    />
                                </div>

                                <div class="col-4 my-auto position-relative">

                                    <div
                                        class="col-12 position-absolute top-0 left-0 bg-white rounded z-1 border autocomplete-results-box"
                                        v-if="
                                            districts_list &&
                                                districts_list.length > 0
                                        "
                                    >
                                        <p
                                            class="py-2 m-0"
                                            v-for="(district,
                                            index) in districts_list"
                                            :key="index"
                                            @click="selectDistrict(district)"
                                        >
                                            {{ district.nome }}
                                        </p>
                                    </div>
                                </div>
                                <!-- <div class="col-2 my-auto">
                                    <button
                                        class="btn btn-block btn-success mr-2"
                                        @click="addCap"
                                    >
                                        <i class="fas fa-plus mr-2"></i>Aggiungi
                                    </button>
                                </div> -->
                            </div>

                            <div
                                class="row"
                                v-show="does_delivery && caps_len == 0"
                            >
                                <div class="col-12 alert alert-danger">
                                    <p class="m-0 p-1">
                                        <strong
                                            >Attenzione! Nessun CAP
                                            selezionato.</strong
                                        ><br />
                                        Aggiungerne almeno uno o rimuovere la
                                        spunta dall'opzione 'Consegna a
                                        Domicilio' per abilitare i tasti di
                                        salvataggio.
                                    </p>
                                </div>
                            </div>

                            <div
                                class="row text-left mb-3"
                                v-show="
                                    does_delivery &&
                                        (info.zip_codes.length != 0 ||
                                            caps.length != 0)
                                "
                            >
                                <div class="col-12">
                                    <button
                                        class="btn btn-primary mr-2 my-1"
                                        v-for="cap in caps"
                                        :key="cap"
                                    >
                                        <i
                                            class="fas fa-times mr-2"
                                            @click="deleteCap(cap)"
                                        ></i
                                        >{{ cap }}
                                    </button>
                                </div>
                            </div>

                            <div
                                class="row text-left mb-3"
                                v-show="does_delivery"
                            >
                                <div class="col-4 my-auto">
                                    <strong class="h5">Ordine minimo:</strong>
                                </div>
                                <div class="input-group col-2">
                                    <div class="input input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon1"
                                            >€</span
                                        >
                                    </div>
                                    <input
                                        type="number"
                                        min="0"
                                        class="form-control my-auto"
                                        v-model="info.min_order"
                                    />
                                </div>
                                <div class="col-4 my-auto">
                                    <strong class="h5"
                                        >Sovrapprezzo per consegna:</strong
                                    >
                                </div>
                                <div class="input-group col-2">
                                    <div class="input input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon1"
                                            >€</span
                                        >
                                    </div>
                                    <input
                                        type="text"
                                        class="form-control my-auto"
                                        v-model="delivery_charge"
                                    />
                                </div>
                            </div>

                            <div
                                class="row text-left"
                                :class="{ 'mb-3': does_delivery }"
                                v-show="does_delivery || does_takeaway"
                            >
                                <div
                                    class="col-4 my-auto"
                                    v-show="does_delivery"
                                >
                                    <strong class="h5"
                                        >Tempo di preparazione:</strong
                                    >
                                </div>
                                <div class="col-2">
                                    <div
                                        class="input-group my-auto"
                                        v-show="does_delivery"
                                    >
                                        <!-- <div class="input-group-prepend"> -->
                                        <select
                                            class="form-control"
                                            style="background-color: white"
                                            v-if="delivery_time_um == 'm'"
                                            v-model="delivery_time_number"
                                        >
                                            <option
                                                v-for="minute in delivery_time_minutes"
                                                :key="minute.index"
                                                :value="minute"
                                                >{{ minute }}</option
                                            >
                                        </select>
                                        <select
                                            class="form-control"
                                            style="background-color: white"
                                            v-if="delivery_time_um == 'h'"
                                            v-model="delivery_time_number"
                                        >
                                            <option
                                                v-for="hour in delivery_time_hours"
                                                :key="hour.index"
                                                :value="hour"
                                                >{{ hour }}</option
                                            >
                                        </select>
                                        <div class="input-group-append">
                                            <select
                                                class="input-group-text"
                                                style="box-shadow: 0px; outline: none !important"
                                                v-model="delivery_time_um"
                                            >
                                                <option value="m">Min</option>
                                                <option value="h"> Ore</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ##########################   SHIPMENT SECTION   ################# -->
                        <div
                            class="row text-left mb-3"
                            v-show="info.does_shipment"
                        >
                            <div class="col-12 mt-3">
                                <div class="alert alert-warning text-center">
                                    Crea in questa sezione le tue spedizioni.
                                </div>
                            </div>
                            <!-- NOME INVIO -->
                                <div class="col-3 my-auto">
                                    <strong class="h5"
                                        >Nome della spedizione</strong
                                    >
                                </div>
                                <div class="col-4 my-auto position-relative">
                                    <input
                                        type="text"
                                        class="form-control col-12 my-auto"
                                        v-model="name_shipment"
                                         placeholder="es.spedizione nazionale"
                                    />
                                </div>
                                <div class="col-2 my-auto">
                                    <button
                                        class="btn btn-block btn-success mr-2"
                                        @click="
                                            addShipment()
                                            updateInfo('services');
                                            loading_services = true;
                                        "
                                    >
                                        <i class="fas fa-plus mr-2 ml-5"></i>Aggiungi
                                    </button>
                                </div>
                            <!-- COSTO INVIO -->
                            <div
                                class="d-flex justify-content-between"
                                style="margin-top: 10px; margin-bottom: 10px; width: 100%;"
                            >
                                <div class="col-4 my-auto">
                                    <strong class="h5">Costo invio:</strong>
                                </div>
                                <div class="input-group col-2">
                                    <div class="input input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon1"
                                            >€</span
                                        >
                                    </div>
                                    <input
                                        type="number"
                                        min="0"
                                        class="form-control my-auto"
                                        v-model="shipment_charge"

                                    />
                                </div>
                                <!-- MINIMO SPESA -->
                                <div class="col-4 my-auto">
                                    <strong class="h5"
                                        >Minimo ordine (facoltativo):</strong
                                    >
                                </div>
                                <div class="input-group col-2">
                                    <div class="input input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon1"
                                            >€</span
                                        >
                                    </div>
                                    <input
                                        type="number"
                                        min="0"
                                        class="form-control my-auto"
                                        v-model="min_shipment"
                                    />
                                </div>
                            </div>
                            <!-- MINIMO SPESA INVIO GRATIS -->
                            <div class="col-4 my-auto">
                                <strong class="h5"
                                    >Minimo ordine invio gratis
                                    (facoltativo):</strong
                                >
                            </div>
                            <div class="input-group col-2">
                                <div class="input input-group-prepend">
                                    <span
                                        class="input-group-text"
                                        id="basic-addon1"
                                        >€</span
                                    >
                                </div>
                                <input
                                    type="number"
                                    min="0"
                                    class="form-control my-auto"
                                    v-model="free_shipment"
                                />
                            </div>
                        </div>

                        <div>
                            <div
                                class="col-12 alert alert-danger my-3 font-weight-bold"
                                v-if="errorMsg"
                            >
                                <span class="error">{{ errorMsg }}</span>
                            </div>
                        </div>

                            <!-- <div class="col-12"> -->
                                <div
                                    class=""
                                    v-show="info.does_shipment"
                                >
                                    <table class="table table-striped mt-5 text-center table-bordered">
                                        <thead class="bg-primary text-white">
                                            <th>Tipo di Invio</th>
                                            <th>Costo</th>
                                            <th>Minimo</th>
                                            <th>Invio gratis</th>
                                            <th>Elimina</th>
                                        </thead>
                                            <tr v-for="shipment in shipments" :key="shipment.name">
                                                <td>{{ shipment.name }}</td>
                                                <td>{{ shipment.charge/100 }}€</td>
                                                <td>{{ shipment.min_ship/100 }}€</td>
                                                <td>{{ shipment.free_ship/100 }}€</td>
                                                <td><button class="btn btn-primary btn-block"><i
                                                    class="fas fa-times mr-2"
                                                    @click="
                                                        deleteShipment(shipment.name)
                                                        updateInfo('services');
                                                        loading_services = true;
                                                    "
                                                ></i
                                                ></button></td>
                                            </tr>
                                    </table>
                                </div>

<!-- #######################    END SHIPMENT SECTION   ##################### -->
                        <div
                            :class="contact_message_class"
                            role="alert"
                            v-show="confirm_services"
                        >
                            <strong>{{ contact_message_text }}</strong>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-label="Close"
                                @click="confirm_services = false"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent p-2">
                        <button
                            class="btn btn-block btn-warning p-2"
                            v-if="loading_services"
                        >
                            <span
                                class="spinner-border spinner-border-sm my-auto"
                                role="status"
                                aria-hidden="true"
                            ></span>
                        </button>
                        <button
                            :disabled="does_delivery && caps_len == 0"
                            class="btn btn-block btn-primary p-2"
                            @click="
                                updateInfo('services');
                                loading_services = true;
                            "
                            v-else
                        >
                            <strong class="h4"
                                ><i class="fas fa-save mr-2"></i>Salva
                                Informazioni Servizi Offerti</strong
                            >
                        </button>
                    </div>
                </div>

                <!-- card con dati orari -->
                <div class="card shadow mb-3">
                    <div class="card-header bg-white">
                        <div class="col-12">
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        :class="{
                                            active: selected_day_id == 1
                                        }"
                                    >
                                        <label
                                            class="h5 mb-0"
                                            @click="selected_day_id = 1"
                                            >Lunedì</label
                                        >
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        :class="{
                                            active: selected_day_id == 2
                                        }"
                                    >
                                        <label
                                            class="h5 mb-0"
                                            @click="selected_day_id = 2"
                                            >Martedì</label
                                        >
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        :class="{
                                            active: selected_day_id == 3
                                        }"
                                    >
                                        <label
                                            class="h5 mb-0"
                                            @click="selected_day_id = 3"
                                            >Mercoledì</label
                                        >
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        :class="{
                                            active: selected_day_id == 4
                                        }"
                                    >
                                        <label
                                            class="h5 mb-0"
                                            @click="selected_day_id = 4"
                                            >Giovedì</label
                                        >
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        :class="{
                                            active: selected_day_id == 5
                                        }"
                                    >
                                        <label
                                            class="h5 mb-0"
                                            @click="selected_day_id = 5"
                                            >Venerdì</label
                                        >
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        :class="{
                                            active: selected_day_id == 6
                                        }"
                                    >
                                        <label
                                            class="h5 mb-0"
                                            @click="selected_day_id = 6"
                                            >Sabato</label
                                        >
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        :class="{
                                            active: selected_day_id == 7
                                        }"
                                    >
                                        <label
                                            class="h5 mb-0"
                                            @click="selected_day_id = 7"
                                            >Domenica</label
                                        >
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-12">
                                    <div
                                        class="alert alert-warning text-center"
                                    >
                                        Attenzione: assicurarsi di compilare
                                        accuratamente tutti gli orari per tutti
                                        i giorni della settimana
                                    </div>
                                </div>
                            </div>
                        </div>
                        <day
                            id="1"
                            v-show="selected_day_id == 1"
                            :day-name="'Lunedì'"
                            :does-delivery="this.does_delivery"
                            :does-takeaway="this.does_takeaway"
                            :day-id="1"
                            :timeslot="info.timeslots[0]"
                            @timeslot="onTimeslotReceived"
                        >
                        </day>
                        <day
                            id="2"
                            v-show="selected_day_id == 2"
                            :day-name="'Martedì'"
                            :does-delivery="this.does_delivery"
                            :does-takeaway="this.does_takeaway"
                            :day-id="2"
                            :timeslot="this.info.timeslots[1]"
                            @timeslot="onTimeslotReceived"
                        >
                        </day>
                        <day
                            id="3"
                            v-show="selected_day_id == 3"
                            :day-name="'Mercoledì'"
                            :does-delivery="this.does_delivery"
                            :does-takeaway="this.does_takeaway"
                            :day-id="3"
                            :timeslot="this.info.timeslots[2]"
                            @timeslot="onTimeslotReceived"
                        >
                        </day>
                        <day
                            id="4"
                            v-show="selected_day_id == 4"
                            :day-name="'Giovedì'"
                            :does-delivery="this.does_delivery"
                            :does-takeaway="this.does_takeaway"
                            :day-id="4"
                            :timeslot="this.info.timeslots[3]"
                            @timeslot="onTimeslotReceived"
                        >
                        </day>
                        <day
                            id="5"
                            v-show="selected_day_id == 5"
                            :day-name="'Venerdì'"
                            :does-delivery="this.does_delivery"
                            :does-takeaway="this.does_takeaway"
                            :day-id="5"
                            :timeslot="this.info.timeslots[4]"
                            @timeslot="onTimeslotReceived"
                        >
                        </day>
                        <day
                            id="6"
                            v-show="selected_day_id == 6"
                            :day-name="'Sabato'"
                            :does-delivery="this.does_delivery"
                            :does-takeaway="this.does_takeaway"
                            :day-id="6"
                            :timeslot="this.info.timeslots[5]"
                            @timeslot="onTimeslotReceived"
                        >
                        </day>
                        <day
                            id="7"
                            v-show="selected_day_id == 7"
                            :day-name="'Domenica'"
                            :does-delivery="this.does_delivery"
                            :does-takeaway="this.does_takeaway"
                            :day-id="7"
                            :timeslot="this.info.timeslots[6]"
                            @timeslot="onTimeslotReceived"
                        >
                        </day>
                        <div
                            :class="contact_message_class"
                            role="alert"
                            v-show="confirm_hours"
                        >
                            <strong>{{ contact_message_text }}</strong>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-label="Close"
                                @click="confirm_hours = false"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent p-2">
                        <button
                            class="btn btn-block btn-warning p-2"
                            v-if="loading_hours"
                        >
                            <span
                                class="spinner-border spinner-border-sm my-auto"
                                role="status"
                                aria-hidden="true"
                            ></span>
                        </button>
                        <button
                            :disabled="does_delivery && caps_len == 0"
                            class="btn btn-block btn-primary p-2 mb-5"
                            @click="
                                updateInfo('hours');
                                loading_hours = true;
                            "
                            v-else
                        >
                            <strong class="h5"
                                ><i class="fas fa-save mr-2"></i>Salva
                                Informazioni Orari</strong
                            >
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Day from "./Day";
import DailyHours from "./DailyHours";
import VueTimepicker from "vue2-timepicker";
import Axios from "axios";
export default {
    components: {
        Day,
        DailyHours,
        VueTimepicker
    },
    props: ["retailer_id", "publisher_id"],
    metaInfo() {
        return {
            title: "info Negozio",
            // override the parent template and just use the above title only
            /*  titleTemplate: null, */
            meta: [
                {
                    "http-equiv": "pragma",
                    content: "no-cache"
                },
                {
                    name: "robots",
                    contant: "noindex, nofollow"
                }
            ]
        };
    },
    data() {
        return {
            old_password: "",
            new_password: "",
            main_message: {
                text:
                    "Attenzione! Compila tutti i campi con l'asterisco, altrimenti la tua attivita' non verra' mostrata.",
                message_class: "alert alert-primary mb-2"
            },
            error_message: {
                text:
                    "Attenzione, per procedere è necessario compilare i seguenti campi: ",
                missing_fields: [],
                message_class: "alert alert-danger mb-2",
                show: false
            },
            delivery_time_minutes: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55],
            delivery_time_hours: [
                1,
                2,
                3,
                4,
                5,
                6,
                7,
                8,
                9,
                10,
                11,
                12,
                13,
                14,
                15,
                16,
                17,
                18,
                19,
                20,
                21,
                22,
                23,
                24
            ],
            contact_message_text: "Modifiche apportate con successo",
            contact_message_class:
                "alert alert-success alert-dismissible fade show my-1",
            does_delivery: false,
            does_takeaway: false,
            does_shipment: false,
            name_shipment: null,
            shipment_charge: null,
            min_shipment: null,
            free_shipment: null,
            errorMsg: null,
            retailer_address_id: "",
            retailer_address: "",
            retailer_city: "",
            retailer_province: "",
            retailer_zip_code: "",
            delivery_charge: "",
            delivery_time: "",
            delivery_time_number: "",
            delivery_time_um: "m",
            init: true,
            alert_time: "",
            input_cap: null,
            input_district: null,
            districts_list: null,
            selected_district: null,
            selected_day_id: 1,
            caps: [],
            shipments: [],
            info: {
                description: "",
                phone: "",
                email: "",
                website: "",
                zip_codes: [],
                does_shipment: false,
                shipments: [],
                min_order: "",
                social: {
                    facebook: "",
                    twitter: "",
                    instagram: ""
                },
                im: {
                    whatsapp: "",
                    fb_messenger: "",
                    telegram: ""
                },
                geo: {
                    lat: "",
                    lng: ""
                },
                timeslots: [
                    {
                        id: 1,
                        name: "Lunedì",
                        opening_schedule: "",
                        delivery_schedule: "",
                        takeaway_schedule: "",
                        delivery_hours: [],
                        takeaway_hours: [],
                        opening_hours: []
                    },
                    {
                        id: 2,
                        name: "Martedì",
                        opening_schedule: "",
                        delivery_schedule: "",
                        takeaway_schedule: "",
                        delivery_hours: [],
                        takeaway_hours: [],
                        opening_hours: []
                    },
                    {
                        id: 3,
                        name: "Mercoledì",
                        opening_schedule: "",
                        delivery_schedule: "",
                        takeaway_schedule: "",
                        delivery_hours: [],
                        takeaway_hours: [],
                        opening_hours: []
                    },
                    {
                        id: 4,
                        name: "Giovedì",
                        opening_schedule: "",
                        delivery_schedule: "",
                        takeaway_schedule: "",
                        delivery_hours: [],
                        takeaway_hours: [],
                        opening_hours: []
                    },
                    {
                        id: 5,
                        name: "Venerdì",
                        opening_schedule: "",
                        delivery_schedule: "",
                        takeaway_schedule: "",
                        delivery_hours: [],
                        takeaway_hours: [],
                        opening_hours: []
                    },
                    {
                        id: 6,
                        name: "Sabato",
                        opening_schedule: "",
                        delivery_schedule: "",
                        takeaway_schedule: "",
                        delivery_hours: [],
                        takeaway_hours: [],
                        opening_hours: []
                    },
                    {
                        id: 7,
                        name: "Domenica",
                        opening_schedule: "",
                        delivery_schedule: "",
                        takeaway_schedule: "",
                        delivery_hours: [],
                        takeaway_hours: [],
                        opening_hours: []
                    }
                ]
            },

            logo_src: `/storage/${this.$store.state.retailerVat}/img/profile/logo.jpg`,
            cover_src: `/storage/${this.$store.state.retailerVat}/img/profile/cover.jpg`,

            logo_preview: "",
            cover_preview: "",

            logo: "",
            cover: "",

            loading_contacts: false,
            confirm_contacts: false,
            loading_services: false,
            confirm_services: false,
            loading_hours: false,
            confirm_hours: false
        };
    },
    watch: {
        delivery_time_number: function() {
            if (this.delivery_time_um == "h") {
                this.delivery_time = this.delivery_time_number * 60;
            } else {
                this.delivery_time = this.delivery_time_number;
            }
        },

        delivery_time: function() {
            this.initDeliveryTime();
        },

        input_district: function() {
            this.districtsAPI();
        }
    },
    computed: {
        caps_len: function() {
            if (this.caps) {
                return this.caps.length;
            }
        }
    },
    methods: {
        addShipment() {
            if (!this.name_shipment || !this.shipment_charge) {
                this.errorMsg =
                    "Controllare di aver compilato correttamente tutti i campi obbligatori per l'invio  (nome e costo)";
            } else {
                    let charge = this.shipment_charge*100
                    let min = this.min_shipment*100
                    let free = this.free_shipment*100
                    let shipment = {'name': this.name_shipment, 'charge': charge, 'min_ship': min, 'free_ship': free}
                    this.shipments.push(shipment)
                    this.name_shipment = ""
                    this.shipment_charge = ""
                    this.min_shipment = ""
                    this.free_shipment = ""
            }
        },
        deleteShipment(name_shipment) {
            this.shipments.forEach(
                shipment => {
                    if(shipment.name === name_shipment) {
                        this.shipments.splice(this.shipments.indexOf(shipment), 1)
                    }
                }
            )
        },
        addCap() {
            console.log(this.info.min_order)
            if (this.caps.indexOf(this.input_cap) == -1 && this.input_cap) {
                this.caps.push(this.input_cap);
            }
            // let min_ord = this.info.min_order*100
            // let delivery_charge = this.delivery_charge*100
            // this.delivery_charge = delivery_charge
            // this.info.min_order = min_ord
        },

        deleteCap(cap) {
            this.caps.splice(this.caps.indexOf(cap), 1);
        },

        districtsAPI() {
            axios
                .get(`/api/districts/${this.input_district}`)
                .then(response => {
                    this.districts_list = response.data.data;
                });
        },

        selectDistrict(district) {
            this.selected_district = district;
            this.input_district = null;
            this.selected_district.zipcodes.forEach(zip => {
                if (
                    this.caps.indexOf(zip.codice + " - " + district.nome) == -1
                ) {
                    this.caps.push(zip.codice + " - " + district.nome);
                }
            });
            this.districts_list = null;
        },

        createAddress() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };

            axios
                .post(
                    `/api/addresses/create`,
                    {
                        city: this.retailer_city,
                        address: this.retailer_address,
                        province: this.retailer_province,
                        zip_code: this.retailer_zip_code,
                        retailer_id: this.retailer_id
                    },
                    config
                )
                .then(response => {
                    console.log("address-created", response);
                    localStorage.setItem(
                        "retailer-address-id",
                        response.data.data.id
                    );
                    this.retailer_address_id = response.data.data.id;
                })
                .catch(e => {
                    console.log(e);
                });
        },

        updateAddress() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };

            axios
                .put(
                    `/api/addresses/${this.retailer_address_id}`,
                    {
                        city: this.retailer_city,
                        address: this.retailer_address,
                        province: this.retailer_province,
                        zip_code: this.retailer_zip_code,
                        retailer_id: this.retailer_id
                    },
                    config
                )
                .then(response => {
                    console.log("address-updated", response);
                })
                .catch(e => {
                    console.log(e);
                });
        },

        updateInfo(button) {

            let missing = this.checkFields();
            //multiply min_order for update data
            this.info.min_order = this.info.min_order*100
            if (!missing) {
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.token}`
                    }
                };
                if (!this.retailer_address_id) {
                    this.createAddress();
                } else {
                    this.updateAddress();
                }
                this.info.zip_codes = this.caps;
                this.info.shipments = this.shipments;

                // console.log("info.geo:", this.info.geo);

                let formData = new FormData();
                formData.append("retailer_vat", this.$store.state.retailerVat);
                formData.append("logo", this.logo);
                formData.append("cover", this.cover);

                axios
                    .post("/api/image_upload", formData, {
                        header: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(e => {
                        console.log(e.data);
                    });

                axios
                    .put(
                        `/api/retails/${this.retailer_id}`,
                        {
                            does_delivery: this.does_delivery,
                            does_takeaway: this.does_takeaway,
                            delivery_time: this.delivery_time,
                            alert_time: this.alert_time,
                            delivery_charge: this.delivery_charge*100,
                            info: JSON.stringify(this.info)
                        },
                        config
                    )
                    .then(response => {
                        switch (button) {
                            case "contacts":
                                this.confirm_contacts = true;
                                break;
                            case "services":
                                this.confirm_services = true;
                                break;
                            case "hours":
                                this.confirm_hours = true;
                                break;

                            default:
                                break;
                        }
                        this.loading_contacts = false;
                        this.loading_services = false;
                        this.loading_hours = false;
                        //divide min_order for rendering data
                        this.info.min_order = this.info.min_order/100
                        /*  this.logo_preview = this.logo_src + "?version=1";
                        this.cover_preview = this.cover_src + "?version=1"; */
                        /*  this.$router.go(); */

                    })
                    .catch(e => {
                        console.log(e);
                    });
            }
        },

        checkUrls(url) {
            var expression = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/;
            var regex = new RegExp(expression);
            console.log("@@@@@@@@@@@@@@@@@@@", regex.test(url));
            if (!url) {
                return true;
            }
            if (regex.test(url)) {
                return true;
            }
            return false;
        },
        checkFields() {
            let isWebUrl = this.checkUrls(this.info.website);
            let isFecebookUrl = this.checkUrls(this.info.social.facebook);
            let isTwitterUrl = this.checkUrls(this.info.social.twitter);
            let isInstagramUrl = this.checkUrls(this.info.social.instagram);

            if (
                !this.retailer_city ||
                !this.retailer_address ||
                !this.retailer_province ||
                !this.retailer_zip_code ||
                !this.info.email ||
                !this.info.phone ||
                isWebUrl === false ||
                isFecebookUrl === false ||
                isTwitterUrl === false ||
                isInstagramUrl === false
            ) {
                this.error_message.missing_fields = [];
                if (!this.retailer_city) {
                    this.error_message.missing_fields.push("Città");
                }
                if (!this.retailer_address) {
                    this.error_message.missing_fields.push("Indirizzo");
                }
                if (!this.retailer_province) {
                    this.error_message.missing_fields.push("Provincia");
                }
                if (!this.retailer_zip_code) {
                    this.error_message.missing_fields.push("CAP");
                }
                if (!this.info.email) {
                    this.error_message.missing_fields.push("Email");
                }
                if (!this.info.phone) {
                    this.error_message.missing_fields.push("Telefono");
                }
                if (isWebUrl === false) {
                    this.error_message.missing_fields.push("Web - Url non valida");
                }
                if (isFecebookUrl === false) {
                    this.error_message.missing_fields.push("Facebook - Url non valida");
                }
                if (isTwitterUrl === false) {
                    this.error_message.missing_fields.push("Twitter - Url non valida");
                }
                if (isInstagramUrl === false) {
                    this.error_message.missing_fields.push("Instagram - Url non valida");
                }
                this.error_message.show = true;
                this.loading_contacts = false;
                return true;
            } else {
                this.error_message.show = false;
                this.error_message.missing_fields = [];
                return false;
            }
        },

        getGeo(button) {
            var addressObj = {
                address_line_1: this.retailer_address,
                address_line_2: "",
                city: this.retailer_city,
                state: "",
                zip_code: this.retailer_zip_code,
                country: "Italy"
            };

            this.$geocoder.send(addressObj, response => {
                this.info.geo.lat = response.results[0].geometry.location.lat;
                this.info.geo.lng = response.results[0].geometry.location.lng;

                this.updateInfo(button);
            });

            return this.info;
        },

        onTimeslotReceived(payload) {
            this.info.timeslots[payload.id - 1] = payload;
        },

        getRetailer() {
            axios
                .get(`/api/retails/${this.retailer_id}`)
                .then(response => {
                    this.info = JSON.parse(response.data.data.info);
                    this.retailer_address_id = response.data.data.address.id;
                    this.retailer_address = response.data.data.address.address;
                    this.retailer_city = response.data.data.address.city;
                    this.retailer_province =
                        response.data.data.address.province;
                    this.retailer_zip_code =
                        response.data.data.address.zip_code;
                    this.delivery_time = response.data.data.delivery_time;
                    this.alert_time = response.data.data.alert_time;
                    this.does_takeaway = response.data.data.does_takeaway;
                    this.does_delivery = response.data.data.does_delivery;
                    this.does_shipment = this.info.does_shipment;
                    this.delivery_charge = response.data.data.delivery_charge/100;
                    this.caps = this.info.zip_codes;
                    this.shipments = this.info.shipments;
                    this.$store.dispatch('setRetailerSlug', response.data.data.slug)
                    this.$store.dispatch('setRetailerVat', response.data.data.vat)
                    if(this.info.min_order) {
                        this.info.min_order = this.info.min_order/100
                    }
                })
                .catch(e => {
                    console.log(e);
                });
        },

        previewLogo: function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                this.logo = input.files[0];
                var reader = new FileReader();
                reader.onload = e => {
                    this.logo_preview = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        },

        previewCover: function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                this.cover = input.files[0];
                var reader = new FileReader();
                reader.onload = e => {
                    this.cover_preview = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        },

        initDeliveryTime: function() {
            let result = this.delivery_time / 60;
            let remainder = this.delivery_time % 60;
            console.log("initdeliverytime", [result, remainder]);
            if (result > 0 && remainder == 0) {
                this.delivery_time_number = result;
                this.delivery_time_um = "h";
            } else {
                this.delivery_time_number = this.delivery_time;
                this.delivery_time_um = "m";
            }
            this.init = false;
        },

        change_password() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };
            axios
                .post(
                    `/api/users/${this.publisher_id}/change_password`,
                    {
                        old_password: this.old_password,
                        new_password: this.new_password
                    },
                    config
                )
                .then(response => {
                    (this.old_password = ""),
                        (this.new_password = ""),
                        (this.confirm_contacts = true);
                })
                .catch(e => {
                    console.log(e);
                });
        }
    },
    async mounted() {
        await this.getRetailer();
        // await this.initDeliveryTime();
        let version_number = Math.floor(Math.random() * 100);
        (this.logo_src = this.logo_src + `?version=${version_number}`),
            (this.cover_src = this.cover_src + `?version=${version_number}`),
            (this.logo_preview = this.logo_src);
        this.cover_preview = this.cover_src;
    }
};
</script>
<style scoped>
.hours-card {
    border-radius: 10px;
}

input.form-control,
.btn {
    outline: none !important;
    box-shadow: none !important;
}
</style>
