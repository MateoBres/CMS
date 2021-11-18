<template>
    <div v-if="!loading">
        <a
            class="socialIcon"
            v-for="social in myIM"
            :href="social.url"
            target="_blank"
            :key="social.id"
            ><span class="fa-stack fa-2x">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i :class="social.iconClass"></i> </span
        ></a>
    </div>
</template>

<script>
export default {
    name: "im",
    props: ["im"],
    data() {
        return {
            myIM: [],
            my_im: this.im,
            loading: true
        };
    },
    async mounted() {
        await this.setIcons();
        this.loading = false;
    },
    methods: {
        setIcons() {
            let getImmyIM = this.im;
            console.log(getImmyIM);
            for (let [key, value] of Object.entries(getImmyIM)) {
                if (value != "") {
                    console.log(`social_list= ${key}: ${value}`);
                    let social = {
                        name: key,
                        url: value,
                    };
                    switch (key) {
                        case "fb_messenger":
                            social.iconClass = "fab fa-facebook-messenger fa-stack-1x fa-inverse";
                            social.url = 'https://m.me/' + social.url
                            break;
                        case "telegram":
                            social.iconClass = "fab fa-telegram-plane fa-stack-1x fa-inverse";
                            social.url = 'https://t.me/' + social.url
                            break;
                        case "whatsapp":
                            social.iconClass = "fab fa-whatsapp fa-stack-1x fa-inverse";
                            social.url = 'https://wa.me/' + social.url
                            break;

                        default:
                            social.iconClass =
                                "fab fa-facebook-f fa-stack-1x fa-inverse";
                            break;
                            break;
                    }
                    this.myIM.push(social);
                }
            }
        }
    }
};
</script>

<style></style>
