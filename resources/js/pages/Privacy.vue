<template>
    <div class="box">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-white">
                <h1 class="display-3">Spesavicino - Privacy Policy</h1>
                <h2 class="lead">
                    <strong>
                        La piattaforma che trasforma i piccoli esercizi
                        commerciali del territorio in negozi online per essere
                        sempre vicini ai propri clienti anche quando sono
                        lontani
                    </strong>
                </h2>
                <hr class="my-2" />
                <!-- <p>More info</p>
                <p class="lead">
                    <a
                        class="btn btn-primary btn-lg"
                        href="Jumbo action link"
                        role="button"
                        >Il nostro sogno</a
                    >
                </p> -->
            </div>
        </div>
        <div class="container  my-4">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Title</h4> -->
                    <div class="card-text">
                        <article class="text-left main-content">
                            <a
                                href="https://www.iubenda.com/privacy-policy/16200524"
                                class="iubenda-white no-brand iubenda-embed iub-legal-only iub-body-embed"
                                title="Privacy Policy"
                                >Privacy Policy</a
                            >
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript"></script>
<script>
export default {
    name: "Privacy",
    data() {
        return {};
    },
    mounted() {
        (function(w, d) {
            var loader = function() {
                var s = d.createElement("script"),
                    tag = d.getElementsByTagName("script")[0];
                s.src = "https://cdn.iubenda.com/iubenda.js";
                tag.parentNode.insertBefore(s, tag);
            };
            if (w.addEventListener) {
                w.addEventListener("load", loader, false);
            } else if (w.attachEvent) {
                w.attachEvent("onload", loader);
            } else {
                w.onload = loader;
            }
        })(window, document);
    }
};
</script>

<style scoped lang="scss">
.box {
    background-color: #e9d7c3;
    padding-bottom: 60px;
}

.box-blue {
    background-color: #005c92;
    color: #fff;
}
.jumbotron {
    background-image: linear-gradient(
            rgba(241, 133, 0, 0.6),
            rgba(241, 133, 0, 0.6)
        ),
        url("/images/perchicompra.jpg");
    background-size: cover;
    background-position: center;
    background-color: #f18500;
}
text-white {
    color: white;
}

.main-content {
    font-size: 1em;
    padding-bottom: 80px;
    color: #454545;
}

.evidenza {
    font-size: 1.4em;
}
</style>
