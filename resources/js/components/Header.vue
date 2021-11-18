<template>
    <div>
        <nav class="navbar navbar-expand-xl navbar-dark bg-secondary position-relative d-flex d-lg-none">
            <router-link
                :to="{ name: 'Home' }"
                class="navbar-brand"
            >
                <img
                    @click="closeNavMenu()"
                    class="img-fluid logo-header"
                    src="/images/logo/logo-spesa-vicino-bianco-ombra-arancio-min.png"
                    style="height:80px;"
                    alt="spesavicino.it - la spesa sotto casa"
                />
            </router-link>
            <button
                class="navbar-toggler position-relative my-4"
                id="hamburger"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
                style="top:0; right:0"
            >
                <span class="navbar-toggler-icon text-white"></span>
            </button>

            <div
                class="collapse navbar-collapse ml-md-5"
                id="navbarSupportedContent"
            >
                <ul class="navbar-nav ml-auto d-flex">
                    <li class="nav-item my-1">
                        <a
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            class="nav-link text-white h5 my-auto"
                            href="#"
                            @click="goToPage('IlProgetto')"
                            >Il Progetto</a
                        >
                    </li>
                    <li class="nav-item my-1">
                        <a
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            class="nav-link text-white h5 my-auto"
                            href="#"
                            @click="goToPage('PerChiCompra')"
                            >FAQ</a
                        >
                    </li>
                    <li class="nav-item my-1">
                        <a
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            class="nav-link text-white h5 my-auto"
                            href="#"
                            @click="goToPage('PerChiVende')"
                            >Funzionalità</a
                        >
                    </li>
                    <li class="nav-item my-1 mx-3 my-auto">
                        <a
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            class="nav-link h5 my-auto"
                            @click="toggleCart()"
                        >
                            <i
                                class="fas fa-shopping-cart fa-lg text-white"
                            ></i
                            ><span class="fa-stack fa-sm" v-if="itemsCount > 0" style="font-size:0.8rem">
                                <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                <span class="fa-stack-1x text-white">
                                    {{ itemsCount }}
                                </span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item my-1 mx-3 my-auto p-1">
                        <router-link
                            :to="{ name: 'VersioneAvanzata' }"
                            class="nav-link nav-item btn-primary shadow text-white rounded my-auto"
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                        >
                            Acquista Pacchetto
                        </router-link>
                    </li>
                    <li
                        class="nav-item my-1 mx-3 my-auto p-1"
                        v-if="!isLoggedInComputed"
                    >
                        <router-link
                            :to="{ name: 'RegistraAzienda' }"
                            class="nav-link nav-item btn-primary shadow rounded text-white my-auto"
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                        >
                            Registra gratis la tua attività
                        </router-link>
                    </li>
                    <li class="nav-item my-1 mx-3 my-auto p-1">
                        <router-link
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            :to="{
                                path: `/publisher/${userId}/retailer/${retailerId}/${retailerRoute}`
                            }"
                            v-if="
                                userId &&
                                    isLoggedInComputed &&
                                    userName &&
                                    userRoleName == 'publisher'
                            "
                        >
                            <a class="nav-link btn btn-primary text-white border-0 px-2 shadow">
                                <i class="fas fa-user mr-2"></i> {{ userName }}
                            </a>
                        </router-link>
                        <router-link
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            :to="{ path: `/user/${userId}/orders` }"
                            v-if="
                                userId &&
                                    isLoggedInComputed &&
                                    userName &&
                                    userRoleName == 'std_user'
                            "
                        >
                            <a class="nav-link btn btn-primary border-0 px-2 shadow text-white">
                                <i class="fas fa-user mr-2"></i> {{ userName }}
                            </a>
                        </router-link>
                    </li>
                    <li class="nav-item my-1 mx-3 my-auto" v-if="!loading_data">
                        <router-link
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            :to="{ name: 'Login' }"
                            v-if="!isLoggedInComputed"
                        >
                            <a class="nav-link h5 my-auto text-white">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login
                            </a>
                        </router-link>

                        <a
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            class="nav-link h5 my-auto text-white"
                            v-else
                            @click="logout()"
                        >
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav social">
                     <li class="nav-item my-1 mx-3 my-auto">
                         <a href="https://www.facebook.com/spesavicino" target="_blank" class="nav-link">
                            <i class="fab fa-facebook"></i>
                         </a>
                     </li>
                </ul>
            </div>
        </nav>

        <nav class="navbar navbar-expand-xl navbar-dark bg-secondary position-relative d-none d-lg-flex">
            <router-link

               
                :to="{ name: 'Home' }"
                class="navbar-brand mx-auto"
            >
                <img
                    class="img-fluid logo-header"
                    src="/images/logo/logo-spesa-vicino-bianco-ombra-arancio-min.png"
                    style="height:80px;"
                    alt="spesavicino.it - la spesa sotto casa"
                />
            </router-link>
            <button
                class="navbar-toggler position-relative m-4"
                type="button"


                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
                style="top:0; right:0"
            >
                <span class="navbar-toggler-icon text-white"></span>
            </button>

            <div
                class="collapse navbar-collapse ml-md-5"
                id="navbarSupportedContent"
            >
                <ul class="navbar-nav ml-auto d-flex">
                    <li class="nav-item my-1">
                        <a


                            class="nav-link text-white h5 my-auto"
                            href="#"
                            @click="goToPage('IlProgetto')"
                            >Il Progetto</a
                        >
                    </li>
                    <li class="nav-item my-1">
                        <a


                            class="nav-link text-white h5 my-auto"
                            href="#"
                            @click="goToPage('PerChiCompra')"
                            >FAQ</a
                        >
                    </li>
                    <li class="nav-item my-1">
                        <a


                            class="nav-link text-white h5 my-auto"
                            href="#"
                            @click="goToPage('PerChiVende')"
                            >Funzionalità</a
                        >
                    </li>
                    <li class="nav-item my-1 mx-3 my-auto">
                        <a


                            class="nav-link h5 my-auto"
                            @click="toggleCart()"
                        >
                            <i
                                class="fas fa-shopping-cart fa-lg text-white"
                            ></i
                            ><span class="fa-stack fa-sm" v-if="itemsCount > 0" style="font-size:0.8rem">
                                <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                <span class="fa-stack-1x text-white">
                                    {{ itemsCount }}
                                </span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item my-1 mx-3 my-auto p-1">
                        <router-link
                            :to="{ name: 'VersioneAvanzata' }"
                            class="nav-link nav-item btn-primary shadow text-white rounded my-auto"


                        >
                            Acquista Pacchetto
                        </router-link>
                    </li>
                    <li
                        class="nav-item my-1 mx-3 my-auto p-1"
                        v-if="!isLoggedInComputed"
                    >
                        <router-link
                            :to="{ name: 'RegistraAzienda' }"
                            class="nav-link nav-item btn-primary shadow rounded text-white my-auto"


                        >
                            Registra gratis la tua attività
                        </router-link>
                    </li>
                    <li class="nav-item my-1 mx-3 my-auto p-1">
                        <router-link


                            :to="{
                                path: `/publisher/${userId}/retailer/${retailerId}/${retailerRoute}`
                            }"
                            v-if="
                                userId &&
                                    isLoggedInComputed &&
                                    userName &&
                                    userRoleName == 'publisher'
                            "
                        >
                            <a class="nav-link btn btn-primary text-white border-0 px-2 shadow">
                                <i class="fas fa-user mr-2"></i> {{ userName }}
                            </a>
                        </router-link>
                        <router-link


                            :to="{ path: `/user/${userId}/orders` }"
                            v-if="
                                userId &&
                                    isLoggedInComputed &&
                                    userName &&
                                    userRoleName == 'std_user'
                            "
                        >
                            <a class="nav-link btn btn-primary border-0 px-2 shadow text-white">
                                <i class="fas fa-user mr-2"></i> {{ userName }}
                            </a>
                        </router-link>
                    </li>
                    <li class="nav-item my-1 mx-3 my-auto" v-if="!loading_data">
                        <router-link


                            :to="{ name: 'Login' }"
                            v-if="!isLoggedInComputed"
                        >
                            <a class="nav-link h5 my-auto text-white">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login
                            </a>
                        </router-link>

                        <a


                            class="nav-link h5 my-auto text-white"
                            v-else
                            @click="logout()"
                        >
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav social">
                     <li class="nav-item my-1 mx-3 my-auto">
                         <a href="https://www.facebook.com/spesavicino" target="_blank" class="nav-link">
                            <i class="fab fa-facebook"></i>
                         </a>
                     </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
