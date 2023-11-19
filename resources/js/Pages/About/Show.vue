<script setup>
import AppLayout from '@/Layouts/GuestLayout.vue';

defineProps({
    page: String,
    title: String
});

</script>

<template>
    <AppLayout title="About">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                About {{ $page.props.app_name }}
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 dark:text-gray-300 bg-white mt-10 mb-10 rounded-lg shadow-lg">
                <div class="text-lg max-w-prose mx-auto">
                    <span class="block text-base text-center text-indigo-600 font-semibold tracking-wide uppercase items-center">
                        <span>Alfred <span class="items-center mr-1">🚀</span>  Nutile
                        </span>
                    </span>
                    <h1>
                        <span class="mt-2 block text-3xl text-center leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">About</span>
                    </h1>
                </div>

                <div class="mx-auto text-xl text-gray-500 py-10 prose px-5 sm:px-0">
                    I have been in the industry for 20+ years. My roots are in coding and a passion for technology (OpenAi, PHP, Laravel and more). For the past several years, I have been building and leading a team to create technologies to assist in the digital transformation in my current role.

                    Worked at Pfizer for 10 years building amazing products and working with an amazing team.

                    Now I am building great products for companies like <a href="https://break9.com/" target="_blank" class="underline">Break9</a>, Resurva and <a href="https://www.unearthcampaigns.com/" target="_blank" class="underline">Unearth</a> and more Open Source Projects including <a href="https://larachain.io/" target="_blank" class="underline">LaraChain</a> and <a href="https://github.com/alnutile/llm-assistant" target="_blank" class="underline">LLM Assistant</a>
                </div>
                <section class="bg-white dark:bg-gray-900">
                    <div>
                        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3 max-w-4xl mx-auto">
                            <div class="px-4 py-5 bg-white shadow-xl rounded-lg overflow-hidden sm:p-6 h-48">
                                <dt class="text-xl font-medium text-gray-500 truncate">GitHub</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">
                                    The place that matters for developers 🙂
                                    <a href="https://github.com/alnutile" target="_blank" class="underline">here</a>
                                </dd>
                            </div>

                            <div class="px-4 py-5 bg-white shadow-xl rounded-lg overflow-hidden sm:p-6 h-48">
                                <dt class="text-xl font-medium text-gray-500 truncate">YouTube</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">
                                    More content coming soon! 📺
                                    <a href="https://www.youtube.com/c/AlfredNutile" target="_blank" class="underline">here</a>
                                </dd>
                            </div>

                            <div class="px-4 py-5 bg-white shadow-xl rounded-lg overflow-hidden sm:p-6 h-48">
                                <dt class="text-xl font-medium text-gray-500 truncate">LinkedIn</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">
                                    Some posts, connections and recommendations. 👉
                                    <a href="https://www.linkedin.com/in/alfrednutile/" target="_blank" class="underline">here</a>
                                </dd>
                            </div>
                            <div class="px-4 py-5 bg-white shadow-xl rounded-lg overflow-hidden sm:p-6 h-48">
                                <dt class="text-xl font-medium text-gray-500 truncate">Resume</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">
                                    👔 👔 👔 👔 👔 👔 👉
                                    <a href="https://bit.ly/30BHcwA" target="_blank" class="underline">here</a>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </section>
            </div>
        </div>
    </AppLayout>
</template>
