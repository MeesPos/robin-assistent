<template>
    <div>
        <button v-for="activity in activities" @click.prevent="goToStepsPage(activity)">
            <img :src="activity.image"
                 class="w-20 h-20"
                 :alt="activity.name"
            >

            <h2 v-text="activity.name" />
        </button>
    </div>
</template>

<script>
export default {
    name: "Create",
    props: {
        activities: {
            type: Array,
            required: true
        }
    },
    methods: {
        goToStepsPage(activity) {
            return this.$inertia.get(`/activity/steps/${activity.unique_key}`);
        }
    }
}
</script>