import { eventBus } from "../app";
export default {
    name: "Header",
    data() {
        return {
            isLoggedIn: this.$store.getters.isLoggedIn,
            show_login: true,
            show_register_company: false,
            show_reserved_area: false,
            items_number: 0,
            retailer_info: null,
            retailer_address: null,
            loading_data: true
        };
    },
    async mounted() {
        await this.getRetailer();
        this.loading_data = false;
        this.isLoggedIn = this.$store.getters.isLoggedIn;
        if (this.isLoggedInComputed) {
            this.show_login = false;
        }

        eventBus.$on("login", () => {
            this.show_login = false;
            console.log("login emit received");
        });

        eventBus.$on("items-number", number => {
            this.items_number = number;
        });
    },
    computed: {
        isLoggedInComputed: function() {
            return this.$store.getters.isLoggedIn;
        },
        userId: function() {
            return this.$store.getters.userId;
        },
        retailerId: function() {
            return this.$store.getters.retailerId;
        },
        userName: function() {
            return this.$store.getters.userName;
        },
        retailerRoute: function() {
            if (this.retailer_info) {
                if (
                    !this.retailer_info.phone ||
                    !this.retailer_info.email ||
                    !this.retailer_address
                ) {
                    return "info";
                } else {
                    return "orders";
                }
            }
        },
        userRoleName: function() {
            return this.$store.getters.userRoleName;
        },
        itemsCount: function() {
            return this.$store.getters.itemsCount
        }
    },
    watch: {
        isLoggedInComputed: function() {
            if (this.isLoggedInComputed) {
                this.show_login = false;
            } else {
                this.show_login = true;
            }
            // this.show_login = !this.show_login;
        }
    },
    methods: {
        closeNavMenu() {
            let classlist = document.getElementById('navbarSupportedContent').classList
            if(classlist.contains('show')) {
                document.getElementById('hamburger').click()
            }
        },
        logout() {
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
        goToPage(page) {
            this.$router.push({ name: page });
        },
        toggleCart() {
            eventBus.$emit("toggle-cart", {});
        },
        getRetailer() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.token}`
                }
            };
            axios
                .get("/api/retails/" + this.retailerId, config)
                .then(response => {
                    this.retailer_info = JSON.parse(response.data.data.info);
                    this.retailer_address = response.data.data.address;
                    this.$store.dispatch('setRetailerSlug', response.data.data.slug)
                    this.$store.dispatch('setRetailerVat', response.data.data.vat)
                })
                .catch(e => {
                    console.log(e);
                });
        }
    }
};
</script>

<style scoped lang="scss">
$primary: #005c92;
$secondary: #f18500;
$background: #e9d7c3;

@media only screen and (max-width:330px) {
    .logo-header {
        max-height: 40px;
    }

    .navbar-toggler-icon {
        max-height: 20px;
    }
}
@media only screen and (min-width:330px) and (max-width:576px) {
    .logo-header {
        max-height: 70px;
    }

    .navbar-toggler-icon {
        max-height: 20px;
    }
}
@media only screen and (min-width:576px) and (max-width:768px) {
    .logo-header {
        max-height: 60px;
    }

    .navbar-toggler-icon {
        max-height: 40px;
    }
}
@media only screen and (min-width:768px) {
    .logo-header {
        max-height: 80px;
    }
}

.site-header {
    background-color: #ffc244;
    padding-top: 20px;
    padding-bottom: 20px;
}

.navbar-brand {
    display: inline-block;
    padding-top: 0rem;
    padding-bottom: 0rem;
    margin-right: 1rem;
    font-size: 1.125rem;
    line-height: inherit;
    white-space: nowrap;
}
.normal-link,
.normal-link:active,
.normal-link:visited,
.normal-link:hover,
.normal-link:link {
    color: #ffffff;
    font-size: 12pt;
    font-weight: bold;
}

.cart {
    background-color: seagreen;
}
.cart:link,
.cart:visited,
.cart:hover,
.cart:active {
    color: #ffffff;
    padding-left: 10px;
    padding-right: 10px;
    border-radius: 20px;
}

.registrati {
    background-color: #2abb9b;
}
.registrati:hover,
.registrati:visited,
.registrati:active,
.registrati:link {
    color: #ffffff;
    font-weight: bolder;
    /* padding-left:10px;padding-right: 10px;
        margin-top: 0px;margin-bottom: 0px;
        padding-bottom: 0px;padding-top: 0px; */
    /* border-radius:0px; */
}

.login-link:link,
.login-link:visited,
.login-link:hover,
.login-link:active {
    color: #2abb9b;
}

.bg-secondary {
    background-color: $secondary;
}

.social {font-size: 22pt;}
.social li a,
.social li a:link,
.social li a:hover,
.social li a:active,
.social li a:visited {color:#ffffff;}
</style>
