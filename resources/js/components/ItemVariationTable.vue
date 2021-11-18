<template>
  <div class="col col-12 px-0">
      <div class="table-responsive" v-if="items.composition">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Colore</th>
                    <th scope="col">Taglia</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in items.composition" :key="index">
                    <td>{{ item.parent }}</td>
                    <td>
                        <span v-for="(s, i) in item.childs" :key="i" class="badge badge-primary mx-2">
                            {{ s }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm"
                            @click.prevent="$emit('deleteCombination', index)">
                            <i class="fas fa-minus-circle"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
</div>

  </div>
</template>

<script>
export default {
    name: 'ItemVariationTable',
    props: ['items'],
    data() {
        return {

        }
    }
}
</script>

<style>

</style>
