<template>
    <form @submit.prevent="submit">
        <input type="date" v-model="form.start_date" />

        <input type="date" v-model="form.end_date" />

        <input type="time" v-model="form.start_time" />

        <select v-model="form.repeat">
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
        </select>

        <div class="flex gap-4 flex-row my-8">
            <div v-for="day in days">
                <input type="checkbox"
                       :id="day"
                       class="hidden"
                       :ref="day + '_checkbox'"
                       @click="addDayToArray(day)"
                >

                <label :for="day"
                       class="text-white w-20 h-20 flex items-center cursor-pointer text-center bg-black"
                >
                    <p class="mx-auto">
                        {{ day }}
                    </p>
                </label>
            </div>
        </div>

        <input type="submit" value="submit" />
    </form>
</template>

<script>
export default {
    name: "DateTimeInfo",
    data() {
        return {
            form: this.$inertia.form({
                start_date: '',
                end_date: '',
                start_time: '',
                repeat: '',
                days: [],
                activity: this.activity,
                client_id: this.client_id
            }),
            days: {
                monday: 'Mon',
                tuesday: 'Tue',
                wednesday: 'Wed',
                thursday: 'Thu',
                friday: 'Fri',
                saturday: 'Sat',
                sunday: 'Sun'
            },
            selectedDays: []
        }
    },
    props: {
        activity: {
            type: Array,
            required: true
        },
        client_id: {
            required: true
        }
    },
    methods: {
        submit() {
            console.log(this.form);
            this.form.post(this.route('activity.store'));
        },
        addDayToArray(day) {
            if (this.$refs[`${day}_checkbox`][0].checked === true) {
                this.selectedDays.push(day);
            } else {
                this.selectedDays.splice(this.selectedDays.indexOf(day), 1);
            }
        }
    }
}
</script>
