<template>
    <div class="box">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-white">
                <h1 class="display-3 d-none d-sm-block">
                    Per te negoziante - Spesavicino
                </h1>
                <h1 class="d-block d-sm-none">
                    Per te negoziante - Spesavicino
                </h1>
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
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <button
                        type="button"
                        class="btn btn-primary"
                        v-on:click="goToPage()"
                    >
                        <h2 class="call2action">
                            Registra Gratuitamente la tua attività
                        </h2>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6 mb-4">
                    <div class="card features-card">
                        <article class="card-body">
                            <section class="card-text text-left p-3">
                                <ul class="features p-0 m-0">
                                    <li
                                        class="d-flex my-3"
                                        v-for="highlight in highlights"
                                        v-bind:key="highlight.id"
                                    >
                                        <i class="fas fa-check text-success my-auto mr-3 fa-lg"></i>
                                        <p class="my-auto h4">
                                            {{ highlight.text }}
                                        </p>
                                    </li>
                                </ul>
                            </section>
                        </article>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 mb-4">
                    <div class="card" id="contactForm">
                        <div class="card-body">
                            <h4 class="card-title">Contattaci senza impegno</h4>
                            <div class="card-text">
                                <form-contatti></form-contatti>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container  my-4">
            <div class="card  mb-4">
                <div class="card-body p-0">
                    <table class="table">
                        <thead class="bg-primary text-white border-0">
                            <tr>
                                <th>FUNZIONALITA'</th>
                                <th>VERSIONE BASE GRATUITA</th>
                                <th>VERSIONE A PAGAMENTO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="feat in features" v-bind:key="feat.id">
                                <td>{{ feat.feat }}</td>
                                <td v-if="feat.free">
                                    <span style="color:green"
                                        ><i class="fas fa-check"></i
                                    ></span>
                                </td>
                                <td v-else>
                                    <span style="color:red"
                                        ><i class="fas fa-times"></i
                                    ></span>
                                </td>
                                <td v-if="feat.pay">
                                    <span style="color:green"
                                        ><i class="fas fa-check"></i
                                    ></span>
                                </td>
                                <td v-else>
                                    <span style="color:red"
                                        ><i class="fas fa-times"></i
                                    ></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Contatti from "../components/home/FormContatti";
