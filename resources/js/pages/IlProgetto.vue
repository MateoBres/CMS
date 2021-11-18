<template>
    <div class="box">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-white">
                <h1 class="display-3">Spesavicino - Il nostro sogno</h1>
                <h2 class="lead">
                    <strong>
                       La piattaforma di negozi online dei piccoli esercizi commerciali del territorio, 
                       per essere sempre vicini ai propri clienti anche quando sono lontani!

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
        <div class="container  my-4">
            <div class="card box-blue mb-4">
                <div class="card-body">
                    <div class="card-text">
                        <article class="text-left ">
                            <ol class="evidenza mb-4">
                                <li>
                                    <strong
                                        >Il negozio online non sostituisce l’attività tradizionale del 
                                        commerciante ma è necessario per non perdere fatturato e clienti
                                    </strong>
                                </li>
                                <li>
                                    <strong
                                        >Manteniamo aperte le attività commerciali e 
                                        sosteniamo il lavoro di tante persone</strong
                                    >
                                </li>
                                <li>
                                    <strong>
                                        Mantieni vivo e attivo il tuo Paese
                                    </strong>
                                </li>
                            </ol>
                        </article>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Title</h4> -->
                    <div class="card-text">
                        <article class="text-left main-content">
                            <p>
                                Chi avrebbe mai pensato, solo due mesi fa, 
                                che il mondo sarebbe cambiato così velocemente e profondamente?
                            </p>
                            <p>
                                Questa improvvisa emergenza, con le conseguenti misure protettive che limitano fortemente spostamenti e relazioni fisiche,
                                 sta mettendo in seria difficoltà tante attività commerciali, 
                                in particolare quelle più piccole e più legate ad una spesa di prossimità fatta di incontri, 
                                conoscenza diretta dei clienti, legame col territorio.
                            </p>
                            <p>
                                Il problema è serio e grave, ma, come ci piace
                                sempre dire:
                                <cite>
                                    <strong
                                        >“Dietro ad ogni problema c’è
                                        un’opportunità”</strong
                                    >
                                </cite>
                            </p>
                            <p>
                                Perché non provare a reagire, ad accettare la
                                sfida del cambiamento, sperimentando nuovi modi
                                di entrare in relazione con i clienti e vendere?
                            </p>
                            <p>
                                Oggi tutti hanno uno smartphone e, proprio in
                                queste ultime settimane, è enormemente cresciuto
                                il numero di persone che fanno acquisti sul web.
                                Molti non torneranno più indietro.
                            </p>
                            <p>
                                I supermercati si stanno organizzando per
                                ricevere ordini e gestire consegne a domicilio.
                                Perché non dovrebbero poterlo fare anche i tanti
                                piccoli esercizi commerciali disseminati sul
                                territorio?
                            </p>
                            <p>
                                Noi di
                                <a href="http://attividigitali.com"
                                    >attividigitali</a
                                >
                                ci occupiamo di sviluppo software e
                                realizzazione di piattaforme web. Per questo
                                motivo, abbiamo realizzato
                                <strong>spesavicino.it</strong> uno strumento
                                semplice e veloce per aprire una vetrina nel
                                mondo digitale e vendere online.
                                <strong>Spesavicino</strong>
                                è disponibile in una versione base completamente
                                gratuita che ha tutto ciò che serve per avviare
                                e gestire una vendita online. Offriamo anche una
                                versione avanzata a pagamento per chi fosse
                                interessato a servizi più personalizzati.
                            </p>
                            <p>
                                www.spesavicino.it è il nostro modo di essere di
                                aiuto e dare una mano a chi vuole uscire dalla
                                crisi e ripartire con speranza e fiducia nel
                                futuro.
                            </p>
                            <p>
                                Il mondo non sta finendo, sta solo cambiando.
                                Adattarci ed evolvere è ciò che, anche questa
                                volta, siamo chiamati a fare.
                            </p>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "IlProgetto"
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
        url("/images/ilprogetto.jpg");
    background-size: cover;
    background-position: center;
    background-color: #f18500;
}
text-white {
    color: white;
}

.main-content {
    font-size: 1.2em;
    padding-bottom: 80px;
}

.evidenza {
    font-size: 1.4em;
}

@media screen and (max-width: 767px) {
    .display-3 {font-size:26pt;}
}
</style>
