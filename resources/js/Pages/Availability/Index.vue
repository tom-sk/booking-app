<script setup>
import WeekCalendar from "@/Components/Calendars/WeekCalendar.vue";
import SideModal from "@/Components/Modals/SideModal.vue";
import {provide, ref} from "vue";
import EditForm from "@/Pages/Availability/EditForm.vue";

defineProps({
    availability: {
        type: Object,
    }
});


const isOpen = ref(false)
const modalContent = ref(null)

function open(component) {
    isOpen.value = true
}

function close() {
    isOpen.value = false
}

provide('sideModal', { isOpen, open, close })
const selectedDay = ref(null);
const openModal = (day) => {
    // Logic to open the modal and pass the selected day
    selectedDay.value = day;
    open()
};
</script>

<template>
    <h1 class="text-2xl font-bold">Availability</h1>
    <div class="h-[900px] overflow-scroll">
        <WeekCalendar :availability @select-day="openModal"/>
    </div>

    <SideModal>
        <EditForm
            v-if="selectedDay"
            :selected-day="selectedDay"
            @close="close"/>
    </SideModal>
</template>
