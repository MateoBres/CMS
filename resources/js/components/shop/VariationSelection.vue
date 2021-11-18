<template>
  <div class="col col-12 mx-0 px-0">
      <div class="row">

        <div class="col col-12 col-md-6" v-if="items">
            <label for="">Scegli Colore:</label>
            <select 
                v-model="parent"
                class="form-control"
                @change="setVariationParent()">
                <option v-for="(item, index) in items.composition" :key="index" :value="item">{{ item.parent }}</option>
            </select>
        </div>
        
        <div class="col col-12 col-md-6" v-if="parent.childs" >
            <label for="">Seleziona Taglia</label>
            <select
                v-model="child"
                class="form-control"
                @change="setVariationChild()">
                <option
                v-for="(item, index) in parent.childs" :key="index" 
                    :value="item">
                        {{ item }}
                </option>
            </select>
        </div>

      </div><!-- /row -->
  </div>
</template>

<script>
export default {
    name: 'VariationSelection',
    props: ['items'],
    data() {
        return {
            parent: '',
            child: '',
            variation: {
                parent: '',
                child: '',
            }
        }
    },
    methods: {
        setVariationParent() {
            this.variation.parent = this.parent.parent
            this.$emit('setVariation', this.variation);
        },
        setVariationChild() {
            this.variation.child = this.child;
            this.$emit('setVariation', this.variation);
        }
    }
}
</script>

<style>

</style>