<template>
    <div class="row text-left justify-content-center mb-5">
        <div class="col-12">
            <div class="row my-3">
                <div class="col-6">
                    <strong class="h4">
                        <i class="fas fa-business-time mr-2"></i>Tipo di orario
                    </strong>
                </div>
                <div class="col-6">
                    <div class="input-group my-auto">
                        <div class="form-check pl-0 pr-3">
                            <input
                                type="radio"
                                :name="this.dayName + this.hours + 'type'"
                                v-model="payload.schedule_type"
                                :value="'standard'"
                                :id="this.dayName + this.hours + 'standard'"
                            />
                            <label class="my-auto">Normale</label>
                        </div>
                        <div class="form-check pl-0 pr-3">
                            <input
                                type="radio"
                                :name="this.dayName + this.hours + 'type'"
                                v-model="payload.schedule_type"
                                :value="'all_day'"
                                :id="this.dayName + this.hours + 'all_day'"
                            />
                            <label>Continuato</label>
                        </div>
                        <div class="form-check pl-0 pr-3">
                            <input
                                type="radio"
                                :name="this.dayName + this.hours + 'type'"
                                v-model="payload.schedule_type"
                                :value="'am_only'"
                                :id="this.dayName + this.hours + 'am_only'"
                            />
                            <label>Mattina</label>
                        </div>
                        <div class="form-check pl-0 pr-3">
                            <input
                                type="radio"
                                :name="this.dayName + this.hours + 'type'"
                                v-model="payload.schedule_type"
                                :value="'pm_only'"
                                :id="this.dayName + this.hours + 'pm_only'"
                            />
                            <label>Pomeriggio</label>
                        </div>
                        <div class="form-check pl-0 pr-3">
                            <input
                                type="radio"
                                :name="this.dayName + this.hours + 'type'"
                                v-model="payload.schedule_type"
                                :value="'closed'"
                                :id="this.dayName + this.hours + 'closed'"
                            />
                            <label>Chiuso</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- mattina -->
        <div
            class="col-xs-12 col-md-6"
            v-show="payload.schedule_type != 'all_day'"
        >
            <div class="card hours-card bg-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <strong class="h4">
                                <i class="far fa-clock mr-2"></i>Mattina
                            </strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- inizio -->
                            <div class="row align-items-center my-3">
                                <div class="col-5 h5">
                                    Apertura:
                                </div>
                                <div class="col-7">
                                    <vue-timepicker
                                        auto-scroll
                                        :close-on-complete="true"
                                        :hide-clear-button="true"
                                        format="HH:mm"
                                        placeholder="Seleziona un orario"
                                        hour-label="Ore"
                                        minute-label="Minuti"
                                        input-width="100%"
                                        v-model="payload.schedule.am_init"
                                        :hour-range="[[0, 15]]"
                                        hide-disabled-hours
                                        :disabled="
                                            payload.schedule_type ==
                                                'pm_only' ||
                                                payload.schedule_type ==
                                                    'closed'
                                        "
                                        :hours="hours"
                                        :minute-interval="15"
                                        @input="emitData()"
                                    >
                                    </vue-timepicker>
                                </div>
                            </div>

                            <!-- fine -->
                            <div class="row align-items-center my-3">
                                <div class="col-5 h5">
                                    Chiusura:
                                </div>
                                <div class="col-7">
                                    <vue-timepicker
                                        auto-scroll
                                        :close-on-complete="true"
                                        :hide-clear-button="true"
                                        format="HH:mm"
                                        placeholder="Seleziona un orario"
                                        hour-label="Ore"
                                        minute-label="Minuti"
                                        input-width="100%"
                                        v-model="payload.schedule.am_end"
                                        :hour-range="[[0, 15]]"
                                        hide-disabled-hours
                                        :disabled="
                                            payload.schedule_type ==
                                                'pm_only' ||
                                                payload.schedule_type ==
                                                    'closed'
                                        "
                                        :hours="hours"
                                        :minute-interval="15"
                                        @input="emitData()"
                                    >
                                    </vue-timepicker>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- pomeriggio -->
        <div
            class="col-xs-12 col-md-6"
            v-show="payload.schedule_type != 'all_day'"
        >
            <div class="card hours-card bg-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <strong class="h4">
                                <i class="fas fa-clock mr-2"></i>Pomeriggio
                            </strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- inizio -->
                            <div class="row align-items-center my-3">
                                <div class="col-5 h5">
                                    Inizio:
                                </div>
                                <div class="col-7">
                                    <vue-timepicker
                                        auto-scroll
                                        :close-on-complete="true"
                                        :hide-clear-button="true"
                                        format="HH:mm"
                                        placeholder="Seleziona un orario"
                                        hour-label="Ore"
                                        minute-label="Minuti"
                                        input-width="100%"
                                        v-model="payload.schedule.pm_init"
                                        :hour-range="[[13, 24]]"
                                        hide-disabled-hours
                                        :disabled="
                                            payload.schedule_type ==
                                                'am_only' ||
                                                payload.schedule_type ==
                                                    'closed'
                                        "
                                        :hours="hours"
                                        :minute-interval="15"
                                        @input="emitData()"
                                    >
                                    </vue-timepicker>
                                </div>
                            </div>

                            <!-- fine -->
                            <div class="row align-items-center my-3">
                                <div class="col-5 h5">
                                    Fine:
                                </div>
                                <div class="col-7">
                                    <vue-timepicker
                                        auto-scroll
                                        :close-on-complete="true"
                                        :hide-clear-button="true"
                                        format="HH:mm"
                                        placeholder="Seleziona un orario"
                                        hour-label="Ore"
                                        minute-label="Minuti"
                                        input-width="100%"
                                        v-model="payload.schedule.pm_end"
                                        :hour-range="[[13, 24]]"
                                        hide-disabled-hours
                                        :disabled="
                                            payload.schedule_type ==
                                                'am_only' ||
                                                payload.schedule_type ==
                                                    'closed'
                                        "
                                        :hours="hours"
                                        :minute-interval="15"
                                        @input="emitData()"
                                    >
                                    </vue-timepicker>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- continuato -->
        <div
            class="col-xs-12 col-md-6"
            v-show="payload.schedule_type == 'all_day'"
        >
            <div class="card hours-card bg-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <strong class="h4">
                                <i class="fas fa-sync-alt mr-2"></i>Orario
                                Continuato
                            </strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- inizio -->
                            <div class="row align-items-center my-3">
                                <div class="col-5 h5">
                                    Inizio:
                                </div>
                                <div class="col-7">
                                    <vue-timepicker
                                        auto-scroll
                                        :close-on-complete="true"
                                        :hide-clear-button="true"
                                        format="HH:mm"
                                        placeholder="Seleziona un orario"
                                        hour-label="Ore"
                                        minute-label="Minuti"
                                        input-width="100%"
                                        v-model="payload.schedule.all_day_init"
                                        :disabled="
                                            payload.schedule_type ==
                                                'am_only' ||
                                                payload.schedule_type ==
                                                    'closed'
                                        "
                                        :hours="hours"
                                        :minute-interval="15"
                                        @input="emitData()"
                                    >
                                    </vue-timepicker>
                                </div>
                            </div>

                            <!-- fine -->
                            <div class="row align-items-center my-3">
                                <div class="col-5 h5">
                                    Fine:
                                </div>
                                <div class="col-7">
                                    <vue-timepicker
                                        auto-scroll
                                        :close-on-complete="true"
                                        :hide-clear-button="true"
                                        format="HH:mm"
                                        placeholder="Seleziona un orario"
                                        hour-label="Ore"
                                        minute-label="Minuti"
                                        input-width="100%"
                                        v-model="payload.schedule.all_day_end"
                                        :disabled="
                                            payload.schedule_type ==
                                                'am_only' ||
                                                payload.schedule_type ==
                                                    'closed'
                                        "
                                        :hours="hours"
                                        :minute-interval="15"
                                        @input="emitData()"
                                    >
                                    </vue-timepicker>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import VueTimepicker from "vue2-timepicker";
