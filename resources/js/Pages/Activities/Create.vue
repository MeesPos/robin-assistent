<template>
    <div class="flex w-full flex-row h-3/5 gap-16">
        <div class="w-3/12">
            <div class="bg-white h-full rounded-5xl">
                <div class="mx-8 py-8 flex flex-col place-content-center gap-6">
                    <div class="text-center space-y-6">
                        <h2 class="text-green-dark font-bold text-3xl">{{ client.first_name + ' ' + client.last_name }}</h2>
                        <h4 class="text-base">{{ moment(client.birth_date) }}</h4>
                    </div>

                    <div class="space-y-4">
                        <h2 class="font-bold text-3xl">Patient details</h2>

                        <div class="grid grid-cols-2">
                            <h2>Height</h2>

                            <h3 class="text-right">170 cm</h3>
                        </div>

                        <div class="grid grid-cols-2">
                            <h2>Weight</h2>

                            <h3 class="text-right">50 kg</h3>
                        </div>

                        <div class="grid grid-cols-2">
                            <h2>Height</h2>

                            <h3 class="text-right">170 cm</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div>
                <h1 class="font-quantify text-4xl">Planning an activity for {{ client.first_name + ' ' + client.last_name }}</h1>
                <h3 class="text-base">Choose which activity you want to plan</h3>
            </div>

            <form @submit.prevent="submit" class="mt-8">
                <div class="flex flex-row gap-x-12 gap-y-8">
                    <div v-for="activity in activities"
                         :class="active === activity.unique_key ? 'border-6 border-blue-border' : ''"
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
                            <img :src="activity.image"
                                 class="w-20 h-20 mx-auto"
                                 :alt="activity.name"
                            >

                            <h2 v-text="activity.name"
                                class="font-bold mt-1"
                            />
                        </label>
                    </div>
                </div>

                <input type="submit"
                       value="Next"
                />
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
        }
    },
    components: {
        moment
    }
}
</script>
