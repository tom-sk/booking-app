<script setup>
import { ref, onMounted } from 'vue'

const container = ref(null)
const containerNav = ref(null)
const containerOffset = ref(null)

defineProps({
    availability: {
        type: Array,
        default: () => []
    }
})

const emit = defineEmits(['select-day', 'add'])

function timeToGridRow(time) {
    const [hours, minutes] = time.split(':').map(Number)
    return (8 + (hours * 60 + minutes) / 5)
}

function formatHourLabel(hour) {
    const h = hour % 12 === 0 ? 12 : hour % 12;
    const ampm = hour < 12 ? 'AM' : 'PM';
    return `${h}${ampm}`;
}

function handleCellClick(rowIndex, colIndex) {
    const minutes = rowIndex * 30
    const startHour = Math.floor(minutes / 60)
    const startMinutes = minutes % 60

    const start_time = `${startHour.toString().padStart(2, '0')}:${startMinutes.toString().padStart(2, '0')}`

    // Add 60 minutes to the start time
    const endTotalMinutes = minutes + 60
    const endHour = Math.floor(endTotalMinutes / 60)
    const endMinutes = endTotalMinutes % 60

    const end_time = `${endHour.toString().padStart(2, '0')}:${endMinutes.toString().padStart(2, '0')}`

    emit('add', {
        day_of_week: colIndex + 1, // 1 = Monday
        start_time,
        end_time
    })
}


onMounted(() => {
    const targetMinute = 9 * 60
    container.value.scrollTop =
        ((container.value.scrollHeight - containerNav.value.offsetHeight - containerOffset.value.offsetHeight) *
            targetMinute) /
        1440
})
</script>

