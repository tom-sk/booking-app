
<script setup>
import { ChevronRightIcon } from '@heroicons/vue/20/solid'
const props = defineProps({
    bookings: {
        type: Array,
        required: true,
    },
})
const people = [
    {
        name: 'Leslie Alexander',
        email: 'leslie.alexander@example.com',
        role: 'Co-Founder / CEO',
        imageUrl:
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        href: '#',
        lastSeen: '3h ago',
        lastSeenDateTime: '2023-01-23T13:23Z',
    },
    {
        name: 'Michael Foster',
        email: 'michael.foster@example.com',
        role: 'Co-Founder / CTO',
        imageUrl:
            'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        href: '#',
        lastSeen: '3h ago',
        lastSeenDateTime: '2023-01-23T13:23Z',
    },
    {
        name: 'Dries Vincent',
        email: 'dries.vincent@example.com',
        role: 'Business Relations',
        imageUrl:
            'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        href: '#',
        lastSeen: null,
    },
    {
        name: 'Lindsay Walton',
        email: 'lindsay.walton@example.com',
        role: 'Front-end Developer',
        imageUrl:
            'https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        href: '#',
        lastSeen: '3h ago',
        lastSeenDateTime: '2023-01-23T13:23Z',
    },
    {
        name: 'Courtney Henry',
        email: 'courtney.henry@example.com',
        role: 'Designer',
        imageUrl:
            'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        href: '#',
        lastSeen: '3h ago',
        lastSeenDateTime: '2023-01-23T13:23Z',
    },
    {
        name: 'Tom Cook',
        email: 'tom.cook@example.com',
        role: 'Director of Product',
        imageUrl:
            'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        href: '#',
        lastSeen: null,
    },
]
</script>

<template>
    <ul role="list" class="divide-y divide-gray-100 overflow-hidden bg-white shadow-xs ring-1 ring-gray-900/5 sm:rounded-xl">
        <li v-for="booking in bookings" :key="booking.id"
            class="cursor-pointer relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6">
            <div class="flex min-w-0 gap-x-4">
                <img v-if="booking.client.profile_image" class="size-12 flex-none rounded-full bg-gray-50" :src="booking.client.profile_image" alt="" />
                <div v-else class="w-12 h-12 flex-none rounded-full bg-zinc-200" />
                <div class="min-w-0 flex-auto">
                    <p class="text-sm/6 font-semibold text-gray-900">
                        <a :href="booking.href">
                            <span class="absolute inset-x-0 -top-px bottom-0" />
                            {{ booking.client.name }}
                        </a>
                    </p>
                    <p class="mt-1 flex text-xs/5 text-gray-500">
                        <a :href="`mailto:${booking.client.email}`" class="relative truncate hover:underline">{{ booking.service.name }}</a>
                    </p>
                </div>
            </div>
            <div class="flex shrink-0 items-center gap-x-4">
                <div class="hidden sm:flex sm:flex-col sm:items-end">
                    <p class="text-sm/6 text-gray-900">{{ booking.start_time }}</p>
                    <p class="text-sm/6 text-gray-900">{{ booking.duration }}</p>
                    <p v-if="booking.lastSeen" class="mt-1 text-xs/5 text-gray-500">
                        Last seen <time :datetime="booking.lastSeenDateTime">{{ booking.lastSeen }}</time>
                    </p>
                    <div v-else class="mt-1 flex items-center gap-x-1.5">
                        <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                            <div class="size-1.5 rounded-full bg-emerald-500" />
                        </div>
                        <p class="text-xs/5 text-gray-500">{{booking.status}}</p>
                    </div>
                </div>
                <ChevronRightIcon class="size-5 flex-none text-gray-400" aria-hidden="true" />
            </div>
        </li>
    </ul>
</template>

