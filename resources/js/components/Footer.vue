<template>
    <div>
        <footer class="containner-fluid py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mb-2" role="img" viewBox="0 0 24 24" focusable="false"><title>Product</title><circle cx="12" cy="12" r="10"></circle><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"></path></svg> -->
                        <router-link
                            :to="{ name: 'Home' }"
                            class="navbar-brand"
                        >
                            <img
                                class="img-fluid"
                                src="/images/logo/logo-spesa-vicino-bianco-min.png"
                            />
                        </router-link>
                        <small class="d-block mb-3 text-muted">© 2020</small>
                    </div>
                    <div class="col-6 col-md">
                        <h5>Link Rapidi</h5>
                        <ul class="list-unstyled text-small">
                            <li
                                v-for="link in links_policy"
                                v-bind:key="link.name"
                            >
                                <a
                                    class="text-muted"
                                    href="#"
                                    v-on:click="goToPage(link.name)"
                                    >{{ link.desc }}</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="col-6 col-md">
                        <h5>Servizi</h5>
                        <ul class="list-unstyled text-small">
                            <li
                                v-for="link in links_pages"
                                v-bind:key="link.name"
                            >
                                <a
                                    class="text-muted"
                                    href="#"
                                    v-on:click="goToPage(link.name)"
                                    >{{ link.desc }}</a
                                >
                            </li>
                            <!--  <li><a class="text-muted" href="#">Takeaway</a></li>
                            <li><a class="text-muted" href="#">Altro</a></li> -->
                        </ul>
                    </div>
                    <!-- <div class="col-6 col-md">
                        <h5>Risorse</h5>
                        <ul class="list-unstyled text-small">
                            <li><a class="text-muted" href="#">Mappa</a></li>
                            <li><a class="text-muted" href="#">Carrello</a></li>
                            <li><a class="text-muted" href="#">Ordini</a></li>
                            <li><a class="text-muted" href="#">Account</a></li>
                        </ul>
                    </div> -->
                    <!-- <div class="col-6 col-md">
                        <h5>About</h5>
                        <ul class="list-unstyled text-small">
                            <li><a class="text-muted" href="#">Team</a></li>
                            <li>
                                <a class="text-muted" href="#">Locations</a>
                            </li>
                            <li><a class="text-muted" href="#">Privacy</a></li>
                            <li><a class="text-muted" href="#">Terms</a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
            <!-- /container -->
            <div class="container-flui">
                <div class="container copyright" id="footer">
                    <p>
                        © 2020 - Attivi Digitali srl -
                        <a
                            href="https://www.attividigitali.com/"
                            style="color:white"
                            >www.attividigitali.com</a
                        >
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    name: "Footer",
    data() {
        return {
            links_policy: [
                {
                    name: "Condizioni",
                    desc: "Condizioni di servizio"
                },
                {
                    name: "privacy",
                    desc: "Privacy Policy"
                },
                {
                    name: "cookie",
                    desc: "Cookie Policy"
                }
            ],
            links_pages: [
                {
                    name: "IlProgetto",
                    desc: "il nostro progetto"
                },
                {
                    name: "PerChiVende",
                    desc: "il tuo negozio online"
                },
                {
                    name: "PerChiCompra",
                    desc: "incomincia ad usare spesavicino"
                }
            ]
        };
    },
    methods: {
        goToPage(component) {
            this.$router.push({ name: component });
        }
    }
};
</script>

<style scoped lang="scss">
$primary: #005c92;
$secondary: #f18500;
$background: #e9d7c3;
footer a,
footer a:link,
footer a:visited,
footer a:hover {
    color: $primary;
}
footer {
    background-color: #003864;
    color: $secondary;
}
footer .text-muted,
footer .text-muted:link,
footer .text-muted:visited,
footer .text-muted:active,
footer .text-muted:hover {
    color: $primary;
}

.copyright {
    font-size: 9pt;
}
</style>
