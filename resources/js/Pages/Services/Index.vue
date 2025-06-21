<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthSidebar from "@/Layouts/AuthSidebar.vue";

defineProps({
    services: {
        type: Object,
    }
});
</script>

<template>
    <div class="grid grid-cols-2 gap-4 md:grid-cols-4 mb-8">
        <Link v-for="service in services"
              :href="route('service.edit', service.id)"
              :key="service.id"
             class="group relative shadow p-4 hover:bg-gray-200 text-gray-900 transition-all ease cursor-pointer rounded-lg">
            <h3 class="text-sm ">
                {{service.name}}
            </h3>

            <p class="mt-1 text-sm font-medium mb-12">
                {{service.duration}} mins
            </p>

            <div class="absolute rounded-l right-0 bottom-2 px-2 bg-gray-300 text-sm font-medium text-gray-900">
                £{{service.price}}
            </div>
        </Link>
    </div>

    <Link :href="route('service.new')" class="mt-8 w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
        Add Service
    </Link>
</template>
