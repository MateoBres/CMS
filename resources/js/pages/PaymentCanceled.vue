<template>
    
</template>
<script>
    export default {
        mounted() {
            this.cancelOrder()
        },
        methods: {
            cancelOrder() {
                let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.getters.token}`
                }
            }
            axios
                .put(`/api/orders/${this.$params.order_id}/cancel`)
                .then(response => {
                    this.$router.push({ name: 'Home'})
                })
            }
        }
    }
</script>