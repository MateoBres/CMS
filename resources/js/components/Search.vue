<template>
<div class="container-fluid">
    <div class="row justify-content-center p-3">
        <div class="col-12 d-flex flex-column">
            <label class="text-center d-block d-md-none">Cerca negozio per nome, categoria, o città</label>
            <div class="form-inline mx-auto w-100 row justify-content-between border border-primary rounded-pill p-1">
                <div class="w-80 mx-auto p-0">
                    <input type="text" 
                        class="form-control rounded-pill border-0 w-100 outline-none box-shadow-none text-center d-block d-md-none" 
                        v-model="search"
                        @keyup.enter="searchFunc()"
                    >
                    <input type="text" 
                        class="form-control rounded-pill border-0 w-100 outline-none box-shadow-none text-center d-none d-md-block" 
                        placeholder="Cerca negozio per nome, categoria, o città"
                        v-model="search"
                        @keyup.enter="searchFunc()"
                    >
                </div>
                <div class="p-0">
                    <button class="btn btn-primary btn-icon rounded-pill" @click="searchFunc()">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {eventBus} from '../app'

export default {
    name: 'MapSearch',
    data () {
        return {
            search: null
        }
    },
    methods: {
         searchFunc () {
            eventBus.$emit('searchItem', this.search);
        },
    }
}
</script>

<style scoped>
    .search {
        /* padding: 20px; */
        /* position: relative; */
        /* margin-top: -77px; */
        /* background-color: #ffc244; */
    }
    .w-80 {
        width: 80%;
    }
    .outline-none {
        outline: none;
    }
    .box-shadow-none {
        box-shadow: none;
    }
</style>>

