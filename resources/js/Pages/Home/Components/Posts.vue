<template>
    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
        <div class="flex-shrink-0">
            <img class="h-48 w-full object-cover" :src="page.image" alt="" />
        </div>
        <div class="flex-1 bg-white p-6 flex flex-col justify-between mb-10">
            <div class="flex-1">
                <div>
                    <div class="flex justify-center">
                        <div class="text-sm text-gray-600" v-for="tag in page.tags" :key="tag.id">
                            <div >
                                {{ tag.name.en }}
                                <span  class="items-center mr-1 text-md">🚀</span>
                            </div>
                        </div>
                    </div>
                </div>
                <Link :href="page.url" class="block mt-2 text-xl font-semibold text-gray-900">
                    {{ page.title }}
                </Link>

                <p class="text-sm text-gray-700">
                    {{ page.date }}
                </p>
                <div class="mt-3 text-base text-gray-500" v-html="page.intro"></div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    page: Object
})
</script>

<style scoped>

</style>
