<script setup>
import { Head } from '@inertiajs/vue3';
import AuthSidebar from "@/Layouts/AuthSidebar.vue";
import ClientsTable from "@/Components/ClientsTable.vue";

defineProps({
    clients: {
        type: Object,
    }
});
</script>

<template>
    <div>
        <div class="">
            <ClientsTable :clients="clients"/>
        </div>
    </div>
</template>
