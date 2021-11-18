<template>
    <div class="container py-5 mt-5" style="min-height:80vh">
        <div class="col-12 d-flex flex-row">
            <div class="row justify-content-start">
                <a class="btn btn-primary text-white mt-2" @click="$router.go(-1)">
                    <i class="fas fa-chevron-circle-left mr-2"></i>
                    Torna alla pagina precedente
                </a>
            </div>
        </div>

        <div class="row mt-3">

            <div class="col-12 my-2 row d-flex justify-content-between" v-if="retailer">
                <div class="ml-3">
                    <h3><strong>{{ retailer.name }}</strong></h3>
                    <h4>{{ retailer.address.address }}</h4>
                    <h4>{{ retailer.address.city }}  -  {{ retailer.address.province }}</h4>
                    <h4>Tel. {{ retailer_info.phone }}  -  {{ retailer_info.email }}</h4>
                </div>
                <div>
                    <h3>Codice Ordine: <strong>{{ order.code }}</strong></h3>
                </div>
                <hr class="w-100">
            </div>

            <div class="col-xs-12 col-lg-6 mb-3">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger" v-show="show_error">
                            {{ error_msg }}
                        </div>
                    </div>
                    <div class="col-12">
                        <!-- orari -->
                        <div class="card shadow mb-3" v-if="!loading_data && user">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12">
                                            <div class="alert alert-warning">
                                                I campi contrassegnati dall'asterisco sono obbligatori
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                             <div class="alert alert-warning" v-if="belowMinOrder">
                                                Il totale è inferiore al minimo per la consegna a domicilio
                                            </div>
                                            <label class="h5">Tipo:</label>

                                            <div class="input-group my-auto">
                                                <div class="form-check pl-0 pr-3">
                                                    <input type="radio" name="order_type" v-model="order_type" :value="'takeaway'" :id="'order_takeaway'">
                                                    <label for="order_takeaway" class="my-auto">Ritiro in negozio</label>
                                                </div>
                                                <div class="form-check pl-0 pr-3">
                                                    <input type="radio" name="order_type" v-model="order_type" :value="'delivery'" :id="'order_delivery'" :disabled="belowMinOrder">
                                                    <label for="order_delivery" class="my-auto">Consegna a domicilio</label>
                                                </div>
                                                <div class="form-check pl-0 pr-3">
                                                    <input type="radio" name="order_type" v-model="order_type" :value="'shipment'" :id="'order_shipment'" :disabled="!retailer_info.does_shipment">
                                                    <label for="order_shipment" class="my-auto">Invio</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="order_type == 'takeaway'">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">*Data:</label>
                                            <select class="form-control" v-model="selected_date">
                                                <option v-for="day in week.filter(day=>day.opening_hours.length>0)" :key="day.index" :value="day.index">
                                                    {{ day.day_name }} {{ day.day_number }} {{ day.month_name }} {{ day.year }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" v-if="order_type == 'delivery'">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">*Data:</label>
                                            <select class="form-control" v-model="selected_date">
                                                <option v-for="day in week.filter(day=>day.delivery_hours.length>0)" :key="day.index" :value="day.index">
                                                    {{ day.day_name }} {{ day.day_number }} {{ day.month_name }} {{ day.year }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                    <!-- ##########################   SHIPMENT SECTION   ################# -->
                                    <div class="col-12 col-md-6 col-lg-12">
                                        <div style="font-size:10pt; margin-left: -10px;" v-if="order_type == 'shipment'">

                                            <div class="" v-for="shipment in retailer_info.shipments" :key="shipment.name">
                                                <input
                                                    v-if="recap.total_price >= shipment.min_ship/100"
                                                    name="shipment_type"
                                                    class="form-check-input"
                                                    type="radio"
                                                    :id="shipment.name"
                                                    v-model="shipment_type"
                                                    :value="shipment.name"
                                                    @change="uniqueCheck(shipment)"
                                                >
                                                <p v-if="recap.total_price < shipment.min_ship/100">
                                                    Invio {{ shipment.name }} minimo spesa {{shipment.min_ship/100}}&euro;
                                                </p>
                                                <label
                                                     v-if="recap.total_price >= shipment.min_ship/100"
                                                    :for="shipment.name">Invio disponibile: {{ shipment.name }}
                                                    <span v-if="shipment.free_ship/100 && recap.total_price >= shipment.free_ship/100">
                                                        (invio gratuito)
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                    <!-- #######################    END SHIPMENT SECTION   ##################### -->
                                    <div class="row" v-if="selected_date != null && order_type == 'delivery'">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">*Fascia Oraria</label>
                                            <select class="form-control" v-model="selected_timeslot" v-if="deliveryHoursLength > 0">
                                                <option v-for="timeslot in week[selected_date].delivery_hours" :key="timeslot.index" :value="timeslot">
                                                    {{ timeslot.start }} - {{timeslot.end}}
                                                </option>
                                            </select>
                                            <div class="alert alert-warning" v-else>
                                                Non disponibile
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="selected_date != null && order_type == 'takeaway'">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">*Fascia Oraria</label>
                                            <select class="form-control" v-model="selected_timeslot" v-if="takeawayHoursLength > 0">
                                                <option v-for="timeslot in week[selected_date].takeaway_hours" :key="timeslot.index" :value="timeslot">
                                                    {{ timeslot.start }} - {{timeslot.end}}
                                                </option>
                                            </select>
                                            <div class="alert alert-warning" v-else>
                                                Non disponibile
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="order_type == 'delivery' && selected_timeslot != null">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">*Numero di Telefono</label>
                                            <input type="text" class="form-control" v-model="phone">
                                        </div>
                                    </div>
                                    <div class="row" v-if="order_type == 'takeaway' && selected_timeslot != null">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">*Numero di Telefono</label>
                                            <input type="text" class="form-control" v-model="phone">
                                        </div>
                                    </div>
                                    <div class="row" v-if="order_type == 'delivery' && phone != null && selected_timeslot != null">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">Note</label>
                                            <textarea class="form-control" rows="2" v-model="order_notes" placeholder="Se vuoi, lascia una nota riguardante il tuo ordine per il negoziante"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- indirizzo delivery-->
                        <div class="card shadow mb-3" v-show="user && !loading_data && order_type == 'delivery' || (order_type == 'shipment' && shipment_type != null)">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row" v-if="!loading_data && user && user.addresses && user.addresses.length > 0">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <div class="input-group my-auto">
                                                <div class="form-check pl-0 pr-3">
                                                    <input type="radio" name="new_address" v-model="userAddress" :value="'new'" id="new_address" @click="userAddress='new'">
                                                    <label for="new_address" class="my-auto">Nuovo Indirizzo</label>
                                                </div>
                                                <div class="form-check pl-0 pr-3">
                                                    <input type="radio" name="new_address" v-model="userAddress" :value="'old'" id="old_address" @click="userAddress='old'">
                                                    <label for="old_address" class="my-auto">Scegli fra i tuoi indirizzi</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="!loading_data && user && user.addresses && userAddress=='old'">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">Indirizzi associati:</label>
                                            <select class="form-control" v-model="address">
                                                <option v-for="address in user.addresses" :key="address.id" :value="address">
                                                    {{ address.name }} - {{ address.address }}, {{ address.zip_code }}, {{ address.city }} - {{ address.province }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">
                                                *Nome Campanello</label>
                                            <input type="text" class="form-control" v-model="address.name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">
                                                *Indirizzo</label>
                                            <input type="text" class="form-control" v-model="address.address">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4 form-group text-left">
                                            <label for="" class="h5">*CAP</label>
                                            <input type="text" class="form-control" v-model="address.zip_code" @change="handleBlurZipCode">
                                        </div>
                                        <div class="col-xs-12 col-md-4 form-group text-left">
                                            <label for="" class="h5">
                                                *Città</label>
                                            <input type="text" class="form-control" v-model="address.city">
                                        </div>
                                        <div class="col-xs-12 col-md-4 form-group text-left">
                                            <label for="" class="h5">*Provincia</label>
                                            <input type="text" class="form-control" v-model="address.province">
                                        </div>
                                    </div>
                                    <div class="row" v-if="order_type == 'shipment'">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">*Numero di Telefono</label>
                                            <input type="text" class="form-control" v-model="phone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" v-if="order_type=='delivery' && serviced == false">
                            <div class="col-12">
                                <div class="col-12 alert alert-danger text-center">
                                    <p class="m-0 p-2">
                                        <strong>Questo negoziante non consegna nella zona selezionata.</strong><br>
                                        Immettere un altro indirizzo o selezionare un'altra modalità di consegna/ritiro
                                    </p>
                                </div>
                            </div>
                        </div>

                    <!-- indirizzo shipment-->
                        <!-- <div class="card shadow mb-3" v-show="user && !loading_data && order_type == 'shipment' && shipment_type != null">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row" v-if="!loading_data && user && user.addresses && user.addresses.length > 0">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <div class="input-group my-auto">
                                                <div class="form-check pl-0 pr-3">
                                                    <input type="radio" name="new_address" v-model="userAddress" :value="'new'" id="new_address">
                                                    <label for="new_address" class="my-auto">Nuovo Indirizzo</label>
                                                </div>
                                                <div class="form-check pl-0 pr-3">
                                                    <input type="radio" name="new_address" v-model="userAddress" :value="'old'" id="old_address">
                                                    <label for="old_address" class="my-auto">Scegli fra i tuoi indirizzi</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="!loading_data && user && user.addresses && userAddress=='old'">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">Indirizzi associati:</label>
                                            <select class="form-control" v-model="address">
                                                <option v-for="address in user.addresses" :key="address.id" :value="address">
                                                    {{ address.name }} - {{ address.address }}, {{ address.zip_code }}, {{ address.city }} - {{ address.province }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">
                                                *Nome Campanello</label>
                                            <input type="text" class="form-control" v-model="address.name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">
                                                *Indirizzo</label>
                                            <input type="text" class="form-control" v-model="address.address">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4 form-group text-left">
                                            <label for="" class="h5">*CAP</label>
                                            <input type="text" class="form-control" v-model="address.zip_code" @change="handleBlurZipCode">
                                        </div>
                                        <div class="col-xs-12 col-md-4 form-group text-left">
                                            <label for="" class="h5">
                                                *Città</label>
                                            <input type="text" class="form-control" v-model="address.city">
                                        </div>
                                        <div class="col-xs-12 col-md-4 form-group text-left">
                                            <label for="" class="h5">*Provincia</label>
                                            <input type="text" class="form-control" v-model="address.province">
                                        </div>
                                    </div>

                                    <div class="row" v-if="order_type == 'shipment'">
                                        <div class="col-xs-12 col-md-12 form-group text-left">
                                            <label for="" class="h5">*Numero di Telefono</label>
                                            <input type="text" class="form-control" v-model="phone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- login/register -->
                        <div class="card shadow mb-3" v-show="!user && !loading_data">
                            <div class="card-body">
                                <!-- <div class="alert alert-danger" v-show="show_error">
                                    {{ error_msg }}
                                </div> -->

                                <!-- login -->
                                <div class="alert alert-danger" role="alert" v-if="alert">
                                    Questo utente non puó comprare nel suo proprio negozio
                                </div>
                                <div class="col-12">
                                    <div class="row justify-content-center" v-show="!show_register">
                                        <div class="col-xs-10 col-md-8 form-group text-left">
                                            <label for="" class="h5">Email</label>
                                            <input type="email" class="form-control" v-model="email">
                                        </div>
                                        <div class="col-xs-10 col-md-8 form-group text-left">
                                            <label for="" class="h5">Password</label>
                                            <input type="password" class="form-control" v-model="password">
                                        </div>
                                        <div class="col-xs-10 col-md-8">
                                            <button class="btn btn-block btn-primary" @click="login()">
                                                Accedi
                                            </button>
                                        </div>
                                        <div class="col-xs-10 col-md-8 mt-2">
                                            <p>se non sei ancora registrato, clicca sul bottone qui sotto per registrarti</p>
                                        </div>
                                        <div class="col-xs-10 col-md-8">
                                            <button class="btn btn-block btn-secondary text-white" @click="show_register = true">
                                                Registrati
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- registrazione -->
                                <div class="col-12" v-show="show_register">
                                    <div class="row justify-content-center">
                                        <div class="col-xs-10 col-md-8 form-group text-left">
                                            <label for="" class="h5">Nome</label>
                                            <input type="text" class="form-control" v-model="name">
                                        </div>
                                        <div class="col-xs-10 col-md-8 form-group text-left">
                                            <label for="" class="h5">Email</label>
                                            <input type="email" class="form-control" v-model="email">
                                        </div>
                                        <div class="col-xs-10 col-md-8 form-group text-left">
                                            <label for="" class="h5">Password</label>
                                            <input type="password" class="form-control" v-model="password">
                                        </div>
                                        <div class="col-xs-10 col-md-8 form-group text-left">
                                            <label for="" class="h5">Conferma Password</label>
                                            <input type="password" class="form-control" v-model="password_confirmation">
                                        </div>
                                        <div class="form-check my-1">
                                            <input type="checkbox" id="privacy" class="form-check-input" required v-model="privacy">
                                            <label id="privacy" class="form-check-label" for="privacy">
                                                Dichiaro di aver letto e compreso le finalità e le modalità del <a href="/Condizioni" target="_blank">trattamento dei dati personali</a>
                                            </label>
                                        </div>
                                        <div class="col-xs-10 col-md-8">
                                            <button class="btn btn-block btn-primary" @click="register()">
                                                Registrati
                                            </button>
                                        </div>
                                        <div class="col-xs-10 col-md-8 mt-2">
                                            <p>se sei già un utente registrato, clicca sul bottone qui sotto per accedere</p>
                                        </div>
                                        <div class="col-xs-10 col-md-8">
                                            <button class="btn btn-block btn-secondary text-white" @click="show_register = false">
                                                Accedi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- cart recap -->
            <div class="col-xs-12 col-lg-6 mb-3">
                <div class="card shadow">
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Articolo</th>
                                    <th>Quantità</th>
                                    <th>Prezzo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in items_list" :key="item.index">
                                    <td>{{ item.item.name }}
                                       <!-- <span v-if="item.variation.parent">
                                        ({{ item.variation.parent}} - {{ item.variation.child }})
                                        </span> -->


                                    </td>
                                    <td>{{ item.qty }}<span v-if="item && item.item && item.item.info && JSON.parse(item.item.info).size.unit">
                                            {{ JSON.parse(item.item.info).size.unit }}
                                        </span><span v-if="item && item.item && item.item.info && JSON.parse(item.item.info).weight.unit">
                                            {{ JSON.parse(item.item.info).weight.unit }}
                                        </span></td>
                                    <td>{{ ((item.item.price * item.qty)/100).toFixed(2) }}&euro;</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6 text-right">
                                Articoli: {{ recap.items_number }}
                            </div>
                            <div class="col-6 text-center">
                                Totale articoli: {{ recap.total_price.toFixed(2) }}&euro;
                            </div>
                        </div>
                        <div class="row" v-if="order_type == 'delivery'">
                            <div class="col-6 text-right">
                                Consegna: {{ retailer.delivery_charge/100 }}&euro;
                            </div>
                            <div class="col-6 text-center">
                                Totale: {{ totalWithDelivery.toFixed(2) }}&euro;
                            </div>
                        </div>
                        <div class="row" v-if="order_type == 'shipment' && shipment_type != null">
                            <div v-if="!is_free" class="col-6 text-center">
                                Invio: {{ shipment_type.charge/100 }}&euro;
                            </div>
                            <div v-if="is_free" class="col-6 text-right">
                                Invio: Gratis
                            </div>
                            <div class="col-6 text-center">
                                Totale: {{ totalWithShipment.toFixed(2) }}&euro;
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="alert alert-warning mt-3 border-warning shadow"
                    v-if="
                            order_type == 'takeaway' && (selected_date == null || !selected_timeslot || !phone) ||
                            (order_type == 'delivery' && (!address.name || !address.address || !address.zip_code || !address.city || !address.province)) ||
                            (order_type == 'shipment' && (!address.name || !address.address || !address.zip_code || !address.city))
                        "
                >
                    <p class="p-1 m-0">
                        <strong>Attenzione!</strong><br>
                        Compilare tutti i campi per procedere.
                    </p>
                </div>

        <!-- modalita di pagamento delivery -->
                <!-- <div class="row mt-3">
                    <div class="col-xs-12 col-lg-6 mb-3"> -->
                        <div class="card shadow mt-3" v-if="phone != null && selected_timeslot != null && addressCompleteDelivery">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <label class="h5">Modalità di pagamento</label>
                                    </div>
                                    <div class="row">
                                        <div class="input-group my-auto">
                                            <div class="form-check pl-0 pr-3">
                                                <input type="radio" name="payment_type" v-model="payment_type" :value="'cash'" :id="'cash_payment'" :disabled="!retailer_info.payments.cash.checked">
                                                <label class="my-auto" v-if="order_type == 'delivery'">Paga al ritiro/consegna</label>
                                                <label class="my-auto" v-else>Pagamento al ritiro/consegna</label>
                                            </div>
                                            <div class="form-check pl-0 pr-3">
                                                <input type="radio" name="payment_type" v-model="payment_type" :value="'card'" :id="'card_payment'" :disabled="!retailer_info.payments.card.checked">
                                                <label class="my-auto">Carta di Credito</label>
                                            </div>
                                            <div class="form-check pl-0 pr-3">
                                                <input type="radio" name="payment_type" v-model="payment_type" :value="'transfer'" :id="'transfer_payment'" :disabled="!retailer_info.payments.transfer.checked">
                                                <label class="my-auto">Bonifico</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-12 mt-3 p-0" v-if="payment_type == 'cash'">
                                            <button :disabled="
                                                (order_type == 'takeaway' && (selected_date == null || !selected_timeslot || !phone)) ||
                                                (order_type == 'delivery' && (!address.name || !address.address || !address.zip_code || !address.city || !address.province || !serviced))
                                                " class="btn btn-block btn-primary" @click="saveAddress()">Conferma Ordine</button>
                                        </div>

                                        <div class="col-12 mt-3 p-0" v-if="payment_type == 'card'">
                                            <!-- <payment :amount-prop="totalWithDelivery*100" :msg-prop="'Spesavicino.it - ' + order.code" :pkProp="retailer_info.payments.card.stripe_key" :skProp="retailer_info.payments.card.stripe_secret_key"></payment> -->
                                            <button
                                                class="btn btn-block btn-primary" @click="saveAddress()"
                                                :disabled="
                                                    (order_type == 'takeaway' && (selected_date == null || !selected_timeslot || !phone)) ||
                                                    (order_type == 'delivery' && (!address.name || !address.address || !address.zip_code || !address.city || !address.province || !serviced))
                                                "
                                            >
                                                    Paga con Carta di Credito
                                            </button>
                                        </div>

                                        <div class="col-12 mt-3 p-0" v-if="payment_type == 'transfer'">
                                            <div class="alert alert-warning" v-if="retailer_info.payments.transfer.notes">
                                                {{ retailer_info.payments.transfer.notes }}
                                            </div>
                                            <div class="alert alert-danger">
                                                Come causale del bonifico, indicare il codice dell'ordine<br>(reperibile in cima alla pagina)
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-4 text-left my-1"><strong>Intestatario:</strong></div>
                                                <div class="col-7 text-left my-1">{{ retailer_info.payments.transfer.name }}</div>
                                                <div class="col-4 text-left my-1"><strong>Codice IBAN:</strong></div>
                                                <div class="col-7 text-left my-1">{{ retailer_info.payments.transfer.iban_code }}</div>
                                                <div class="col-4 text-left my-1"><strong>Numero Conto:</strong></div>
                                                <div class="col-7 text-left my-1">{{ retailer_info.payments.transfer.number }}</div>
                                                <div class="col-4 text-left my-1"><strong>Banca:</strong></div>
                                                <div class="col-7 text-left my-1">{{ retailer_info.payments.transfer.bank }}</div>
                                            </div>
                                            <button :disabled="
                                                    (order_type == 'takeaway' && (selected_date == null || !selected_timeslot || !phone)) ||
                                                    (order_type == 'delivery' && (!address.name || !address.address || !address.zip_code || !address.city || !address.province || !serviced))
                                                "
                                                class="btn btn-block btn-primary mt-3" @click="saveAddress()">Conferma Ordine</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow mt-3" v-if="phone != null && selected_timeslot != null && order_type == 'takeaway'">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <label class="h5">Modalità di pagamento</label>
                                    </div>
                                    <div class="row">
                                        <div class="input-group my-auto">
                                            <div class="form-check pl-0 pr-3">
                                                <input type="radio" name="payment_type" v-model="payment_type" :value="'cash'" :id="'cash_payment'" :disabled="!retailer_info.payments.cash.checked">
                                                <label class="my-auto" v-if="order_type == 'delivery'">Paga al ritiro/consegna</label>
                                                <label class="my-auto" v-else>Pagamento al ritiro/consegna</label>
                                            </div>
                                            <div class="form-check pl-0 pr-3">
                                                <input type="radio" name="payment_type" v-model="payment_type" :value="'card'" :id="'card_payment'" :disabled="!retailer_info.payments.card.checked">
                                                <label class="my-auto">Carta di Credito</label>
                                            </div>
                                            <div class="form-check pl-0 pr-3">
                                                <input type="radio" name="payment_type" v-model="payment_type" :value="'transfer'" :id="'transfer_payment'" :disabled="!retailer_info.payments.transfer.checked">
                                                <label class="my-auto">Bonifico</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-12 mt-3 p-0" v-if="payment_type == 'cash'">
                                            <button :disabled="
                                                (order_type == 'takeaway' && (selected_date == null || !selected_timeslot || !phone)) ||
                                                (order_type == 'delivery' && (!address.name || !address.address || !address.zip_code || !address.city || !address.province || !serviced))
                                                " class="btn btn-block btn-primary" @click="saveAddress()">Conferma Ordine</button>
                                        </div>

                                        <div class="col-12 mt-3 p-0" v-if="payment_type == 'card'">
                                            <!-- <payment :amount-prop="totalWithDelivery*100" :msg-prop="'Spesavicino.it - ' + order.code" :pkProp="retailer_info.payments.card.stripe_key" :skProp="retailer_info.payments.card.stripe_secret_key"></payment> -->
                                            <button
                                                class="btn btn-block btn-primary" @click="saveAddress()"
                                                :disabled="
                                                    (order_type == 'takeaway' && (selected_date == null || !selected_timeslot || !phone)) ||
                                                    (order_type == 'delivery' && (!address.name || !address.address || !address.zip_code || !address.city || !address.province || !serviced))
                                                "
                                            >
                                                    Paga con Carta di Credito
                                            </button>
                                        </div>

                                        <div class="col-12 mt-3 p-0" v-if="payment_type == 'transfer'">
                                            <div class="alert alert-warning" v-if="retailer_info.payments.transfer.notes">
                                                {{ retailer_info.payments.transfer.notes }}
                                            </div>
                                            <div class="alert alert-danger">
                                                Come causale del bonifico, indicare il codice dell'ordine<br>(reperibile in cima alla pagina)
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-4 text-left my-1"><strong>Intestatario:</strong></div>
                                                <div class="col-7 text-left my-1">{{ retailer_info.payments.transfer.name }}</div>
                                                <div class="col-4 text-left my-1"><strong>Codice IBAN:</strong></div>
                                                <div class="col-7 text-left my-1">{{ retailer_info.payments.transfer.iban_code }}</div>
                                                <div class="col-4 text-left my-1"><strong>Numero Conto:</strong></div>
                                                <div class="col-7 text-left my-1">{{ retailer_info.payments.transfer.number }}</div>
                                                <div class="col-4 text-left my-1"><strong>Banca:</strong></div>
                                                <div class="col-7 text-left my-1">{{ retailer_info.payments.transfer.bank }}</div>
                                            </div>
                                            <button :disabled="
                                                    (order_type == 'takeaway' && (selected_date == null || !selected_timeslot || !phone)) ||
                                                    (order_type == 'delivery' && (!address.name || !address.address || !address.zip_code || !address.city || !address.province || !serviced))
                                                "
                                                class="btn btn-block btn-primary mt-3" @click="saveAddress()">Conferma Ordine</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- </div>
                </div> -->

                <!-- <div class="row mt-3">
                    <div class="col-12">
                        <button class="btn btn-block btn-primary" @click="confirmOrder()">Conferma Ordine</button>
                    </div>
                </div> -->

        <!-- modalita di pagamento shipment -->
                <div class="card shadow mt-3" v-if="addressCompleteShipment">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row">
                                <label class="h5">Modalità di pagamento</label>
                            </div>
                            <div class="row">
                                <div class="input-group my-auto">
                                    <div class="form-check pl-0 pr-3">
                                        <input type="radio" name="payment_type" v-model="payment_type" :value="'cash'" :id="'cash_payment'" :disabled="!retailer_info.payments.cash.checked">
                                        <label class="my-auto" v-if="order_type == 'delivery'">Paga al ritiro/consegna</label>
                                        <label class="my-auto" v-else>Pagamento al ritiro/consegna</label>
                                    </div>
                                    <div class="form-check pl-0 pr-3">
                                        <input type="radio" name="payment_type" v-model="payment_type" :value="'card'" :id="'card_payment'" :disabled="!retailer_info.payments.card.checked">
                                        <label class="my-auto">Carta di Credito</label>
                                    </div>
                                    <div class="form-check pl-0 pr-3">
                                        <input type="radio" name="payment_type" v-model="payment_type" :value="'transfer'" :id="'transfer_payment'" :disabled="!retailer_info.payments.transfer.checked">
                                        <label class="my-auto">Bonifico</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12 mt-3 p-0" v-if="payment_type == 'cash'">
                                    <button :disabled="
                                        (order_type == 'takeaway' && (selected_date == null || !selected_timeslot || !phone)) ||
                                        (order_type == 'delivery' && (!address.name || !address.address || !address.zip_code || !address.city || !address.province || !serviced)) ||
                                        (order_type == 'shipment' && (!address.name || !address.address || !address.zip_code || !address.city))
                                        " class="btn btn-block btn-primary" @click="saveAddress()">Conferma Ordine</button>
                                </div>

                                <div class="col-12 mt-3 p-0" v-if="payment_type == 'card'">
                                    <!-- <payment :amount-prop="totalWithDelivery*100" :msg-prop="'Spesavicino.it - ' + order.code" :pkProp="retailer_info.payments.card.stripe_key" :skProp="retailer_info.payments.card.stripe_secret_key"></payment> -->
                                    <button
                                        class="btn btn-block btn-primary" @click="saveAddress()"
                                        :disabled="
                                            (order_type == 'takeaway' && (selected_date == null || !selected_timeslot || !phone)) ||
                                            (order_type == 'delivery' && (!address.name || !address.address || !address.zip_code || !address.city || !address.province || !serviced)) ||
                                            (order_type == 'shipment' && (!address.name || !address.address || !address.zip_code || !address.city || !address.province))
                                        "
                                    >
                                            Paga con Carta di Credito
                                    </button>
                                </div>

                                <div class="col-12 mt-3 p-0" v-if="payment_type == 'transfer'">
                                    <div class="alert alert-warning" v-if="retailer_info.payments.transfer.notes">
                                        {{ retailer_info.payments.transfer.notes }}
                                    </div>
                                    <div class="alert alert-danger">
                                        Come causale del bonifico, indicare il codice dell'ordine<br>(reperibile in cima alla pagina)
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-4 text-left my-1"><strong>Intestatario:</strong></div>
                                        <div class="col-7 text-left my-1">{{ retailer_info.payments.transfer.name }}</div>
                                        <div class="col-4 text-left my-1"><strong>Codice IBAN:</strong></div>
                                        <div class="col-7 text-left my-1">{{ retailer_info.payments.transfer.iban_code }}</div>
                                        <div class="col-4 text-left my-1"><strong>Numero Conto:</strong></div>
                                        <div class="col-7 text-left my-1">{{ retailer_info.payments.transfer.number }}</div>
                                        <div class="col-4 text-left my-1"><strong>Banca:</strong></div>
                                        <div class="col-7 text-left my-1">{{ retailer_info.payments.transfer.bank }}</div>
                                    </div>
                                    <button :disabled="
                                            (order_type == 'takeaway' && (selected_date == null || !selected_timeslot || !phone)) ||
                                            (order_type == 'delivery' && (!address.name || !address.address || !address.zip_code || !address.city || !address.province || !serviced)) ||
                                            (order_type == 'shipment' && (!address.name || !address.address || !address.zip_code || !address.city || !address.province))
                                        "
                                        class="btn btn-block btn-primary mt-3" @click="saveAddress()">Conferma Ordine</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { eventBus } from "../app";
import TestPayment from "../pages/TestPayment";
import moment from 'moment';
import { mapState } from 'vuex'

export default {
    props: ["items_list", "recap", "retailer_id", "order"],
    components: {
        "payment": TestPayment
    },
    data() {
        return {
            alert: false,
            is_free: false,
            shipment_type: null,
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            user_id: null,
            user: null,
            bearer_token: null,
            show_register: false,

            show_error: false,
            error_msg: null,
            privacy: false,

            retailer_info: null,
            retailer: null,

            userAddress: 'new',
            address_id: null,
            address: {
                'name': '',
                'address': '',
                'zip_code': '',
                'city': '',
                'province': '',
            },

            serviced: null,

            order_type: 'takeaway',
            payment_type: '',
            selected_date: null,
            selected_timeslot: null,
            phone: null,
            order_notes: '',

            loading_data: true,
            week:[],

            order_data: {
                'code': '',
                'retailer_id': '',
                'user_id': '',
                'address_id': '',
                'delivery_time': '',
                'status_id': '',
                'is_submitted': '',
                'is_delivery': '',
                'is_takeaway': '',
                'delivery_info': {
                    'address': '',
                    'phone': '',
                    'date': '',
                    'time': '',
                    'notes': '',
                    'delivery_charge': '',
                    'ship_charge': '',
                    'is_ship': false,
                    'payment_info': {
                        'payment_type': '',
                        'is_paid': false,
                    }
                },
                'items': '',
            }
        }
    },
    async mounted() {

        if(!this.items_list || !this.recap || !this.retailer_id || !this.order) {
            this.$router.push({name: 'Home'});
        }
        eventBus.$emit('hide-cart', {});
        await this.getRetailer();
        await this.getUser();
        await this.initWeek();
        await this.initAddresses();
        if (this.$store.getters.token) {
            this.bearer_token = this.$store.getters.token
        }

        if(this.retailer_info.payments.cash.checked) {
            this.payment_type = 'cash'
        } else if (this.retailer_info.payments.card.checked) {
            this.payment_type = 'card'
        } else if (this.retailer_info.payments.transfer.checked) {
            this.payment_type = 'transfer'
        } else {
            this.payment_type = ''
        }
        this.loading_data = false;
        eventBus.$on('payment-successful', () => {
            this.confirmOrder()
        })

    },
    computed: {
        newAddress: function() {
            this.old_address=false
            this.address.name=""
            this.address.zip_code=""
            this.address.city=""
            this.address.province=""
        },
        h: function() {
            return (window.innerHeight - 383.2) + 'px'
        },

        userId: function() {
            return this.$store.getters.userId
        },

        token: function() {
            return this.$store.getters.token
        },

        addressId: function() {
            return this.address_id
        },

        totalWithDelivery: function() {
            if (this.order_type == 'delivery') {
                return this.recap.total_price + this.retailer.delivery_charge/100
            }
            else {
                return this.recap.total_price
            }
        },

        totalWithShipment: function() {
            if (this.order_type == 'shipment' && this.shipment_type != null) {
                if(this.shipment_type.free_ship && this.shipment_type.free_ship/100<=this.recap.total_price) {
                    this.is_free = true
                    return this.recap.total_price
                } else {
                    let total = this.recap.total_price + this.shipment_type.charge/100
                    return total
                }
            }
        },

        belowMinOrder: function() {
            if(this.recap.total_price < this.retailer_info.min_order/100 || !this.retailer.does_delivery) {
                return true
            } else {
                return false
            }
        },



        deliveryHoursLength: function() {
            if(this.selected_date != null) {
                return this.week[this.selected_date].delivery_hours.length
            }
        },

        takeawayHoursLength: function() {
            return this.week[this.selected_date].takeaway_hours.length
        },

        addressCompleteDelivery() {
            if(this.order_type == 'delivery' && this.address.name && this.address.zip_code && this.address.city && this.address.province && this.phone) {
                return true
            } else {
                return false
            }
        },

        addressCompleteShipment() {
            if(this.shipment_type && this.order_type == 'shipment' && this.address.name && this.address.zip_code && this.address.city && this.address.province && this.phone) {
                return true
            } else {
                return false
            }
        },
        ...mapState({
        isLoggedIn:     state => state.isLoggedIn,
        }),
    },
    watch: {
        userId: async function() {
            this.loading_data = true
            await this.getUser()
            this.loading_data = false
        },

        address: function() {
            this.address_id = this.address.id
        },

        deliveryHoursLength: function() {
            if(this.deliveryHoursLength == 0) {
                this.selected_timeslot = null
            }
        },

        selected_date: function() {
            if(this.takeawayHoursLength == 0) {
                this.selected_timeslot = null
            }
        },

        address: {
            deep: true,
            handler() {
                this.checkServicedAreas()
            }
        }
    },
    methods: {
        logout() {
            this.$store.dispatch('logout')
        },
        handleBlurZipCode() {
            let token = this.$store.state.token
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            }
            axios
                .get(`/api/zip/${this.address.zip_code}`, config)
                .then(response => {
                    console.log(response.data.data[0])
                    this.address.province = response.data.data[0].district.sigla
                    this.address.city = response.data.data[0].district.nome
                })
                .catch(e => {
                    console.log(e)
                })
        },
        uniqueCheck(shipment){
            this.shipment_type = shipment;
        },
        checkPassword() {
            if (this.password === this.password_confirmation) {
                return true;
            }
        },
        async check_repeated() {
            await axios
                .post('/api/check_repeated', {
                    'mail': this.email
                })
                .then(response => {
                    if(!response.data.success) {
                        this.error_msg = response.data.message
                        this.show_error = true
                    } else {
                        this.show_error = false
                        this.error_msg = null
                    }
                })
                .catch(e => {
                    console.log(e)
                })
        },
        login() {
            this.show_error = false
            let headers = {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
            let data = {
                email: this.email,
                password: this.password
            }
            if(!this.show_error) {
                axios
                    .post('/api/login', data, headers)
                    .then(response => {
                        this.user = response.data.data.user
                        this.user_id = response.data.data.user.id
                        this.bearer_token = response.data.data.token
                        if(this.user_id == this.retailer.user_id) {
                            this.user = null
                            this.user_id = null
                            this.bearer_token = null
                            this.alert = true
                        } else {
                            this.$store.dispatch('login', response.data.data)
                        }

                    })
                    .catch(e => {
                        this.error_msg = 'Credenziali incorrette, riprovare'
                        this.show_error = true
                        console.log(e)
                    })
            }
        },
        async register() {
            this.show_error = false
            await this.check_repeated();

            if(!this.privacy && !this.show_error) {
                this.error_msg = 'È necessario acconsentire al trattamento dei dati personali per procedere'
                this.show_error = true
            }

            if(!this.show_error && this.privacy) {
                if(this.checkPassword()) {
                    this.show_error = false,
                    axios
                        .post('/api/register/user', {
                            'name': this.name,
                            'email': this.email,
                            'password': this.password,
                            'c_password': this.password_confirmation
                        })
                        .then(response => {
                            this.user = response.data.data.user
                            this.user_id = response.data.data.user.id
                            this.bearer_token = response.data.data.token
                            this.$store.dispatch('login', response.data.data)
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
        async getUser() {
            // let userId = this.$store.getters.userId;
            let userId = this.userId;
            let token = this.$store.getters.token;

            if(userId && token) {
                let config = {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                };

                await axios
                    .get(`/api/users/${userId}`, config)
                    .then(response => {
                        this.user = response.data.data
                        this.user_id = response.data.data.id
                        console.log('*****user****', this.user)
                    })
                    .catch(e => {
                        console.log(e)
                    })
            }
        },
        async getRetailer() {
            await axios
                .get(`/api/retails/${this.retailer_id}`)
                .then(response => {
                    this.retailer_info = JSON.parse(response.data.data.info);
                    this.retailer = response.data.data;
                    this.$store.dispatch('setRetailerSlug', response.data.data.slug)
                    this.$store.dispatch('setRetailerVat', response.data.data.vat)
                    console.log('retailer', this.retailer)
                    console.log('retailer_info', this.retailer_info.does_shipment)
                })
                .catch(e => {
                    console.log(e)
                })
        },
        initWeek() {
            let today = moment().locale('it');
            for (let index = 0; index < 15; index++) {
                let new_day = moment(today).add(index, 'days');
                this.week[index] = {
                    'index': index,
                    'day_name': moment(new_day).locale('it').format('dddd').toString(),
                    'day_number': moment(new_day).locale('it').format('DD').toString(),
                    'month_name': moment(new_day).locale('it').format('MMMM').toString(),
                    'month_number': moment(new_day).locale('it').format('MM').toString(),
                    'year': moment(new_day).locale('it').format('YYYY').toString(),
                    'opening_hours': [],
                    'delivery_hours': [],
                    'takeaway_hours': [],
                }

                this.fillTimeslot(moment(new_day).locale('it').format('dddd'), index)
            }
        },
        initAddresses() {
            if(this.user && this.user.addresses && this.user.addresses.length > 0) {
                this.address = this.user.addresses[0];
                this.userAddress = 'old'
            } else {
                this.UserAddress = 'new'
            }
        },
        fillTimeslot(day_name, index) {
            let day = this.retailer_info.timeslots.filter(d => {
                return d.name.toLowerCase() == day_name
            });

            // console.log('day', day)
            // console.log('day[0].opening_hours', day[0].opening_hours)
            // console.log('retailer_info', this.retailer_info)

            this.week[index].opening_hours = day[0].opening_hours;
            this.week[index].delivery_hours = day[0].delivery_hours;
            this.week[index].takeaway_hours = day[0].takeaway_hours;
        },
        async saveAddress() {
            if(this.check_fields()) {
                if (this.order_type == 'takeaway') {
                    this.confirmOrder()
                } else {
                    let address_data = {
                        'name': this.address.name,
                        'city': this.address.city,
                        'address': this.address.address,
                        'province': this.address.province,
                        'zip_code': this.address.zip_code,
                        'user_id': this.user_id,
                    }

                    let config = {
                        headers: {
                            Authorization: `Bearer ${this.bearer_token}`
                        }
                    };

                    if (this.userAddress == 'new') {
                        await axios
                            .post('/api/addresses/create', address_data, config)
                            .then(response => {
                                this.address_id = response.data.data.id;
                                this.confirmOrder()
                            })
                            .catch(e => {
                                console.log(e)
                            })
                    } else {
                        await axios
                            .put(`/api/addresses/${this.address.id}`, address_data, config)
                            .then(response => {
                                console.log(response)
                                this.address_id = response.data.data.id
                                this.confirmOrder()
                            })
                            .catch(e => {
                                console.log(e)
                            })
                    }
                }
            }
        },
        check_fields() {
            if(this.order_type == 'takeaway') {
                if(this.selected_date == null || this.selected_timeslot == null || this.phone == null) {
                    this.error_msg = 'Compilare tutti i campi per procedere'
                    this.show_error = true
                    console.log('return false', ['takeaway', this.selected_date, this.selected_timeslot, this.phone])
                    return false
                } else {
                    this.show_error = false
                    this.error_msg = null
                    console.log('return true', ['takeaway', this.selected_date, this.selected_timeslot, this.phone])
                    return true
                }
            } else if(this.order_type == 'delivery') {
                if(this.selected_date == null || this.selected_timeslot == null || this.phone == null || this.address.name == '' || this.address.city == '' || this.address.address == '' || this.address.province == '' || this.address.zip_code == '') {
                    this.error_msg = 'Compilare tutti i campi per procedere'
                    this.show_error = true
                    console.log('return false', ['delivery', this.selected_date, this.selected_timeslot, this.phone])
                    return false
                } else {
                    this.show_error = false
                    this.error_msg = null
                    console.log('return true', ['delivery', this.selected_date, this.selected_timeslot, this.phone, this.address.name, this.address.city, this.address.address, this.address.province, this.address.zip_code])
                    return true
                }
            } else {
                if(this.phone == null || this.address.name == '' || this.address.city == '' || this.address.address == '' || this.address.province == '' || this.address.zip_code == '') {
                    this.error_msg = 'Compilare tutti i campi per procedere'
                    this.show_error = true
                    console.log('return false', ['shipment', this.shipment_type.name, this.phone])
                    return false
                } else {
                    this.show_error = false
                    this.error_msg = null
                    console.log('return true', ['shipment', this.shipment_type.name, this.phone, this.address.name, this.address.city, this.address.address, this.address.province, this.address.zip_code])
                    return true
                }
            }
        },
        async checkout(order_id) {
            var stripe = Stripe(this.retailer_info.payments.card.stripe_key)
            var sID = ''
            var stripe_sk = this.retailer_info.payments.card.stripe_secret_key
            var items = []

            this.items_list.forEach(item => {
                let checkout_item = {
                    'name': item.item.name,
                    'price': item.item.price,
                    'qty': item.qty
                }
                items.push(checkout_item)
            });

            if (this.order_type == 'delivery' && this.retailer.delivery_charge != 0) {
                let checkout_item = {
                    'name': 'Consegna a domicilio',
                    'price': this.retailer.delivery_charge*100,
                    'qty': 1
                }
                items.push(checkout_item)
            }

            if (this.order_type == 'shipment') {
                if (this.shipment_type && this.shipment_type.free_ship/100<=this.recap.total_price) {
                    let checkout_item = {
                        'name': 'Spedizione',
                        'price': 0,
                        'qty': 1
                    }
                    items.push(checkout_item)
                } else {
                    let checkout_item = {
                    'name': 'Spedizione',
                    'price': this.shipment_type.charge/100,
                    'qty': 1
                    }
                    items.push(checkout_item)
                }
            }

            console.log(items)

            axios
                .post('/api/checkout', {
                    'items' : items,
                    'stripe_sk': stripe_sk,
                    // 'success_url': `http://localhost:8001/orders/${order_id}/payment_success`,
                    // 'cancel_url': `http://localhost:8001/orders/${order_id}/payment_canceled`
                    'success_url': `http://www.spesavicino.it/orders/${this.order.id}/payment_success`,
                    'cancel_url': `http://www.spesavicino.it/orders/${this.order.id}/payment_canceled`
                })
                .then(response => {
                    sID = response.data
                    stripe.redirectToCheckout({
                        sessionId: sID
                    }).then(function (result) {
                        console.log('checkout')
                        eventBus.$emit('')
                    });
                })
        },
        checkServicedAreas() {
            var zip_codes = JSON.parse(this.retailer.info).zip_codes
            var zip_codes_upper = []
            zip_codes.forEach(zip_code => {
                zip_codes_upper.push(zip_code.toUpperCase())
            })
            console.log(zip_codes)
            // if(this.address.zip_code && this.city && zip_codes.length > 0) {
                if((this.address.zip_code) && this.address.city) {
                    var search_term = this.address.zip_code + ' - ' + this.address.city.toUpperCase()
                    if(zip_codes_upper.indexOf(search_term) == -1) {
                        this.serviced = false
                    } else {
                        this.serviced = true
                    }
                }
            // }
        },
        submitOrder() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.bearer_token}`
                }
            };

            axios
                .get(`/api/orders/${this.order.id}/submit`, config)
                .then(response => {
                    axios
                        .get(`/api/orders/${this.order.id}/notify`)
                        .then(response => {
                            console.log('notifications sent')
                        })
                        .catch(e => {
                            console.log(e)
                        })

                    eventBus.$emit('order-completed', {})
                    console.log('order completed (CompleteOrder)')
                    this.$router.push({
                        name: 'Order-submitted',
                        params: {
                            order: response.data.data,
                            items_list: this.items_list,
                            recap: this.recap,
                            delivery_charge: this.retailer.delivery_charge,
                            total_with_delivery: this.totalWithDelivery,
                            total_with_shipment: this.totalWithShipment,
                            shipment_type: this.shipment_type,
                            order_type: this.order_type
                        }
                    })
                })
                .catch()
        },
        async confirmOrder() {
            this.order_data.delivery_info.is_free = this.is_free
            this.order_data.code = this.order.code
            this.order_data.retailer_id = this.retailer_id
            this.order_data.user_id = this.user_id
            this.order_data.address_id = this.addressId
            this.order_data.status_id = 1
            this.order_data.is_submitted = true
            if (this.order_type == 'delivery') {
                this.order_data.is_delivery = true
                this.order_data.is_takeaway = false
            } else {
                this.order_data.is_delivery = false
                this.order_data.is_takeaway = true
            }
            this.order_data.delivery_info.address = this.address
            this.order_data.delivery_info.phone = this.phone
            this.order_data.delivery_info.notes = this.order_notes
            if (this.order_type == 'shipment') {
                this.order_data.is_takeaway = false
                this.order_data.is_delivery = false
                var dateLiteral = {day_name: moment().locale('it').format('dddd').toString(), day_number: moment().locale('it').format('DD').toString(), month_name:moment().locale('it').format('MMMM').toString(), year: moment().locale('it').format('YYYY').toString()};
                console.log('*******date', dateLiteral)
                var hourLiteral = {start: moment().format("HH") + ':' + moment().format("mm") , end: moment().format("HH") + ':' + moment().format("mm")};
                console.log('*****hour', hourLiteral)
                this.order_data.delivery_info.date = dateLiteral;
                this.order_data.delivery_info.time = hourLiteral;
                this.order_data.delivery_info.delivery_charge = ""
            } else {
                this.order_data.delivery_info.delivery_charge = this.retailer.delivery_charge/100
                this.order_data.delivery_info.date = this.week[this.selected_date]
                this.order_data.delivery_info.time = this.selected_timeslot
            }
            if (this.order_type == 'shipment') {
                if (this.shipment_type && this.shipment_type.free_ship/100<=this.recap.total_price) {
                    this.order_data.delivery_info.ship_charge = 0
                    this.order_data.delivery_info.is_ship = true
                } else {
                    this.order_data.delivery_info.ship_charge = this.shipment_type.charge/100
                    this.order_data.delivery_info.is_ship = true
                }
            }

            this.order_data.delivery_info.payment_info.payment_type = this.payment_type
            if (this.payment_type == 'card') {
                this.order_data.delivery_info.payment_info.is_paid = false
                this.order_data.is_submitted = false
            }
            this.order_data.items = this.items_list
            console.log('riassunto ordine*******', this.order_data)
            let config = {
                headers: {
                    Authorization: `Bearer ${this.bearer_token}`
                }
            };

            axios
                .post(`/api/orders/create`, this.order_data, config)
                .then(response => {
                    if (this.order_data.delivery_info.payment_info.payment_type != 'card') {
                        axios
                            .get(`/api/orders/${response.data.data.id}/notify`)
                            .then(response => {
                                console.log('notifications sent')
                            })
                            .catch(e => {
                                console.log(e)
                            })

                        eventBus.$emit('order-completed', {})
                        this.$router.push({
                            name: 'Order-submitted',
                            params: {
                                order: response.data.data,
                                items_list: this.items_list,
                                recap: this.recap,
                                delivery_charge: this.retailer.delivery_charge,
                                total_with_delivery: this.totalWithDelivery,
                                total_with_shipment: this.totalWithShipment,
                                shipment_type: this.shipment_type,
                                order_type: this.order_type
                            }
                        })
                    } else {
                        this.checkout(response.data.data.id)
                    }
                })
                .catch(e => {
                    console.log(e)
                })
        },
    }
}
</script>
