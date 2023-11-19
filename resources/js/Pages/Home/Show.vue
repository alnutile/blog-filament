<script setup>
import AppLayout from '@/Layouts/GuestLayout.vue';
import GitHub from '@/Components/GitHub.vue';
import Posts from "@/Pages/Home/Components/Posts.vue";

defineProps({
    page: String,
    title: String,
    posts: Object,
});

</script>

<template>
    <AppLayout :title="$page.props.app_name">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $page.props.app_name }}
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 dark:text-gray-300 bg-white mt-10 mb-10 rounded-lg shadow-lg">
                <section class="bg-white dark:bg-gray-900">
                    <GitHub/>
                </section>
                <section>
                    <div class="px-4 mt-10 mx-auto max-w-screen-xl lg:py-8 lg:px-6">
                        <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
                            <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                                Alfred Nutile</h2>
                            <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Laravel 🚀 Vue 🚀
                                Inertia</p>
                        </div>
                        <div class="grid gap-8 lg:grid-cols-3">
                            <Posts :page="page" v-for="page in posts.data" />
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AppLayout>
</template>
