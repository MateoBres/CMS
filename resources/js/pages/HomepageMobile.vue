<template>
  <div>
    <!-- hero -->
    <section id="hero" class="hero">
      <div class="overlay backdrop w-100 h-100">
        <div class="d-flex flex-column my-auto">
          <h1 class="text-white text-uppercase font-weight-bold mx-auto h2 text-center mt-3">Spesa Vicino</h1>
          <span class="text-white mx-auto text-center mt-1 h4">
            Ristoranti - Negozi alimentari <br /> Artigiani - Commercio al Dettaglio
          </span>
          <img class="mx-auto" src="/images/logo/logo-sm-ora.png">
          
          <span class="text-white text-uppercase font-weight-bold mx-auto h2 text-center mt-2">
            il commercio locale passa al digitale
          </span>

          <h2 class="text-white mx-auto text-center mt-2 h4">
            Crea il tuo negozio online <br />in pochi click!
          </h2><br />
          

          <!-- <button class="btn btn-secondary rounded rounded-pill px-5 py-2 text-white text-uppercase mx-auto mt-5">
            inizia ora
          </button> -->
          <a href="#" v-scroll-to="'#intro-section'" class="mx-auto d-flex mt-5" style="height: 60px; width: 60px;">
              <svg
                class="bounce"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                aria-hidden="true"
                role="img"
                width="60"
                height="60"
                preserveAspectRatio="xMidYMid meet"
                viewBox="0 0 20 20"
              >
                <g fill="none">
                  <path
                    d="M15.853 8.646a.5.5 0 0 1 .001.707l-5.465 5.484a.55.55 0 0 1-.78 0L4.146 9.353a.5.5 0 1 1 .708-.706L10 13.812l5.147-5.165a.5.5 0 0 1 
                    .707-.001zm0-4a.5.5 0 0 1 .001.707l-5.465 5.484a.55.55 0 0 1-.78 0L4.146 5.353a.5.5 0 1 1 .708-.706L10 9.812l5.147-5.165a.5.5 0 0 1 .707-.001z"
                    fill="white"
                  />
                </g>
              </svg>
            </a>
        </div>
      </div>
    </section>

    <!-- intro -->
    <section id="intro-section" class="p-5 d-flex flex-column text-center">
      <span class="text-secondary h3 font-weight-bold">Unisci la vendita online a quella tradizionale</span>
      <div class="d-flex flex-column pt-3 pb-5 h4">
        <span>1. Apri la tua vetrina anche nel mondo digitale</span>
        <span>2. Rafforza la relazione con i tuoi clienti</span>
        <span>3. Fatti conoscere da nuove persone</span>
      </div>
      <span class="h3">Tieni aperta la tua attività commerciale</span>
    </section>

    <!-- checkmarks -->
    <section id="second-section" class="text-center">
      <div style="background-image:url('/images/counter-girl.jpg'); background-size:cover; background-position:center;">
        <div class="p-5" style="background-color:rgba(0,0,0,0.6)">
          <h2 style="color:#DB7600; font-size:2rem; font-weight:bold;">Spesa Vicino è la scelta migliore!</h2>
          <div class="row justify-content-center py-3">
            <div class="col-12 d-flex flex-column text-center pb-3">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                style="width:30%; color:white;"
                class="mx-auto"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="1"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
              <span class="text-white" style="font-size:1.5rem">Basta poco per partire</span>
            </div>
            <div class="col-12 d-flex flex-column text-center pb-3">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                style="width:30%; color:white;"
                class="mx-auto"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="1"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
              <span class="text-white" style="font-size:1.5rem">Semplice da usare</span>
            </div>
            <div class="col-12 d-flex flex-column text-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                style="width:30%; color:white;"
                class="mx-auto"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="1"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
              <span class="text-white" style="font-size:1.5rem">Non ti lascia solo nella gestione</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- pricing section -->
    <section id="pricing-section" class="pb-4">
      <h2 style="color:#DB7600; font-size:2rem; font-weight:bold;" class="text-center py-4 px-4">
        Scegli il pacchetto<br />adatto a te!
      </h2>
      <div class="container">
        <div style="display:grid; grid-template-rows: 1fr 1fr 1fr">
          <div class="py-2 h-100">
            <div class="w-full h-100 border border-2 border-secondary rounded-lg px-3 pb-4 d-flex flex-column">
              <h2 class="font-weight-bold text-center py-4 border-bottom border-2 border-secondary">Pronti via!</h2>
              <h2 class="font-weight-bold text-center py-4">€ 0,00 / anno<br /><small>gratuito per sempre</small></h2>
              <p class="text-center h4 mb-4">
                Logo e insegna<br />
                Indirizzo geolocalizzato<br />
                Info sull'attività<br />
                Vetrina del negozio<br />
                Badge per pagine social<br />
                Gestione Takeaway e Delivery<br />
                Gestione Spedizioni<br />
                Gestione ordini clienti<br />
              </p>
              <u class="text-center h4 mb-4 mt-auto">Fino a 7 prodotti</u>
              <a href="/azienda/registra" class="btn btn-dark rounded-pill text-uppercase py-3 text-secondary">
                inizia ora
              </a>
            </div>
          </div>
          <div class="py-2 h-100">
            <div class="w-full h-100 border border-2 border-secondary rounded-lg px-3 pb-4 d-flex flex-column">
              <h2 class="font-weight-bold text-center py-4 border-bottom border-2 border-secondary">Standard</h2>
              <h2 class="font-weight-bold text-center py-4">€ 16,90 / mese<br /><small>pagamento annuale</small></h2>
              <p class="text-center h4 mb-4">
                Logo e insegna<br />
                Indirizzo geolocalizzato<br />
                Info sull'attività<br />
                Vetrina del negozio<br />
                Badge per pagine social<br />
                Gestione Takeaway e Delivery<br />
                Gestione Spedizioni<br />
                Gestione ordini clienti<br />
                Gestione avanzata articoli<br />
                Pagamenti online<br />
                1 ora di consulenza<br />
                4 immagini per prodotto<br />
                categorie prodotto<br />
              </p>
              <u class="text-center h4 mb-4 mt-auto">Fino a 70 prodotti</u>
              <!-- <button class="btn btn-dark rounded-pill text-uppercase py-3 text-secondary">
                inizia ora
              </button> -->
              <a href="#" v-scroll-to="'#contacts'" class="btn btn-dark rounded-pill text-uppercase py-3 text-secondary">
                contattaci
              </a>
            </div>
          </div>
          <div class="py-2 h-100">
            <div class="w-full h-100 border border-2 border-secondary rounded-lg px-3 pb-4 d-flex flex-column">
              <h2 class="font-weight-bold text-center py-4 border-bottom border-2 border-secondary">Top!</h2>
              <h2 class="font-weight-bold text-center py-4">€ 24,90 / mese<br /><small>pagamento annuale</small></h2>
              <p class="text-center h4 mb-4">
                Logo e insegna<br />
                Indirizzo geolocalizzato<br />
                Info sull'attività<br />
                Vetrina del negozio<br />
                Badge per pagine social<br />
                Gestione Takeaway e Delivery<br />
                Gestione Spedizioni<br />
                Gestione ordini clienti<br />
                Gestione avanzata articoli<br />
                Pagamenti online<br />
                2 ore di consulenza<br />
                4 immagini per prodotto<br />
                categorie prodotto<br />
              </p>
              <u class="text-center h4 mb-4 mt-auto">Fino a 700 prodotti</u>
              <!-- <button class="btn btn-dark rounded-pill text-uppercase py-3 text-secondary">
                inizia ora
              </button> -->
              <a href="#" v-scroll-to="'#contacts'" class="btn btn-dark rounded-pill text-uppercase py-3 text-secondary">
                contattaci
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- information section -->
    <section id="information" class="bg-secondary">
      <div class="py-5 container">
        <div class="row text-white">
          <div class="col-12 text-center">
            <p class="h5 text-center">
              Vuoi <strong>rinnovare il sito web</strong> della tua attività e renderlo fresco, attraente e aggiornato?
            </p>
            <p class="h5 text-center mb-1">
              Con la nostra piattaforma <u>www.colibree.it</u> possiamo realizzare siti web vetrina in modo professionale, veloce, economico.
              Siti web belli da vedere e semplici da mantenere e aggiornare.
            </p>
            <p class="h5 text-center mb-4">
              <strong>
                E se lo ordini insieme a spesavicino ti facciamo uno sconto!
              </strong>
            </p>
            <a href="#" v-scroll-to="'#contacts'">
              <button class="btn btn-light rounded-pill text-uppercase font-weight-bold">
                contattaci
              </button>
            </a>
          </div>
        </div>
        <div class="row text-white mt-4">
          <div class="col-12 text-center">
            <p class="h5 text-center mb-4">
              <strong>Non hai tempo</strong> per inserire e aggiornare i contenuti del tuo e-commerce (prodotti, testi, video, immagini)?
              Lo facciamo noi per te grazie ad un servizio di <strong>assistenza su misura</strong>
            </p>
            <a href="#" v-scroll-to="'#contacts'">
              <button class="btn btn-light rounded-pill text-uppercase font-weight-bold">
                contattaci
              </button>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- contacts form -->
    <section id="contacts" class="container py-5 bg-dark">
      <div class="container">
        <div class="row justify-content-center">
          <form class="col-12">
            <div class="form-row">
              <div class="col-12 mb-4">
                <input v-model="first_name" type="text" placeholder="Nome" class="form-control rounded-pill border-0">
              </div>
              <div class="col-12 mb-4">
                <input v-model="last_name" type="text" placeholder="Cognome" class="form-control rounded-pill border-0">
              </div>
            </div>
            <div class="form-row">
              <div class="col-12 mb-4">
                <input v-model="phone" type="text" placeholder="Telefono" class="form-control rounded-pill border-0">
              </div>
              <div class="col-12 mb-4">
                <input v-model="email" type="text" placeholder="E-mail" class="form-control rounded-pill border-0">
              </div>
            </div>
            <div class="form-row">
              <div class="col-12 mb-4">
                <input v-model="subject" type="text" placeholder="Oggetto" class="form-control rounded-pill border-0">
              </div>
            </div>
            <div class="form-row">
              <div class="col-12 mb-4">
                <textarea v-model="description" class="form-control border-0" placeholder="Descrizione" style="border-radius:1rem;" rows="3"></textarea>
              </div>
            </div>
            <div class="form-row">
              <div class="col-12 d-flex">
                <button v-if="mail_sent && !mail_error" class="btn btn-success text-white rounded-pill text-uppercase text-center mx-auto px-5">mail inviata</button>
                <button v-else @click.prevent="sendContactsMail" :disabled="!formValidation || !emailValidation" class="btn btn-secondary text-white rounded-pill text-uppercase text-center mx-auto px-5">invia</button>
              </div>
              <div class="col-12 d-flex">
                	<span class="text-center w-100 text-danger mt-1" v-if="formErrorMessage && !mail_sent">{{ formErrorMessage }}</span>
              </div>
              <div class="col-12 d-flex">
                	<span class="text-center w-100 text-danger mt-1" v-if="emailErrorMessage && !mail_sent">{{ emailErrorMessage }}</span>
              </div>
            </div>
          </form>
        </div>
        <div class="row mt-4">
          <div class="col-12 text-center mb-4">
            <img src="/images/logo/logo-spesa-vicino-bianco-ombra-arancio-min.png" style="height:60px;">
          </div>
          <div class="col-12 d-flex mb-4">
            <span class="text-white text-center mx-auto">&copy; 2021 - Attivi Digitali srl - www.attividigitali.com</span>
          </div>
          <div class="col-12 d-flex">
            <span class="text-white text-center mx-auto">
              Condizioni di Servizio &bull; Privacy Policy &bull; Cookie Policy
            </span>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        first_name: null,
        last_name: null,
        phone: null,
        email: null,
        subject: null,
        description: null,
        mail_sent: false,
        mail_error: false,
      }
    },
    computed: {
      formValidation() {
        if ( !this.first_name || !this.last_name || !this.phone || !this.email || !this.subject || !this.description ) {
          return false
        } return true
      },
      emailValidation() {
          if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
              return true
          } return false
      },
      formErrorMessage() {
        if (!this.formValidation) {
          return 'Compilare tutti i campi'
        } return ''
      },
      emailErrorMessage() {
        if (!this.emailValidation) {
          return 'Inserire un indirizzo mail valido'
        } return ''
      },
    },
    methods: {
      clearContactsForm() {
        this.first_name = null,
        this.last_name = null,
        this.phone = null,
        this.email = null,
        this.subject = null,
        this.description = null
      },
      sendContactsMail() {
        axios
          .post('/api/contacts', {
            data: {
              nome: this.first_name,
              cognome: this.last_name,
              phone: this.phone,
              email: this.email,
              oggetto: this.subject,
              description: this.description,
            }
          })
          .then( response => {
            console.log('mail sent')
            this.clearContactsForm()
            this.mail_sent = true
          })
          .catch( error => {
            console.log(error.response)
            this.mail_error = true
          })
      }
    }
  }
