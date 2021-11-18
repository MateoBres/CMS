<template>
    <div id="app">
        <Header></Header>
        <flash-message class="myCustomClass"></flash-message>
        <slot class="vh-60"/>
        <cart></cart>
        <Footer></Footer>
    </div>
</template>

<script>
import Header from "../components/Header";
import Footer from "../components/Footer";
import Cart2 from "../components/Cart2";

export default {
    name: "AppLayout",
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
        Header,
        Footer,
        cart: Cart2
    },
    data() {
        return {};
    }
};
</script>

<style>
/* @import url("https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700&display=swap"); */
/* @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300&display=swap'); */
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap');
#app2 {
    /*font-family: Avenir, Helvetica, Arial, sans-serif;*/
    font-family: "Open Sans", sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 0px;
}

.vh-60 {
    min-height: 60vh;
}

</style>
