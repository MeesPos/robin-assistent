<template>
    <div class="mb-12 mt-6 grid grid-rows-2 xl:grid-rows-1 xl:grid-cols-2 overflow-y-hidden">
        <div>
            <h1 class="font-quantify text-blue-base text-5xl 2xl:text-7xl">Create task</h1>
            <h3 class="font-base">Create here the task for your client</h3>
        </div>

        <div class="mt-4 xl:mt-0 xl:text-right">
            <label style="top: -2px" class="search-label relative mr-8">
                <input type="text" placeholder="Search Clients" style="padding-top: 0.65rem; padding-bottom: 0.65rem"
                       class="pl-8 pb-2 inline-block border-1 border-black rounded-xl w-72">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute inline-block left-2 top-0"
                     viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                          clip-rule="evenodd"/>
                </svg>
            </label>

            <button class="py-3 px-6 bg-green-dark rounded-lg">
                <span class="flex gap-4 text-white font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                    </svg>
                    New client
                </span>
            </button>
        </div>
    </div>

    <div class="flex w-full flex-row gap-16">
        <div class="w-4/12 xl:w-3/12">
            <div class="bg-white h-full rounded-5xl h-60vh">
                <div class="mx-8 py-8 grid grid-rows-auto-1fr h-full gap-6">
                    <div class="text-center space-y-6">
                        <h2 class="text-green-dark font-bold text-xl 2xl:text-3xl">
                            {{ client.first_name + ' ' + client.last_name }}</h2>
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
                <h2 class="font-quantify text-2xl 2xl:text-4xl">Select the steps</h2>
                <h3 class="text-base">Make the steps the client need.</h3>
            </div>

            <form id="stepsForm" @submit.prevent="submit" class="h-full mt-8">
                <div class="flex flex-row flex-wrap gap-6">
                    <draggable
                        :list="activity.steps"
                        item-key="name"
                        class="grid"
                        ghost-class="ghost"
                        tag="transition-group"
                    >
                        <template #item="{ element, index }">
                            <div class="bg-white rounded-10 cursor-move w-80">
                                <div class="">
                                    <img :src="`/images/activities/${activity.unique_key}/tasks/` + element.image" :alt="element.name" class="mx-auto w-32 h-32 object-contain"/>
                                </div>

                                <div class="my-4 ml-3 flex gap-2 items-center">
                                    <p class="text-green-dark text-base font-bold">{{ index + 1 }}</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                         viewBox="0 0 12.311 12.312">
                                        <path id="Icon_awesome-arrows-alt" data-name="Icon awesome-arrows-alt"
                                              d="M8.469,10.238l-1.9,1.9a.577.577,0,0,1-.816,0l-1.9-1.9a.577.577,0,0,1,.408-.985h1.23V6.829H3.059v1.23a.577.577,0,0,1-.985.408l-1.9-1.9a.577.577,0,0,1,0-.816l1.9-1.9a.577.577,0,0,1,.985.408V5.482H5.482V3.059H4.251a.577.577,0,0,1-.408-.985l1.9-1.9a.577.577,0,0,1,.816,0l1.9,1.9a.577.577,0,0,1-.408.985H6.829V5.482H9.253V4.252a.577.577,0,0,1,.985-.408l1.9,1.9a.577.577,0,0,1,0,.816l-1.9,1.9a.577.577,0,0,1-.985-.408V6.829H6.829V9.253H8.061A.577.577,0,0,1,8.469,10.238Z"
                                              transform="translate(0 0)"/>
                                    </svg>
                                    <p class="text-xs">{{ element.name }}</p>
                                </div>

                                <div class="grid grid-cols-3 gap-2 items-center">
                                    <div>
                                        <input v-model="element.duration"
                                               type="time"
                                               name="duration"
                                               step="1"
                                               class="border-none"
                                        />
                                    </div>

                                    <div class="mx-auto">
                                        <SwitchGroup as="div" class="flex items-center">
                                            <Switch v-model="element.sound"
                                                    :class="[element.sound ? 'bg-blue-base' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-4 w-8 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']">
                                                <span aria-hidden="true"
                                                      :class="[element.sound ? 'translate-x-4' : 'translate-x-0', 'pointer-events-none inline-block h-3 w-3 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']"/>
                                            </Switch>
                                            <SwitchLabel as="span" class="ml-2">
                                                <span class="text-gray-900 text-sm">Sound</span>
                                            </SwitchLabel>
                                        </SwitchGroup>
                                    </div>

                                    <div class="mx-auto">
                                        <SwitchGroup as="div" class="flex items-center">
                                            <Switch v-model="element.repeat"
                                                    :class="[element.repeat ? 'bg-blue-base' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-4 w-8 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']">
                                                <span aria-hidden="true"
                                                      :class="[element.repeat ? 'translate-x-4' : 'translate-x-0', 'pointer-events-none inline-block h-3 w-3 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']"/>
                                            </Switch>
                                            <SwitchLabel as="span" class="ml-2">
                                                <span class="text-gray-900 text-sm">Repeat</span>
                                            </SwitchLabel>
                                        </SwitchGroup>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </draggable>
                </div>
            </form>
        </div>
    </div>
    <div class="grid grid-cols-2 xl:grid-cols-3 xl:mt-0 mt-20">
        <div class="hidden xl:block"></div>

        <div class="flex gap-8 items-center text-right xl:justify-center">
            <div class="w-4 h-4 rounded-full bg-gray-dots"></div>
            <div class="w-4 h-4 rounded-full bg-red-dots"></div>
            <div class="w-4 h-4 rounded-full bg-gray-dots"></div>
        </div>

        <div class="text-right">
            <button type="submit" form="stepsForm"
                    class="py-3 px-20 bg-green-dark rounded-lg text-white font-semibold"
            >
                Next
            </button>
        </div>
    </div>
</template>

<script>
import Draggable from "vuedraggable";
import AppLayout from "../../Layouts/AppLayout";
import moment from "moment";
import {Switch, SwitchGroup, SwitchLabel} from '@headlessui/vue'

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
        client: {
            type: Array,
            required: true
        }
    },
    methods: {
        submit() {
            this.$inertia.post(this.route('activity.date-time-info'), {
                'activity': this.activity,
                'client_id': this.client.id
            });
        },
        moment(date) {
            return moment(date).format('DD MMMM YYYY');
        },
        countAge() {
            return moment().diff(moment(this.client.birth_date, 'YYYY-MM-DD'), 'years');
        }
    },
    components: {
        Draggable,
        Switch,
        SwitchGroup,
        SwitchLabel
    }
}
</script>
