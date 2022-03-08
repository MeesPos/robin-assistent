<template>
    <form @submit.prevent="submit">
        <input type="date" v-model="form.start_date" />

        <input type="date" v-model="form.end_date" />

        <input type="time" v-model="form.start_time" />

        <select v-model="form.repeat">
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
        </select>

        <select v-model="form.days">
            <option value="monday">Mon</option>
            <option value="tuesday">Tue</option>
            <option value="wednesday">Wed</option>
            <option value="thursday">Thu</option>
            <option value="friday">Fri</option>
            <option value="saturday">Sat</option>
            <option value="sunday">Sun</option>
        </select>

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
            })
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
        }
    }
}
</script>
