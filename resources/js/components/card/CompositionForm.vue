<template>
  <div class="col col-12 px-0 py-4">
      <div class="row">
          <div class="col col-12 col-md-4">
              <label for="">Colore</label>
              <input type="text" 
                    class="form-control"
                    v-model="color">
          </div>
          <div class="col col-12 col-md-8">
              <label for="">Taglia</label>
              <input type="text" 
                    class="form-control"
                    placeholder="Inserisci valori separati da virgola (es: sm, s, x, xl xxl)"
                    v-model="size">
          </div>
          <div class="col col-12 col-md-12 text-right">
              <br>
              <button class="btn btn-primary"
                @click.prevent="sendComposition()">Aggiungi</button>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            color: '',
            size: '',
        }
    },
    methods: {
        sendComposition() {
            this.$emit('setComposition', this.color, this.size.split(','));
            this.color = '';
            this.size = '';
        }
    }
}
</script>

<style>

</style>