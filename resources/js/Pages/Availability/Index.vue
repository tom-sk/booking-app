<script setup>
import WeekCalendar from "@/Components/Calendars/WeekCalendar.vue";
import SideModal from "@/Components/Modals/SideModal.vue";
import { ref} from "vue";
import EditForm from "@/Pages/Availability/EditForm.vue";
import NewAvailabilityForm from "@/Pages/Availability/NewAvailabilityForm.vue";

defineProps({
    availability: {
        type: Object,
    }
});

const editOpen = ref(false)
const newOpen = ref(false)

function close() {
    editOpen.value = false
}

const selectedDay = ref(null);
const newDay = ref(null);
const openEditModal = (day) => {
    // Logic to open the modal and pass the selected day
    selectedDay.value = day;
    editOpen.value = true
};

const openNewModal = (day) => {
    // Logic to open the modal and pass the selected day
    newDay.value = day;
    newOpen.value = true
};
</script>

<template>
    <h1 class="text-2xl font-bold">Availability</h1>
    <div class="h-[900px] overflow-scroll">
        <WeekCalendar
            :availability
            @select-day="openEditModal"
            @add="openNewModal"/>
    </div>

    <SideModal v-model="editOpen" @close="editOpen = false">
        <EditForm
            v-if="selectedDay"
            :selected-day="selectedDay"
            @close="editOpen = false"
            />
    </SideModal>

    <SideModal v-model="newOpen" @close="newOpen = false">
        <NewAvailabilityForm
            v-if="newDay"
            :new-day="newDay"
            @close="newOpen = false"
        />
    </SideModal>
</template>
