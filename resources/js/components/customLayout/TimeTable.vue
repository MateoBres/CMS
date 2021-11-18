<template>
    <div class="col col-12 mt-2">

        <ul class="nav nav-tabs text-black mb-2">
            <li class="nav-item">
                <a ref="orari" class="nav-link"  @click="showOpeningHoursTable()" style="cursor: pointer" :class="{ 'font-weight-bold' : showOpeningHours, 'active' : showOpeningHours }">Orari</a>
            </li>
            <li class="nav-item">
                <a ref="takeway" class="nav-link" @click="showTakeawayTable()" style="cursor: pointer" :class="{ 'font-weight-bold' : showTakeaway, 'active' : showTakeaway }">Orari Takeaway</a>
            </li>
            <li class="nav-item">
                <a ref="delivery" class="nav-link" @click="showDeliveryTable()" style="cursor: pointer" :class="{ 'font-weight-bold' : showDelivery, 'active' : showDelivery }"> Consegna a Domicilio</a>
            </li>
        </ul>


    
        <table class="table w-100" v-if="showOpeningHours">
            <!-- <thead class="thead-dark">
                <tr>
                    <th>Giorno</th>
                    <th>Mattina</th>
                    <th>Pomeriggio</th>
                </tr>
            </thead> -->
            <tbody>
                <tr v-for="(item, index) in info.timeslots" :key="index">
                    <td class="border-right font-weight-bold">{{ item.name }}</td>
                    <!-- mattina -->
                    <td v-if="item.opening_schedule == 'closed'"> - </td>
                    <td v-if="item.opening_schedule == 'standard'"> {{ item.opening_hours[0].start + '-' + item.opening_hours[0].end }} </td>
                    <td v-if="item.opening_schedule == 'all_day'"> {{ item.opening_hours[0].start }} </td>
                    <td v-if="item.opening_schedule == 'am'"> {{ item.opening_hours[0].start + '-' + item.opening_hours[0].end }} </td>
                    <td v-if="item.opening_schedule == 'pm'"> - </td>
                    <!-- /mattina -->

                    <!-- pomeriggio -->
                    <td v-if="item.opening_schedule == 'closed'"> - </td>
                    <td v-if="item.opening_schedule == 'standard'"> {{ item.opening_hours[1].start + '-' + item.opening_hours[1].end }} </td>
                    <td v-if="item.opening_schedule == 'all_day'"> {{ item.opening_hours[0].end }} </td>
                    <td v-if="item.opening_schedule == 'am'"> - </td>
                    <td v-if="item.opening_schedule == 'pm'"> {{ item.opening_hours[0].start + '-' + item.opening_hours[0].end }} </td>
                    <!-- /pomeriggio -->
                </tr>
            </tbody>
        </table>

        <table class="table w-100" style="height: 208px;" width="419" v-if="showTakeaway">
            <!-- <thead class="">
                <tr>
                    <th>Giorno</th>
                    <th>Mattina</th>
                    <th>Pomeriggio</th>
                </tr>
            </thead> -->
            <tbody>
                <tr v-for="(item, index) in info.timeslots" :key="index">
                    <td class="border-right font-weight-bold">{{ item.name }}</td>
                    <!-- mattina -->
                    <td v-if="item.delivery_schedule == 'closed'"> - </td>
                    <td v-if="item.delivery_schedule == 'standard'"> {{ item.delivery_hours[0].start + '-' + item.delivery_hours[0].end }} </td>
                    <td v-if="item.delivery_schedule == 'all_day'"> {{ item.delivery_hours[0].start }} </td>
                    <td v-if="item.delivery_schedule == 'am'"> {{ item.delivery_hours[0].start + '-' + item.delivery_hours[0].end }} </td>
                    <td v-if="item.delivery_schedule == 'pm'"> - </td>
                    <!-- /mattina -->

                    <!-- pomeriggio -->
                    <td v-if="item.delivery_schedule == 'closed'"> - </td>
                    <td v-if="item.delivery_schedule == 'standard'"> {{ item.delivery_hours[1].start + '-' + item.delivery_hours[1].end }} </td>
                    <td v-if="item.delivery_schedule == 'all_day'"> {{ item.delivery_hours[0].end }} </td>
                    <td v-if="item.delivery_schedule == 'am'"> - </td>
                    <td v-if="item.delivery_schedule == 'pm'"> {{ item.delivery_hours[0].start + '-' + item.delivery_hours[0].end }} </td>
                    <!-- /pomeriggio -->
                </tr>
            </tbody>
        </table>

        <table class="table w-100" style="height: 208px;" width="419" v-if="showDelivery">
            <!-- <thead class="thead-dark">
                <tr>
                    <th>Giorno</th>
                    <th>Mattina</th>
                    <th>Pomeriggio</th>
                </tr>
            </thead> -->
            <tbody>
                <tr v-for="(item, index) in info.timeslots" :key="index">
                    <td class="border-right font-weight-bold">{{ item.name }}</td>
                    <!-- mattina -->
                    <td v-if="item.takeaway_schedule == 'closed'"> - </td>
                    <td v-if="item.takeaway_schedule == 'standard'"> {{ item.takeaway_hours[0].start + '-' + item.takeaway_hours[0].end }} </td>
                    <td v-if="item.takeaway_schedule == 'all_day'"> {{ item.takeaway_hours[0].start }} </td>
                    <td v-if="item.takeaway_schedule == 'am'"> {{ item.takeaway_hours[0].start + '-' + item.takeaway_hours[0].end }} </td>
                    <td v-if="item.takeaway_schedule == 'pm'"> - </td>
                    <!-- /mattina -->

                    <!-- pomeriggio -->
                    <td v-if="item.takeaway_schedule == 'closed'"> - </td>
                    <td v-if="item.takeaway_schedule == 'standard'"> {{ item.takeaway_hours[1].start + '-' + item.takeaway_hours[1].end }} </td>
                    <td v-if="item.takeaway_schedule == 'all_day'"> {{ item.takeaway_hours[0].end }} </td>
                    <td v-if="item.takeaway_schedule == 'am'"> - </td>
                    <td v-if="item.takeaway_schedule == 'pm'"> {{ item.takeaway_hours[0].start + '-' + item.takeaway_hours[0].end }} </td>
                    <!-- /pomeriggio -->
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: 'TimeTable',
    props: ['info'],
    data() {
        return {
            showOpeningHours: true,
            showTakeaway: false,
            showDelivery: false,
        }
    },
    methods: {
        
        showDeliveryTable() {
            this.showDelivery = true;
            this.showOpeningHours = false;
            this.showTakeaway = false;
        },
        showTakeawayTable() {
            this.showDelivery = false;
            this.showOpeningHours = false;
            this.showTakeaway = true;
        },
        showOpeningHoursTable() {
            this.showDelivery = false;
            this.showOpeningHours = true;
            this.showTakeaway = false;
        }
    }
}
</script>

<style scoped>
.nav-tabs {
    border-bottom: 1px solid #dee2e6;
}

.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #495057;
    background-color: #fff;
    border-color: #dee2e6 #dee2e6 #fff;
}
.nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: 0.25rem;
    border-top-right-radius: 0.25rem;
    color: #000000;
}
.tab-table {padding-bottom: 10px;margin-left: 0px;padding-left: 0px;margin-bottom: 30px;}
.tab-table li {
    display: inline;
    padding: 7px 15px; 
    border-right: 2px solid white; 
    background-color: #000000;
    color: #ffffff; font-size: 11pt;
}
tr{
    border-top: hidden;
}
</style>