<template>

<div class="d-flex flex-column w-100" style="background-color: #2f2f2f; height: 20vh">
    <div id="footer" class="row my-auto">
        <div class="col-12 col-md-4 d-flex flex-column">
            <div class="row justify-content-center my-auto">
                <div class="col-8 col-md-6">
                    <a href="/">
                        <img src="/customLayout/images/logo-spesa-vicino-bianco-ombra-arancio-min.png" class="w-100 img-fluid">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 my-1 testo-footer d-flex flex-column">
            <div class="row justify-content-center my-auto">
                <div class="col-10 text-center d-flex flex-column">
                    <p class="text-white text-center my-auto">
                        © 2021 - Attivi Digitali srl - www.attividigitali.com
                    </p>
                </div>
            </div>
        </div> 
        <div class="col-12 col-md-4 my-1 testo-footer d-flex flex-column">
            <div class="row justify-content-center my-auto">
                <a class="text-white mx-1" href="/condizioni">
                    Condizioni di Servizio
                </a>
                <span class="text-white">&bull;</span>
                <a class="text-white mx-1" href="/privacy">
                    Privacy Policy
                </a>
                <span class="text-white">&bull;</span>
                <a class="text-white mx-1" href="/cookie">
                    Cookie Policy
                </a>
            </div>
        </div> 
    </div>
</div>
</template>

<script>
export default {
    name: 'Footer'
}
</script>

<style scoped>
.list-unstyled {list-style: inline;}
.list-unstyled li {padding-left: 15px;}
.list-unstyled li a,
.list-unstyled li a:link,
.list-unstyled li a:hover,
.list-unstyled li a:active,
.list-unstyled li a:focus {color: #fff;}
</style>