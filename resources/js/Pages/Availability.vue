<script setup>
import WeekCalendar from "@/Components/Calendars/WeekCalendar.vue";

defineProps({
    availability: {
        type: Object,
    }
});
</script>

<template>
    <h1 class="text-2xl font-bold">Availability</h1>

    <div class="h-[900px] overflow-scroll">
        <WeekCalendar :availability/>
    </div>
</template>
