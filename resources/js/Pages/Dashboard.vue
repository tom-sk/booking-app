<script setup>
import UpcomingBookings from "@/Components/Widgets/UpcomingBookings.vue";
import Stats from "@/Components/Widgets/Stats.vue";
import BookingCalendar from "@/Components/BookingCalendar.vue";

defineProps({
    bookings: {
        type: Object,
    }
});
</script>

<template>
    <div>
        <div>
            <div
                class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
            >
                <div class="text-gray-900">
                    <h3 class="bold text-2xl mb-4">Upcoming Bookings</h3>

                    <div class="grid gap-4">
                        <div class="grid grid-cols-3 gap-4">
                            <UpcomingBookings :bookings class="col-span-2"/>

                            <div>
                                <BookingCalendar :bookings/>
                            </div>
                        </div>

                        <Stats/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
