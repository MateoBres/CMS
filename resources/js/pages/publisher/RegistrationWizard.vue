<template>
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-12 mt-5">
                <form-wizard
                    ref="wizard"
                    @on-complete="onComplete"
                    @on-validate="handleValidation"
                    :title="'Benvenuto su Spesavicino.it!'"
                    :subtitle="'Di seguito potrai registrare il tuo negozio'"
                    :color="'#F18501'"
                    :nextButtonText="'Avanti'"
                    :backButtonText="'Indietro'"
                    :finishButtonText="'Fine'"
                    :start-index="0"
                >
                    <tab-content class="py-3" title="Personal details">
                       <div class="card card-min-height bg-white rounded shadow">
                            <div class="card-body d-flex flex-column justify-content-center p-5" style="color:#666">
                                <h2 class="mb-5">Grazie per averci scelto! 🎉</h2>
                                <p style="font-size:1.2rem" class="mb-5 text-center">
                                    Ti ricordiamo che nella versione gratuita, potrai pubblicare una presentazione della tua attività, collegare i tuoi social network preferiti,
                                    inserire gli orari e tutti i dati di contatto, ma anche ricevere gli ordini per e-mail e pubblicare fino ad un max di 7 articoli.<br/>
                                    Una volta terminata la registrazione potrai decidere se passare ad una delle versioni a pagamento. <br />
                                    <strong>Buon Lavoro!</strong>
                                </p>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="card h-100 border-primary">
                                            <div class="card-body">
                                                <h2 class="text-center w-100 mb-3">⏰</h2>
                                                <p style="font-size:1.2rem" class="my-auto text-center">
                                                    La procedura guidata durerà circa 10 minuti e ti verranno chiesti alcuni dati, tra cui:
                                                    <ul class="text-left my-3">
                                                        <li><strong>l'indirizzo del tuo negozio</strong></li>
                                                        <li><strong>orarigli di apertura</strong></li>
                                                        <li><strong>una fotografia per la copertina del tuo negozio</strong></li>
                                                        <li><strong>una fotografia di un prodotto</strong></li>
                                                    </ul>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card h-100 border-secondary">
                                            <div class="card-body">
                                                <h2 class="text-center w-100 mb-3">👨‍🔧</h2>
                                                <p style="font-size:1.2rem" class="my-auto text-center">
                                                    Hai bisogno di aiuto? Scrivici una mail all'indirizzo<br><strong>info@spesavicino.it</strong>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                    </tab-content>
                    <tab-content
                        class="py-3"
                        title="Indirizzo"
                        :before-change="validateAddress"
                    >
                        <div class="alert alert-info d-flex w-100 p-3 shadow">
                            <p class="m-auto font-weight-bold h5 p-2 text-center">
                                I campi contrassegnati con l'asterisco rosso sono necessari, gli altri possono essere lasciati vuoti
                            </p>
                        </div>
                        <div class="card card-min-height bg-white rounded shadow">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h3 class="mb-3">
                                    Indirizzo della tua attività
                                </h3>
                                <div class="w-100 my-auto">
                                    <div class="form-row">
                                        <div class="col-12 form-group text-left">
                                            <label>Indirizzo<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                            <input type="text" class="form-control" v-model="address">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-4 form-group text-left">
                                            <label>CAP<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                            <input type="number" min="0" class="form-control" v-model="zip_code" @change="handleBlurZipCode">
                                        </div>
                                        <div class="col-4 form-group text-left">
                                            <label>Città o Comune<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                            <input type="text" class="form-control" v-model="city">
                                        </div>
                                        <div class="col-4 form-group text-left">
                                            <label>Provincia<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                            <input type="text" class="form-control" v-model="province">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="alert alert-danger my-3" v-if="errorMsg">
                                        <span class="error">{{errorMsg}}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </tab-content>
                    <tab-content
                        class="py-3"
                        title="Breve Presentazione"
                        :before-change="validateShopInfo"
                    >
                        <div class="alert alert-info d-flex w-100 p-3 shadow">
                            <p class="m-auto font-weight-bold h5 p-2 text-center">
                                I campi contrassegnati con l'asterisco rosso sono necessari, gli altri possono essere lasciati vuoti
                            </p>
                        </div>
                        <div class="card card-min-height bg-white shadow rounded">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h3 class="mb-3">
                                    Informazioni Negozio
                                </h3>
                                <div class="my-auto w-100">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-row">
                                                <div class="col-12 text-left">
                                                    <div class="form-group">
                                                        <label>Insegna Negozio<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                        <input type="text" class="form-control" v-model="shop_name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Descrizione Negozio<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                        <textarea class="form-control" v-model="shop_description"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group h-75">
                                                <label>Logo</label>
                                                <div class="col-12 border rounded h-100 p-0 overflow-hidden height-fit-content position-relative" :class="{ 'height-fit-content' : logo_preview }" @click="selectLogo()">
                                                    <!-- <img class="w-100" style="object-fit:cover" :src="logo_preview" v-if="logo_preview"> -->
                                                    <div style="height:0px; padding-top:100%; overflow:hidden;" :style="logo_style"></div>
                                                    <div class="w-100 h-100 position-absolute top-0 left-0 d-flex" style="margin-top:-100%">
                                                        <p class="p-1 my-auto mx-auto text-center pointer" style="cursor:pointer" :class="{ 'text-white' : logo, 'text-muted' : !logo }">
                                                            {{ logo ? 'Clicca per cambiare immagine' : 'Clicca per selezionare un\'immagine' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <input type="file" hidden ref="selectLogo" @input="onSelectLogo()">
                                                <div v-if="logoError" class="alert alert-danger">
                                                    {{logoError}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group h-75">
                                                <label>Immagine Copertina<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                <div class="col-12 border rounded h-100 p-0 overflow-hidden position-relative" @click="selectCover()">
                                                    <div style="height:0px; padding-top:56.25%; overflow:hidden;" :style="cover_style"></div>
                                                    <div class="w-100 h-100 position-absolute top-0 left-0 d-flex" style="margin-top:-56.25%">
                                                        <p class="p-1 my-auto mx-auto text-center pointer" style="cursor:pointer" :class="{ 'text-white' : cover, 'text-muted' : !cover }">
                                                            {{ cover ? 'Clicca per cambiare immagine' : 'Clicca per selezionare un\'immagine' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <input type="file" hidden ref="selectCover" @input="onSelectCover()">
                                                <div v-if="coverError" class="alert alert-danger">
                                                    {{coverError}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="alert alert-danger my-3" v-if="errorMsg">
                                        <span class="error">{{errorMsg}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tab-content>
                    <tab-content
                        class="py-3"
                        title="I Tuoi Servizi"
                        :before-change="validateServices"
                    >
                        <div class="alert alert-info d-flex w-100 p-3 shadow">
                            <p class="m-auto font-weight-bold h5 p-2 text-center">
                                I campi contrassegnati con l'asterisco rosso sono necessari, gli altri possono essere lasciati vuoti
                            </p>
                        </div>
                        <div class="card card-min-height bg-white shadow rounded">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h3 class="mb-3">
                                    Scelta Servizi
                                </h3>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-info border-primary text-primary w-100 text-center" v-if="does_delivery">
                                            <p class="text-center h5 my-1">
                                                Per selezionare le zone servite, iniziare a scrivere il nome della città e poi clickare l'opzione desiderate tra quelle disponibili
                                            </p>
                                            <p class="text-center h5 my-1">
                                                In seguito potrete rimuovere i CAP indesiderati dalla lista premendo la <i class="fa fa-times"></i>.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100 my-auto">
                                    <div class="form-row">
                                        <div class="offset-2 col-4 text-left">
                                            <div class="form-group">
                                                <label>Servizi</label>
                                                <div class="form-check">
                                                    <input id="takeaway" class="form-check-input" type="checkbox" v-model="does_takeaway">
                                                    <label class="form-check-label" for="takeaway">Ritiro in Negozio</label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="delivery" class="form-check-input" type="checkbox" v-model="does_delivery">
                                                    <label class="form-check-label" for="delivery">Consegna a Domicilio</label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="shipment" class="form-check-input" type="checkbox" v-model="does_shipment">
                                                    <label class="form-check-label" for="shipment">Spedizione</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6" v-show="does_delivery">
                                            <div class="form-row">
                                                <div class="col-4 text-left">
                                                    <div class="form-group">
                                                        <label>Costo Consegna<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="textnumber"
                                                             v-model="delivery_charge">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-dark" disabled>
                                                                    <i class="fa fa-euro-sign"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <div class="form-group">
                                                        <label>Ordine Minimo<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                        <div class="input-group">
                                                            <input class="form-control"
                                                            type="number"
                                                            min="0"
                                                            v-model="min_order">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-dark" disabled>
                                                                    <i class="fa fa-euro-sign"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-left position-relative">
                                                    <div class="form-group">
                                                        <label>Comuni Serviti<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                            <input class="form-control" type="text" v-model="input_district">
                                                        <div class="col-12 position-absolute top-0 left-0 bg-white rounded z-1 border autocomplete-results-box p-0" v-if="districts_list && districts_list.length > 0">
                                                            <p
                                                                class="p-2 m-0 border-bottom district-option"
                                                                v-for="(district, index) in districts_list" :key="index"
                                                                @click.prevent="districtSelect(district)"
                                                                :class="{ 'bg-light' : index % 2 == 0}"
                                                            >
                                                                {{ district.nome }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div
                                            class="row text-left mb-3"
                                            v-show="does_delivery && caps.length != 0"
                                        >
                                            <div class="col-2 my-1 px-1" v-for="cap in caps" :key="cap">
                                                <button
                                                    class="btn btn-primary btn-block"
                                                >
                                                    <i
                                                        class="fas fa-times mr-2"
                                                        @click="deleteCap(cap)"
                                                    ></i
                                                    >{{ cap }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12" v-show="does_shipment">
                                        <h2>Definisci modalità di spedizione</h2>
                                        <h4>Puoi definire più di una modalità di spedizione sepcificando per ciascuna un costo corrispondente</h4>
                                        <div class="form-row">
                                            <div class="col-3 text-left">
                                                <div class="form-group">
                                                    <label>Nome spedizione<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                    <div class="input-group">
                                                        <input class="form-control" type="text" v-model="name_shipment" placeholder="es. nazionale">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 text-left">
                                                <div class="form-group">
                                                    <label>Costo Invio<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                    <div class="input-group">
                                                        <input class="form-control" type="number"
                                                        min="0"
                                                        v-model="shipment_charge">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-dark" disabled>
                                                                <i class="fa fa-euro-sign"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 text-left">
                                                <div class="form-group">
                                                    <label>Minimo spesa</label>
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" v-model="min_shipment">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-dark" disabled>
                                                                <i class="fa fa-euro-sign"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 text-left">
                                                <div class="form-group">
                                                    <label>Minimo spesa con Invio Gratis</label>
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" v-model="free_shipment">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-dark" disabled>
                                                                <i class="fa fa-euro-sign"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
                                                <button class="btn btn-primary" @click="addShipment">
                                                    Aggiungi
                                                </button>
                                            </div>
                                        </div>

                                        <div
                                            class=""
                                            v-show="shipments.length != 0"
                                        >

                                            <table class="table table-striped mt-5 text-center">
                                                <thead class="thead-dark">
                                                    <th>Tipo di Invio</th>
                                                    <th>Costo</th>
                                                    <th>Minimo</th>
                                                    <th>Invio gratis</th>
                                                    <th>Elimina</th>
                                                </thead>
                                                    <tr v-for="shipment in shipments" :key="shipment.name">
                                                        <td>{{ shipment.name }}</td>
                                                        <td>{{ ((shipment.charge)/100).toFixed(2) }}</td>
                                                        <td>{{ ((shipment.min_ship)/100).toFixed(2)}}</td>
                                                        <td>{{ ((shipment.free_ship)/100).toFixed(2)}}</td>
                                                        <td><button class="btn btn-danger btn-block"><i
                                                            class="fas fa-times mr-2"
                                                            @click="deleteShipment(shipment.name)"
                                                        ></i
                                                        ></button></td>
                                                    </tr>
                                            </table>

                                        </div>

                                    </div>
                                </div>
                                <div>
                                    <div class="alert alert-danger my-3" v-if="errorMsg">
                                        <span class="error">{{errorMsg}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tab-content>
                    <tab-content
                        class="py-3"
                        title="Orari di Apertura"
                    >
                        <div class="alert alert-info d-flex w-100 p-3 shadow">
                            <p class="m-auto font-weight-bold h5 p-2 text-center">
                                I campi contrassegnati con l'asterisco rosso sono necessari, gli altri possono essere lasciati vuoti
                            </p>
                        </div>
                        <div class="card card-min-height shadow bg-white rounded">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h3 class="mb-3">
                                    Orari di Apertura
                                </h3>
                                <h5 class="mb-5">
                                    Potrete modificare in seguito tutti gli orari nella pagina del vostro negozio, se avete spuntato la casella per la consegna a domicilio,
                                    gli orari per le consegne saranno inizializzati uguali ai vostri orari di apertura ma potrete modificare anche quelli in seguito, sempre
                                    nella pagina del vostro negozio
                                </h5>
                                <div class="row mb-3">
                                    <!-- <div class="offset-2 col-2 text-left">Tipo Orario</div> -->
                                    <div class="col-4 text-left">
                                        <div class="row m-0">
                                            <div class="col-6 offset-6 font-weight-bold text-center">
                                                <div class="col-12">
                                                    Tipo Orario
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-left">
                                        <div class="row m-0">
                                            <div class="col-8 offset-4 font-weight-bold text-center">
                                                <div class="col-12">
                                                    Mattina
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-left">
                                        <div class="row m-0">
                                            <div class="col-8 offset-4 font-weight-bold text-center">
                                                <div class="col-12">
                                                    Pomeriggio
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-1 p-1 border rounded bg-light" v-for="(day, index) in days" :key="index">
                                    <div class="col-2 d-flex">
                                        <p class="my-auto">{{ day.name }}</p>
                                    </div>
                                    <div class="col-2 d-flex">
                                        <select class="form-control my-auto" v-model="day.schedule_type">
                                            <option value="standard">Spezzato</option>
                                            <option value="am_only">Solo Mattina</option>
                                            <option value="pm_only">Solo Pomeriggio</option>
                                            <option value="all_day">Continuato</option>
                                            <option value="closed">Chiuso</option>
                                        </select>
                                    </div>
                                    <!-- mattina -->
                                    <div class="col-4">
                                        <div class="col-12">
                                            <div class="row my-1">
                                                <div class="col-4 text-left p-0 d-flex">
                                                    <p class="my-auto">Apertura</p>
                                                </div>
                                                <div class="col-8 d-flex">
                                                    <vue-timepicker
                                                        auto-scroll
                                                        :close-on-complete="true"
                                                        :hide-clear-button="true"
                                                        format="HH:mm"
                                                        placeholder="Seleziona un orario"
                                                        hour-label="Ore"
                                                        minute-label="Minuti"
                                                        input-width="100%"
                                                        hide-disabled-hours
                                                        :disabled="day.schedule_type == 'pm_only' || day.schedule_type == 'closed'"
                                                        :minute-interval="15"
                                                        v-model="day.schedule.am_init"
                                                    >
                                                    </vue-timepicker>
                                                </div>
                                            </div>
                                            <div class="row my-1" v-if="day.schedule_type != 'all_day'">
                                                <div class="col-4 text-left p-0 d-flex">
                                                    <p class="my-auto">Chiusura</p>
                                                </div>
                                                <div class="col-8 d-flex">
                                                    <vue-timepicker
                                                        auto-scroll
                                                        :close-on-complete="true"
                                                        :hide-clear-button="true"
                                                        format="HH:mm"
                                                        placeholder="Seleziona un orario"
                                                        hour-label="Ore"
                                                        minute-label="Minuti"
                                                        input-width="100%"
                                                        hide-disabled-hours
                                                        :disabled="day.schedule_type == 'pm_only' || day.schedule_type == 'closed'"
                                                        :minute-interval="15"
                                                        v-model="day.schedule.am_end"
                                                    >
                                                    </vue-timepicker>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /mattina -->
                                    <!-- pomeriggio -->
                                    <div class="col-4">
                                         <div class="col-12">
                                            <div class="row my-1" v-if="day.schedule_type != 'all_day'">
                                                <div class="col-4 text-left p-0 d-flex">
                                                    <p class="my-auto">Apertura</p>
                                                </div>
                                                <div class="col-8 d-flex">
                                                    <vue-timepicker
                                                        auto-scroll
                                                        :close-on-complete="true"
                                                        :hide-clear-button="true"
                                                        format="HH:mm"
                                                        placeholder="Seleziona un orario"
                                                        hour-label="Ore"
                                                        minute-label="Minuti"
                                                        input-width="100%"
                                                        hide-disabled-hours
                                                        :disabled="day.schedule_type == 'am_only' || day.schedule_type == 'closed'"
                                                        :minute-interval="15"
                                                        v-model="day.schedule.pm_init"
                                                    >
                                                    </vue-timepicker>
                                                </div>
                                            </div>
                                            <div class="row my-1">
                                                <div class="col-4 text-left p-0 d-flex">
                                                    <p class="my-auto">Chiusura</p>
                                                </div>
                                                <div class="col-8 d-flex">
                                                    <vue-timepicker
                                                        auto-scroll
                                                        :close-on-complete="true"
                                                        :hide-clear-button="true"
                                                        format="HH:mm"
                                                        placeholder="Seleziona un orario"
                                                        hour-label="Ore"
                                                        minute-label="Minuti"
                                                        input-width="100%"
                                                        hide-disabled-hours
                                                        :disabled="day.schedule_type == 'am_only' || day.schedule_type == 'closed'"
                                                        :minute-interval="15"
                                                        v-model="day.schedule.pm_end"
                                                    >
                                                    </vue-timepicker>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /pomeriggio -->
                                </div>
                                <div>
                                    <div class="alert alert-danger my-3" v-if="errorMsg">
                                        <span class="error">{{errorMsg}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tab-content>
                    <tab-content
                        class="py-3"
                        title="Collega i tuoi Social"
                        :before-change="validateContacts"
                    >
                        <div class="alert alert-info d-flex w-100 p-3 shadow">
                            <p class="m-auto font-weight-bold h5 p-2 text-center">
                                I campi contrassegnati con l'asterisco rosso sono necessari, gli altri possono essere lasciati vuoti
                            </p>
                        </div>
                        <div class="card card-min-height shadow bg-white rounded">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h3 class="mb-3">
                                    Contatti
                                </h3>
                                <div class="my-auto w-100">
                                    <!-- <div class="alert alert-info d-flex w-100 p-3">
                                        <p class="m-auto font-weight-bold h5 p-2 text-center">
                                            I campi contrassegnati con l'asterisco rosso sono necessari, gli altri possono essere lasciati vuoti
                                        </p>
                                    </div> -->
                                    <div class="form-row">
                                        <div class="col-4">
                                            <div class="form-group text-left">
                                                <label>Telefono Attività<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                <input type="text" class="form-control" v-model="phone">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group text-left">
                                                <label>Email Attività<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                <input type="text" class="form-control" v-model="email">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group text-left">
                                                <label>Indirizzo Sito Web</label>
                                                <input type="text" class="form-control" v-model="website" placeholder="https://example.com">
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="my-3">
                                        Social Network
                                    </h3>
                                    <div class="form-row">
                                        <div class="col-4">
                                            <div class="form-group text-left">
                                                <label>Facebook</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="facebook"
                                                    placeholder="https://www.facebook.com/nome_utente/"
                                                >
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group text-left">
                                                <label>Instagram</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="instagram"
                                                    placeholder="https://www.instagram.com/nome_utente/"
                                                >
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group text-left">
                                                <label>Twitter</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="twitter"
                                                    placeholder="https://www.twitter.com/nome_utente"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="my-3">
                                        Instant Messaging
                                    </h3>
                                    <div class="form-row">
                                        <div class="col-4">
                                            <div class="form-group text-left">
                                                <label>Facebook Messenger</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="facebook_messenger"
                                                    placeholder="incolla link al tuo messenger"
                                                >
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group text-left">
                                                <label>Telegram</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="telegram"
                                                    placeholder="url di invito ad unirsi al gruppo del negozio"
                                                >
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group text-left">
                                                <label>Whatsapp</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="whatsapp"
                                                    placeholder="es: +391234467059"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="alert alert-danger my-3" v-if="errorMsg">
                                        <span class="error">{{errorMsg}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tab-content>
                    <tab-content
                        class="py-3"
                        title="Carica Prodotti"
                        :before-change="validateProduct"
                    >
                        <div class="alert alert-info d-flex w-100 p-3 shadow">
                            <p class="m-auto font-weight-bold h5 p-2 text-center">
                                I campi contrassegnati con l'asterisco rosso sono necessari, gli altri possono essere lasciati vuoti
                            </p>
                        </div>
                        <div class="card card-min-height bg-white shadow rounded">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h3 class="mb-3">
                                    Crea il tuo primo prodotto
                                </h3>
                                <div class="my-auto w-100">
                                    <div class="alert alert-info d-flex flex-wrap w-100 p-3">
                                        <p class="w-100 font-weight-bold h5 p-2 text-center">
                                            I campi contrassegnati con l'asterisco rosso sono necessari, gli altri possono essere lasciati vuoti.
                                        </p>
                                        <p class="w-100 font-weight-bold h5 p-2 text-center">
                                            Il campo codice prodotto è un identificativo a vostro uso interno, può essere anche semplicemente un numero, l'importante è che sia univoco per ogni prodotto
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-row">
                                                <div class="col-12 text-left">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input id="insert_sku" class="form-check-input" type="checkbox" v-model="insert_sku">
                                                            <label class="form-check-label" for="insert_sku">Inserire Manualmente Codice Prodotto</label>
                                                        </div>
                                                        <div v-if="insert_sku">
                                                            <label>Codice Prodotto<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                            <input type="text" class="form-control" v-model="product_sku">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nome<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                        <input type="text" class="form-control" v-model="product_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <!-- <div class="col-6 text-left">
                                                    <div class="form-group text-left">
                                                        <label>Prezzo<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control" v-model="product_price">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-dark" disabled>
                                                                    <i class="fa fa-euro-sign"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->

                                                <!-- prezzo unitario, lunghezza e peso-->
                            <div class="row m-1 px-0">
                                <!-- unitario -->
                                <div class="col col-12 col-md-12 px-0">
                                    <input
                                        id="unitPrice"
                                        type="radio"
                                        value="true"
                                        name="price"
                                        v-model="showPrice"
                                        v-on:click="showSize=false, showWeight=false"
                                        />
                                    <label for="unitPrice">Inserisci Prezzo unitario</label>
                                    <div class="row">
                                        <div class="form-group col-4" v-if="showPrice">
                                            <label for="article-price">Prezzo *</label>
                                            <div class="d-flex flex-row">
                                                <input
                                                    type="number"
                                                    min="0.00"
                                                    max="10000.00"
                                                    step="0.01"
                                                    class="form-control"
                                                    name="price"
                                                    id="article-price"
                                                    v-model="product_price"
                                                    required
                                                />
                                                <button><i class="bi bi-currency-euro">€</i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /unitario -->
                                    <br>
                                    <!-- lunghezza -->
                                    <input
                                        id="size"
                                        type="radio"
                                        value="true"
                                        name="price"
                                        v-model="showSize" v-on:click="showPrice=false, showWeight=false"/>
                                    <label for="size">Inserisci Prezzo per Lunghezza</label>
                                    <div
                                        class="form-group col-12"
                                        v-if="showSize"
                                    >
                                        <div class="row mr-1">
                                             <div class="col col-12 col-md-4">
                                                <label for="">U. Misura:</label>
                                                <select
                                                    class="form-control"
                                                    v-model="infoPrice.size.unit"
                                                >
                                                    <option
                                                        v-for="(item,
                                                        index) in unit_size"
                                                        :key="index"
                                                        :value="item"
                                                        >{{ item }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col col-12 col-md-8">
                                                <label for="article-size">Prezzo al: *</label>
                                                <div class="d-flex flex-row">
                                                    <input
                                                        id="article-size"
                                                        type="number"
                                                        min="0.00"
                                                        max="10000.00"
                                                        step="0.01"
                                                        v-model="product_price"
                                                        class="form-control"
                                                    />
                                                    <button><i class="bi bi-currency-euro">€</i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /lunghezza -->

                                <!-- peso -->
                                <div class="col col-12 col-md-12 px-0">
                                    <input
                                        id="weight"
                                        type="radio"
                                        value="true"
                                        name="price"
                                        v-model="showWeight"
                                        v-on:click="showPrice=false, showSize=false"
                                    />
                                    <label for="weight">Inserisci Prezzo per Peso</label>
                                    <div
                                        class="form-group col-12"
                                        v-if="showWeight"
                                    >
                                        <div class="row mr-1">
                                            <div class="col col-12 col-md-4">
                                                <label for="weight">U. Misura</label>
                                                <select
                                                    class="form-control"
                                                    v-model="infoPrice.weight.unit"
                                                >
                                                    <option
                                                        v-for="(item,
                                                        index) in unit_weight"
                                                        :key="index"
                                                        :value="item"
                                                        >{{ item }}</option
                                                    >
                                                </select>
                                            </div>
                                            <div class="col col-12 col-md-8">
                                                <label for="">Prezzo al: *</label>
                                                <div class="d-flex flex-row">
                                                    <input
                                                        type="number"
                                                        min="0.00"
                                                        max="10000.00"
                                                        step="0.01"
                                                        v-model="product_price"
                                                        class="form-control"
                                                    />
                                                    <button><i class="bi bi-currency-euro">€</i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /prezzo unitario, lunghezza e peso -->


                                                <div class="col-6 d-flex">
                                                    <div class="form-group w-100 text-left">
                                                        <label>Immagine Prodotto<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                        <input type="file" hidden ref="selectProductImage" @input="onSelectProductImage()">
                                                        <button class="btn btn-outline-info mt-auto ml-auto btn-block" @click="selectProductImage()">
                                                            {{ product_image_preview ? 'Cambia immagine' : 'Scegli immagine' }}
                                                        </button>
                                                    </div>
                                                    <div v-if="productImageError" class="alert alert-danger">
                                                        {{productImageError}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2" v-if="product_image">
                                            <div class="form-group">
                                                <label>Anteprima Quadrata</label>
                                                <div class="col-12 border rounded h-100 p-0 overflow-hidden height-fit-content" :class="{ 'height-fit-content' : product_image_preview }">
                                                    <!-- <img class="w-100" style="object-fit:cover" :src="logo_preview" v-if="logo_preview"> -->
                                                    <div style="height:0px; padding-top:100%; overflow:hidden;" :style="product_preview_style"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4" v-if="product_image">
                                            <div class="form-group h-75">
                                                <label>Anteprima Rettangolare</label>
                                                <div class="col-12 border rounded h-100 p-0 overflow-hidden" :class="{ 'height-fit-content' : product_image_preview }">
                                                    <div style="height:0px; padding-top:56.25%; overflow:hidden;" :style="product_preview_style"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-row">
                                                <div class="col-12 text-left">
                                                    <div class="form-group">
                                                        <label>Descrizione Breve Prodotto<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                        <textarea class="form-control" v-model="product_description"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Descrizione Lunga Prodotto<i class="fa fa-asterisk ml-1 text-danger"></i></label>
                                                        <vue-editor
                                                            v-model="product_long_description"
                                                        ></vue-editor>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="alert alert-danger my-3" v-if="errorMsg">
                                        <span class="error">{{errorMsg}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tab-content>
                    <tab-content class="py-3" title="Riassunto">
                        <div class="card card-min-height bg-white rounded shadow">
                            <div class="card-body d-flex flex-column justify-content-center p-5">
                                <h2 class="mb-4">
                                    Grazie per esserti registrato su Spesavicino.it! 🙌
                                </h2>
                                <p style="font-size:1.2rem" class="my-auto text-center">
                                    Clicca sul bottone <strong>'Fine'</strong> in basso a destra per terminare il processo di registrazione.
                                </p>
                                <p style="font-size:1.2rem" class="my-auto text-center">
                                    In seguito verrai reindirizzato alla tua pagina personale in cui potrai modificare in ogni momento le informazioni del tuo negozio,
                                    aggiungere nuovi prodotti e gestire i tuoi ordini
                                </p>
                            </div>
                        </div>
                    </tab-content>
                </form-wizard>
            </div>
        </div>
    </div>
</template>
<script>
    import { VueEditor } from "vue2-editor";
    import VueTimepicker from "vue2-timepicker"
    import {FormWizard, TabContent} from 'vue-form-wizard'
    import 'vue-form-wizard/dist/vue-form-wizard.min.css'

    export default {
        name: 'registrationWizard',
        components: {
            FormWizard,
            TabContent,
            VueTimepicker,
            VueEditor
        },
        data(){
            return {
                tab_index:0,
                valid: true,
                logoError: "",
                coverError: "",
                productImageError: "",
                // address tab
                address:null,
                city:null,
                zip_code:null,
                province:null,

                // shop info tab
                shop_name:null,
                shop_description:null,
                logo:null,
                logo_preview:null,
                cover:null,
                cover_preview:null,
                slug:null,

                // services tab
                does_takeaway:false,
                does_delivery:false,
                does_shipment:false,
                name_shipment:null,
                shipment_charge:null,
                min_shipment:null,
                free_shipment: null,
                min_order:null,
                input_district:null,
                districts_list:null,
                selected_district:null,
                delivery_charge:null,
                shipments:[],
                selected_zip_codes: [],
                caps:[],


                showPrice: true,
                showSize: false,
                showWeight: false,
                unit_weight: ["kg", "hg", "g", "lt", "ml"],
                unit_size: ["mm", "cm", "mt"],
                infoPrice: {
                    weight: {
                        unit: "",
                        value: "",
                        price: ""
                    },
                    size: {
                        unit: "",
                        value: "",
                        price: ""
                    },
                    size_list: "",
                    color_list: ""
                },


                // opening hours
                selected_day_id:null,
                days: [
                    {
                        name: 'Lunedì',
                        schedule_type: 'standard',
                        schedule: {
                            am_init: '08:00',
                            am_end: '12:00',
                            pm_init: '13:00',
                            pm_end: '18:00',
                            all_day_init: '08:00',
                            all_day_end: '18:00'
                        }
                    },
                    {
                        name: 'Martedì',
                        schedule_type: 'standard',
                        schedule: {
                            am_init: '08:00',
                            am_end: '12:00',
                            pm_init: '13:00',
                            pm_end: '18:00',
                            all_day_init: '08:00',
                            all_day_end: '18:00'
                        }
                    },
                    {
                        name: 'Mercoledì',
                        schedule_type: 'standard',
                        schedule: {
                            am_init: '08:00',
                            am_end: '12:00',
                            pm_init: '13:00',
                            pm_end: '18:00',
                            all_day_init: '08:00',
                            all_day_end: '18:00'
                        }
                    },
                    {
                        name: 'Giovedì',
                        schedule_type: 'standard',
                        schedule: {
                            am_init: '08:00',
                            am_end: '12:00',
                            pm_init: '13:00',
                            pm_end: '18:00',
                            all_day_init: '08:00',
                            all_day_end: '18:00'
                        }
                    },
                    {
                        name: 'Venerdì',
                        schedule_type: 'standard',
                        schedule: {
                            am_init: '08:00',
                            am_end: '12:00',
                            pm_init: '13:00',
                            pm_end: '18:00',
                            all_day_init: '08:00',
                            all_day_end: '18:00'
                        }
                    },
                    {
                        name: 'Sabato',
                        schedule_type: 'standard',
                        schedule: {
                            am_init: '08:00',
                            am_end: '12:00',
                            pm_init: '13:00',
                            pm_end: '18:00',
                            all_day_init: '08:00',
                            all_day_end: '18:00'
                        }
                    },
                    {
                        name: 'Domenica',
                        schedule_type: 'standard',
                        schedule: {
                            am_init: '08:00',
                            am_end: '12:00',
                            pm_init: '13:00',
                            pm_end: '18:00',
                            all_day_init: '08:00',
                            all_day_end: '18:00'
                        }
                    },
                ],

                // contacts & web
                phone:null,
                email:null,
                website:null,
                facebook:null,
                instagram:null,
                twitter:null,
                facebook_messenger:null,
                telegram:null,
                whatsapp:null,

                // product
                insert_sku:false,
                product_sku: null,
                product_name:null,
                product_description:null,
                product_long_description:null,
                product_price:null,
                product_image:null,
                product_image_preview:null,

                msg_error:null,
                error:false,
                msg_success:null,
                success:false,

                info: {
                    description: "",
                    phone: "",
                    email: "",
                    website: "",
                    zip_codes: [],
                    min_order: "",
                    shipments: [],
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
                    payments: {
                        cash: {
                            checked: true
                        },
                        card: {
                            checked: false,
                            stripe_key: ''
                        },
                        transfer: {
                            checked: false,
                            iban_code: '',
                            name: '',
                            number:''
                        }
                    },
                    timeslots: []
                },

                count: 0,
                errorMsg:null,
            }
        },
        computed: {
            cover_style: function() {
                return {
                    backgroundImage: 'url(' + this.cover_preview + ')',
                    backgroundSize: 'cover',
                    backgroundPosition: 'center',
                    backgroundRepeat: 'no-repeat'
                }
            },
            logo_style: function() {
                return {
                    backgroundImage: 'url(' + this.logo_preview + ')',
                    backgroundSize: 'cover',
                    backgroundPosition: 'center',
                    backgroundRepeat: 'no-repeat'
                }
            },
            product_preview_style: function() {
                return {
                    backgroundImage: 'url(' + this.product_image_preview + ')',
                    backgroundSize: 'cover',
                    backgroundPosition: 'center',
                    backgroundRepeat: 'no-repeat'
                }
            },
        },
        watch: {
            input_district: function() {
                this.districtsAPI()
            },
            zip_code: function () {
                this.handleBlurZipCode()
            }
        },
        mounted() {
            this.getSlug()
            console.log(this.$refs.wizard.activeTabIndex)
        },
        methods: {
            addShipment() {
                if(!this.name_shipment || !this.shipment_charge) {
                    this.errorMsg = "Controllare di aver compilato correttamente tutti i campi per l'invio"
                } else {
                     let shipment = {'name': this.name_shipment, 'charge': this.shipment_charge*100, 'min_ship': this.min_shipment*100, 'free_ship': this.free_shipment*100}
                    this.shipments.push(shipment)
                    this.name_shipment = ""
                    this.shipment_charge = ""
                    this.min_shipment = ""
                    this.free_shipment = ""
                }
            },
            handleBlurZipCode() {
                let token = this.$store.state.token
                const config = {
                    headers: { Authorization: `Bearer ${token}` }
                }
                axios
                    .get(`/api/zip/${this.zip_code}`, config)
                    .then(response => {
                        console.log(response.data.data[0])
                        this.province = response.data.data[0].district.sigla
                        this.city = response.data.data[0].district.nome
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            getSlug() {
                let token = this.$store.state.token
                const config = {
                    headers: { Authorization: `Bearer ${token}` }
                }
                axios
                    .get(`/api/retails/${this.$attrs.retailer_id}/get_slug`, config)
                    .then(response => {
                        this.slug = response.data.data
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            validateAddress() {
                return new Promise((resolve, reject) => {
                    if(!this.address || !this.zip_code || !this.city || !this.province) {
                        this.errorMsg = 'Controllare di aver compilato correttamente tutti i campi'
                        reject(false)
                    } else {
                        this.errorMsg = null
                        this.getGeo()
                        resolve(true)
                    }
                })
            },
            validateShopInfo() {
                return new Promise((resolve, reject) => {
                    if(!this.shop_name || !this.shop_description || !this.cover) {
                        this.errorMsg = 'Controllare di aver compilato correttamente tutti i campi e di aver selezionato almeno un\'immagine di copertina'
                        reject(false)
                    } else {
                        this.errorMsg = null
                        resolve(true)
                    }
                })
            },
            validateServices() {
                return new Promise((resolve, reject) => {
                    if(!this.does_delivery && !this.does_takeaway && !this.does_shipment) {
                        this.errorMsg = 'Selezionare almeno un servizio tra asporto, consegna a domicilio o spedizione'
                        reject(false)
                    } else if(this.does_delivery) {
                        if(!this.min_order || !this.delivery_charge || !this.caps.length || this.caps.length < 1) {
                            this.errorMsg = 'Controllare di aver compilato correttamente tutti i campi e di aver selezionato almeno un CAP per cui rendere il servizio disponibile'
                            reject(false)
                        } else {
                            this.errorMsg = null
                            resolve(true)
                        }
                    } else if(this.does_shipment) {
                        if(this.shipments.length === 0) {
                            this.errorMsg = "Controllare di aver compilato correttamente tutti i campi per l'invio"
                            reject(false)
                        } else {
                            this.errorMsg = null
                            resolve(true)
                        }
                    } else {
                        this.errorMsg = null
                        resolve(true)
                    }
                })
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
            validateContacts() {
                let isWebUrl = this.checkUrls(this.website);
                let isFecebookUrl = this.checkUrls(this.facebook);
                let isTwitterUrl = this.checkUrls(this.twitter);
                let isInstagramUrl = this.checkUrls(this.instagram);
                return new Promise((resolve, reject) => {
                    if(!this.phone || !this.email) {
                        this.errorMsg = 'Controllare di aver compilato correttamente i campi contrassegnati con l\'asterisco'
                        reject(false)
                    } else if(!isWebUrl || !isFecebookUrl || !isTwitterUrl || !isInstagramUrl) {
                        this.errorMsg = 'Controllare che gli inirizzi web siano validi'
                        reject(false)
                    } else {
                        this.errorMsg = null
                        resolve(true)
                    }
                })
            },
            validateProduct() {
                return new Promise((resolve, reject) => {
                    if(this.insert_sku && !this.product_sku || !this.product_name || !this.product_description || !this.product_long_description || !this.product_price || !this.product_image) {
                        this.errorMsg = 'Controllare di aver compilato correttamente tutti i campi'
                        reject(false)
                    } else {
                        this.errorMsg = null
                        this.completeRegistration()
                        resolve(true)
                    }
                })
            },
            handleValidation(isValid, tabIndex){
                console.log('Tab: '+tabIndex+ ' valid: '+isValid)
                window.scrollTo(0,0)
            },
            districtsAPI() {
                axios
                    .get(`/api/districts/${this.input_district}`)
                    .then(response => {
                        this.districts_list = response.data.data
                    })
            },

            districtSelect(district) {
                console.log('district', district);
                this.selected_district = district
                this.input_district = null;
                this.selected_district.zipcodes.forEach(zip => {
                    if (this.caps.indexOf(zip.codice + ' - ' + district.nome) == -1) {
                        this.caps.push(zip.codice + ' - ' + district.nome)
                    }
                });
                this.districts_list = null;
            },

            deleteCap(cap) {
                this.caps.splice(this.caps.indexOf(cap), 1);
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

            async onComplete() {
                this.redirectToInfo()
            },

            selectLogo() {
                this.logoError = ""
                this.$refs.selectLogo.click()
            },

            selectCover() {
                this.coverError = ""
                this.$refs.selectCover.click()
            },

            selectProductImage() {
                this.productImageError = ""
                this.$refs.selectProductImage.click()
            },

            onSelectLogo() {
                const input = this.$refs.selectLogo
                const files = input.files
               
                if (files && files[0]) {
                        if(files[0].size > 800000) {
                            this.logoError = `L'immagine troppo pesante (massimo consentito: 800kb).`;
                            this.valid = false;
                            return;
                        }
                        this.logo = files[0]
                        this.logo_preview = URL.createObjectURL(input.files[0]);
                }
            },

            onSelectCover() {
                const input = this.$refs.selectCover
                const files = input.files
                
                if (files && files[0]) {
                        if(files[0].size > 1200000) {
                            this.coverError = `L'immagine troppo pesante (massimo consentito: 1200kb).`;
                            this.valid = false;
                            return;
                        }
                        this.cover = files[0]
                        this.cover_preview = URL.createObjectURL(input.files[0]);
                }
            },

            onSelectProductImage() {
                const input = this.$refs.selectProductImage
                const files = input.files
                if (files && files[0]) {
                    if(files[0].size > 1200000) {
                            this.productImageError = `L'immagine troppo pesante (massimo consentito: 1200kb).`;
                            this.valid = false;
                            return;
                    }
                    this.product_image = files[0]
                    this.product_image_preview = URL.createObjectURL(input.files[0])
                }
            },

            getGeo() {
                var addressObj = {
                    address_line_1: this.address,
                    address_line_2: "",
                    city: this.city,
                    state: "",
                    zip_code: this.zip_code,
                    country: "Italy"
                };

                this.$geocoder.send(addressObj, response => {
                    this.info.geo.lat = response.results[0].geometry.location.lat;
                    this.info.geo.lng = response.results[0].geometry.location.lng;
                });
            },

            compileInfo() {

                this.info.description = this.shop_description
                this.info.phone = this.phone
                this.info.email = this.email
                this.info.website = this.website
                this.info.zip_codes = this.caps
                this.info.min_order = this.min_order*100
                this.info.social.facebook = this.facebook
                this.info.social.twitter = this.twitter
                this.info.social.instagram = this.instagram
                this.info.im.whatsapp = this.whatsapp
                this.info.im.fb_messenger = this.facebook_messenger
                this.info.im.telegram = this.telegram
                this.info.shipments = this.shipments
                this.info.does_shipment = this.does_shipment,
                this.getGeo()

                this.days.forEach((day, index) => {
                    let timeslot = {
                        id: index+1,
                        name: day.name,
                        opening_schedule: day.schedule_type,
                        delivery_schedule: day.schedule_type,
                        takeaway_schedule: day.schedule_type,
                        delivery_hours: [],
                        takeaway_hours: [],
                        opening_hours: [],
                    }

                    switch (day.schedule_type) {
                        case 'standard':
                            timeslot.opening_hours.push({
                                start: day.schedule.am_init,
                                end: day.schedule.am_end
                            })

                            timeslot.opening_hours.push({
                                start: day.schedule.pm_init,
                                end: day.schedule.pm_end
                            })
                            break;

                        case 'am_only':
                            timeslot.opening_hours.push({
                                start: day.schedule.am_init,
                                end: day.schedule.am_end,
                            })
                            break;

                        case 'pm_only':
                            timeslot.opening_hours.push({
                                start: day.schedule.pm_init,
                                end: day.schedule.pm_end,
                            })
                            break;

                        case 'all_day':
                            timeslot.opening_hours.push({
                                start: day.schedule.am_init,
                                end: day.schedule.pm_end,
                            })
                            break;

                        default:
                            break;
                    }

                    timeslot.delivery_hours = timeslot.opening_hours
                    timeslot.takeaway_hours = timeslot.opening_hours

                    this.info.timeslots[index] = timeslot
                })
            },

            getItems() {
                let token = this.$store.state.token
                const config = {
                    headers: { Authorization: `Bearer ${token}` }
                }
                axios
                    .get(`/api/retails/${this.$attrs.retailer_id}/items`, config)
                    .then(response => {
                        return response.data.data
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },

            storeItem() {
                let items = this.getItems()
                let duplicates = []
                if(!this.insert_sku) {
                    this.product_sku = (Date.now().toString(36).substr(2, 5) + Math.random().toString(36).substr(2, 5)).toUpperCase()
                }
                if(items && items.length > 0) {
                    duplicates = items.filter(item => {
                        return item.sku == this.product_sku
                    })
                }

                let config = {
                    header: {
                        'content-type': 'multipart/form-data'
                    }
                }

                if(duplicates.length > 0) {
                    this.success = false
                    this.msg_error = 'Codice articolo duplicato'
                    this.error = true
                } else {
                    this.error = false
                    let data = new FormData()
                    data.append('retailer_vat', this.$store.state.retailerVat)
                    data.append('sku', this.product_sku),
                    data.append('item_image', this.product_image)
                    axios
                        .post(`/api/image_upload`, data, config)
                        .then(response => {
                            if(response.data.success) {
                                let itemData = {
                                    sku: this.product_sku,
                                    name: this.product_name,
                                    price: this.product_price * 100,
                                    desc: this.product_description,
                                    long_description: this.product_long_description,
                                    info: JSON.stringify(this.infoPrice)
                                }
                                let token = this.$store.state.token
                                let storeItemConfig = {
                                    headers: { Authorization: `Bearer ${token}` }
                                }

                                axios
                                    .post(`/api/retails/${this.$attrs.retailer_id}/items/create`, itemData, storeItemConfig)
                                    .then(storeResponse => {
                                        if(storeResponse.data.success) {
                                            this.error = false
                                            this.msg_success = 'Operazione completata con successo'
                                            this.success = true
                                            console.log(this.msg_success)
                                        } else {
                                            this.success = false
                                            this.msg_error = 'Impossibile completare l\'operazione, qualcosa è andato storto'
                                            this.error = true
                                            console.log(this.msg_error)
                                        }
                                    })
                                    .catch(e => {
                                        console.log(e)
                                    })
                            }
                        })

                }
            },

            storeAddress() {
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.token}`
                    }
                };

                axios
                    .post(
                        `/api/addresses/create`,
                        {
                            city: this.city,
                            address: this.address,
                            province: this.province,
                            zip_code: this.zip_code,
                            retailer_id: this.$attrs.retailer_id
                        },
                        config
                    )
                    .then(response => {
                        localStorage.setItem(
                            "retailer-address-id",
                            response.data.data.id
                        );
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },

            redirectToInfo() {
                this.$router.push(
                    {
                        path: `/publisher/${this.$attrs.publisher_id}/retailer/${this.$attrs.retailer_id}/sharing`,
                        // path: `/azienda/${this.slug}/${this.$store.state.retailerVat}`,
                        params: {
                            publisher_id: this.$attrs.publisher_id,
                            retailer_id: this.$attrs.retailer_id,
                            isLoggedIn: false
                        }
                    }
                );
            },

            completeRegistration() {
                this.storeAddress()
                this.compileInfo()
                let data = {
                    name: this.shop_name,
                    delivery_charge: this.delivery_charge*100,
                    does_delivery: this.does_delivery,
                    does_takeaway: this.does_takeaway,
                    is_published: true,
                    info: JSON.stringify(this.info)
                }

                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.token}`
                    }
                };

                let formData = new FormData()
                formData.append('retailer_vat', this.$store.state.retailerVat)
                formData.append('logo', this.logo)
                formData.append('cover', this.cover)

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
                    .put(`/api/retails/${this.$attrs.retailer_id}`, data, config)
                    .then(response => {
                        if (response.data.success) {
                            this.storeItem()
                        } else {
                            this.success = false
                            this.msg_error = 'Impossibile completare l\'operazione, qualcosa è andato storto'
                            this.error = true
                        }
                    })
                    .catch(e => {
                        console.log(e)
                    })
            }
        },
    }
</script>
<style scoped>
    .card-min-height {
        min-height: 350px;
    }

    .square {
        width: 50%;
    }

    .square:after {
        content: "";
        display: block;
        padding-bottom: 100%;
    }

    .height-fit-content {
        height: fit-content !important;
    }

    /* .cover-preview {
            background: url(this.cover_preview);
            padding-top: 56.25% !important;
    } */

    .district-option:hover {
        font-weight: bold;
        cursor: pointer;
    }
    li {
        float: left;
        color: #333;
    }
</style>
