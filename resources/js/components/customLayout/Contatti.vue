<template>

    <div id="form" class="col-12 py-5" style="background-color: #2f2f2f;">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-4">
                <p class="titolo-section col-12 text-center h3">Per maggiori informazioni compila il form!</p>
                <form class="mx-auto">
                    <div class="form-row mt-4">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="Nome*">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="Cognome*">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Telefono*">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="E-mail*">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Oggetto">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Descrizione" style="height: 100px;">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col-12">
                            <button type="submit" class="btn w-100" style="background-color:#e59e26">Contattaci</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
</template>

<script>
export default {
    name: 'Contatti',
}
</script>

<style>

</style>