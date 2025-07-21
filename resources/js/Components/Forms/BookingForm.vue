<script setup>
import { useForm } from '@inertiajs/vue3'
import Select from '@/Components/Forms/Select.vue'
import { inject } from 'vue'

const emit = defineEmits(['close'])

const props = defineProps({
    booking: {
        type: Object,
        default: () => null
    }
})

const clients = inject('clients')
const services = inject('services')

// Extract date from existing start_time if editing
const initialDate = props.booking?.start_time?.split('T')[0] ??
    props.booking?.start_time?.split(' ')[0] ??
    ''

const form = useForm({
    client_id: props.booking?.client_id ?? null,
    service_id: props.booking?.service_id ?? null,
    date: initialDate,
    start_time: props.booking?.start_time?.split('T')[1]?.slice(0, 5) ??
        props.booking?.start_time?.split(' ')[1]?.slice(0, 5) ?? '',
    end_time: props.booking?.end_time?.split('T')[1]?.slice(0, 5) ??
        props.booking?.end_time?.split(' ')[1]?.slice(0, 5) ?? '',
    notes: props.booking?.notes ?? ''
})

const submit = () => {
    const isEdit = !!props.booking?.id

    // Combine date + time into datetime strings
    const formatDateTime = (date, time) => {
        if (!date || !time) return null
        return `${date} ${time}:00`
    }

    form
        .transform((data) => ({
            ...data,
            start_time: formatDateTime(data.date, data.start_time),
            end_time: formatDateTime(data.date, data.end_time)
        }))
        .post(
            isEdit
                ? route('booking.update', props.booking.id)
                : route('booking.store'),
            {
                onSuccess: () => {
                    form.reset()
                    emit('close')
                }
            }
        )
}
</script>

<template>
    <div>
        {{form}}
        <h2 class="text-2xl font-bold mb-4">
            {{ booking?.id ? 'Edit Booking' : 'New Booking' }}
        </h2>

        <form @submit.prevent="submit" class="space-y-4">
            <Select placeholder="Select client" :options="clients" v-model="form.client_id"/>
            <Select placeholder="Select service" :options="services" v-model="form.service_id"/>

            <!-- 📅 Date picker -->
            <div>
                <label class="block text-sm font-medium">Date</label>
                <input
                    type="date"
                    v-model="form.date"
                    class="form-input w-full"
                    required
                />
                <p v-if="form.errors.date" class="text-red-500 text-sm">{{ form.errors.date }}</p>
            </div>

            <!-- ⏰ Start time -->
            <div>
                <label class="block text-sm font-medium">Start Time</label>
                <input
                    type="time"
                    v-model="form.start_time"
                    class="form-input w-full"
                    min="09:00"
                    max="18:00"
                    required
                />
                <p v-if="form.errors.start_time" class="text-red-500 text-sm">{{ form.errors.start_time }}</p>
            </div>

            <!-- ⏰ End time -->
            <div>
                <label class="block text-sm font-medium">End Time</label>
                <input
                    type="time"
                    v-model="form.end_time"
                    class="form-input w-full"
                    min="09:00"
                    max="18:00"
                    required
                />
                <p v-if="form.errors.end_time" class="text-red-500 text-sm">{{ form.errors.end_time }}</p>
            </div>

            <!-- 📝 Notes -->
            <div>
                <label class="block text-sm font-medium">Notes</label>
                <textarea v-model="form.notes" class="form-textarea w-full"></textarea>
            </div>

            <button
                type="submit"
                class="w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-500"
            >
                {{ booking?.id ? 'Update' : 'Create' }} Booking
            </button>
        </form>
    </div>
</template>

