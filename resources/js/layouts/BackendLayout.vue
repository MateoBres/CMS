<template>
    <!-- <div id="app-new" class="container-fluid p-0 row-fluid flex-wrap" style="overflow: hidden;"> -->
    <div id="app-new" class="d-flex flex-column min-vh-100" style="overflow: hidden;">
        <div v-if="isLoggedIn && userRoleName == 'publisher'" class="navbar fixed-top testo-nav d-flex flex-row justify-content-end" style="height: 5vh; background-color: rgba(0,0,0,0.5)">
            <router-link v-if="!isLoggedIn" class="my-auto text-white text-uppercase mx-3" :to="{ path: `/login` }">
                login
            </router-link>
            <router-link
                v-if="isLoggedIn && userRoleName == 'publisher'"
                class="my-auto text-white text-uppercase mx-3"
                :to="{ path: `/publisher/${userId}/retailer/${retailerId}/orders` }"
            >
                {{ userName }}
            </router-link>
            <router-link
                v-if="isLoggedIn && userRoleName == 'std_user'"
                class="my-auto text-white text-uppercase mx-3"
                :to="{ path: `/user/${userId}/orders` }"
            >
                {{ userName }}
            </router-link>
            <span @click.prevent="logout()" v-if="isLoggedIn" class="my-auto text-white text-uppercase mx-3">
                logout
            </span>
        </div>
        <slot/>
        <Footer />
        <cart></cart>
        <flash-message class="myCustomClass"></flash-message>
    </div>
</template>

<script>
import Cart2 from "../components/Cart2";
import Header from '../components/customLayout/Header'
import Footer from '../components/customLayout/Footer'

import { mapState } from 'vuex'
export default {
    name: "backend",
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
        // Footer
    },
    data() {
        return {};
    },
    methods: {
        logout() {
            console.log('backendlayout')
            if (this.$store.getters.isRetailer) {
                this.$store.dispatch('logout')
                this.$router.push({ name: "Home" })
            } else {
                this.$store.dispatch('logout')
                this.$router.push({
                    name: "Retailer",
                    params: {
                        slug: this.$route.params.slug,
                        vat: this.$route.params.vat
                    }
                });
            }
        },
    },
    computed: mapState({
        isLoggedIn:     state => state.isLoggedIn,
        retailerId:     state => state.retailerId,
        userName:       state => state.userName,
        userId:         state => state.userId,
        userRoleName:   state => state.userRoleName
    })
};
</script>

<style>


</style>
