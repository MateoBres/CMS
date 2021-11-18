<template>
    <div>
        <p class="prodotti-nr d-flex justify-content-center">
            Articoli Disponibili: <span class="badge badge-light my-auto ml-1"> {{ item < 8 ? item : '7' }}</span>
        </p>
    </div>
</template>

<script>
export default {
    name: 'TotalItems',
    props: ['item']
}
</script>

<style scoped>
.top-footer-card {}
p {padding-bottom:0px !important;padding-top: 0px;color: #ffffff;margin-bottom: 0px;}
</style>>

