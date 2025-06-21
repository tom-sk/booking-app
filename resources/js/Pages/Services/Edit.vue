<script setup>
import {Head, router, useForm} from '@inertiajs/vue3';
import AuthSidebar from "@/Layouts/AuthSidebar.vue";

const props = defineProps({
    service: {
        type: Object,
        default: () => ({})
    }
})
// Initialize the form with default values
const form = useForm({
    name: props.service.name || '',
    duration: props.service.duration || '',
    price: props.service.price || '',
});

function submit() {
    form.post(route('service.update', props.service.id), {
        onSuccess: () => {

        },
    });
}
</script>

<template>
    <Head title="Add Service" />
    <AuthSidebar>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Add Services
            </h2>
        </template>

        <form @submit.prevent="submit" class="space-y-6 max-w-md">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Service Name</label>
                <input
                    v-model="form.name"
                    id="name"
                    type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
                <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
            </div>

            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                <input
                    v-model.number="form.duration"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
                <p v-if="form.errors.duration" class="mt-1 text-sm text-red-600">{{ form.errors.duration }}</p>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                <input
                    v-model.number="form.price"
                    id="price"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
                <p v-if="form.errors.price" class="mt-1 text-sm text-red-600">{{ form.errors.price }}</p>
            </div>

            <div class="flex justify-end gap-4">
                <button type="button" @click="form.reset()" class="px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-100">
                    Cancel
                </button>
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-500 disabled:opacity-50"
                >
                    Save
                </button>
            </div>
        </form>
    </AuthSidebar>
</template>