<template>
    <div class="flex h-full flex-col">
        <div ref="container" class="isolate flex flex-auto flex-col overflow-auto bg-white">
            <div style="width: 165%" class="flex max-w-full flex-none flex-col sm:max-w-none md:max-w-full">
                <div ref="containerNav" class="sticky top-0 z-30 flex-none bg-white shadow-sm ring-1 ring-black/5">
                    <div class="grid grid-cols-7 text-sm/6 text-gray-500 sm:hidden">
                        <button type="button" class="flex flex-col items-center pt-2 pb-3">
                            M <span class="mt-1 flex size-8 items-center justify-center font-semibold text-gray-900">10</span>
                        </button>
                        <button type="button" class="flex flex-col items-center pt-2 pb-3">
                            T <span class="mt-1 flex size-8 items-center justify-center font-semibold text-gray-900">11</span>
                        </button>
                        <button type="button" class="flex flex-col items-center pt-2 pb-3">
                            W <span class="mt-1 flex size-8 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white">12</span>
                        </button>
                        <button type="button" class="flex flex-col items-center pt-2 pb-3">
                            T <span class="mt-1 flex size-8 items-center justify-center font-semibold text-gray-900">13</span>
                        </button>
                        <button type="button" class="flex flex-col items-center pt-2 pb-3">
                            F <span class="mt-1 flex size-8 items-center justify-center font-semibold text-gray-900">14</span>
                        </button>
                        <button type="button" class="flex flex-col items-center pt-2 pb-3">
                            S <span class="mt-1 flex size-8 items-center justify-center font-semibold text-gray-900">15</span>
                        </button>
                        <button type="button" class="flex flex-col items-center pt-2 pb-3">
                            S <span class="mt-1 flex size-8 items-center justify-center font-semibold text-gray-900">16</span>
                        </button>
                    </div>

                    <div class="-mr-px hidden grid-cols-7 divide-x divide-gray-100 border-r border-gray-100 text-sm/6 text-gray-500 sm:grid">
                        <div class="col-end-1 w-14" />
                        <div class="flex items-center justify-center py-3"><span>Mon</span></div>
                        <div class="flex items-center justify-center py-3"><span>Tue</span></div>
                        <div class="flex items-center justify-center py-3"><span>Wed</span></div>
                        <div class="flex items-center justify-center py-3"><span>Thu</span></div>
                        <div class="flex items-center justify-center py-3"><span>Fri</span></div>
                        <div class="flex items-center justify-center py-3"><span>Sat</span></div>
                        <div class="flex items-center justify-center py-3"><span>Sun</span></div>
                    </div>
                </div>

                <div class="flex flex-auto relative">
                    <div class="sticky left-0 z-10 w-14 flex-none bg-white ring-1 ring-gray-100" />
                    <div class="grid flex-auto grid-cols-1 grid-rows-1">
                        <div class="absolute left-0 top-7 pl-14 grid w-full ">
                            <div  class="col-start-1 col-end-2 row-start-1 grid divide-y divide-gray-100"
                                  :style="'grid-template-rows: repeat(48, minmax(3.5rem, 1fr))'">
                                <template v-for="(rowIndex) in 48" :key="rowIndex">
                                    <div class="grid grid-cols-7">
                                        <template v-for="(colIndex) in 7" :key="colIndex">
                                            <div
                                                class="text-center border-r hover:bg-red-300 cursor-pointer"
                                                @click="handleCellClick(rowIndex - 1, colIndex - 1)"
                                            />
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>
a                        <!-- Horizontal lines -->
                        <div
                            class="col-start-1 col-end-2 row-start-1 grid divide-y divide-gray-100"
                            :style="'grid-template-rows: repeat(48, minmax(3.5rem, 1fr))'"
                        >
                            <div ref="containerOffset" class="row-end-1 h-7" />
                            <template v-for="i in 48" :key="i">
                                <div v-if="i % 2 === 1"></div>
                                <div v-else>
                                    <div class="sticky left-0 z-20 -mt-2.5 -ml-14 w-14 text-right text-xs/5 text-gray-400">
                                        {{ formatHourLabel(i / 2 - 1) }}
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Vertical lines -->
                        <div class="col-start-1 col-end-2 row-start-1 hidden grid-cols-7 grid-rows-1 divide-x divide-gray-100 sm:grid sm:grid-cols-7">
                            <div class="col-start-1 row-span-full" />
                            <div class="col-start-2 row-span-full" />
                            <div class="col-start-3 row-span-full" />
                            <div class="col-start-4 row-span-full" />
                            <div class="col-start-5 row-span-full" />
                            <div class="col-start-6 row-span-full" />
                            <div class="col-start-7 row-span-full" />
                        </div>

                        <!-- Events -->
                        <ol
                            class="col-start-1 col-end-2 row-start-1 grid grid-cols-1 sm:grid-cols-7"
                            style="grid-template-rows: 1.75rem repeat(288, minmax(0, 1fr)) auto"
                        >
                            <li
                                v-for="(event, i) in availability"
                                :key="i"
                                @click="emit('select-day', event)"
                                class="relative mt-px flex"
                                :class="`col-start-${event.day_of_week || 1} sm:col-start-${event.day_of_week || 1} bg-red-400 border`"
                                :style="`grid-row: ${timeToGridRow(event.start_time)} / span ${timeToGridRow(event.end_time) - timeToGridRow(event.start_time)}`"
                            >
                                <a
                                    href="#"
                                    class="group absolute inset-1 flex flex-col overflow-y-auto rounded-lg p-2 text-xs/5 hover:bg-opacity-75"
                                >
                                    <p class="order-1 font-semibold">{{ event.title || 'Available' }}</p>
                                    <p class="order-1 font-semibold">Day {{ event.day_of_week }}</p>
                                    <p class="group-hover:text-current">
                                        <time :datetime="`2022-01-12T${event.start_time}`">{{ event.start_time }}</time>
                                        -
                                        <time :datetime="`2022-01-12T${event.end_time}`">{{ event.end_time }}</time>
                                    </p>
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
