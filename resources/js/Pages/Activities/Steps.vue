<template>
    <form @submit.prevent="submit">
        <div class="grid">
            <draggable
                :list="activity.steps"
                item-key="name"
                class="grid"
                ghost-class="ghost"
                tag="transition-group"
            >
                <template class="grid" #item="{ element }" :group="element">
                    <div class="cell">
                        <div>
                            <img :src="element.image" :alt="element.name" />
                        </div>

                        <p>{{ element.name }}</p>

                        <div>
                            <input v-model="element.duration" type="time" name="duration" step="1" />

                            <div>
                                <input v-model="element.sound" type="checkbox" name="sound" :id="'sound_' + element.name" />
                                <label :for="'sound_' + element.name">Sound</label>
                            </div>

                            <div>
                                <input v-model="element.repeat" type="checkbox" name="repeat" :id="'repeat_' + element.name" />
                                <label :for="'repeat_' + element.name">Repeat</label>
                            </div>
                        </div>
                    </div>
                </template>
            </draggable>
        </div>

        <button type="submit">Submit</button>
    </form>
</template>

<script>
import Draggable from "vuedraggable";
import AppLayout from "../../Layouts/AppLayout";

export default {
    name: "Steps",
    layout: AppLayout,
    data() {
        return {
            activitySteps: {
                image: '',
                name: '',
                duration: '',
                sound: false,
                repeat: false
            }
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
            this.$inertia.post(this.route('activity.date-time-info'), {
                'activity': this.activity,
                'client_id': this.client_id
            });
        }
    },
    components: {
        Draggable
    }
}
</script>

<style scoped>
    #app {
        font-family: "Avenir", Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 60px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(4, 225px);
        grid-template-rows: repeat(3, 150px);
        grid-gap: 0.2em;
    }

    .grid-move {
        transition: all 0.3s;
    }

    .cell {
        background: lightblue;
        display: block;
        justify-content: center;
        align-items: center;
    }
</style>
