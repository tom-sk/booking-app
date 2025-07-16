<script setup>
import ClientsTable from "@/Components/ClientsTable.vue";

defineProps({
    clients: {
        type: Object,
    }
});
</script>

<template>
    <ClientsTable :clients="clients"/>
</template>
