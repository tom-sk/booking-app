<script setup>
import { useForm } from "@inertiajs/vue3";
import Select from "@/Components/Forms/Select.vue";

const emit = defineEmits(['close']);
const props = defineProps({
    selectedDay: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    day_of_week: props.selectedDay.day_of_week || 0,
    start_time: props.selectedDay.start_time || '',
    end_time: props.selectedDay.end_time || '',
});

const getDayOfWeek = (day) => {
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    return days[day];
};

const days = [
    { id: 1, value: 1, name: 'Monday' },
    { id: 2, value: 2, name: 'Tuesday' },
    { id: 3, value: 3, name: 'Wednesday' },
    { id: 4, value: 4, name: 'Thursday' },
    { id: 5, value: 5, name: 'Friday' },
    { id: 6, value: 6, name: 'Saturday' },
    { id: 7, value: 7, name: 'Sunday' }
];

const submit = () => {
    const formatTime = (time) => {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd} ${time}:00`;
    };

    form
        .transform((data) => ({
            ...data,
            start_time: formatTime(form.start_time),
            end_time: formatTime(form.end_time),
        }))
        .put(route('availability.update', props.selectedDay.id), {
            onSuccess: () => {
                form.reset();
                emit('close');
            },
        });
};

const deleteAvailability = () => {
    if (!confirm('Are you sure you want to delete this availability?')) return;

    form.delete(route('availability.destroy', props.selectedDay.id), {
        onSuccess: () => {
            form.reset();
            emit('close');
        },
    });
};
</script>

<template>
    <h3 class="text-2xl font-bold">Edit Availability</h3>

    <div class="mb-4">
        <div>{{ getDayOfWeek(selectedDay.day_of_week) }}</div>

        <Select :options="days" v-model="form.day_of_week"/>

        <label for="start_time" class="block mb-2 text-sm font-medium">Start time:</label>
        <div class="relative">
            <!-- your existing input here -->
            <input
                type="time"
                id="start_time"
                v-model="form.start_time"
                class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                min="09:00"
                max="18:00"
                required
            />
            <p v-if="form.errors.start_time" class="text-red-600 text-sm mt-1">{{ form.errors.start_time }}</p>
        </div>

        <label for="end_time" class="block mb-2 text-sm font-medium mt-4">End time:</label>
        <div class="relative">
            <!-- your existing input here -->
            <input
                type="time"
                id="end_time"
                v-model="form.end_time"
                class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                min="09:00"
                max="18:00"
                required
            />
            <p v-if="form.errors.end_time" class="text-red-600 text-sm mt-1">{{ form.errors.end_time }}</p>
        </div>
    </div>

    <div class="flex justify-between items-center gap-4">
        <button @click="submit"
                class="w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
            Update time
        </button>

        <!-- Delete button -->
        <button @click="deleteAvailability"
                class="w-full rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-500">
            Delete
        </button>
    </div>
</template>
