<template>
    <div>
       <copertina :items="sliders" />

        <!--Section 1-->
        <div class="w-100 d-flex flex-column py-5" style="background-color: white;">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-10 col-md-6">
                        <p class="titolo-section text-center h1"  style="text-shadow: 1px 2px 2px #2f2f2f;" >
                            Unisci la vendita online a quella tradizionale
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-10 text-center d-flex flex-column justify-content-center py-4">
                        <!-- mobile -->
                        <span class="d-block d-md-none text-center mb-2">
                            1. Apri la tua vetrina anche nel mondo digitale <br>
                        </span>
                        <span class="d-block d-md-none text-center mb-2">
                            2. Rafforza la relazione con i tuoi clienti <br>
                        </span>
                        <span class="d-block d-md-none text-center">
                            3. Fatti conoscere da nuove persone
                        </span>
                        <!-- !mobile -->

                        <!-- desktop -->
                        <span class="d-none d-md-block h3 text-center mb-2">
                            1. Apri la tua vetrina anche nel mondo digitale <br>
                        </span>
                        <span class="d-none d-md-block h3 text-center mb-2">
                            2. Rafforza la relazione con i tuoi clienti <br>
                        </span>
                        <span class="d-none d-md-block h3 text-center">
                            3. Fatti conoscere da nuove persone
                        </span>
                        <!-- !esktop -->
                    </div>
                    <div class="col-12 text-center">
                        <strong class="d-block d-md-none">Tieni aperta la tua attività commerciale.</strong>
                        <strong class="d-none d-md-block h3 font-weight-bold">Tieni aperta la tua attività commerciale.</strong>
                    </div>
                </div>
            </div>
            <div class="col-10 col-md-6 mx-auto py-4">
                <div class="row mt-5">
                    <div class="col-4 text-center mx-auto" v-for="index in 3" :key="index">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            height="55px"
                            width="55px"
                            viewBox="0 0 384 384"
                            style="fill: #e59e26; margin: 0 auto;">
                            <path d="m192 384c105.863281 0 192-86.128906 192-192 0-18.273438-2.550781-36.28125-7.601562-53.527344-2.488282-8.480468-11.34375-13.351562-19.847657-10.863281-8.488281 2.480469-13.34375 11.367187-10.863281 19.847656 4.183594 14.328125 6.3125 29.320313 6.3125 44.542969 0 88.222656-71.777344 160-160 160s-160-71.777344-160-160 71.777344-160 160-160c32.0625 0 62.910156 9.375 89.207031 27.105469 7.320313 4.941406 17.273438 3 22.207031-4.320313 4.9375-7.328125 3.011719-17.273437-4.316406-22.210937-31.601562-21.308594-68.632812-32.574219-107.097656-32.574219-105.863281 0-192 86.128906-192 192s86.136719 192 192 192zm0 0"/>
                            <path d="m356.6875 36.6875-164.6875 164.679688-52.6875-52.679688c-6.25-6.246094-16.375-6.246094-22.625 0-6.246094 6.25-6.246094 16.375 0 22.625l64 64c3.128906 3.128906 7.214844 4.6875 11.3125 4.6875s8.183594-1.558594 11.3125-4.6875l176-176c6.246094-6.25 6.246094-16.375 0-22.625-6.25-6.246094-16.375-6.246094-22.625 0zm0 0"/>
                        </svg>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-4 text-center mx-auto" v-for="(item, index) in textList" :key="index">
                        <span class="d-block d-md-none">
                            {{ item }}
                        </span>
                        <span class="d-none d-md-block h4">
                            {{ item }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /end section -->

        <!--Section 2-->
        <div class="w-100 py-5" style="background-color: #2f2f2f;">
            <p class="titolo-section text-center h2">Spesa Vicino è la scelta migliore!</p>
            <p class="testo col-11 col-md-9 pt-2 mx-auto" style="line-height: 25px; text-align: center;">
                Chi avrebbe mai pensato, solo un anno fa, che il mondo sarebbe cambiato così velocemente e profondamente?
            </p>
            <p class="testo col-11 col-md-9 pt-2 mx-auto text-center">
                Questa improvvisa emergenza, con le conseguenti misure protettive che limitano spostamenti e relazioni fisiche, sta mettendo in seria difficoltà la tua attività commerciale, che è legata ad una spesa di prossimità, fatta di incontri, conoscenza diretta dei clienti, legame col territorio?
                Perché non reagire, ad accettare la sfida del cambiamento, sperimentando nuovi modi di entrare in relazione con i clienti e vendere?
                Oggi tutti hanno uno smartphone e, proprio in queste ultime settimane, è enormemente cresciuto il numero di persone che fanno acquisti sul web. Molti non torneranno più indietro.
                Noi di www.attividigitali.com ci occupiamo di sviluppo software e realizzazione di applicazioni web e abbiamo realizzato www.spesavicino.it uno strumento semplice e veloce per aprire una vetrina nel mondo digitale e vendere anche online.
            </p>
            <blockquote class="text-white text-center pt-1 col-11 col-md-9 mx-auto pt-5 font-italic" style="font-weight:bold;">
                "Il mondo non sta finendo, sta solo cambiando. <br>Adattarci ed evolvere è ciò che, anche questa volta, siamo chiamati a fare."
            </blockquote>
        </div>
        <!-- /section -->

        <!--Section 3 - gallery-->
        <div id="orange" class="w-100 py-5">
            <p class="titolo-section2 text-center h2">Molti ci hanno già scelto</p>
            <div class="row mt-5 mx-auto w-75">
                <div class="col p-0 rounded"
                    style="background-color:#fff; box-shadow: 15px 15px 20px black; overflow: hidden; margin: 5px;"
                    v-for="(item, index) in loghiList" :key="index">
                    <img :src="item.image" :alt="item.alt" style="width: 100%; height: auto;">
                </div>
            </div><!-- /row -->
        </div>

        <box-offerte />
        <contact />

    </div>
</template>

<script>
import Copertina from '../components/customLayout/Copertina'
import Offerte from '../components/customLayout/Offerte'
import Contatti from '../components/customLayout/Contatti'

export default {
    name: "Home",
    metaInfo: {
        title: "Spesavicino, la spesa sotto casa",
        // override the parent template and just use the above title only
        titleTemplate: null,
        meta: [
            {
                name: "description",
                content: "spesavicino l'e-commerce di prossimità"
            }
        ]
    },
    components: {
        'copertina' : Copertina,
        'box-offerte' : Offerte,
        'contact' : Contatti
    },
    data() {
        return {
            sliders: [
                {
                    image: '/customLayout/images/bread.jpg',
                    alt: 'bread'
                },
                {
                    image: '/customLayout/images/flowers.jpg',
                    alt: 'flowers'
                },
                {
                    image: '/customLayout/images/coffee.jpg',
                    alt: 'coffee'
                },
                {
                    image: '/customLayout/images/food.jpg',
                    alt: 'food'
                },
                {
                    image: '/customLayout/images/pizza.jpg',
                    alt: 'pizza'
                },
            ],
            textList: [
                'Basta poco per partire',
                'Semplice da usare',
                'Non ti lascia solo nella gestione'
            ],
            loghiList: [
                {
                    image: '/customLayout/images/loghi/logo (1).jpg',
                    alt: 'logo1'
                },
                {
                    image: '/customLayout/images/loghi/logo (2).jpg',
                    alt: 'logo1'
                },
                {
                    image: '/customLayout/images/loghi/logo (3).jpg',
                    alt: 'logo1'
                },
                {
                    image: '/customLayout/images/loghi/logo (4).jpg',
                    alt: 'logo1'
                }
            ]
        };
    },
    created() {
    },
    mounted() {
    },
    methods: {
    }
};
</script>

<style scoped>
#orange {
    background-color: #e59e26;
    padding-bottom: 100px;
}
</style>
