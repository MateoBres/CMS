<template>
        <div id="app-new" class="container-fluid p-0 row-fluid flex-wrap d-flex flex-grow-1" style="overflow: hidden;">
            <Header />
            <slot />
            <Footer />
            <!-- <cart v-if="isLoggedIn"></cart> -->
            <flash-message class="myCustomClass"></flash-message>
        </div>
</template>

<script>
import Cart2 from "../components/Cart2";
import Header from '../components/customLayout/Header'
import Footer from '../components/customLayout/Footer'
import { mapState } from 'vuex'

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
        // cart: Cart2,
        Header,
        Footer
    },
    data() {
        return {};
    },
    computed:
        mapState({
            isLoggedIn:     state => state.isLoggedIn
        })
};
</script>

<style>


</style>