import 'vue2-timepicker/dist/VueTimepicker.css'

export default {
    name: "daily-hours",
    components: {
        VueTimepicker
    },
    props: ["hours", "dayName", "values", "scheduleValue"],
    data() {
        return {
            test: null,
            payload: {
                schedule_type: "standard",
                schedule: {
                    am_init: "",
                    am_end: "",
                    pm_init: "",
                    pm_end: "",
                    all_day_init: "",
                    all_day_end: ""
                }
            }
        };
    },
    created() {
        // this.payload.schedule_type='standard';
        // console.log('after mounted: '+this.scheduleValue);
        this.initValues();
        // this.test = this.values;
    },
    computed: {
        scheduleType: function() {
            return this.payload.schedule_type
        }
    },
    watch: {
        values: function() {
            this.initValues();
        },
        scheduleValue: function() {
            if (this.scheduleValue == "" || !this.scheduleValue) {
                this.payload.schedule_type = "standard";
            } else {
                this.payload.schedule_type = this.scheduleValue;
            }
        },
        scheduleType: function() {
            this.emitData();
        }
    },
    methods: {
        emitData() {
            this.$emit(this.hours + "-hours-change", this.payload);
        },

        initValues() {
            // console.log('initValues')
            // console.log(this.scheduleValue)
            this.payload.schedule_type = this.scheduleValue;
            switch (this.scheduleValue) {
                case "standard":
                    this.payload.schedule.am_init = this.values[0].start;
                    this.payload.schedule.am_end = this.values[0].end;
                    this.payload.schedule.pm_init = this.values[1].start;
                    this.payload.schedule.pm_end = this.values[1].end;
                    this.payload.schedule.all_day_init = "";
                    this.payload.schedule.all_day_end = "";
                    break;

                case "am_only":
                    this.payload.schedule.am_init = this.values[0].start || "";
                    this.payload.schedule.am_end = this.values[0].end || "";
                    this.payload.schedule.pm_init = "";
                    this.payload.schedule.pm_end = "";
                    this.payload.schedule.all_day_init = "";
                    this.payload.schedule.all_day_end = "";
                    break;

                case "pm_only":
                    this.payload.schedule.am_init = "";
                    this.payload.schedule.am_end = "";
                    this.payload.schedule.pm_init = this.values[0].start;
                    this.payload.schedule.pm_end = this.values[0].end;
                    this.payload.schedule.all_day_init = "";
                    this.payload.schedule.all_day_end = "";
                    break;

                case "all_day":
                    this.payload.schedule.am_init = "";
                    this.payload.schedule.am_end = "";
                    this.payload.schedule.pm_init = "";
                    this.payload.schedule.pm_end = "";
                    (this.payload.schedule.all_day_init = this.values[0].start),
                        (this.payload.schedule.all_day_end = this.values[0].end);
                    break;

                case "closed":
                    this.payload.schedule.am_init = "";
                    this.payload.schedule.am_end = "";
                    this.payload.schedule.pm_init = "";
                    this.payload.schedule.pm_end = "";
                    (this.payload.schedule.all_day_init = ""),
                        (this.payload.schedule.all_day_end = "");

                    break;

                default:
                    this.payload.schedule_type = "standard";
                    break;
            }
        }
    }
};
</script>
<style scoped>

