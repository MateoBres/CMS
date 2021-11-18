<template>
    <li class="text-left">
        <span>{{ item_sku }}</span> -
        <span> {{ item_name }} X {{ item_qty }}</span>
        <strong class="text-monospace"
            >&euro; {{ ((item_price / 100) * item_qty).toFixed(2) }}</strong
        >
    </li>
</template>

<script>
export default {
    name: "itemvoice",
    props: ["itemData"],
    data() {
        return {
            /* item: this.itemData */
            item_sku: null,
            item_name: null,
            item_price: null,
            item_qty: null
        };
    },
    mounted() {
        this.item_sku = this.itemData.sku;
        this.item_name = this.itemData.name;
        this.item_price = this.itemData.price;
        if (this.itemData.pivot.modify) {
            let details = JSON.parse(this.itemData.pivot.modify);
            this.item_qty = details.qty;
        } else {
            this.item_qty = 1;
        }
    }
};
</script>

<style></style>
