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
    <Head title="Dashboard" />

    <AuthSidebar>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Clients
            </h2>
        </template>

        <div>
            <div class="">
                <ClientsTable :clients="clients.data"/>
            </div>
        </div>
    </AuthSidebar>
</template>