select {
    height: 31.67px !important;
}

.vue__time-picker {
    display: inline-block;
    position: relative;
    font-size: 1em;
    width: 10em;
    font-family: sans-serif;
    vertical-align: middle
}

.vue__time-picker * {
    -webkit-box-sizing: border-box;
    box-sizing: border-box
}

.vue__time-picker input.display-time {
    border: 1px solid #d2d2d2;
    border-radius: 4px;
    width: 10em;
    height: 2.2em;
    padding: .3em .5em;
    font-size: 1em
}

.vue__time-picker input {
    text-align: center !important;
}

.vue__time-picker input.display-time.disabled,
.vue__time-picker input.display-time:disabled {
    color: #d2d2d2
}

.vue__time-picker .clear-btn {
    position: absolute;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-flow: column nowrap;
    flex-flow: column nowrap;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    top: 0;
    right: 0;
    bottom: 0;
    width: 1.3em;
    z-index: 3;
    font-size: 1.1em;
    line-height: 1em;
    vertical-align: middle;
    color: #d2d2d2;
    background: hsla(0, 0%, 100%, 0);
    text-align: center;
    font-style: normal;
    -webkit-margin-before: -.15em;
    -webkit-transition: color .2s;
    transition: color .2s
}

.vue__time-picker .clear-btn:hover {
    color: #797979;
    cursor: pointer
}

.vue__time-picker .clear-btn:active {
    outline: 0
}

.vue__time-picker .time-picker-overlay {
    z-index: 2;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0
}

.vue__time-picker .dropdown {
    position: absolute;
    z-index: 5;
    top: calc(2.2em + 2px);
    left: 0;
    background: #fff;
    -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, .15);
    box-shadow: 0 1px 6px rgba(0, 0, 0, .15);
    width: 10em;
    height: 10em;
    font-weight: 400
}

.vue__time-picker .dropdown .select-list {
    width: 10em;
    height: 10em;
    overflow: hidden;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-flow: row nowrap;
    flex-flow: row nowrap;
    -webkit-box-align: stretch;
    -ms-flex-align: stretch;
    align-items: stretch;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between
}

.vue__time-picker .dropdown .select-list:active,
.vue__time-picker .dropdown .select-list:focus {
    outline: 0
}

.vue__time-picker .dropdown ul {
    padding: 0;
    margin: 0;
    list-style: none;
    outline: 0;
    -webkit-box-flex: 1;
    -ms-flex: 1 1 0.00001px;
    flex: 1 1 0.00001px;
    overflow-x: hidden;
    overflow-y: auto
}

.vue__time-picker .dropdown ul.apms,
.vue__time-picker .dropdown ul.minutes,
.vue__time-picker .dropdown ul.seconds {
    border-left: 1px solid #fff
}

.vue__time-picker .dropdown ul li {
    list-style: none;
    text-align: center;
    padding: .3em 0;
    color: #161616
}

.vue__time-picker .dropdown ul li:not(.hint):not([disabled]):focus,
.vue__time-picker .dropdown ul li:not(.hint):not([disabled]):hover {
    background: rgba(0, 0, 0, .08);
    color: #161616;
    cursor: pointer
}

.vue__time-picker .dropdown ul li:not([disabled]).active,
.vue__time-picker .dropdown ul li:not([disabled]).active:focus,
.vue__time-picker .dropdown ul li:not([disabled]).active:hover {
    background: #415dff;
    color: #fff
}

.vue__time-picker .dropdown ul li[disabled],
.vue__time-picker .dropdown ul li[disabled]:hover {
    background: transparent;
    opacity: .3;
    cursor: not-allowed
}

.vue__time-picker .dropdown .hint {
    color: #a5a5a5;
    cursor: default;
    font-size: .8em
}

.z-1 {
    z-index: 1;
}

.autocomplete-results-box {
    max-height: 250px !important;
    overflow-y: auto !important;
    overscroll-behavior: contain;
}


</style>
