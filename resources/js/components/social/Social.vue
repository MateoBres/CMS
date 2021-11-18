<template>
    <div class="d-flex" v-if="!loading && mysocials.length && mysocials.length > 0">
        <div v-for="social in mysocials" :key="social.id">
            <a
                v-if="social.url != null && social.url != ''"
                class="socialIcon"
                :href="'//' + social.url.replace(/^https?:\/\//,'')"
                target="_blank"
            >
                <span class="fa-stack" :class="{ 'fa-2x' : size != 'small' || !size }">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i :class="social.iconClass"></i>
                </span>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: "social",
    props: ["sn", 'size'],
    data() {
        return {
            mysocials: [],
            my_sn: this.sn,
            loading: true
        };
    },
    async mounted() {
        await this.setIcons();
        this.loading = false;
    },
    methods: {
        setIcons() {
            let getSocials = this.sn;
            console.log('getSocials', getSocials);
            for (let [key, value] of Object.entries(getSocials)) {
                if (value != "" || value != null) {
                    console.log(`social_list= ${key}: ${value}`);
                    let social = {
                        name: key,
                        url: value
                    };
                    switch (key) {
                        case "facebook":
                            social.iconClass =
                                "fab fa-facebook-f fa-stack-1x fa-inverse";
                            break;
                        case "instagram":
                            social.iconClass =
                                "fab fa-instagram fa-stack-1x fa-inverse";
                            break;
                        case "twitter":
                            social.iconClass =
                                "fab fa-twitter fa-stack-1x fa-inverse";
                            break;
                        case "youtube":
                            social.iconClass =
                                "fab fa-youtube fa-stack-1x fa-inverse";
                            break;

                        default:
                            social.iconClass =
                                "fab fa-facebook-f fa-stack-1x fa-inverse";
                            break;
                    }
                    this.mysocials.push(social);
                }
            }
        },
    }
};
</script>

<style></style>
