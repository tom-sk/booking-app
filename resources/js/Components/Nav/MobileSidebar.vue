<script setup>
import {Link, usePage} from "@inertiajs/vue3";

defineProps({
    navigation: {
        type: Array,
        required: true
    }
});

const emit = defineEmits(['close']);

const isActive = (routeName) => {
    return usePage().props.pageName === routeName;
};
</script>

<template>
    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-2 ring-1 ring-white/10">
        <div class="flex h-16 shrink-0 items-center text-white text-xl">
            Taperly
        </div>
        <nav class="flex flex-1 flex-col">
            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>
                    <ul role="list" class="-mx-2 space-y-1">
                        <li v-for="item in navigation" :key="item.name">
                            <Link :href="route(item.routeName)"
                                  @click="emit('close')"
                                  :class="[isActive(item.routeName) ? 'bg-gray-800 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white', 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold']">
                                <component :is="item.icon" class="size-6 shrink-0" aria-hidden="true" />
                                {{ item.name }}
                            </Link>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</template>
