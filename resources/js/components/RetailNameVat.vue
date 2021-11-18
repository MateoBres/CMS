<template>
<div>
    <h5>
        <i class="fas fa-info-circle" 
                data-toggle="modal" 
                data-target="#exampleModalVat"></i>
        {{ name }} - {{ vat }} <span><i v-if="subscription != 'free'" class="fas fa-star ml-3 mr-1"></i>{{ subscription }}</span>
    </h5>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalVat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">
                        <i class="fas fa-question-circle"></i> HAI BISOGNO DI ASSISTENZA?
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        SE HAI NECESSITA' DI CAMBIARE L'INSEGNA<br>
                        (piva, denominazione o altro...) <br>
                        <br>contattaci qui:
                    </p>
                    <div class="box box-sx">
                        <h2 class="text-center"><i class="fas fa-envelope"></i></h2>
                        <p>
                            SCRIVI A QUESTA EMAIL:
                            <br><a href="mailto:info@spesavicino.it">info@spesavicino.it</a>
                        </p>
                        <p class="text-small">N.B: Lasciaci un recapito telefonico, ti ricontatteremo al più presto!</p>
                    </div>
                    <div class="box box-rx">
                        <h2 class="text-center"><i class="fas fa-phone-square-alt"></i></h2>
                        <p>
                            OPPURE TELEFONA O INVIA UN SMS AL<br>
                            <a href="tel:">+39 030 7829290</a>
                        </p>
                    </div>
                </div>

                </div>
            </div>
        </div><!-- /modal -->

</div>
</template>

<script>
import { mapState } from 'vuex'
export default {
    name: 'RetailNameVat',
    props: ['name', 'vat', 'premium', 'subscription'],
}
</script>

<style scoped>
    
    #exampleModalVat p {font-size: 14pt;color: #000000;}

    #exampleModalVat .text-small {font-size: 10pt;font-weight: bold;}

    #exampleModalVat .box {
        margin-top: 20px;margin-bottom: 20px;
        padding-top: 30px;padding-bottom: 30px;
        color:#ffffff;
    }

    .box-sx {background-color: #f18500;}
    .box-rx {background-color: #005c92;}
    #exampleModalVat h2 {color: #ffffff;}
    #exampleModalVat a,
    #exampleModalVat a:link,
    #exampleModalVat a:hover,
    #exampleModalVat a:visited {color: #ffffff;}
</style>