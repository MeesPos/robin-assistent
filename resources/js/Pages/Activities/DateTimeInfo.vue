<template>
    <div class="mb-12 mt-6 grid grid-rows-2 xl:grid-rows-1 xl:grid-cols-2 overflow-y-hidden">
        <div>
            <h1 class="font-quantify text-blue-base text-5xl 2xl:text-7xl">Create task</h1>
            <h3 class="font-base">Create here the task for your client</h3>
        </div>

        <div class="mt-4 xl:mt-0 xl:">
            <label style="top: -2px" class="search-label relative mr-8">
                <input type="text" placeholder="Search Clients" style="padding-top: 0.65rem; padding-bottom: 0.65rem" class="pl-8 pb-2 inline-block border-1 border-black rounded-xl w-72">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute inline-block left-2 top-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </label>

            <button class="py-3 px-6 bg-green-dark rounded-lg">
                <span class="flex gap-4 text-white font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                    </svg>
                    New client
                </span>
            </button>
        </div>
    </div>

    <div class="flex w-full flex-row gap-16 h-60vh">
        <div class="w-4/12 xl:w-3/12">
            <div class="bg-white h-full rounded-5xl">
                <div class="mx-8 py-8 grid grid-rows-auto-1fr h-full gap-6">
                    <div class="text-center space-y-6">
                        <h2 class="text-green-dark font-bold text-xl 2xl:text-3xl">{{ client.first_name + ' ' + client.last_name }}</h2>
                        <h4 class="text-base">{{ moment(client.birth_date) }}</h4>
                    </div>

                    <div class="space-y-8 mt-12">
                        <h2 class="font-bold text-xl 2xl:text-3xl">Patient details</h2>

                        <div class="grid grid-cols-2 items-center">
                            <h2 class="text-xl">Gender</h2>

                            <h3 class="text-right">{{ client.gender }}</h3>
                        </div>

                        <div class="grid grid-cols-2 items-center">
                            <h2 class="text-xl">Age</h2>

                            <h3 class="text-right">{{ countAge() }}</h3>
                        </div>

                        <div class="grid grid-cols-2 items-center">
                            <h2 class="text-xl">Panic button</h2>

                            <h3 class="text-right">{{ client.panic_button }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 h-full">
            <div>
                <h2 class="font-quantify text-2xl 2xl:text-4xl">Planning an activity for {{ client.first_name + ' ' + client.last_name }}</h2>
                <h3 class="text-base">Choose which activity you want to plan</h3>
            </div>

            <form @submit.prevent="submit" class="grid grid-cols-2 mt-10">
                <div>
                    <label class="font-bold text-md"
                           for="start_date"
                    >
                        Start date
                    </label>
                    <br>
                    <input class="border-none pl-6 rounded-10 font-bold py-3 w-5/6 mt-1"
                           id="start_date"
                           type="date"
                           v-model="form.start_date"
                    />
                </div>

                <div>
                    <label class="font-bold text-md"
                        for="end_date"
                    >
                        End date
                    </label>
                    <br>
                    <input class="border-none pl-6 rounded-10 font-bold py-3 w-5/6 mt-1"
                           id="end_date"
                           type="date"
                           v-model="form.end_date"
                    />
                </div>

                <div class="mt-10">
                    <label class="font-bold text-md"
                           for="start_time"
                    >
                        Start time
                    </label>
                    <br>
                    <input class="border-none pl-6 rounded-10 font-bold py-3 w-5/6 mt-1"
                           id="start_date"
                           type="time"
                           v-model="form.start_time"
                    />
                </div>

                <div class="mt-10">
                    <label class="font-bold text-md"
                        for="repeat"
                    >
                        Repeat
                    </label>
                    <br>
                    <select class="border-none pl-6 rounded-10 font-bold py-3 w-5/6 mt-1"
                            id="repeat"
                            v-model="form.repeat"
                    >
                        <option value="weekly" selected>
                            Weekly
                        </option>
                        <option value="monthly">
                            Monthly
                        </option>
                    </select>
                </div>

                <div class="mt-10">
                    <label class="text-md font-bold">Days</label>
                    <div class="flex gap-4 flex-row mt-1">
                        <div v-for="day in days">
                            <input type="checkbox"
                                   :id="day"
                                   class="hidden"
                                   :ref="day + '_checkbox'"
                                   @click="addDayToArray(day)"
                            >

                            <label :for="day"
                                   class="font-bold text-md w-16 h-14 flex items-center cursor-pointer text-center rounded-10"
                                   :class="selectedDays.includes(day) ? 'bg-blue-base text-white' : 'bg-white text-black'"
                            >
                                <p class="mx-auto">
                                    {{ day }}
                                </p>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import moment from "moment";

export default {
    name: "DateTimeInfo",
    layout: AppLayout,
    data() {
        return {
            form: this.$inertia.form({
                start_date: '',
                end_date: '',
                start_time: '',
                repeat: '',
                days: [],
                activity: this.activity,
                client_id: this.client.id
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
        client: {
            type: Array,
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
        },
        moment(date) {
            return moment(date).format('DD MMMM YYYY');
        },
        countAge() {
            return moment().diff(moment(this.client.birth_date, 'YYYY-MM-DD'), 'years');
        }
    }
}
</script>
