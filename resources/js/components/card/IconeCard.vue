<template>

   <div class="col-12">
      <div class="row">
         <div class="col-12">
            <div class="row">
            <!-- <div class="col-lg-12 col-xl-6 p-0 m-0"> -->
               <div class="col-3 my-1" v-if="phone">
                  <a :href="'tel:' + phone" class="icon-link">
                     <i class="fas fa-phone-alt fa-lg mx-2 py-1" v-if="phone"></i>
                  </a>
               </div>
               <div class="col-3 my-1" v-if="email">
                  <a :href="'mailto:' + email" class="icon-link">
                     <i class="fas fa-envelope fa-lg mx-2 py-1" v-if="email"></i>
                  </a>
               </div>
               <div class="col-3 my-1" v-if="social.facebook">
                  <a :href="social.facebook" target="_blank" class="icon-link">
                     <i class="fab fa-facebook fa-lg mx-2 py-1" v-if="social.facebook"></i>
                  </a>
               </div>
               <div class="col-3 my-1" v-if="social.twitter">
                  <a :href="social.twitter" target="_blank" class="icon-link">
                     <i class="fab fa-twitter fa-lg mx-2 py-1" v-if="social.twitter"></i>
                  </a>
               </div>
            <!-- </div> -->
            <!-- <div class="col-lg-12 col-xl-6 p-0 m-0"> -->
               <div class="col-3 my-1" v-if="social.instagram">
                  <a :href="social.instagram" target="_blank" class="icon-link">
                     <i class="fab fa-instagram fa-lg mx-2 py-1" v-if="social.instagram"></i>
                  </a>
               </div>
               <div class="col-3 my-1" v-if="whatsapp">
                  <a :href="'https://wa.me/' + whatsapp" class="icon-link">
                     <i class="fab fa-whatsapp fa-lg mx-2 py-1" v-if="whatsapp"></i>
                  </a>
               </div>
               <div class="col-3 my-1" v-if="telegram">
                  <a :href="'https://t.me/' + telegram" class="icon-link">
                     <i class="fab fa-telegram-plane fa-lg mx-2 py-1" v-if="telegram"></i>
                  </a>
               </div>
               <div class="col-3 my-1" v-if="messenger">
                  <a :href="'http://m.me/' + messenger" class="icon-link">
                     <i class="fab fa-facebook-messenger fa-lg mx-2 py-1" v-if="messenger"></i>
                  </a>
               </div>
            <!-- </div> -->
            </div>
         </div>
      </div>
   </div>

</template>

<script>
export default {
    name: 'IconeCard',
    props: ['data', 'phone', 'email', 'social', 'whatsapp', 'telegram', 'messenger'],
}
</script>

<style scoped>
    .icone-card {padding-left: 0px;padding-top: 0px;padding-bottom: 0px;margin-bottom: 0rem}
    .icone-card li {
        display: inline;
        padding: 7px 4px 7px 4px;
    }
    .icone-card li a,
    .icone-card li a:link,
    .icone-card li a:hover,
    .icone-card li a:visited,
    .icone-card li a:active {
        color: #ffffff;
        border-radius: 100%;
        font-size: 14pt;
    }

    .icon-link,
    .icon-link:link,
    .icon-link:hover,
    .icon-link:visited,
    .icon-link:active {color: #ffffff}
</style>