</script>
<style scoped>
  html {
    scroll-behavior: smooth;
  }

  .hero {
    height: 100vh;
    width: 100vw;
    position: relative;
    background-image: url('/images/counter-girl.jpg');
    background-size: cover;
    background-position: center;
  }
  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
  }
  .backdrop {
    background-color: rgba(0, 0, 0, 0.6);
  }
  .bounce {
	-webkit-animation: bounce 2s;
	        animation: bounce 2s;
	-webkit-animation-iteration-count: infinite;
	        animation-iteration-count: infinite;
}

@-webkit-keyframes bounce {
	0%,
	25%,
	50%,
	75%,
	100% {
		-webkit-transform: translateY(0);
		        transform: translateY(0);
	}
	40% {
		-webkit-transform: translateY(-20px);
		        transform: translateY(-20px);
	}
	60% {
		-webkit-transform: translateY(-12px);
		        transform: translateY(-12px);
	}
}

@keyframes bounce {
	0%,
	25%,
	50%,
	75%,
	100% {
		-webkit-transform: translateY(0);
		        transform: translateY(0);
	}
	40% {
		-webkit-transform: translateY(-20px);
		        transform: translateY(-20px);
	}
	60% {
		-webkit-transform: translateY(-12px);
		        transform: translateY(-12px);
	}
}
</style>