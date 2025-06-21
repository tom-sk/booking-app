<script setup>
import {
    ChevronLeftIcon,
    ChevronRightIcon,
} from '@heroicons/vue/20/solid'
import { ref, computed } from 'vue'
import { startOfMonth, endOfMonth, startOfWeek, endOfWeek, eachDayOfInterval, format, isSameMonth, isToday, isSameDay, parseISO } from 'date-fns'
const emit = defineEmits(['day-selected-bookings'])
const props = defineProps({
    bookings: {
        type: Array,
        default: () => []
    }
})

const currentDate = ref(new Date())
const selectedDate = ref(format(new Date(), 'yyyy-MM-dd'))

const monthLabel = computed(() => format(currentDate.value, 'MMMM yyyy'))

// Create a Set of booking dates extracted from start_time (date part only)
const bookedDates = computed(() => {
    return new Set(props.bookings.map(b => {
        // Extract the date portion from start_time (format: 'YYYY-MM-DD HH:mm')
        // We can just take first 10 chars or parse
        return b.start_time.substring(0, 10) // "2025-06-22"
    }))
})

const days = computed(() => {
    const start = startOfWeek(startOfMonth(currentDate.value), { weekStartsOn: 1 })
    const end = endOfWeek(endOfMonth(currentDate.value), { weekStartsOn: 1 })
    return eachDayOfInterval({ start, end }).map(date => {
        const dayString = format(date, 'yyyy-MM-dd')
        return {
            date,
            isCurrentMonth: isSameMonth(date, currentDate.value),
            isToday: isToday(date),
            isSelected: isSameDay(date, parseISO(selectedDate.value)),
            hasBooking: bookedDates.value.has(dayString)
        }
    })
})

function goToPreviousMonth() {
    const newDate = new Date(currentDate.value)
    newDate.setMonth(newDate.getMonth() - 1)
    currentDate.value = newDate
}

function goToNextMonth() {
    const newDate = new Date(currentDate.value)
    newDate.setMonth(newDate.getMonth() + 1)
    currentDate.value = newDate
}

// const selectedTime = ref(format(new Date(), 'HH:mm'))

function getBookingIdsForDay(dayString) {
    return props.bookings
        .filter(b => b.start_time.startsWith(dayString))
        .map(b => b.id)
}

function onDayClick(day) {
    const dayString = format(day.date, 'yyyy-MM-dd')
    selectedDate.value = dayString

    if (day.hasBooking) {
        const bookingIds = getBookingIdsForDay(dayString)
        emit('day-selected-bookings', { date: dayString, bookingIds })
    } else {
        // Optional: emit with empty booking IDs or do nothing
        emit('day-selected-bookings', { date: dayString, bookingIds: [] })
    }
}
</script>

<template>
    <div class="text-center">
        <div class="flex items-center text-gray-900 justify-between mb-4">
            <button @click="goToPreviousMonth" class="p-2 text-gray-400 hover:text-gray-600">
                <ChevronLeftIcon class="size-5" />
            </button>
            <div class="text-sm font-semibold">{{ monthLabel }}</div>
            <button @click="goToNextMonth" class="p-2 text-gray-400 hover:text-gray-600">
                <ChevronRightIcon class="size-5" />
            </button>
        </div>
        <div class="grid grid-cols-7 text-xs text-gray-500 mb-2">
            <div>M</div><div>T</div><div>W</div><div>T</div><div>F</div><div>S</div><div>S</div>
        </div>
        <div class="grid grid-cols-7 overflow-hidden gap-px rounded-lg bg-gray-200 text-sm shadow-sm ring-1 ring-gray-200">
            <button
                v-for="(day, index) in days"
                :key="index"
                @click="onDayClick(day)"
                type="button"
                :class="[
                  'relative py-1.5 hover:bg-gray-300 hover:text-black focus:z-10 transition-colors transition-ease-in-out',
                  day.isCurrentMonth ? 'bg-white' : 'bg-gray-50',
                  day.isSelected && 'font-semibold text-white bg-indigo-400',
                  day.isSelected && day.isToday && 'bg-indigo-600',
                  day.isSelected && !day.isToday && 'bg-gray-900',
                  !day.isSelected && day.isToday && 'text-indigo-600',
                  !day.isSelected && !day.isToday && (day.isCurrentMonth ? 'text-gray-900' : 'text-gray-400'),
                  index >= days.length - 7 && index % 7 === 0 && 'rounded-bl-lg',
                  index === days.length - 1 && 'rounded-br-lg',
                ]"
            >
                <time :datetime="format(day.date, 'yyyy-MM-dd')" class="mx-auto flex size-7 items-center justify-center rounded-full">
                    {{ format(day.date, 'd') }}
                </time>

                <!-- Booking indicator dot -->
                <span
                    v-if="day.hasBooking"
                    class="absolute bottom-1 right-1 h-2 w-2 rounded-full bg-red-500"
                    aria-label="Booking exists"
                    title="This day has a booking"
                ></span>
            </button>
        </div>

        <button class="mt-8 w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
            Add event
        </button>
    </div>
</template>
