<template>
    <div class="card rounded bg-white shadow m-0 border border-secondary home-banner">
        <div class="container">
            <Search class="p-1 my-auto"></Search>
            <div class="d-flex flex-row justify-content-center px-4 pb-4 text-left d-none d-lg-flex">
                <img
                    class="img-fluid banner-image d-none d-md-block"
                    src="/images/logo-spesa-vicino-bianco-small.png"
                    alt="spesavicino - la spesa sotto casa"
                />
                <div class="d-flex flex-column my-auto ml-5">
                    <h1 class="h1 d-none d-lg-block">spesavicino.it</h1>
                    <h3 class="d-none d-md-block" style="font-size:1rem"> 
                        I migliori commercianti della tua città che effettuano consegne a domicilio e ritiro in negozio. Ordina subito!
                    </h3>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Search from './Search'
export default {
    name: "Banner",
    components:{
        Search
    },
};
</script>

<style scoped lang="scss">
$primary: #005c92;
$secondary: #f18500;
$background: #e9d7c3;

.jumbotron {
    padding: 0.5rem 2rem;
}
.bg-primary {
    background-color: $primary;
}
.jumbotron-title {
    font-weight: 500;
    font-size: 4rem;
}
h2 {
    font-weight: 300;
    font-size: 1.6rem;
    font-weight: bold;
    font-style: italic;
}
h3 {
    font-weight: 300;
    font-size: 1.3rem;
}

@media only screen and ( max-width: 576px) {
    .banner-image {
        max-height: 50px;
    }
    .home-banner {
    height:fit-content; 
    max-width:100%;
    }
}

@media only screen and ( min-width: 576px) {
    .banner-image {
        max-height: 100px;
    }
    .home-banner {
    height:fit-content; 
    max-width:50%;
    }
}
/* .banner {background-color: #2abb9b;color: #ffffff;margin-bottom: 0px;} */
</style>
