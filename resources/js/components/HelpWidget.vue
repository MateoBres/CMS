<template>
<div>
    <div class="assistenza">
        <button class="btn btn-danger btn-help"
                data-toggle="modal" 
                data-target="#exampleModal"
                @mouseover="hover = true"
                @mouseleave="hover = false">
            <i class="fas fa-question-circle"></i>
            <span v-if="hover">ASSISTENZA</span>
        </button>
    </div>

    <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header d-flex">
                    <h5 class="modal-title text-center mx-auto" id="exampleModalLabel">
                        <i class="fas fa-question-circle"></i> HAI BISOGNO DI ASSISTENZA?
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="box box-sx d-flex flex-column">
                        <h2 class="text-center w-100"><i class="fas fa-envelope"></i></h2>
                        <p class="mx-auto text-center">
                            SCRIVI A QUESTA EMAIL:
                            <br><a href="mailto:info@spesavicino.it">info@spesavicino.it</a>
                        </p>
                        <p class="text-small col-8 mx-auto text-center">N.B: Lasciaci un recapito telefonico, ti ricontatteremo al più presto!</p>
                    </div>
                    <div class="box box-rx d-flex flex-column">
                        <h2 class="text-center" w-100><i class="fas fa-phone-alt"></i></h2>
                        <p class="mx-auto text-center">
                            OPPURE TELEFONA O INVIA UN SMS AL<br>
                            <a href="tel:">331 1338209</a>
                        </p>
                    </div>
                </div>

                </div>
            </div>
        </div><!-- /modal -->

</div>
</template>

<script>
export default {
    name: 'HelpWidget',
    data() {
        return {
            hover: false
        }
    }
}
</script>

<style scoped>
    .assistenza {
        position: fixed;
        right: 0px;
        top:50%;
        z-index: 9999;
    }

    .btn-help {border-radius: 100px 0px 0px 100px;}
    
    #exampleModal p {font-size: 14pt;color: #ffffff;}

    #exampleModal .text-small {font-size: 10pt;font-weight: bold;}

    #exampleModal .box {
        margin-top: 20px;margin-bottom: 20px;
        padding-top: 30px;padding-bottom: 30px;
    }

    .box-sx {background-color: #f18500;}
    .box-rx {background-color: #005c92;}
    #exampleModal h2 {color: #ffffff;}
    #exampleModal a,
    #exampleModal a:link,
    #exampleModal a:hover,
    #exampleModal a:visited {color: #ffffff;}
</style>