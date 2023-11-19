<template>
    <Disclosure as="nav" class="bg-white shadow" v-slot="{ open }">
        <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
            <div class="flex h-16 justify-between">
                <div class="flex px-2 lg:px-0">
                    <div class="flex flex-shrink-0 items-center">
                        <img class="h-6 w-6 rounded-full" src="/images/me_2023.png" alt="Your Company" />
                    </div>
                    <div class="hidden lg:ml-6 lg:flex lg:space-x-8">
                        <!-- Current: "border-indigo-500 text-gray-900", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
                        <Link
                            :href="route('home')"
                            :class="{  'border-b-2'  : route().current('home') }"
                            class="inline-flex items-center  border-indigo-500 px-1 pt-1 text-sm font-medium text-gray-900">
                            Home
                        </Link>
                        <Link
                            :href="route('pages.index')"
                            :class="{  'border-b-2'  : route().current('pages.index') }"
                            class="inline-flex items-center border-indigo-500 px-1 pt-1 text-sm font-medium text-gray-900">
                            Posts
                        </Link>
                        <Link
                            :href="route('about')"
                            :class="{  'border-b-2'  : route().current('about') }"
                            class="inline-flex items-center border-indigo-500 px-1 pt-1 text-sm font-medium text-gray-900">
                            About
                        </Link>
                    </div>
                </div>
                <div class="flex flex-1 items-center justify-center px-2 lg:ml-6 lg:justify-end">
                    <div class="w-full max-w-lg lg:max-w-xs">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                            </div>
                            <form @submit.prevent="searchIt">
                                <input
                                    autofocus
                                    autocomplete="off"
                                    v-model="form.search"
                                    id="search_top" name="search_top"
                                    class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Search" type="search" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="flex items-center lg:hidden">
                    <!-- Mobile menu button -->
                    <DisclosureButton class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <span class="absolute -inset-0.5" />
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                        <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                    </DisclosureButton>
                </div>
            </div>
        </div>

        <DisclosurePanel class="lg:hidden">
            <div class="space-y-1 pb-3 pt-2">
                <!-- Current: "bg-indigo-50 border-indigo-500 text-indigo-700", Default: "border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800" -->
                <Link :class="{  'border-l-4 bg-indigo-50 '  : route().current('home') }"
                                  :href="route('home')" class="block border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Home</Link>
                <Link :class="{  'border-l-4 bg-indigo-50 '  : route().current('pages.index') }"
                                  :href="route('pages.index')" class="block border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Posts</Link>
                <Link :class="{  'border-l-4 bg-indigo-50 '  : route().current('about') }"
                                  :href="route('about')" class="block border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">About</Link>
            </div>
        </DisclosurePanel>
    </Disclosure>
</template>

<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import {Link, useForm} from "@inertiajs/vue3";

const form = useForm(
    {
        search: ""
    }
)


const searchIt = () => {
    form.get(route("pages.index"), {
        preserveScroll: true
    })
}

</script>
