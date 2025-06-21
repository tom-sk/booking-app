<script setup>
import { Head } from '@inertiajs/vue3';
import AuthSidebar from "@/Layouts/AuthSidebar.vue";
import BookingCalendar from "@/Components/BookingCalendar.vue";

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
                Bookings
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <BookingCalendar/>
            </div>
        </div>
    </AuthSidebar>
</template>
