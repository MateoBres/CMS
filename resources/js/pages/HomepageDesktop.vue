<template>
  <div id="homepage-container">
    <!-- header -->
    <section id="cover" style="height:100vh; position:relative; background-image:url('/images/counter.jpg'); background-size:cover; background-position:center;">
      <div class="w-100 h-100" style="position:relative; top:0; left:0; background-color:rgba(0,0,0,0.6); z-index:0">
        <div class="w-full">
          <div class="d-flex px-5 py-1">
            <img src="/images/logo/logo-spesa-vicino-bianco-ombra-arancio-min.png" style="height:80px">
            <div class="d-flex flex-row ml-auto">
              <!-- <span class="my-auto text-white h2">HOME</span>
              <span class="my-auto ml-5 text-white h2">ESEMPI</span> -->
              <a href="/login" class="my-auto ml-5 text-white h2 text-decoration-none">LOGIN</a>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row justify-content-center py-5">
            <img src="/images/logo/logo-sm-ora.png" class="mx-auto">
          </div>
          <div class="row">
            <p class="text-uppercase text-white mx-auto text-center font-weight-bold" style="font-size:4rem;">
              il commercio locale<br />passa al digitale
            </p>
            <p class="text-white mx-auto" style="font-size:2rem;">
              Crea il tuo negozio in pochi click!
            </p>
          </div>
          <div class="row">
            <a href="/azienda/registra" class="mx-auto">
              <button class="btn btn-secondary text-white text-uppercase rounded-pill py-2 px-5" style="font-size:1.5rem;">inizia ora</button>
            </a>
          </div>
          <div class="row mt-5">
            <a href="#first-section" class="mx-auto d-flex" style="height: 60px; width: 60px;">
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
      </div>
    </section>
    
    <!-- bullet points section -->
    <section id="first-section" class="p-5 d-flex flex-column text-center">
      <h2 style="color:#DB7600; font-size:2rem; font-weight:bold;">Unisci la vendita online a quella tradizionale</h2>
      <div class="d-flex flex-column pt-3 pb-5" style="font-size:1.5rem; ">
        <span>1. Apri la tua vetrina anche nel mondo digitale</span>
        <span>2. Rafforza la relazione con i tuoi clienti</span>
        <span>3. Fatti conoscere da nuove persone</span>
      </div>
      <span style="font-size:2rem;">Tieni aperta la tua attività commerciale</span>
    </section>

    <!-- checkmarks section -->
    <section id="second-section" class="text-center">
      <div style="background-image:url('/images/counter-girl.jpg'); background-size:cover; background-position:center;">
        <div class="p-5" style="background-color:rgba(0,0,0,0.6)">
          <h2 style="color:#DB7600; font-size:2rem; font-weight:bold;">Spesa Vicino è la scelta migliore!</h2>
          <span style="font-size:2rem; color:white;">Chi avrebbe mai pensato che il mondo sarebbe cambiato così velocemente e profondamente?</span>
          <div class="row justify-content-center py-3">
            <div class="col-3 d-flex flex-column text-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                style="width:50%; color:white;"
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
            <div class="col-3 d-flex flex-column text-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                style="width:50%; color:white;"
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
            <div class="col-3 d-flex flex-column text-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                style="width:50%; color:white;"
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
          <div class="row justify-content-center py-2">
            <h2 class="mx-auto font-italic text-white">
              "Il mondo non sta finendo, sta solo cambiando. Adattarci ed evolvere è ciò che, anche questa volta, siamo chiamati a fare"
            </h2>
          </div>
          <div class="row justify-content-center py-2">
            <a href="/azienda/registra">
              <button class="btn btn-lg btn-light rounded-pill text-uppercase font-weight-bold px-5 py-3">inizia ora</button>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- pricing section -->
    <section id="pricing-section" class="pb-4">
      <h2 style="color:#DB7600; font-size:2rem; font-weight:bold;" class="text-center py-4">
        Scegli il pacchetto adatto a te!
      </h2>
      <div class="container">
        <div style="display:grid; grid-template-columns: 1fr 1fr 1fr">
          <div class="px-2 h-100">
            <div class="w-full h-100 border border-2 border-secondary rounded-lg px-3 pb-4 d-flex flex-column">
              <h2 class="font-weight-bold text-center py-4 border-bottom border-2 border-secondary">Pronti via!</h2>
              <h2 class="font-weight-bold text-center py-4">€ 0,00 / anno<br /><small>gratuito per sempre</small></h2>
              <p class="text-center h4 mb-4">
                Logo e insegna<br />
                Indirizzo geolocalizzato<br />
                Info sull'attività<br />
                Menu Virtuale <br />
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
          <div class="px-2 h-100">
            <div class="w-full h-100 border border-2 border-secondary rounded-lg px-3 pb-4 d-flex flex-column">
              <h2 class="font-weight-bold text-center py-4 border-bottom border-2 border-secondary">Standard</h2>
              <h2 class="font-weight-bold text-center py-4">€ 16,90 / mese<br /><small>pagamento annuale</small></h2>
              <p class="text-center h4 mb-4">
                Logo e insegna<br />
                Indirizzo geolocalizzato<br />
                Info sull'attività<br />
                Vetrina del negozio<br />
                Menu Virtuale <br />
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
              <button @click="scrollBottom" class="btn btn-dark rounded-pill text-uppercase py-3 text-secondary">
                contattaci
              </button>
            </div>
          </div>
          <div class="px-2 h-100">
            <div class="w-full h-100 border border-2 border-secondary rounded-lg px-3 pb-4 d-flex flex-column">
              <h2 class="font-weight-bold text-center py-4 border-bottom border-2 border-secondary">Top!</h2>
              <h2 class="font-weight-bold text-center py-4">€ 24,90 / mese<br /><small>pagamento annuale</small></h2>
              <p class="text-center h4 mb-4">
                Logo e insegna<br />
                Indirizzo geolocalizzato<br />
                Info sull'attività<br />
                Vetrina del negozio<br />
                Menu Virtuale <br />
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
              <button @click="scrollBottom" class="btn btn-dark rounded-pill text-uppercase py-3 text-secondary">
                contattaci
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- information section -->
    <section id="information" class="bg-secondary">
      <div class="py-5 container">
        <div class="row text-white justify-content-center">
          <div class="col-3">
            <svg
              class="w-100 h-100"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              aria-hidden="true"
              role="img"
              width="1em"
              height="1em"
              preserveAspectRatio="xMidYMid meet"
              viewBox="0 0 32 32"
            >
              <path
                style="transform:rotate(25deg); transform-origin:center;"
                d="
                  M28.707 19.293L26 16.586V13a10.014 10.014 0 0 0-9-9.95V1h-2v2.05A10.014 10.014 0 0 0 6 13v3.586l-2.707 2.707A1 1 0 0 0 3 
                  20v3a1 1 0 0 0 1 1h7v.777a5.152 5.152 0 0 0 4.5 5.199A5.006 5.006 0 0 0 21 25v-1h7a1 1 0 0 0 1-1v-3a1 1 0 0 0-.293-.707zM19 
                  25a3 3 0 0 1-6 0v-1h6zm8-3H5v-1.586l2.707-2.707A1 1 0 0 0 8 17v-4a8 8 0 0 1 16 0v4a1 1 0 0 0 .293.707L27 20.414z
                "
                fill="white"
              />
            </svg>
          </div>
          <div class="col-8">
            <p class="h3">
              Vuoi <strong>rinnovare il sito web</strong> della tua attività e renderlo fresco, attraente e aggiornato?
            </p>
            <p class="h3 mb-1">
              Con la nostra piattaforma <u>www.colibree.it</u> possiamo realizzare siti web vetrina in modo professionale, veloce, economico.
              Siti web belli da vedere e semplici da mantenere e aggiornare.
            </p>
            <p class="h3 mb-4">
              <strong>
                E se lo ordini insieme a spesavicino ti facciamo uno sconto!
              </strong>
            </p>
            <button @click="scrollBottom" class="btn btn-light rounded-pill text-uppercase font-weight-bold">
              contattaci
            </button>
          </div>
        </div>
        <div class="row text-white mt-4 justify-content-center">
          <div class="col-8 text-right">
            <p class="h3 mb-4 text-right">
              <strong>Non hai tempo</strong> per inserire e aggiornare i contenuti del tuo e-commerce (prodotti, testi, video, immagini)?
              Lo facciamo noi per te grazie ad un servizio di <strong>assistenza su misura</strong>
            </p>
            <button @click="scrollBottom" class="btn btn-light rounded-pill text-uppercase font-weight-bold">
              contattaci
            </button>
          </div>
          <div class="col-3">
            <svg
              class="w-100 h-100"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              aria-hidden="true"
              role="img"
              width="1em"
              height="1em"
              preserveAspectRatio="xMidYMid meet"
              viewBox="0 0 1024 1024"
            >
              <path
                style="transform:rotate(-25deg); transform-origin:center;"
                d="M880 112c-3.8 0-7.7.7-11.6 2.3L292 345.9H128c-8.8 0-16 7.4-16 16.6v299c0 9.2 7.2 16.6 16 16.6h101.7c-3.7 11.6-5.7 23.9-5.7 
                36.4c0 65.9 53.8 119.5 120 119.5c55.4 0 102.1-37.6 115.9-88.4l408.6 164.2c3.9 1.5 7.8 2.3 11.6 2.3c16.9 0 32-14.2 32-33.2V145.2C912 
                126.2 897 112 880 112zM344 762.3c-26.5 0-48-21.4-48-47.8c0-11.2 3.9-21.9 11-30.4l84.9 34.1c-2 24.6-22.7 44.1-47.9 44.1zm496 58.4L318.8 
                611.3l-12.9-5.2H184V417.9h121.9l12.9-5.2L840 203.3v617.4z"
                fill="white"
              />
            </svg>
          </div>
        </div>
      </div>
    </section>

    <!-- contacts form -->
    <section id="contacts" class="p-5 bg-dark">
      <div class="container">
        <div class="row justify-content-center">
          <form class="col-8">
            <div class="form-row mb-4">
              <div class="col">
                <input v-model="first_name" type="text" placeholder="Nome" required class="form-control rounded-pill border-0">
              </div>
              <div class="col">
                <input v-model="last_name" type="text" placeholder="Cognome" required class="form-control rounded-pill border-0">
              </div>
            </div>
            <div class="form-row mb-4">
              <div class="col">
                <input v-model="phone" type="tel" pattern="[0-9]{10}" placeholder="Telefono" class="form-control rounded-pill border-0">
              </div>
              <div class="col">
                <input v-model="email" type="text" placeholder="E-mail" class="form-control rounded-pill border-0">
              </div>
            </div>
            <div class="form-row mb-4">
              <div class="col">
                <input v-model="subject" type="text" placeholder="Oggetto" required class="form-control rounded-pill border-0">
              </div>
            </div>
            <div class="form-row mb-4">
              <div class="col">
                <textarea v-model="description" class="form-control border-0" required placeholder="Descrizione" style="border-radius:1rem;" rows="3"></textarea>
              </div>
            </div>
            <div class="form-row mb-4">
              <button v-if="mail_sent && !mail_error" class="btn btn-success text-white rounded-pill text-uppercase text-center mx-auto px-5">mail inviata</button>
              <button v-else @click.prevent="sendContactsMail" :disabled="!formValidation || !emailValidation" class="btn btn-secondary text-white rounded-pill text-uppercase text-center mx-auto px-5">invia</button>
              <span class="text-center w-100 text-danger mt-1" v-if="formErrorMessage && !mail_sent">{{ formErrorMessage }}</span>
              <span class="text-center w-100 text-danger mt-1" v-if="emailErrorMessage && !mail_sent">{{ emailErrorMessage }}</span>
            </div>
          </form>
        </div>
        <div class="row mt-4">
          <div class="col">
            <img src="/images/logo/logo-spesa-vicino-bianco-ombra-arancio-min.png" style="height:60px;">
          </div>
          <div class="col d-flex">
            <span class="text-white text-center my-auto">&copy; 2021 - Attivi Digitali srl - www.attividigitali.com</span>
          </div>
          <div class="col d-flex">
            <span class="text-white text-right my-auto">
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
        email_error_message: null,
        form_error_message: null,
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
      },
      scrollBottom() {
        const homepageContainer = document.querySelector("#homepage-container");
        const bottom = homepageContainer.offsetHeight
        window.scrollTo(0, bottom)
      },
    }
  }
</script>
<style scoped>
  html {
      scroll-behavior: smooth;
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