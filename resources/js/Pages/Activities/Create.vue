<template>
    <h1>Planning an activity for {{ client.first_name + ' ' + client.last_name }}</h1>
    <h3>Create here the task for your client</h3>

    <form @submit.prevent="submit">
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
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";

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
        }
    }
}
</script>
