<template>
    <TransitionRoot as="template" :show="isOpen">
        <Dialog class="relative z-50" @close="close">
            <!-- Backdrop (fade in/out) -->
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black bg-opacity-50" />
            </TransitionChild>

            <!-- Slide-in Panel -->
            <div class="fixed inset-0 flex justify-end">
                <TransitionChild
                    as="template"
                    enter="transform transition ease duration-300"
                    enter-from="translate-x-full"
                    enter-to="translate-x-0"
                    leave="transform transition ease duration-300"
                    leave-from="translate-x-0"
                    leave-to="translate-x-full"
                >
                    <DialogPanel class="relative w-[500px] h-full bg-white shadow-xl p-6 overflow-y-auto">
                        <slot />
                    </DialogPanel>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { inject } from 'vue'
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'

const { isOpen, close } = inject('sideModal')
</script>
