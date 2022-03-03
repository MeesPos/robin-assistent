<template>
    <form @submit.prevent="submit">
        <div class="grid">
            <draggable
                :list="list"
                item-key="name"
                class="grid"
                ghost-class="ghost"
                tag="transition-group"
            >
                <template class="grid" #item="{ element }">
                    <div class="cell">
                        {{ element }}
                    </div>
                </template>
            </draggable>
        </div>

        <button type="submit">Submit</button>
    </form>
</template>

<script>
import Draggable from "vuedraggable";

export default {
    name: "VueGridTest",
    data() {
        return {
            list: [1, 2, 3, 4, 5, 6, 7, 8, 9]
        }
    },
    methods: {
        submit() {
            console.log(this.list);
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
        grid-template-columns: repeat(3, 100px);
        grid-template-rows: repeat(3, 100px);
        grid-gap: 0.2em;
    }

    .grid-move {
        transition: all 0.3s;
    }

    .cell {
        background-color: lightblue;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
