<template>
    <div class="card-body">
        <div class="col-12">
            <!-- orari apertura -->
            <div class="row text-left justify-content-center">
                <div class="col-12 mb-2">
                    <h1><i class="fas fa-door-open mr-2"></i>Orari di Apertura {{ this.dayName }}</h1>
                </div>
            </div>
            <daily-hours
                :hours="'opening'"
                :day-name="dayName"
                :values="payload.opening_hours"
                :schedule-value="payload.opening_schedule"
                v-on:opening-hours-change="onOpeningHoursChange"></daily-hours>

            <!-- orari consegna -->
            <div class="row text-left justify-content-center" v-show="this.doesDelivery">
                <div class="col-12 mb-2">
                    <h1><i class="fas fa-shipping-fast mr-2"></i>Orari di Consegna {{ this.dayName }}</h1>
                </div>
            </div>
            <daily-hours
                :hours="'delivery'"
                :day-name="dayName"
                :values="payload.delivery_hours"
                :schedule-value="payload.delivery_schedule"
                v-show="this.doesDelivery" v-on:delivery-hours-change="onDeliveryHoursChange"></daily-hours>

            <!-- orari ritiro -->
            <div class="row text-left justify-content-center" v-show="this.doesTakeaway">
                <div class="col-12 mb-2">
                    <h1><i class="fas fa-box mr-2"></i>Orari di Ritiro {{ this.dayName }}</h1>
                </div>
            </div>
            <daily-hours
                :hours="'takeaway'"
                :day-name="dayName"
                :values="payload.takeaway_hours"
                :schedule-value="payload.takeaway_schedule"
                v-show="this.doesTakeaway" v-on:takeaway-hours-change="onTakeawayHoursChange"></daily-hours>

        </div>
    </div>
</template>
<script>
import DailyHours from './DailyHours'
import VueTimepicker from 'vue2-timepicker'
export default {
    name: 'day',
    props: [
        'dayName',
        'doesDelivery',
        'doesTakeaway',
        'dayId',
        'timeslot',
    ],
    components: {
        VueTimepicker,
        DailyHours
    },
    data() {
        return {
            payload: {
                id: this.dayId,
                name: this.dayName,
                opening_schedule: '',
                delivery_schedule: '',
                takeaway_schedule: '',
                opening_hours: [],
                delivery_hours: [],
                takeaway_hours: [],
            }
        }
    },
    mounted() {
        this.payload = this.timeslot
        // console.log('payload', this.payload)
    },
    methods: {
        onOpeningHoursChange(payload) {
            this.payload.opening_schedule = payload.schedule_type
            switch (payload.schedule_type) {
                case 'standard':
                    this.payload.opening_hours = [
                        {
                            'start' : payload.schedule.am_init,
                            'end' : payload.schedule.am_end
                        },
                        {
                            'start' : payload.schedule.pm_init,
                            'end' : payload.schedule.pm_end
                        }
                    ]
                    break;
            
                case 'am_only':
                    this.payload.opening_hours = [
                        {
                            'start' : payload.schedule.am_init,
                            'end' : payload.schedule.am_end
                        }
                    ]
                    break;
            
                case 'pm_only':
                    this.payload.opening_hours = [
                        {
                            'start' : payload.schedule.pm_init,
                            'end' : payload.schedule.pm_end
                        }
                    ]
                    break;
            
                case 'all_day':
                    this.payload.opening_hours = [
                        {
                            'start' : payload.schedule.all_day_init,
                            'end' : payload.schedule.all_day_end
                        }
                    ]
                    break;
            
                case 'closed':
                    this.payload.opening_hours = [
                        // {
                        //     'start' : '',
                        //     'end' : ''
                        // }
                    ]
                    
                    break;
            
                default:
                    break;
            }

            this.emitData()
        },
        onDeliveryHoursChange(payload) {
            this.payload.delivery_schedule = payload.schedule_type
            switch (payload.schedule_type) {
                case 'standard':
                    this.payload.delivery_hours = [
                        {
                            'start' : payload.schedule.am_init,
                            'end' : payload.schedule.am_end
                        },
                        {
                            'start' : payload.schedule.pm_init,
                            'end' : payload.schedule.pm_end
                        }
                    ]
                    break;
            
                case 'am_only':
                    this.payload.delivery_hours = [
                        {
                            'start' : payload.schedule.am_init,
                            'end' : payload.schedule.am_end
                        }
                    ]
                    break;
            
                case 'pm_only':
                    this.payload.delivery_hours = [
                        {
                            'start' : payload.schedule.pm_init,
                            'end' : payload.schedule.pm_end
                        }
                    ]
                    break;
            
                case 'all_day':
                    this.payload.delivery_hours = [
                        {
                            'start' : payload.schedule.all_day_init,
                            'end' : payload.schedule.all_day_end
                        }
                    ]
                    break;
            
                case 'closed':
                    this.payload.delivery_hours = [
                        // {
                        //     'start' : '',
                        //     'end' : ''
                        // }
                    ]
                    
                    break;
            
                default:
                    break;
            }

            this.emitData()
        },
        onTakeawayHoursChange(payload) {
            this.payload.takeaway_schedule = payload.schedule_type
            switch (payload.schedule_type) {
                case 'standard':
                    this.payload.takeaway_hours = [
                        {
                            'start' : payload.schedule.am_init,
                            'end' : payload.schedule.am_end
                        },
                        {
                            'start' : payload.schedule.pm_init,
                            'end' : payload.schedule.pm_end
                        }
                    ]
                    break;
            
                case 'am_only':
                    this.payload.takeaway_hours = [
                        {
                            'start' : payload.schedule.am_init,
                            'end' : payload.schedule.am_end
                        }
                    ]
                    break;
            
                case 'pm_only':
                    this.payload.takeaway_hours = [
                        {
                            'start' : payload.schedule.pm_init,
                            'end' : payload.schedule.pm_end
                        }
                    ]
                    break;
            
                case 'all_day':
                    this.payload.takeaway_hours = [
                        {
                            'start' : payload.schedule.all_day_init,
                            'end' : payload.schedule.all_day_end
                        }
                    ]
                    break;
            
                case 'closed':
                    this.payload.takeaway_hours = [
                        // {
                        //     'start' : '',
                        //     'end' : ''
                        // }
                    ]
                    
                    break;
            
                default:
                    break;
            }

            this.emitData()
        },

        emitData() {
            if (this.payload.id == 1) {
                this.$emit('timeslot', this.payload);
            }
        }
    },
    watch: {
        timeslot: function() {
            this.payload = this.timeslot
        }
    }
}
</script>