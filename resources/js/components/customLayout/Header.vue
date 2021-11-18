<template>
    <nav class="navbar fixed-top testo-nav d-flex flex-row" style="min-height: 10vh">
        <div class="col-12">
            <div class="row px-3 justify-content-between">
                <div class="col-6 col-md-3 col-lg-2 d-flex flex-column">
                    <img
                        v-if="!$route.meta.hideLogo"
                        src="/customLayout/images/logo-orange.png"
                        class="logo w-100 img-fluid"
                        alt="logo"
                        @click="$router.push('/')"
                    >
                </div>

                <div class="d-flex d-md-none" >
                    <button class="btn btn-dark border text-white navbar-toggler my-auto" type="button" data-toggle="collapse" data-target="#collapse-menu"
                    v-on:click="showMobileMenu = true" v-if="isLoggedIn">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>

                <div class="collapse navbar-collapse col-8 col-md-9 col-lg-10 d-none d-md-flex p-0"  v-if="isLoggedIn">
                    <div class="row w-100 justify-content-end">
                        <router-link class="my-auto mx-3 text-white text-uppercase " :to="{ path: `/` }" @click="logout()">
                            logout
                        </router-link>
                        <!-- <router-link class="my-auto mx-3 text-white text-uppercase" :to="{ path: `/login` }">
                            login
                        </router-link> -->
                    </div>
                </div>
            </div>

            <div class="row w-100 justify-content-center collapse" id="collapse-menu"  v-show="showMobileMenu" v-if="isLoggedIn">
                <div class="col-12 p-0">
                    <div class="d-flex flex-column w-100 justify-content-center">
                        <a href="" @click="showMobileMenu=false">
                            <router-link class="mx-auto my-1 text-white text-uppercase" :to="{ path: `/` }" @click="logout()">
                                logout
                            </router-link>
                        </a>
                        <!-- <a href="" @click="showMobileMenu=false">
                            <router-link class="mx-auto my-1 text-white text-uppercase" :to="{ path: `/login` }" >
                                login
                            </router-link>
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- <img
            src="/customLayout/images/logo-orange.png"
            class="logo h-100 img-fluid"
            alt="logo"
            @click="$router.push('/')"
        >
        <ul class="float-left text-white text-uppercase mt-1 right-menu">
            <li class="mx-3">
                <router-link :to="{ path: `/` }">
                    home
                </router-link>
            </li>
            <li class="mx-3">servizi</li>
            <li class="mx-3">
                <router-link :to="{ path: `/login` }">
                login
                </router-link>
            </li>
        </ul> -->
    </nav>
</template>

<script>
import { mapState } from 'vuex'

export default {
    name: 'Header',
    data () {
        return {
            showMobileMenu:true
        }
    },
    methods: {
        logout() {
            this.$store.dispatch('logout')
        },
    },
    computed:
        mapState({
            isLoggedIn:     state => state.isLoggedIn
        })
}
</script>

<style scoped>
.navbar {
    width: 100%;
    z-index: 999;
    background-color: rgba(47, 47, 47, 0.5);
}
.navbar .logo {
    z-index: 999;
}

.navbar .right-menu {
    list-style: none;
    z-index: 999;
}
a,
a:link {
    color: #ffffff;

    }
a:hover {color: #E59E35;}
a{
    text-align: center;
}
</style>

