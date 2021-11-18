<template>
    <div class="bg-light d-flex flex-column" style="height: 100vh">
      <!-- <Header /> -->
      <slot />
      <div class="w-100 overflow-hidden mt-auto">
        <!-- <Footer /> -->
      </div>
    </div>
</template>

<script>
import Cart2 from "../components/Cart2";
import Header from '../components/customLayout/Header'
import Footer from '../components/customLayout/Footer'

export default {
    name: "custom",
    metaInfo: {
        // if no subcomponents specify a metaInfo.title, this title will be used
        title: "Spesavicino.it",
        // all titles will be injected into this template
        titleTemplate: "%s | spesavicino.it",
        meta: [
            {
                name: "robots",
                content: "index, follow"
            }
        ]
    },

    components: {
        cart: Cart2,
        Header,
        Footer
    },
    data() {
        return {};
    }
};
</script>

<style>


</style>
