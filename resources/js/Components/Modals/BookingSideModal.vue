<script setup>
import ButtonStyled from "@/Components/ButtonStyled.vue";
import NewAvailabilityForm from "@/Pages/Availability/NewAvailabilityForm.vue";
import SideModal from "@/Components/Modals/SideModal.vue";

import { ref } from "vue";
import BookingForm from "@/Components/Forms/BookingForm.vue";

const open = ref(false);
</script>

<template>
    <ButtonStyled @click="open = true">Add Booking</ButtonStyled>
    <SideModal v-model="open" @close="open = false">
       <BookingForm/>
    </SideModal>
</template>

<style scoped>

</style>
