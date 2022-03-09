<template>
    <form @submit.prevent="submit">
        <div class="flex flex-row">
            <div v-for="activity in activities"
                 :class="active === activity.unique_key ? 'border' : ''"
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
                         class="w-20 h-20"
                         :alt="activity.name"
                    >

                    <h2 v-text="activity.name" />
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
        client_id: {
            required: true
        }
    },
    methods: {
        goToStepsPage(activity) {
            return this.$inertia.get(`/activity/steps/${activity.unique_key}/${this.client_id}`);
        },
        setActive(activity) {
            this.active = activity;
        },
        submit() {
            if (this.active !== '') {
                return this.$inertia.get(`/activity/steps/${this.active}/${this.client_id}`);
            }
        }
    }
}
</script>
