<script setup>
import { ref, computed, watch } from 'vue'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'

const props = defineProps({
    modelValue: String // Expected format: "HH:mm"
})
const emit = defineEmits(['update:modelValue'])

// Safe default
let initialHour = 0
let initialMinute = 0

if (typeof props.modelValue === 'string' && props.modelValue.includes(':')) {
    const [h, m] = props.modelValue.split(':').map(Number)
    if (!isNaN(h) && !isNaN(m)) {
        initialHour = h
        initialMinute = m
    }
}

const hour = ref(initialHour)
function roundToNearestQuarter(min) {
    return Math.round(min / 15) * 15 % 60
}
const minute = ref(roundToNearestQuarter(initialMinute))

const formattedHour = computed(() => String(hour.value).padStart(2, '0'))
const formattedMinute = computed(() => String(minute.value).padStart(2, '0'))

watch([hour, minute], () => {
    emit('update:modelValue', `${formattedHour.value}:${formattedMinute.value}`)
})

</script>

<template>
    <div class="flex gap-4">
        <!-- Hour Dropdown -->
        <Menu as="div" class="relative inline-block text-left">
            <div>
                <MenuButton class="inline-flex w-20 justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50">
                    {{ formattedHour }}
                    <ChevronDownIcon class="-mr-1 size-5 text-gray-400" />
                </MenuButton>
            </div>

            <transition
                enter-active-class="transition ease-out duration-100"
                enter-from-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75"
                leave-from-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95"
            >
                <MenuItems class="absolute right-0 z-10 mt-2 max-h-60 overflow-y-auto w-20 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                    <div class="py-1">
                        <MenuItem v-for="h in 24" :key="h" v-slot="{ active }">
                            <button
                                @click="hour = h - 1"
                                :class="[
                                  active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                                  'block w-full px-4 py-2 text-sm text-left'
                                ]"
                            >
                                {{ String(h - 1).padStart(2, '0') }}
                            </button>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>

        <!-- Minute Dropdown -->
        <Menu as="div" class="relative inline-block text-left">
            <div>
                <MenuButton class="inline-flex w-20 justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50">
                    {{ formattedMinute }}
                    <ChevronDownIcon class="-mr-1 size-5 text-gray-400" />
                </MenuButton>
            </div>

            <transition
                enter-active-class="transition ease-out duration-100"
                enter-from-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75"
                leave-from-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95"
            >
                <MenuItems class="absolute right-0 z-10 mt-2 max-h-60 overflow-y-auto w-20 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                    <div class="py-1">
                        <MenuItem v-for="m in [0, 15, 30, 45]" :key="m" v-slot="{ active }">
                            <button
                                @click="minute = m"
                                :class="[
                                  active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                                  'block w-full px-4 py-2 text-sm text-left'
                                ]"
                            >
                                {{ String(m).padStart(2, '0') }}
                            </button>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
    </div>
</template>
