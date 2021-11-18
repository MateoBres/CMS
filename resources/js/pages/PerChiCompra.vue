<template>
    <div class="box">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-white">
                <h1 class="display-3 d-none d-sm-block">Spesavicino - Come funziona</h1>
                <h1 class="d-block d-sm-none">Spesavicino - Come funziona</h1>
                <h2 class="lead">
                    <strong>
                        La piattaforma che trasforma i piccoli esercizi
                        commerciali del territorio in negozi online per essere
                        sempre vicini ai propri clienti anche quando sono
                        lontani
                    </strong>
                </h2>
                <hr class="my-2" />
                <!-- <p>More info</p>
                <p class="lead">
                    <a
                        class="btn btn-primary btn-lg"
                        href="Jumbo action link"
                        role="button"
                        >Il nostro sogno</a
                    >
                </p> -->
            </div>
        </div>
        <div class="container my-4" style="min-height:50vh">
            <div class="card my-3">
                <div class="card-body">
                    <!-- <h4 class="card-title">Title</h4> -->
                    <div class="card-text">
                        <article class="text-left">
                            <div class="d-flex w-100 justify-content-between">
                                <h3 class="my-auto" data-target="#faq-buyer">Domande frequenti per chi acquista</h3>
                                <i class="fas fa-2x my-auto" :class="icon_class_buyer" @click.prevent="toggleIconBuyer()" data-toggle="collapse" data-target="#faq-buyer"></i>
                            </div>
                            <div class="collapse mt-5" id="faq-buyer">
                                <div v-for="faq in questionsBuyer" v-bind:key="faq.id">
                                    <p class="domanda">
                                        <strong>{{ faq.domanda }}</strong>
                                    </p>
                                    <div
                                        class="risposta"
                                        v-html="faq.risposta"
                                    ></div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>

            <div class="card my-3">
                <div class="card-body">
                    <div class="card-text">
                        <article class="text-left">
                            <div class="d-flex w-100 justify-content-between">
                                <h3 class="my-auto" data-target="#faq-buyer">Domande frequenti per chi vende</h3>
                                <i class="fas fa-2x my-auto" :class="icon_class_seller" @click.prevent="toggleIconSeller()" data-toggle="collapse" data-target="#faq-seller"></i>
                            </div>
                            <div class="collapse mt-5" id="faq-seller">
                                <div v-for="faq in questionsSeller" v-bind:key="faq.id">
                                    <p class="domanda">
                                        <strong>{{ faq.domanda }}</strong>
                                    </p>
                                    <div
                                        class="risposta"
                                        v-html="faq.risposta"
                                    ></div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PerChiCompra",
    data() {
        return {
            icon_class_buyer: 'fa-chevron-circle-down',
            icon_class_seller: 'fa-chevron-circle-down',
            questionsBuyer: [
                {
                    id: 1,
                    domanda: "Come funziona?",
                    risposta:
                        "<p>spesavicino.it è un vero negozio online, e raggruppa tutti i negozianti di quartiere che hanno aderito all'iniziativa. Puoi acquistare in tutta sicurezza e fare la tua spesa online dai piccoli esercizi commerciali del territorio, e poi ricevere a casa il tuo ordine o andare a ritirarlo in negozio. Scrivi il nome del tuo commerciante di fiducia o cerca il prodotto che ti occorre. Cliccando sull’esercizio prescelto accederai alla vetrina del suo negozio online e potrai cominciare a riempire il tuo carrello. Inoltre Spesavicino è geolocalizzato quindi vedrai prima tutti i commercianti vicini a te.</p>"
                },
                {
                    id: 2,
                    domanda: "Devo registrarmi per usare la piattaforma?",
                    risposta: `<p>Per effettuare un ordine è necessario registrarsi. È infatti richiesta l’iscrizione quando si si vuole inviare un ordine. per la sola consultazione del sito non è richiesta iscrizione. Nel caso di iscrizione/registrazione, puoi richiedere la cancellazione definitiva in qualsiasi momento scrivemdo a <a href="mailto:info@spesavicino.it.">info@spesavicino.it.</a> (indica email utilizzata e nome e cognome e telefono, potremmo doverci mettere in contatto con te);</p>`
                },
                {
                    id: 3,
                    domanda: "Posso memorizzare il mio indirizzo di consegna?",
                    risposta: `<p>Sì, è possibile associare al proprio profilo uno o più indirizzi di consegna. Al momento dell’ordine, specificherai dove vuoi che la tua spesa venga recapitata.  che Questo significa che puoi ordinare e far consegnare a un tuo familiare (papà, nonno, figlio etc.) che non è esperto o se ti trovi in un domicilio diverso dal solito.</p>`
                },
                {
                    id: 4,
                    domanda: "Chi effettua il servizio di consegna?",
                    risposta: `<p>Spesavicino.it non effettua direttamente delle consegne. Il servizio di consegna viene effettuato dal commerciante con strumenti propri o accordi con vettori diversi da spesavicino. Ogni negozio presente sulla piattaforma gestisce in autonomia le modalità di ritiro in sede e/o di consegna dei propri ordini. Nella vetrina negozio puoi trovare giorni,orari e modalità scelte dal negozio online.</p>`
                },
                {
                    id: 5,
                    domanda: "Posso sapere se il servizio di consegna è disponibile nella mia zona?",
                    risposta: `<p>Inserendo nella barra di ricerca il CAP della tua zona, la piattaforma ti mostrerà solo gli esercizi che consegnano al CAP inserito.</p>`
                },
                {
                    id: 6,
                    domanda: "Riceverò una notifica di conferma del mio ordine?",
                    risposta: `<p>Riceverai anche una mail ad ogni cambiamento di stato dell’ordine. Nella vetrina del negozio online è possibile visualizzare lo stato di avanzamento dei tuoi ordini.</p>`
                },
                {
                    id: 7,
                    domanda: "Posso eseguire il pagamento online?",
                    risposta: `<p>Sì, se l’esercizio commerciale dal quale stai ordinando ha attivato sulla piattaforma il servizio di pagamento con carta di credito.</p>`
                },
                {
                    id: 8,
                    domanda: "Posso annullare un ordine?",
                    risposta: `<p>Le regole di modifica o annullamento di un ordine sono decise dal commerciante dove acquisti. Se non trovi indicazioni chiare, ti invitiamo a contattare il negozio online prima di confermare l’ordine.</p>`
                },
            ],

            questionsSeller: [
                {
                    id: 1,
                    domanda: "Spesavicino.it è gratis per il commerciante?",
                    risposta:
                        "<p>Il servizio base è completamente gratuito senza limiti di tempo, presenta alcune limitazioni come il numero di prodotti che è possibile vendere e altri dettagli.</p>"
                },
                {
                    id: 2,
                    domanda: "Cosa comprende il servizio base?",
                    risposta: `Il servizio base mette a disposizione tutto ciò che serve per avviare un negozio digitale:<br />
                        <ul>
                        <li>logo e insegna</li>
                        <li>informazioni sull’attività;</li>
                        <li>Informazioni sugli orari di apertura</li>
                        <li>vetrina degli articoli</li>
                        <li>carrello della spesa</li>
                        <li>ricezione e gestione degli ordini</li>
                        </ul>`
                },
                {
                    id: 3,
                    domanda:
                        "Come avvio il mio negozio online?",
                    risposta: `Basta iscriversi e inserire pochi dati iniziali per essere già operativi e visibili, ma, se hai bisogno di aiuto, contattaci pure all’indirizzo e-mail <a href="mailto:info@spesavicino.it.">info@spesavicino.it.</a>. Se ti blocchi ti richiamiamo noi. Abbiamo istituito un servizio di assistenza anhe per gli account gratuiti.`
                },
                {
                    id: 4,
                    domanda: "Quante foto posso utilizzare per ogni prodotto?",
                    risposta: `<p>La versione base permette di inserire una foto per ogni articolo. La versione avanzata permette di inserire più foto per ogni articolo.</a></p>`
                },
                {
                    id: 5,
                    domanda: "Offrite anche il servizio di consegna?",
                    risposta: `<p>No, noi ci occupiamo solamente di mantenere attiva e funzionante la piattaforma. La gestione dei contenuti e dei servizi del negozio online è a carico dell’esercente.</p>`
                },
                {
                    id: 6,
                    domanda: "Posso specificare se effettuo solo consegna a domicilio o solo ritiro in negozio?",
                    risposta: `<p>Sì, nella versione base è possibile indicarlo. Per le consegne a domicilio, è possibile anche indicare le zone di consegna.</p>`
                },
                {
                    id: 7,
                    domanda:
                        "Se la cosa mi interessa ma non sono esperto mi potete aiutare?",
                    risposta: `<p>Assolutamente si. Abbiamo un servizio di assistenza telefonico per l'inserimento del negozio. Effettueremo per te anche un ordine di prova per assicurarci che tutto funzioni.</p>`
                },
                {
                    id: 8,
                    domanda: "Posso disiscrivermi da spesavicino.it quando voglio?",
                    risposta: `<p>Sì, è possibile disattivare la propria attività e non sarà più visibile nelle ricerche.</p>`
                },
            ]
        };
    },
    methods: {
        toggleIconBuyer() {
            if(this.icon_class_buyer == 'fa-chevron-circle-down') {
                this.icon_class_buyer = 'fa-chevron-circle-up'
            } else {
                this.icon_class_buyer = 'fa-chevron-circle-down'
            }
        },
        toggleIconSeller() {
            if(this.icon_class_seller == 'fa-chevron-circle-down') {
                this.icon_class_seller = 'fa-chevron-circle-up'
            } else {
                this.icon_class_seller = 'fa-chevron-circle-down'
            }
        }
    }
};
</script>

<style scoped lang="scss">
.box {
    background-color: #e9d7c3;
    padding-bottom: 60px;
}

.box-blue {
    background-color: #005c92;
    color: #fff;
}
.jumbotron {
    background-image: linear-gradient(
            rgba(241, 133, 0, 0.6),
            rgba(241, 133, 0, 0.6)
        ),
        url("/images/perchicompra.jpg");
    background-size: cover;
    background-position: center;
    background-color: #f18500;
}
text-white {
    color: white;
}

.main-content {
    font-size: 1em;
    padding-bottom: 80px;
    color: #454545;
}

.evidenza {
    font-size: 1.4em;
}
</style>
