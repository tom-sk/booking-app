<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import AuthSidebar from "@/Layouts/AuthSidebar.vue";

defineProps({
    bookings: {
        type: Object,
    }
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthSidebar>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div>
            <div>
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="text-gray-900">
                        <h3 class="bold text-2xl mb-4">Bookings</h3>
                        <div v-for="booking in bookings">
                            <div class="mb-4 p-4 bg-gray-100 rounded-lg">
                                <h3 class="text-lg font-semibold">
                                    Booking ID: {{ booking.id }}
                                </h3>

                                <p>
                                    Date: {{ booking.start_time }}
                                </p>
                                <p>
                                    Time: {{ booking.end_time }}
                                </p>
                                <p>
                                    Status: {{ booking.status }}
                                </p>

                                <div class="p-4 bg-gray-400">
                                    {{ booking.client.name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthSidebar>
</template>
