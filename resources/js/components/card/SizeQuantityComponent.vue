<template>
  <div>
      <div class="input-group">
                            <div class="input-group-prepend">
                                <span
                                    class="input-group-text"
                                    id="inputGroupPrepend"
                                    @click="qtyMinus()"
                                    ><i class="fas fa-minus"></i
                                ></span>
                            </div>
                            <input
                                type="text"
                                class="form-control text-center"
                                v-model="quantityNumber"
                            />
                            <div class="input-group-append">
                                <span
                                    class="input-group-text"
                                    id="inputGroupPrepend"
                                    @click="qtyPlus()"
                                    ><i class="fas fa-plus "></i
                                ></span>
                            </div>
                        </div>
  </div>
</template>

<script>
export default {
    name: 'QuantitySizeComponent',
    data() {
        return {
            quantityNumber: 0,
        }
    },
    methods: {
         qtyPlus() {
            this.quantityNumber++;
            this.$emit('calcolusPrice', this.quantityNumber);
        },
        qtyMinus() {
            if (this.quantityNumber > 1) {
                this.quantityNumber--;
                this.$emit('calcolusPrice', this.quantityNumber);
            }
        },
    }
}
</script>

<style>

</style>