<script setup>
import { ref } from 'vue'
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
import {
    Bars3Icon,
    CalendarIcon,
    ChartPieIcon,
    DocumentDuplicateIcon,
    FolderIcon,
    HomeIcon,
    UsersIcon,
    XMarkIcon,
} from '@heroicons/vue/24/outline'
import Sidebar from "@/Components/Nav/Sidebar.vue";
import {Head, Link} from "@inertiajs/vue3";
import FlashContainer from "@/Components/FlashMsg/FlashContainer.vue";
import MobileSidebar from "@/Components/Nav/MobileSidebar.vue";

defineProps({
    title: String
});

const navigation = [
    {name: 'Dashboard', href: '#', routeName: 'dashboard', icon: HomeIcon, current: true},
    {name: 'Clients', href: '#', routeName:'clients.index', icon: UsersIcon, current: false},
    {name: 'Bookings', href: '#', routeName:'booking.index', icon: FolderIcon, current: false},
    {name: 'Services', href: '#', routeName:'service.index', icon: CalendarIcon, current: false},
    {name: 'Availability', href: '#', routeName:'availability.index', icon: DocumentDuplicateIcon, current: false},
    // {name: 'Reports', href: '#', icon: ChartPieIcon, current: false},
]
const sidebarOpen = ref(false)
</script>

<template>
    <Head :title/>

    <div>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog class="relative z-50 lg:hidden" @close="sidebarOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-900/80" />
                </TransitionChild>

                <div class="fixed inset-0 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                        <DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
                            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
                                <div class="absolute top-0 left-full flex w-16 justify-center pt-5">
                                    <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                                        <span class="sr-only">Close sidebar</span>
                                        <XMarkIcon class="size-6 text-white" aria-hidden="true" />
                                    </button>
                                </div>
                            </TransitionChild>

                            <!-- Sidebar component, swap this element with another sidebar if you like -->
                            <MobileSidebar :navigation @close="sidebarOpen = false" />
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <Sidebar :navigation />

        <div class="sticky top-0 z-40 flex items-center gap-x-6 bg-gray-900 px-4 py-4 shadow-xs sm:px-6 lg:hidden">
            <button type="button" class="-m-2.5 p-2.5 text-gray-400 lg:hidden" @click="sidebarOpen = true">
                <span class="sr-only">Open sidebar</span>
                <Bars3Icon class="size-6" aria-hidden="true" />
            </button>
            <div class="flex-1 text-sm/6 font-semibold text-white">Dashboard</div>
            <a href="#">
                <span class="sr-only">Your profile</span>
                <img class="size-8 rounded-full bg-gray-800" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
            </a>
        </div>

        <main class="py-10 lg:pl-72 ">
            <div class="px-4 sm:px-6 lg:px-8">
                <!-- Page Content -->
                <main>
                    <slot />
                </main>
            </div>
        </main>

        <FlashContainer/>
    </div>
</template>
