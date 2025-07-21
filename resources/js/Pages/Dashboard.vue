<script setup>
import UpcomingBookings from "@/Components/Widgets/UpcomingBookings.vue";
import Stats from "@/Components/Widgets/Stats.vue";
import BookingCalendar from "@/Components/BookingCalendar.vue";
import ButtonStyled from "@/Components/ButtonStyled.vue";
import BookingSideModal from "@/Components/Modals/BookingSideModal.vue";
import {provide} from "vue";

const props = defineProps({
    bookings: {
        type: Object,
    },
    clients: {
        type: Array,
    },
    services: {
        type: Array,
    }
});

provide('clients', props.clients)
provide('services', props.services)
</script>

<template>
    <div>
        <div>
            <div
                class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
            >
                <div class="text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="bold text-2xl mb-4">Upcoming Bookings</h3>

                        <BookingSideModal/>
                    </div>
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