export default {
    name: "PerChiVende",
    components: {
        "form-contatti": Contatti
    },
    data() {
        return {
            highlights: [
                {
                    id: 1,
                    text:
                        "Ricevere Ordini e organizzare consegne"
                },
                {
                    id: 2,
                    text:
                        "Permettere ai tuoi clienti di ordinare da casa o dal telefono"
                },
                {
                    id: 3,
                    text:
                        "Versione Base completamente gratuita, per sempre!"
                },
                // {
                //     id: 4,
                //     text:
                //         "<p><span style='font-size:3em; color:green'><i class='fas fa-check'></i></span>&nbsp;<span style='font-size:1.5em;'>Offerta Speciale! Pagamenti online compresi nella versione base fino Dicembre 2020!</span></p>"
                // }
            ],
            features: [
                { id: 1, feat: "Logo e Insegna", free: true, pay: true },
                {
                    id: 2,
                    feat: "Indirizzo geo-localizzato",
                    free: true,
                    pay: true
                },
                {
                    id: 3,
                    feat: "Informazioni sull’attività",
                    free: true,
                    pay: true
                },
                {
                    id: 4,
                    feat: "Informazioni sugli orari di apertura",
                    free: true,
                    pay: true
                },
                {
                    id: 5,
                    feat: "Informazioni su orari ritiro in negozio",
                    free: true,
                    pay: true
                },
                {
                    id: 6,
                    feat: "Informazioni su orari consegna a domicilio",
                    free: true,
                    pay: true
                },
                {
                    id: 7,
                    feat: "Vetrina digitale del negozio",
                    free: true,
                    pay: true
                },
                {
                    id: 8,
                    feat: "Gestione base dell’articolo ",
                    free: true,
                    pay: true
                },
                { id: 9, feat: "Carrello della spesa", free: true, pay: true },
                {
                    id: 10,
                    feat: "Gestione degli ordini",
                    free: true,
                    pay: true
                },
                {
                    id: 11,
                    feat: "Badge per le pagine social",
                    free: true,
                    pay: true
                },
                {
                    id: 12,
                    feat:
                        "Pagamento online con carta di credito",
                    free: false,
                    pay: true
                },
                {
                    id: 13,
                    feat:
                        "Gestione avanzata degli articoli (per es. gestione degli ingredienti o gestione taglia e colore)",
                    free: false,
                    pay: true
                },
                {
                    id: 14,
                    feat: "Più foto per articolo",
                    free: false,
                    pay: true
                },
                {
                    id: 15,
                    feat: "Tag articolo per agevolarne la ricerca",
                    free: false,
                    pay: true
                }
            ],
            questions: [
                {
                    id: 1,
                    domanda: "Il servizio offerto è davvero gratuito?",
                    risposta:
                        "<p>Il servizio base è completamente gratuito senza limiti di tempo.</p>"
                },
                {
                    id: 2,
                    domanda: "Cosa comprende il servizio base?",
                    risposta: `Il servizio base mette a disposizione tutto ciò che serve per avviare un negozio digitale:<br />
                        <ul>
                        <li>logo e insegna</li>
                        <li>informazioni sull’attività;</li>
                        <li>informazioni sugli orari di apertura, sui ritiri e sulle consegne</li>
                        <li>vetrina degli articoli</li>
                        <li>carrello della spesa</li>
                        <li>ricezione e gestione degli ordini</li>
                        <li>badge per le pagine social</li>
                        </ul>`
                },
                {
                    id: 3,
                    domanda:
                        "In cosa consistono i servizi avanzati a pagamento?",
                    risposta: `Abbiamo pensato anche dei servizi più personalizzati per chi fosse interessato a una gestione più avanzata e professionale, fornendo la possibilità di:<br />
                        <ul>
                        <li>gestire i pagamenti online</li>
                        <li>gestire gli articoli in modo avanzato (per es. gestione degli ingredienti o gestione di taglia e colore);</li>
                        <li>aggiungere più foto ad uno stesso articolo;</li>
                        <li>associare dei tag ad uno specifico articolo per agevolarne la ricerca;</li>
                        </ul>`
                },
                {
                    id: 4,
                    domanda: "Come avvio il mio negozio digitale?",
                    risposta: `<p>Basta iscriversi e inserire pochi dati iniziali per essere già operativi e visibili, ma, se hai bisogno di aiuto, contattaci pure all’indirizzo e-mail <a href="mailto:info@spesavicino.it.">info@spesavicino.it.</a></p>`
                },
                {
                    id: 5,
                    domanda: "I miei clienti possono pagare online?",
                    risposta: `<p>Sì, se è attiva la versione avanzata e se sottoscrivi un servizio di pagamento online. La funzione pagamenti da Giugno 2020  fino al 31 Dicembre 2020 è disponibile con la versione gratuita e dal 01 Gennaio 2021 solo se attivi la versione avanzata. Se hai dei dubbi, contattaci all’indirizzo e-mail <a href="mailto:info@spesavicino.it.">info@spesavicino.it.</a> e ti potremo consigliare.</p>`
                },
                {
                    id: 6,
                    domanda: "Come posso gestire i miei prodotti?",
                    risposta: `<p>Nella versione base gratuita c’è la possibilità di inserire una vera e propria vetrina degli articoli con dati e fotografia. La versione avanzata permette una gestione più dettagliata e personalizzata degli articoli</p>`
                },
                {
                    id: 7,
                    domanda:
                        "È necessario inserire le foto dei prodotti in vendita?",
                    risposta: `<p>La versione base permette di inserire una foto per ogni articolo, ma non è necessario.
                                    La versione avanzata permette di inserire più foto per ogni articolo.</p>`
                },
                {
                    id: 8,
                    domanda: "E se non ho le foto?",
                    risposta: `<p>Inviaci alcuni campioni dei prodotti e le foto le realizziamo noi. Contattaci all’indirizzo e-mail <a href="mailto:info@spesavicino.it.">info@spesavicino.it.</a> per un preventivo.</p>`
                },
                {
                    id: 9,
                    domanda:
                        "Cosa vuol dire che posso anche gestire gli ordini dei clienti?",
                    risposta: `<p>Una volta inseriti i prodotti sul sito, il cliente potrà riempire il suo carrello della spesa con gli articoli che desidera e inviarti un ordine. La piattaforma permette di vedere tutti gli ordini in entrata e di distinguerli tra: nuovi, in lavorazione, pronti e spediti. In questo modo, è possibile organizzare meglio il lavoro.</p>`
                },
                {
                    id: 10,
                    domanda: "Offrite anche il servizio di consegna?",
                    risposta: `<p>No, noi ci occupiamo solamente di mantenere attiva e funzionante la piattaforma. La gestione dei contenuti e dei servizi del negozio online è a carico dell’esercente.</p>`
                },
                {
                    id: 11,
                    domanda:
                        "Posso gestire consegna a domicilio e ritiro presso il negozio?",
                    risposta: `<p>Sì, nella versione base è possibile indicare i giorni e gli orari in cui è possibile ritirare la merce in negozio, e quelli in cui si effettuano le consegne a domicilio. Per le consegne a domicilio, è possibile anche indicare le zone di consegna.</p>`
                },
                {
                    id: 12,
                    domanda: "La piattaforma permette di fare bolle e fatture?",
                    risposta: `<p>No, ma noi siamo una software house e, se lo desideri, possiamo farti un preventivo per realizzare il collegamento con il tuo software gestionale.</p>`
                },
                {
                    id: 13,
                    domanda:
                        "Se sono già in possesso di un mio e-commerce, posso collegarlo al vostro portale?",
                    risposta: `<p>Quando inserisci le informazioni sulla tua attività commerciale puoi anche inserire il link del tuo e-commerce. Il cliente potrà così arrivare al tuo e-commerce anche attraverso www.spesavicino.it.</p>`
                },
                {
                    id: 14,
                    domanda:
                        "Posso caricare in automatico gli articoli senza doverli inserire manualmente?",
                    risposta: `<p>Al momento possiamo farlo noi per te. Contattaci pure se hai questa esigenza.</p>`
                },
                {
                    id: 1,
                    domanda: "Posso uscire dal portale quando voglio?",
                    risposta: `<p>Sì, è possibile disattivare la propria attività e non sarà più visibile nelle ricerche.</p>`
                }
            ]
        };
    },
    methods: {
        goToPage() {
            this.$router.push({ name: "RegistraAzienda" });
        }
    }
};
</script>

<style scoped lang="scss">
li {
    float: left;
    color: #333;
}
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
        url("/images/perchivende.jpg");
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

.features {
    list-style: none;
}

.feature-check {
    color: green;
}

.features-card {
    background-color: #fff;
    color: #333;
}

#contactForm {
    background-color: #005c92;
    color: #fff;
}
</style>
