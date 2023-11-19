<template>
    <div class="relative
    bg-gray-50 pt-4 pb-10 px-4 sm:px-6
     sm:h-[400px]
     h-[200px]
     mx-auto
     flex
     justify-center
    lg:pt-4 lg:pb-14 lg:px-8 border-slate-300 border-b-2
">
        <Transition name="fade">
            <div class="absolute flex-wrap flex justify-start gap-1 max-w-7xl" v-if="!ready">
                <div
                    :class="`sm:w-16 sm:h-16 w-5 h-5 animate animate-pulse ${day.color}`"
                    v-for="day in github_results.days">
                </div>
            </div>
            <div class="absolute flex-wrap flex justify-start gap-1 max-w-7xl" v-else>
                <div
                    :style="`background-color: ${day.color}`" class="sm:w-16 sm:h-16 w-5 h-5"
                    v-for="day in github_results.days">
                </div>
            </div>
        </Transition>
        <div class="absolute inset-x-0 bottom-12 sm:bottom-24 h-24 w-24 sm:w-60 sm:h-60 flex mx-auto min-w-max">
            <img alt="alfred" class="border border-4 border-white rounded rounded-full h-24 w-24 sm:h-56 sm:w-56 object-cover" src="/images/me_2023.png"/>
        </div>
        <div class="absolute bottom-0 right-10 hidden sm:flex sm:justify-end mt-2">
            <a href="https://github.com/alnutile" target="_blank"
               class="text-gray-600 sm:text-lg text-xs italic flex justify-between items-center">
                <svg fill="currentColor" viewBox="0 0 24 24" class="mr-2 h-6 w-6 text-gray-600" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                GitHub contributions graph</a></div>
    </div>
</template>

<script setup>
import {onBeforeMount, onMounted, ref} from "vue";

const ready = ref(false);
const github_results = ref({});
onBeforeMount(() => {
    github_results.value = {
        days: new Array(70).fill({
            color: "bg-gray-200",
            contributionCount: 14,
            date:"2022-12-23",
            weekday: 5
        })
    }
    getContribs()
})

const getContribs = () => {
    axios.get("/api/github_contribs").then(data => {
        github_results.value = data.data.github_results;
        ready.value = true;
    }).catch(error => {
        console.log(error.message)
    })
}
</script>
<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
