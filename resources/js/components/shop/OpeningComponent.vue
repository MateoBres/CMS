<template>
    <tr>
        <td>{{ opening.name }}</td>
        <td v-for="slot in opening_slot" v-bind:key="slot.id">
            {{ slot.start }} {{ slot.end }}
        </td>
    </tr>
</template>

<script>
export default {
    name: "opening",
    props: ["openingData", "openingType"],
    data() {
        return {
            opening: this.openingData,
            opening_slot: []
        };
    },
    watch: {
        openingType: function(newVal, oldVal) {
            // watch it
            console.log("Prop changed: ", newVal, " | was: ", oldVal);
            this.setOpeningTimes();
        }
    },
    mounted() {
        this.setOpeningTimes();
    },
    methods: {
        setOpeningTimes() {
            let opening_hours = null;
            switch (this.openingType) {
                case "opening":
                    opening_hours = this.opening.opening_hours;
                    break;
                case "delivery":
                    opening_hours = this.opening.delivery_hours;
                    break;
                case "takeaway":
                    opening_hours = this.opening.takeaway_hours;
                    break;
                default:
                    break;
            }

            console.log(opening_hours);
            console.log("slot lenght: " + opening_hours.length);
            switch (opening_hours.length) {
                case 0:
                    let slot = { start: "chiuso", end: "" };
                    let slotclose = { start: "", end: "" };
                    this.opening_slot = [];
                    this.opening_slot.push(slot);
                    this.opening_slot.push(slotclose);
                    break;
                case 1:
                    let slot1 = {
                        start: opening_hours[0].start + " - ",
                        end: opening_hours[0].end
                    };
                    let slot2 = {
                        start: "",
                        end: ""
                    };
                    this.opening_slot = [];
                    this.opening_slot.push(slot1);
                    this.opening_slot.push(slot2);
                    break;
                default:
                    this.opening_slot = [];
                    opening_hours.forEach(element => {
                        let slot = {
                            start: element.start + " - ",
                            end: element.end
                        };
                        this.opening_slot.push(slot);
                    });

                    break;
            }
        }
    }
};
</script>

<style></style>
