<template>
    <div class="mb-12 mt-6 grid grid-rows-2 xl:grid-rows-1 xl:grid-cols-2 overflow-y-hidden">
        <div>
            <h1 class="font-quantify text-blue-base text-5xl 2xl:text-7xl">Create task</h1>
            <h3 class="font-base">Create here the task for your client</h3>
        </div>

        <div class="mt-4 xl:mt-0 xl:text-right">
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
            <div class="bg-white rounded-5xl h-full h-60vh h-[67vh]">
                <div class="mx-8 py-8 grid grid-rows-auto-1fr h-full gap-6">
                    <div class="text-center space-y-6">
                        <h2 class="text-green-dark font-bold text-xl 2xl:text-3xl">
                            {{ client.first_name + ' ' + client.last_name }}</h2>
                        <h4 class="text-base">{{ moment(client.birth_date) }}</h4>
                    </div>

                    <div class="space-y-8 mt-12">
                        <h2 class="font-bold text-xl 2xl:text-3xl xl:text-left text-center">Patient details</h2>

                        <div class="grid xl:grid-cols-2 grid-cols-1 items-center">
                            <h2 class="text-center xl:text-left text-xl">Gender</h2>

                            <h3 class="text-center xl:text-right xl:mt-0 mt-1">{{ client.gender }}</h3>
                        </div>

                        <div class="grid xl:grid-cols-2 grid-cols-1 items-center">
                            <h2 class="text-center xl:text-left text-xl">Age</h2>

                            <h3 class="text-center xl:text-right xl:mt-0 mt-1">{{ countAge() }}</h3>
                        </div>

                        <div class="grid xl:grid-cols-2 grid-cols-1 items-center">
                            <h2 class="text-center xl:text-left text-xl">Panic button</h2>

                            <h3 class="text-center xl:text-right xl:mt-0 mt-1">{{ client.panic_button }}</h3>
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

            <form @submit.prevent="submit" class="mt-8 w-full xl:h-full">
                <div class="flex flex-row gap-x-12 gap-y-8 xl:h-full -mb-8">
                    <div v-for="activity in activities"
                         :class="active === activity.unique_key ? 'border-6 border-blue-base' : ''"
                         class="bg-white flex w-32 h-32 justify-center text-center items-center rounded-xl"
                    >
                        <input class="hidden"
                               :id="'radio_' + activity.unique_key"
                               type="radio"
                               @click="setActive(activity.unique_key)"
                               name="radio"
                        />

                        <label class="cursor-pointer"
                               :for="'radio_' + activity.unique_key"
                        >
                            <img :src="`/images/activities/${activity.unique_key}/` + activity.image"
                                 class="w-20 h-20 mx-auto"
                                 :alt="activity.name"
                            >

                            <h2 v-text="activity.name"
                                class="font-bold mt-1"
                            />
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-2 xl:grid-cols-3 xl:mt-0 mt-20">
                    <div class="hidden xl:block"></div>

                    <div class="flex gap-8 items-center text-right xl:justify-center">
                        <div class="w-4 h-4 rounded-full bg-red-dots"></div>
                        <div class="w-4 h-4 rounded-full bg-gray-dots"></div>
                        <div class="w-4 h-4 rounded-full bg-gray-dots"></div>
                    </div>

                    <div class="text-right">
                        <button type="submit"
                               class="py-3 px-20 bg-green-dark rounded-lg text-white font-semibold"
                        >
                            Next
                        </button>
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
    name: "Create",
    layout: AppLayout,
    data() {
        return {
            active: ''
        }
    },
    props: {
        activities: {
            type: Array,
            required: true
        },
        client: {
            type: Array,
            required: true
        }
    },
    methods: {
        setActive(activity) {
            this.active = activity;
        },
        submit() {
            if (this.active !== '') {
                return this.$inertia.get(`/activity/steps/${this.active}/${this.client.id}`);
            }
        },
        moment(date) {
            return moment(date).format('DD MMMM YYYY');
        },
        countAge() {
            return moment().diff(moment(this.client.birth_date, 'YYYY-MM-DD'), 'years');
        }
    },
    components: {
        moment
    }
}
</script>
