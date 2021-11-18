<template>
    <div class="banner-contatti" style="">
        <div class="container">
            <div class="row">
                <div class="col col-12 col-md-6">
                    <h2>
                        Per problemi o per ulteriori informazioni<br />
                        sulla nostra iniziativa<br />
                        contattaci dal form.
                    </h2>
                </div>
                <div class="col col-12 col-md-6">
                    <form-contatti></form-contatti>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Contatti from "./FormContatti";
export default {
    name: "BannerContatti",
    components: {
        "form-contatti": Contatti
    }
};
</script>

<style scoped lang="scss">
$primary: #005c92;
$secondary: #f18500;
$background: #e9d7c3;
.banner-contatti {
    padding-top: 0px;
    padding-bottom: 0px;
    background-color: $primary;
    background-image: url("/images/siluetta-blu.png");
    background-repeat: no-repeat;
    // background-attachment: fixed;
    background-position: bottom;
    background-size: contain;
}
.banner-contatti h2 {
    text-align: center;
    color: #ffffff;
    vertical-align: middle;
}
.banner-contatti .container {
    padding-top: 40px;
    padding-bottom: 40px;
    // background-color: rgba(190, 88, 88, 0.5);
}
</style>
