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
                        {{ element.name }}
                        {{ element.description }}
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
            list: [
                {
                    id: 1,
                    name: 'Test name 1',
                    description: 'Test description 1'
                },
                {
                    id: 2,
                    name: 'Test name 2',
                    description: 'Test description 2'
                },
                {
                    id: 3,
                    name: 'Test name 3',
                    description: 'Test description 3'
                },
                {
                    id: 4,
                    name: 'Test name 4',
                    description: 'Test description 4'
                },
                {
                    id: 5,
                    name: 'Test name 5',
                    description: 'Test description 5'
                },
                {
                    id: 6,
                    name: 'Test name 6',
                    description: 'Test description 6'
                },
                {
                    id: 7,
                    name: 'Test name 7',
                    description: 'Test description 7'
                },
                {
                    id: 8,
                    name: 'Test name 8',
                    description: 'Test description 8'
                },
                {
                    id: 9,
                    name: 'Test name 9',
                    description: 'Test description 9'
                }
            ]
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
