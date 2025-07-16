<script setup>
import {ref, computed, onMounted} from 'vue';
import {format} from 'date-fns';
import BookingCalendar from "@/Components/BookingCalendar.vue";

const props = defineProps({
    bookings: {
        type: Object,
        required: true,
    },
});

const activeBookingIds = ref([]);

// Get today's date string
const todayString = format(new Date(), 'yyyy-MM-dd');

// Helper to get booking IDs for a given day
function getBookingIdsForDay(dayString) {
    return props.bookings
        .filter(b => b.start_time.startsWith(dayString))
        .map(b => b.id);
}

// Set active booking IDs when a day is clicked
function getBooking(event) {
    activeBookingIds.value = event.bookingIds || [];
}

// Compute full booking objects from active IDs
const activeBookings = computed(() => {
    if (!props.bookings ) return [];
    return props.bookings.filter(b => activeBookingIds.value.includes(b.id));
});

// Set initial bookings for today
onMounted(() => {
    activeBookingIds.value = getBookingIdsForDay(todayString);
});
</script>

<template>
    <div>
        <BookingCalendar
            :bookings="bookings"
            @day-selected-bookings="getBooking"
        />

        <div v-if="activeBookingIds.length" class="mt-6 p-4 bg-white rounded shadow">
            <h3 class="mb-4 font-semibold text-lg">Bookings on selected day</h3>
            <ul class="divide-black divide d-flex">
                <li v-for="booking in activeBookings" :key="booking.id" class="mb-2 pb-2">
                    <div><strong>Client:</strong> {{ booking.client.name }}</div>
                    <div><strong>Service:</strong> {{ booking.service.name }}</div>
                    <div><strong>Time:</strong> {{ booking.start_time.substring(11, 16) }} -
                        {{ booking.end_time.substring(11, 16) }}
                    </div>
                </li>
            </ul>
        </div>

        <div v-else class="mt-6 p-4 text-gray-500">
            Select a day with bookings to see details.
        </div>
    </div>
</template>
