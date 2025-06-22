<script setup>
import { computed } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { ChevronUpDownIcon } from '@heroicons/vue/16/solid'
import { CheckIcon } from '@heroicons/vue/20/solid'

const props = defineProps({
    options: {
        type: Array,
        required: true
    },
    modelValue: {
        type: [Number, String], // allows for either, cast as needed
        required: true
    }
})

const emit = defineEmits(['update:modelValue'])

const selectedOption = computed({
    get: () => props.options.find(option => option.id === props.modelValue),
    set: (option) => emit('update:modelValue', option.value)
})
</script>

<template>
    <Listbox v-model="selectedOption" as="div">
        <ListboxLabel class="block text-sm font-medium text-gray-900">Assigned to</ListboxLabel>
        <div class="relative mt-2">
            <ListboxButton
                class="w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left border border-gray-300 focus:outline-none sm:text-sm">
                <span class="block truncate">{{ selectedOption?.name }}</span>
                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
          <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
        </span>
            </ListboxButton>

            <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100"
                        leave-to-class="opacity-0">
                <ListboxOptions
                    class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 sm:text-sm">
                    <ListboxOption
                        v-for="option in options"
                        :key="option.id"
                        :value="option"
                        v-slot="{ selected, active }"
                    >
                        <li :class="[active ? 'bg-indigo-600 text-white' : 'text-gray-900', 'relative cursor-default select-none py-2 pl-3 pr-9']">
                            <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">{{
                                    option.name
                                }}</span>
                            <span v-if="selected"
                                  :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                <CheckIcon class="h-5 w-5" aria-hidden="true"/>
              </span>
                        </li>
                    </ListboxOption>
                </ListboxOptions>
            </transition>
        </div>
    </Listbox>
</template>
