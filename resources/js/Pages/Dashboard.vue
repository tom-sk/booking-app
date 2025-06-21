<script setup>
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
</template>
