<template>
    <div>
        <button v-for="activity in activities" @click.prevent="submit(activity)">
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
        submit(activity) {
            console.log(activity);
        }
    }
}
</script>
