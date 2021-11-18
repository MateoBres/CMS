<template>
<div class="col-12 col-lg-10 mx-auto py-5" id="card-offerte">
    <div class="row justify-content-center">
        <p class="col-12 font-weight-bold titolo-section h3 text-center">Scegli il pacchetto adatto a te!</p>

        <div class="w-100 row justify-content-center mx-auto">
            
            <div class="col-12 col-md-6 col-lg-4 text-center">
                <div id="card" class="card mb-4 shadow-sm m-3 flex">
                    <div class="card-header" >
                        <h4 class="my-0 font-weight-normal">Pronti via!</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">€0,00 <small class="text-muted">/ anno</small></h1>
                        <div class="d-flex flex-column">
                            <span>Logo e insegna</span>
                            <span>Indirizzo geolocaspanzzato</span>
                            <span>Info sull'attività</span>
                            <span>Vetrina digitale del negozio</span>
                            <span>Badge pagine social</span>
                            <span>Vetrina fino a 7 prodotti</span>
                        </div>
                        <div class="col mt-4">
                            <button type="button" class="btn btn-lg btn-block btn-dark"
                                @click="$router.push('/login')">Inizia subito</button>      
                        </div>
                    </div>
                </div><!-- /card -->
            </div>

            <div class=" col-12 col-md-6 col-lg-4 text-center">
                <div id="card" class="card mb-4 shadow-sm m-3">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Vetrina</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">€159,00 <small class="text-muted">/ anno</small></h1>
                        <div class="d-flex flex-column">
                            <span>Logo e insegna</span>
                            <span>Indirizzo geolocaspanzzato</span>
                            <span>Info sull'attività</span>
                            <span>Vetrina digitale del negozio</span>
                            <span>Badge pagine social</span>
                            <span>Vetrina con prodotti ilspanmitati</span>
                        </div>
                        <div class="col mt-4">
                            <button type="button" class="btn btn-lg btn-block btn-dark"
                                @click="$router.push('/login')">Inizia subito</button>      
                        </div>      
                    </div>
                </div><!-- /card -->
            </div>

            <div class=" col-12 col-md-6 col-lg-4 text-center">
                <div id="card" class="card mb-4 shadow-sm m-3">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Tutto pronto</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">€299,00 <small class="text-muted">/ anno</small></h1>
                        <div class="d-flex flex-column">
                            <span>Pacchetto <b>Vetrina +</b></span>
                            <span>Orari ritiro in negozio e consegna a domicilio</span>
                            <span>Gestione degli ordini clienti</span>
                            <span>Pagamenti online</span>
                            <span>Integrazione spedizioni SiWeGo</span>
                            <span>1 ora consulenza</span>
                        </div>
                    <div class="col mt-4">
                            <button type="button" class="btn btn-lg btn-block btn-dark"
                                @click="$router.push('/login')">Inizia subito</button>      
                        </div>
                    </div>
                </div><!-- /card -->
            </div>

            <div class="col-12 col-md-6 col-lg-4 text-center">
                <div id="card" class="card mb-4 shadow-sm m-3 flex">
                    <div class="card-header" >
                        <h4 class="my-0 font-weight-normal">Identità digitale</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">€799,00 <small class="text-muted">/ anno</small></h1>
                        <div class="d-flex flex-column">
                            <span>Pacchetto <b>Tutto pronto</b> + </span>
                            <span>Sito Web</span>
                            <span><img src="/customLayout/images/logo-colibree.png" style="width:200px;"></span>
                        </div>
                        <div class="col mt-4">
                            <button type="button" class="btn btn-lg btn-block btn-dark"
                                @click="$router.push('/login')">Inizia subito</button>      
                        </div>      
                    </div>
                </div><!-- /card -->
            </div>

            <div class="col-12 col-md-6 col-lg-4 text-center">
                <div id="card" class="card mb-4 shadow-sm m-3">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Ai primi posti</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">€899,00 <small class="text-muted">/ anno</small></h1>
                        <div class="d-flex flex-column">
                            <span>Pacchetto <b>Tutto pronto</b> + </span>
                            <span>Sito Web & Gestione SEO</span>
                            <span><img src="/customLayout/images/logo-colibree.png" style="width:200px;"></span>
                        </div>
                        <div class="col mt-4">
                            <button
                                type="button"
                                class="btn btn-lg btn-block btn-dark"
                                @click="$router.push('/login')"
                            >Inizia subito</button>
                        </div>
                    </div>
                </div><!-- /card -->
            </div>
        </div><!-- /w-100 -->
    </div>
</div>

</template>

<script>
export default {
    name: 'Offerte'
}
</script>

<style scoped>
#card ul {padding-bottom: 30px; padding-top: 15px;}
#card li {color:#000000 !important;}
#card .btn-dark {margin-top:25px;}
</style>