<template>
    <div class="container mt-3" style="min-height:80vh; padding-top:10vh">
        <div class="card shadow mt-2">
            <div class="card-header bg-transparent">
                <p class="h5">Pagamento effettuato con successo</p>
            </div>
            <div class="card-footer bg-transparent">
                <router-link :to="{path: '/'}" class="btn btn-primary btn-block">
                    Torna alla Homepage
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>
import { eventBus } from '../app'
export default {
    data() {
        return {
            style_data: {
                height: window.innerHeight - 383.2 + 'px'
            },
        }
    },
    methods: {
        submitOrder() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.getters.token}`
                }
            }
            axios
                .get(`/api/orders/${this.$route.params.order_id}/submit`, config)
                .then(response => {
                    console.log(response)
                    this.resetState()
                    axios
                        .get(`/api/orders/${this.order.id}/notify`)
                        .then(response => {
                            console.log('notifications sent')
                        })
                        .catch(e => {
                            console.log(e)
                        })
                    eventBus.$emit('order-completed', {})
                })
                .catch(e => {
                    console.log(e)
                })
        },
        resetState() {
            this.$store.commit('resetState')
        }
    },
    async mounted() {
        this.submitOrder()
    },
    computed: {
        order_id: function() {
            return this.$store.getters.order_id
        }
    },
    watch: {
        order_id: function() {
            this.submitOrder()
        }
    }
}
</script>
<style scoped lang="scss">
    $primary: #005c92;
    $secondary: #f18500;
    $background: #e9d7c3;

    .btn-primary {
        background-color: $primary;
    }
</style>